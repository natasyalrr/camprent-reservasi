<?php
// Konfigurasi default (XAMPP). Timpa lewat database.local.php jika perlu.
$config = [
    'host'     => 'localhost',
    'dbname'   => 'camprent_db',
    'username' => 'root',
    'password' => '',
];

if (file_exists(__DIR__ . '/database.local.php')) {
    $config = array_merge($config, require __DIR__ . '/database.local.php');
}

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
        $config['username'],
        $config['password'],
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('Koneksi database gagal.');
}