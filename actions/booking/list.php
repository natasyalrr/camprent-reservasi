<?php
// GET -> daftar booking untuk Staff.
// Parameter: status (opsional), q (kode/nama/email), limit (maks 200, default 50), offset.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('GET');
require_staff();

$validStatus = ['pending', 'confirmed', 'rented', 'rejected', 'cancelled', 'completed'];
$where = [];
$params = [];

$status = trim((string) ($_GET['status'] ?? ''));
if ($status !== '') {
    if (!in_array($status, $validStatus, true)) {
        fail(422, 'Status tidak valid.');
    }
    $where[] = 'b.booking_status = ?';
    $params[] = $status;
}

$q = trim((string) ($_GET['q'] ?? ''));
if ($q !== '') {
    $like = '%' . addcslashes($q, '%_\\') . '%';
    $where[] = '(b.booking_code LIKE ? OR b.renter_name LIKE ? OR b.renter_email LIKE ?)';
    array_push($params, $like, $like, $like);
}

$limit = min(200, max(1, (int) ($_GET['limit'] ?? 50)));
$offset = max(0, (int) ($_GET['offset'] ?? 0));
$sqlWhere = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings b $sqlWhere");
$stmt->execute($params);
$total = (int) $stmt->fetchColumn();

$stmt = $pdo->prepare(
    "SELECT b.id, b.booking_code, b.renter_name, b.renter_email, b.renter_phone, b.basecamp_id,
            bc.city AS basecamp_city, b.destination_mountain, b.start_date, b.end_date, b.total_days,
            b.total_amount, b.booking_status, b.payment_status, b.created_at,
            (SELECT COUNT(*) FROM booking_items bi WHERE bi.booking_id = b.id) AS item_count
     FROM bookings b
     JOIN basecamps bc ON bc.id = b.basecamp_id
     $sqlWhere
     ORDER BY b.created_at DESC, b.id DESC
     LIMIT $limit OFFSET $offset"
);
$stmt->execute($params);
$rows = $stmt->fetchAll();

foreach ($rows as &$r) {
    $r['id'] = (int) $r['id'];
    $r['total_days'] = (int) $r['total_days'];
    $r['total_amount'] = (float) $r['total_amount'];
    $r['item_count'] = (int) $r['item_count'];
}
unset($r);

json_response(['data' => $rows, 'total' => $total, 'limit' => $limit, 'offset' => $offset, 'csrf' => csrf_token()]);