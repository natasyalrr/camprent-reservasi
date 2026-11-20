<?php
/**
 * Fungsi bantu yang dipakai bersama oleh seluruh anggota tim.
 * Jangan ubah perilaku fungsi tanpa memberi tahu tim.
 */

// Ubah sesuai folder proyek di lokal/hosting. Contoh: '/pemweb/uascamp/camprent-reservasi'
if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

const UPLOAD_DIR = __DIR__ . '/../uploads/';

/* ---------- Session ---------- */

function start_session_once(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
            'secure'   => !empty($_SERVER['HTTPS']),
        ]);
        session_start();
    }
}

/* ---------- Output & respons ---------- */

/** Escape teks sebelum ditampilkan di HTML. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function json_response($data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

/** True jika klien meminta JSON (fetch/AJAX). */
function wants_json(): bool
{
    return strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false
        || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';
}

/** Hentikan proses dengan pesan galat (JSON atau teks biasa). */
function fail(int $status, string $message): void
{
    if (wants_json()) {
        json_response(['error' => $message], $status);
    }
    http_response_code($status);
    exit($message);
}

/** Pastikan request memakai metode yang benar (default POST). */
function require_method(string $method = 'POST'): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== $method) {
        header('Allow: ' . $method);
        fail(405, 'Metode tidak diizinkan');
    }
}

/* ---------- Flash message ---------- */

function flash(string $key, ?string $message = null): ?string
{
    start_session_once();
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }
    $value = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $value;
}

/* ---------- CSRF ---------- */

function csrf_token(): string
{
    start_session_once();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/** Tempel di dalam <form method="post">. */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

/** Panggil di awal setiap action yang mengubah data. Menerima field form atau header X-CSRF-Token. */
function csrf_verify(): void
{
    start_session_once();
    $sent = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!is_string($sent) || empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $sent)) {
        fail(403, 'Token CSRF tidak valid. Muat ulang halaman lalu coba lagi.');
    }
}

/* ---------- Audit log ---------- */

/**
 * Catat tindakan ke tabel audit_logs.
 * Contoh: log_action($pdo, 'booking.confirm', 'bookings', $id, ['booking_status' => 'pending'], ['booking_status' => 'confirmed']);
 */
function log_action(PDO $pdo, string $action, string $entityType, $entityId = null, ?array $old = null, ?array $new = null): void
{
    start_session_once();
    $stmt = $pdo->prepare(
        'INSERT INTO audit_logs (user_id, action, entity_type, entity_id, old_values, new_values, ip_address)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $_SESSION['user']['id'] ?? null,
        $action,
        $entityType,
        $entityId !== null ? (string) $entityId : null,
        $old !== null ? json_encode($old, JSON_UNESCAPED_UNICODE) : null,
        $new !== null ? json_encode($new, JSON_UNESCAPED_UNICODE) : null,
        $_SERVER['REMOTE_ADDR'] ?? null,
    ]);
}

/* ---------- Slug (ID alat, ID paket, slug artikel) ---------- */

function slugify(string $text, int $maxLength = 70): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = substr(trim($text, '-'), 0, $maxLength);
    return rtrim($text, '-') !== '' ? rtrim($text, '-') : 'item';
}

/** Buat slug yang belum dipakai. Tabel dan kolom dibatasi daftar putih. */
function unique_slug(PDO $pdo, string $table, string $column, string $base): string
{
    $allowed = ['equipment' => 'id', 'packages' => 'id', 'articles' => 'slug'];
    if (($allowed[$table] ?? null) !== $column) {
        throw new InvalidArgumentException('Tabel atau kolom tidak diizinkan.');
    }

    $base = slugify($base);
    $slug = $base;
    $i = 2;
    $stmt = $pdo->prepare("SELECT 1 FROM `$table` WHERE `$column` = ?");
    while (true) {
        $stmt->execute([$slug]);
        if (!$stmt->fetchColumn()) {
            return $slug;
        }
        $slug = $base . '-' . $i++;
    }
}

/* ---------- Upload gambar aman ---------- */

/**
 * Simpan gambar unggahan. Mengembalikan path relatif untuk disimpan di database,
 * misalnya 'uploads/images/ab12...ef.jpg'. Melempar Exception jika file tidak valid.
 *
 * Pemeriksaan: status upload, ukuran, MIME dari ISI file (bukan ekstensi),
 * getimagesize, ekstensi ditentukan dari MIME, nama acak berbasis hash.
 */
function save_image(array $file, int $userId, int $maxBytes = 2097152): string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        throw new Exception('Upload gagal atau tidak ada file.');
    }
    if (!is_uploaded_file($file['tmp_name'])) {
        throw new Exception('File tidak valid.');
    }
    if ($file['size'] <= 0 || $file['size'] > $maxBytes) {
        throw new Exception('Ukuran file maksimal ' . intdiv($maxBytes, 1048576) . ' MB.');
    }

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($allowed[$mime]) || @getimagesize($file['tmp_name']) === false) {
        throw new Exception('File bukan gambar JPG, PNG, atau WEBP yang valid.');
    }

    $dir = UPLOAD_DIR . 'images/';
    if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
        throw new Exception('Folder upload tidak dapat dibuat.');
    }

    $name = hash('sha256', date('YmdHis') . '|' . $userId . '|' . random_bytes(16)) . '.' . $allowed[$mime];
    if (!move_uploaded_file($file['tmp_name'], $dir . $name)) {
        throw new Exception('Gagal menyimpan file.');
    }
    return 'uploads/images/' . $name;
}

/** Hapus file unggahan lama. Hanya file di dalam folder uploads/ yang boleh dihapus. */
function delete_upload(?string $relativePath): void
{
    if (!$relativePath || strpos($relativePath, 'uploads/') !== 0) {
        return;
    }
    $full = realpath(__DIR__ . '/../' . $relativePath);
    $base = realpath(UPLOAD_DIR);
    if ($full && $base && strpos($full, $base) === 0 && is_file($full)) {
        unlink($full);
    }
}