<?php
/**
 * Helper khusus Staff/Admin (Ani). Dimuat manual: require_once __DIR__ . '/../../includes/staff_helpers.php';
 * Bergantung pada bootstrap.php (e, redirect, current_user) dan db.php.
 */

const UPLOAD_DIR = ROOT_PATH . '/uploads/';

/* ---------- Flash message ---------- */

function staff_flash(string $message, string $type = 'success'): void
{
    $_SESSION['staff_flash'] = ['type' => $type, 'message' => $message];
}

/** Cetak pesan flash (sekali tampil). Panggil di halaman yang menampilkan hasil aksi. */
function staff_flash_render(): string
{
    $f = $_SESSION['staff_flash'] ?? null;
    unset($_SESSION['staff_flash']);
    if (!$f) {
        return '';
    }
    $cls = $f['type'] === 'error' ? 'bg-red-100 text-red-800 border-red-300' : 'bg-green-100 text-green-800 border-green-300';
    return '<div class="mb-4 px-4 py-3 rounded-lg border ' . $cls . '" role="alert">' . e($f['message']) . '</div>';
}

/* ---------- Audit log ---------- */

function log_action(PDO $pdo, string $action, string $entityType, $entityId = null, ?array $old = null, ?array $new = null): void
{
    $stmt = $pdo->prepare(
        'INSERT INTO audit_logs (user_id, action, entity_type, entity_id, old_values, new_values, ip_address)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        current_user()['id'] ?? null,
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

function delete_upload(?string $relativePath): void
{
    if (!$relativePath || strpos($relativePath, 'uploads/') !== 0) {
        return;
    }
    $full = realpath(ROOT_PATH . '/' . $relativePath);
    $base = realpath(UPLOAD_DIR);
    if ($full && $base && strpos($full, $base) === 0 && is_file($full)) {
        unlink($full);
    }
}