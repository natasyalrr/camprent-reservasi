<?php
/**
 * bootstrap.php — dimuat di baris pertama SETIAP halaman.
 * Isi: konfigurasi, sesi aman, helper (e, url, asset, redirect), auth.
 */
declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));

// Konfigurasi: config/database.local.php (lokal, TIDAK di-commit) → jika belum ada, pakai database.example.php
$dbFile = ROOT_PATH . '/config/database.local.php';
$GLOBALS['config'] = [
    'app_name' => 'CampRent',
    'base_url' => null,                                   // null = deteksi otomatis
    'db'       => require (is_file($dbFile) ? $dbFile : ROOT_PATH . '/config/database.example.php'),
];

if (session_status() === PHP_SESSION_NONE) {
    session_name('camprent_sid');
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');

/** Folder proyek relatif terhadap document root (kosong jika proyek = document root). */
if (!defined('BASE_URL')) {
    $cfgBase = $GLOBALS['config']['base_url'] ?? null;
    if ($cfgBase !== null) {
        define('BASE_URL', rtrim($cfgBase, '/'));
    } else {
        $doc  = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
        $root = str_replace('\\', '/', ROOT_PATH);
        define('BASE_URL', ($doc !== '' && str_starts_with($root, $doc)) ? substr($root, strlen($doc)) : '');
    }
}

/** Baca konfigurasi: config('db.host'). */
function config(string $key, mixed $default = null): mixed
{
    $val = $GLOBALS['config'];
    foreach (explode('.', $key) as $part) {
        if (!is_array($val) || !array_key_exists($part, $val)) {
            return $default;
        }
        $val = $val[$part];
    }
    return $val;
}

/** Escape output HTML. WAJIB dipakai untuk semua data dari user/database. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** URL halaman: url('user/katalog.php'). */
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/** URL aset: asset('images/tenda-dome.jpg'). */
function asset(string $path): string
{
    return BASE_URL . '/assets/' . ltrim($path, '/');
}

function redirect(string $path): never
{
    $to = (str_starts_with($path, 'http') || str_starts_with($path, '/')) ? $path : url($path);
    header('Location: ' . $to);
    exit;
}

/** Format tanggal Indonesia: "Jumat, 20 November 2026". */
function tanggal_id(?int $ts = null): string
{
    $ts ??= time();
    $hari  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return $hari[(int) date('w', $ts)] . ', ' . date('j', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts);
}

/** Format rupiah: rupiah(35000) => "Rp35.000". */
function rupiah(int|float $n): string
{
    return 'Rp' . number_format((float) $n, 0, ',', '.');
}

require_once __DIR__ . '/auth.php';
