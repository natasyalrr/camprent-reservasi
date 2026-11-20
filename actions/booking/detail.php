<?php
// GET ?id=2 -> detail satu booking: item, pembayaran, pembatalan, pengambilan, deposit.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('GET');
require_staff();

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    fail(422, 'ID booking tidak valid.');
}

$stmt = $pdo->prepare(
    'SELECT b.*, bc.city AS basecamp_city, bc.branch_name AS basecamp_name
     FROM bookings b
     JOIN basecamps bc ON bc.id = b.basecamp_id
     WHERE b.id = ?'
);
$stmt->execute([$id]);
$booking = $stmt->fetch();
if (!$booking) {
    fail(404, 'Booking tidak ditemukan.');
}

function booking_rows(PDO $pdo, string $sql, int $id): array
{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

$booking['id'] = (int) $booking['id'];
$booking['user_id'] = (int) $booking['user_id'];
$booking['total_days'] = (int) $booking['total_days'];
$booking['subtotal'] = (float) $booking['subtotal'];
$booking['total_amount'] = (float) $booking['total_amount'];

$booking['items'] = booking_rows($pdo,
    'SELECT id, equipment_id, package_id, item_name, quantity, daily_rate, subtotal
     FROM booking_items WHERE booking_id = ? ORDER BY id', $id);
$booking['payments'] = booking_rows($pdo,
    'SELECT payment_code, payment_method, amount, payment_status, paid_at, notes
     FROM payments WHERE booking_id = ? ORDER BY id', $id);
$booking['cancellations'] = booking_rows($pdo,
    'SELECT id, reason, status, refund_amount, refund_status, refund_notes, reviewed_by, reviewed_at, created_at
     FROM cancellations WHERE booking_id = ? ORDER BY id', $id);
$booking['pickup'] = booking_rows($pdo,
    'SELECT pickup_code, picked_up_at, verified_by, pickup_status, checklist_confirmed, notes
     FROM pickup_records WHERE booking_id = ?', $id)[0] ?? null;
$booking['deposits'] = booking_rows($pdo,
    'SELECT deposit_amount, deduction_amount, refund_amount, deposit_status, received_at, refunded_at, notes
     FROM deposit_records WHERE booking_id = ? ORDER BY id', $id);

// Aksi yang boleh dilakukan Staff pada status saat ini (membantu frontend menampilkan tombol).
$booking['allowed_actions'] = $booking['booking_status'] === 'pending' ? ['confirm', 'reject'] : [];

json_response(['data' => $booking, 'csrf' => csrf_token()]);