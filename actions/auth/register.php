<?php
declare(strict_types=1);

/**
 * Backend registrasi pengguna CampRent.
 * Role pengguna baru selalu 'user'.
 */

require_once __DIR__ . '/../../includes/bootstrap.php';

// Pastikan permintaan menggunakan metode POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

// Pengguna yang sudah login tidak perlu mendaftar.
if (current_user()) {
    redirect(role_home(current_user()['role']));
}

// Verifikasi keamanan formulir.
if (!csrf_verify()) {
    $_SESSION['register_flash'] = [
        'info' => null,
        'errors' => [
            'Sesi formulir kedaluwarsa. Silakan coba lagi.'
        ],
        'tab' => 'daftar'
    ];

    redirect('auth/login.php');
}

// Ambil data dari formulir.
$data = [
    'fullname' => trim((string) ($_POST['fullname'] ?? '')),
    'email' => trim((string) ($_POST['email'] ?? '')),
    'phone' => trim((string) ($_POST['phone'] ?? '')),
    'password' => (string) ($_POST['password'] ?? ''),
    'confirm_password' => (string) ($_POST['confirm_password'] ?? '')
];

// Validasi data pendaftaran.
$errors = validate_register($data);

// Proses registrasi jika data valid.
if (!$errors) {
    [$ok, $msg] = register_user(
        $data['fullname'],
        $data['email'],
        $data['phone'],
        $data['password']
    );

    if ($ok) {
        $_SESSION['register_flash'] = [
            'info' => 'Pendaftaran berhasil. Silakan masuk.',
            'errors' => [],
            'tab' => 'masuk'
        ];

        redirect('auth/login.php');
    }

    $errors[] = $msg ?? 'Pendaftaran gagal. Silakan coba lagi.';
}

// Simpan pesan kesalahan registrasi.
$_SESSION['register_flash'] = [
    'info' => null,
    'errors' => $errors,
    'tab' => 'daftar'
];

// Kembali ke halaman formulir.
redirect('auth/login.php');
