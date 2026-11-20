<?php
/**
 * Pemeriksaan login dan role. Dipanggil di setiap halaman dan action yang dilindungi.
 *
 * Kesepakatan dengan bagian login (Difa):
 *   $_SESSION['user'] = ['id' => int, 'full_name' => string, 'email' => string, 'role' => 'user'|'staff'|'admin'];
 *   Sesi dimulai lewat start_session_once() dari functions.php.
 */

require_once __DIR__ . '/functions.php';

function current_user(): ?array
{
    start_session_once();
    return $_SESSION['user'] ?? null;
}

/** Wajib login. Mengembalikan data user. */
function require_login(): array
{
    $user = current_user();
    if (!$user) {
        if (wants_json()) {
            json_response(['error' => 'Belum login'], 401);
        }
        redirect(BASE_URL . '/auth/login.php');
    }
    return $user;
}

/** Wajib login dengan salah satu role yang diizinkan. */
function require_role(array $roles): array
{
    $user = require_login();
    if (!in_array($user['role'] ?? '', $roles, true)) {
        fail(403, 'Akses ditolak');
    }
    return $user;
}

/** Staff dan Admin. */
function require_staff(): array
{
    return require_role(['staff', 'admin']);
}

/** Khusus Admin. */
function require_admin(): array
{
    return require_role(['admin']);
}
