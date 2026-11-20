<?php
/**
 * auth.php — login, sesi, proteksi rute, CSRF.
 *
 * TAHAP FRONTEND: pengguna dibaca dari includes/demo_users.php (password di-hash).
 * TODO(backend): ganti find_user_by_email() dan register_user() dengan query PDO
 *                ke tabel `users`. Fungsi lain TIDAK perlu diubah.
 */
declare(strict_types=1);

/* ---------------------------------------------------------------- data pengguna */

/** @return array<int, array<string, mixed>> */
function demo_users(): array
{
    return require __DIR__ . '/demo_users.php';
}

/** Cari pengguna by email. TODO(backend): SELECT id,nama,email,password_hash,role,status FROM users WHERE email = ? */
function find_user_by_email(string $email): ?array
{
    foreach (demo_users() as $u) {
        if (strcasecmp($u['email'], $email) === 0) {
            return $u;
        }
    }
    return null;
}

/**
 * Daftar akun baru. TODO(backend): INSERT ke `users` dengan password_hash($password, PASSWORD_DEFAULT),
 * role selalu 'user'. Kembalikan [true, null] jika berhasil atau [false, 'pesan galat'].
 */
function register_user(string $nama, string $email, string $telepon, string $password): array
{
    return [false, 'Pendaftaran akan aktif setelah database terhubung (tugas backend).'];
}

/** Validasi form pendaftaran. Mengembalikan daftar pesan galat (kosong = valid). */
function validate_register(array $in): array
{
    $err = [];
    $nama = trim((string) ($in['fullname'] ?? ''));
    if (mb_strlen($nama) < 3 || mb_strlen($nama) > 100) {
        $err[] = 'Nama lengkap 3–100 karakter.';
    }
    if (!filter_var($in['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $err[] = 'Format email tidak valid.';
    }
    if (!preg_match('/^(\+62|62|0)8\d{7,12}$/', preg_replace('/[\s-]/', '', (string) ($in['phone'] ?? '')))) {
        $err[] = 'Nomor telepon tidak valid (contoh 081234567890).';
    }
    $pw = (string) ($in['password'] ?? '');
    if (strlen($pw) < 8 || !preg_match('/[A-Za-z]/', $pw) || !preg_match('/\d/', $pw)) {
        $err[] = 'Kata sandi minimal 8 karakter, berisi huruf dan angka.';
    }
    if ($pw !== (string) ($in['confirm_password'] ?? '')) {
        $err[] = 'Konfirmasi kata sandi tidak sama.';
    }
    return $err;
}

/* ---------------------------------------------------------------- sesi */

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function login_user(array $u): void
{
    session_regenerate_id(true);                       // cegah session fixation
    $_SESSION['user'] = ['id' => $u['id'], 'nama' => $u['nama'], 'email' => $u['email'], 'role' => $u['role']];
    unset($_SESSION['login_fail'], $_SESSION['login_lock']);
}

function logout_user(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $p['path'], $p['domain'], (bool) $p['secure'], (bool) $p['httponly']);
    }
    session_destroy();
}

function role_home(string $role): string
{
    return $role === 'user' ? 'index.php' : 'staff/dashboard.php';
}

function role_label(string $role): string
{
    return ['admin' => 'Administrator', 'staff' => 'Staff Operasional', 'user' => 'Penyewa'][$role] ?? $role;
}

/** Path halaman saat ini relatif ke root proyek, mis. "staff/dashboard.php". */
function current_path(): string
{
    return ltrim(substr((string) ($_SERVER['SCRIPT_NAME'] ?? ''), strlen(BASE_URL)), '/');
}

/** Hanya izinkan tujuan redirect berupa file .php internal (cegah open redirect). */
function safe_next(?string $next): ?string
{
    return ($next !== null && preg_match('#^[A-Za-z0-9_\-/]+\.php$#', $next)) ? $next : null;
}

/* ---------------------------------------------------------------- proteksi rute */

function require_login(): void
{
    if (!current_user()) {
        redirect('auth/login.php?next=' . rawurlencode(current_path()));
    }
}

/** Contoh: require_role(['admin']) di halaman khusus admin. */
function require_role(array $roles): void
{
    require_login();
    if (!in_array(current_user()['role'], $roles, true)) {
        http_response_code(403);
        $home = url(role_home(current_user()['role']));
        echo '<!doctype html><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">'
           . '<title>Akses ditolak</title><body style="font-family:system-ui;background:#fef9ef;color:#1d1c16;display:grid;place-items:center;min-height:100vh;margin:0">'
           . '<div style="text-align:center;padding:24px"><h1 style="margin:0 0 8px">403 — Akses ditolak</h1>'
           . '<p>Akun <b>' . e(role_label(current_user()['role'])) . '</b> tidak boleh membuka halaman ini.</p>'
           . '<a href="' . e($home) . '" style="color:#275334;font-weight:700">Kembali</a></div></body>';
        exit;
    }
}

/* ---------------------------------------------------------------- CSRF */

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_verify(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], (string) $_POST['csrf']);
}

/* ---------------------------------------------------------------- pembatas percobaan login */

function login_locked_seconds(): int
{
    return max(0, (int) ($_SESSION['login_lock'] ?? 0) - time());
}

function login_register_failure(): void
{
    $_SESSION['login_fail'] = (int) ($_SESSION['login_fail'] ?? 0) + 1;
    if ($_SESSION['login_fail'] >= 5) {
        $_SESSION['login_lock'] = time() + 60;
        $_SESSION['login_fail'] = 0;
    }
}
