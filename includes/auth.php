<?php
/**
 * auth.php — login, registrasi, sesi, proteksi rute, CSRF.
 *
 * Autentikasi pengguna menggunakan database MySQL
 * melalui koneksi PDO pada includes/db.php.
 */
declare(strict_types=1);

require_once __DIR__ . '/db.php';

/* ---------------------------------------------------------------- data pengguna */

/** @return array<int, array<string, mixed>> */
function demo_users(): array
{
    return require __DIR__ . '/demo_users.php';
}

/** Cari pengguna aktif berdasarkan email dari database. */
function find_user_by_email(string $email): ?array
{
    $stmt = db()->prepare(
        'SELECT id, full_name AS nama, email, phone,
                password_hash, role, is_active
         FROM users
         WHERE email = ? AND is_active = 1
         LIMIT 1'
    );

    $stmt->execute([trim($email)]);

    return $stmt->fetch() ?: null;
}

/**
 * Daftar akun baru ke database.
 * Password disimpan menggunakan password_hash().
 * Role pengguna baru selalu 'user'.
 */
function register_user(
    string $nama,
    string $email,
    string $telepon,
    string $password
): array {
    $nama = trim($nama);
    $email = trim($email);
    $telepon = preg_replace('/[\s-]/', '', $telepon);

    try {
        $pdo = db();

        // Periksa apakah email sudah terdaftar.
        $stmt = $pdo->prepare(
            'SELECT id FROM users WHERE email = ? LIMIT 1'
        );

        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            return [false, 'Email sudah terdaftar.'];
        }

        // Hash password sebelum disimpan.
        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        // Simpan akun pengguna baru.
        $stmt = $pdo->prepare(
            "INSERT INTO users
            (full_name, email, phone, password_hash, role, is_active)
            VALUES (?, ?, ?, ?, 'user', 1)"
        );

        $stmt->execute([
            $nama,
            $email,
            $telepon,
            $passwordHash
        ]);

        return [true, null];

    } catch (PDOException $e) {
        // Menangani email duplikat.
        if (($e->errorInfo[1] ?? 0) == 1062) {
            return [false, 'Email sudah terdaftar.'];
        }

        // Catat kesalahan tanpa menampilkan detail database.
        error_log('Registrasi gagal: ' . $e->getMessage());

        return [
            false,
            'Pendaftaran gagal. Silakan coba lagi.'
        ];
    }
}

/** Validasi form pendaftaran. */
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

    if (!preg_match(
        '/^(\+62|62|0)8\d{7,12}$/',
        preg_replace('/[\s-]/', '', (string) ($in['phone'] ?? ''))
    )) {
        $err[] = 'Nomor telepon tidak valid (contoh 081234567890).';
    }

    $pw = (string) ($in['password'] ?? '');

    if (
        strlen($pw) < 8 ||
        !preg_match('/[A-Za-z]/', $pw) ||
        !preg_match('/\d/', $pw)
    ) {
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
    session_regenerate_id(true);

    $_SESSION['user'] = [
        'id' => $u['id'],
        'nama' => $u['nama'],
        'email' => $u['email'],
        'role' => $u['role']
    ];

    unset($_SESSION['login_fail'], $_SESSION['login_lock']);
}

function logout_user(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 3600,
            $p['path'],
            $p['domain'],
            (bool) $p['secure'],
            (bool) $p['httponly']
        );
    }

    session_destroy();
}

function role_home(string $role): string
{
    return $role === 'user'
        ? 'index.php'
        : 'staff/dashboard.php';
}

function role_label(string $role): string
{
    return [
        'admin' => 'Administrator',
        'staff' => 'Staff Operasional',
        'user' => 'Penyewa'
    ][$role] ?? $role;
}

/** Path halaman saat ini relatif ke root proyek. */
function current_path(): string
{
    return ltrim(
        substr(
            (string) ($_SERVER['SCRIPT_NAME'] ?? ''),
            strlen(BASE_URL)
        ),
        '/'
    );
}

/** Hanya izinkan tujuan redirect berupa file PHP internal. */
function safe_next(?string $next): ?string
{
    return (
        $next !== null &&
        preg_match('#^[A-Za-z0-9_\-/]+\.php$#', $next)
    ) ? $next : null;
}

/* ---------------------------------------------------------------- proteksi rute */

function require_login(): void
{
    if (!current_user()) {
        redirect(
            'auth/login.php?next=' .
            rawurlencode(current_path())
        );
    }
}

/** Proteksi halaman berdasarkan role pengguna. */
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
    return '<input type="hidden" name="csrf" value="'
        . e(csrf_token()) . '">';
}

function csrf_verify(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && hash_equals(
            $_SESSION['csrf'],
            (string) $_POST['csrf']
        );
}

/* ---------------------------------------------------------------- pembatas percobaan login */

function login_locked_seconds(): int
{
    return max(
        0,
        (int) ($_SESSION['login_lock'] ?? 0) - time()
    );
}

function login_register_failure(): void
{
    $_SESSION['login_fail'] =
        (int) ($_SESSION['login_fail'] ?? 0) + 1;

    if ($_SESSION['login_fail'] >= 5) {
        $_SESSION['login_lock'] = time() + 60;
        $_SESSION['login_fail'] = 0;
    }
}
