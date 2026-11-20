<?php
// GET -> ringkasan dashboard Staff: sewa hari ini, pembatalan menunggu, pendapatan, transaksi terbaru.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('GET');
require_staff();

$rentalsToday = (int) $pdo->query(
    "SELECT COUNT(*) FROM bookings
     WHERE booking_status IN ('confirmed', 'rented') AND CURDATE() BETWEEN start_date AND end_date"
)->fetchColumn();

$pendingCancellations = (int) $pdo->query("SELECT COUNT(*) FROM cancellations WHERE status = 'pending'")->fetchColumn();

// Pendapatan dummy: total booking yang sudah dibayar dan tidak dibatalkan/ditolak.
$revenue = (float) $pdo->query(
    "SELECT COALESCE(SUM(total_amount), 0) FROM bookings
     WHERE payment_status = 'paid' AND booking_status IN ('confirmed', 'rented', 'completed')"
)->fetchColumn();

$byStatus = ['pending' => 0, 'confirmed' => 0, 'rented' => 0, 'rejected' => 0, 'cancelled' => 0, 'completed' => 0];
foreach ($pdo->query('SELECT booking_status, COUNT(*) AS n FROM bookings GROUP BY booking_status')->fetchAll() as $r) {
    $byStatus[$r['booking_status']] = (int) $r['n'];
}

$recent = $pdo->query(
    'SELECT id, booking_code, renter_name, start_date, end_date, total_amount, booking_status, payment_status, created_at
     FROM bookings ORDER BY created_at DESC, id DESC LIMIT 10'
)->fetchAll();
foreach ($recent as &$r) {
    $r['id'] = (int) $r['id'];
    $r['total_amount'] = (float) $r['total_amount'];
}
unset($r);

json_response([
    'rentals_today'         => $rentalsToday,
    'pending_cancellations' => $pendingCancellations,
    'pending_bookings'      => $byStatus['pending'],
    'revenue'               => $revenue,
    'bookings_by_status'    => $byStatus,
    'recent_bookings'       => $recent,
    'csrf'                  => csrf_token(),
]);