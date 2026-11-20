<?php
// POST -> konfirmasi atau tolak booking berstatus pending.
// Body: {"id": 2, "decision": "confirm" | "reject", "note": "alasan (wajib untuk reject)"}
// Header: X-CSRF-Token
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('POST');
$user = require_staff();
csrf_verify();

$in = request_data();
$id = (int) ($in['id'] ?? 0);
$decision = (string) ($in['decision'] ?? '');
$note = trim((string) ($in['note'] ?? ''));

if ($id <= 0) {
    fail(422, 'ID booking tidak valid.');
}
if (!in_array($decision, ['confirm', 'reject'], true)) {
    fail(422, 'Keputusan harus confirm atau reject.');
}
if (mb_strlen($note) > 500) {
    fail(422, 'Catatan maksimal 500 karakter.');
}
if ($decision === 'reject' && mb_strlen($note) < 3) {
    fail(422, 'Alasan penolakan wajib diisi.');
}

/** Kebutuhan alat booking ini: [equipment_id => jumlah]. Item paket diuraikan menjadi isinya. */
function booking_demand(PDO $pdo, int $bookingId): array
{
    $demand = [];
    $stmt = $pdo->prepare('SELECT equipment_id, package_id, quantity FROM booking_items WHERE booking_id = ?');
    $stmt->execute([$bookingId]);
    $pkgStmt = $pdo->prepare('SELECT equipment_id, quantity FROM package_items WHERE package_id = ?');
    foreach ($stmt->fetchAll() as $item) {
        $qty = (int) $item['quantity'];
        if ($item['equipment_id'] !== null) {
            $demand[$item['equipment_id']] = ($demand[$item['equipment_id']] ?? 0) + $qty;
        } else {
            $pkgStmt->execute([$item['package_id']]);
            foreach ($pkgStmt->fetchAll() as $pi) {
                $demand[$pi['equipment_id']] = ($demand[$pi['equipment_id']] ?? 0) + $qty * (int) $pi['quantity'];
            }
        }
    }
    return $demand;
}

/** Alat yang stoknya tidak cukup untuk booking ini. Kosong berarti aman dikonfirmasi. */
function booking_shortages(PDO $pdo, array $booking): array
{
    $shortages = [];
    $stockStmt = $pdo->prepare(
        'SELECT total_units - unavailable_units FROM equipment_stocks WHERE equipment_id = ? AND basecamp_id = ?'
    );
    $overlap = 'b.basecamp_id = ? AND b.booking_status IN (\'confirmed\', \'rented\') AND b.id <> ?
                AND b.start_date <= ? AND b.end_date >= ?';
    $direct = $pdo->prepare(
        "SELECT COALESCE(SUM(bi.quantity), 0) FROM booking_items bi
         JOIN bookings b ON b.id = bi.booking_id
         WHERE bi.equipment_id = ? AND $overlap"
    );
    $viaPackage = $pdo->prepare(
        "SELECT COALESCE(SUM(bi.quantity * pi.quantity), 0) FROM booking_items bi
         JOIN package_items pi ON pi.package_id = bi.package_id
         JOIN bookings b ON b.id = bi.booking_id
         WHERE pi.equipment_id = ? AND $overlap"
    );
    $nameStmt = $pdo->prepare('SELECT name FROM equipment WHERE id = ?');

    foreach (booking_demand($pdo, (int) $booking['id']) as $equipmentId => $needed) {
        $stockStmt->execute([$equipmentId, $booking['basecamp_id']]);
        $usable = (int) ($stockStmt->fetchColumn() ?: 0);
        $args = [$equipmentId, $booking['basecamp_id'], $booking['id'], $booking['end_date'], $booking['start_date']];
        $direct->execute($args);
        $viaPackage->execute($args);
        $available = $usable - (int) $direct->fetchColumn() - (int) $viaPackage->fetchColumn();
        if ($available < $needed) {
            $nameStmt->execute([$equipmentId]);
            $shortages[] = [
                'equipment_id' => $equipmentId,
                'name'         => $nameStmt->fetchColumn() ?: $equipmentId,
                'needed'       => $needed,
                'available'    => max(0, $available),
            ];
        }
    }
    return $shortages;
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT * FROM bookings WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    $booking = $stmt->fetch();
    if (!$booking) {
        $pdo->rollBack();
        fail(404, 'Booking tidak ditemukan.');
    }
    if ($booking['booking_status'] !== 'pending') {
        $pdo->rollBack();
        fail(409, 'Hanya booking berstatus pending yang bisa diproses (status saat ini: ' . $booking['booking_status'] . ').');
    }

    if ($decision === 'confirm') {
        // Kunci stok basecamp agar dua konfirmasi bersamaan tidak sama-sama lolos.
        $pdo->prepare('SELECT id FROM equipment_stocks WHERE basecamp_id = ? FOR UPDATE')->execute([$booking['basecamp_id']]);
        $shortages = booking_shortages($pdo, $booking);
        if ($shortages) {
            $pdo->rollBack();
            json_response(['error' => 'Stok tidak cukup untuk mengonfirmasi booking ini.', 'shortages' => $shortages], 409);
        }
    }

    $newStatus = $decision === 'confirm' ? 'confirmed' : 'rejected';
    $label = $decision === 'confirm' ? 'Dikonfirmasi' : 'Ditolak';
    $entry = '[' . date('Y-m-d H:i') . ' ' . $label . ' oleh ' . ($user['full_name'] ?? 'staff') . ']'
           . ($note !== '' ? ' ' . $note : '');
    $notes = trim(((string) $booking['notes']) . "\n" . $entry);

    $pdo->prepare('UPDATE bookings SET booking_status = ?, notes = ? WHERE id = ?')->execute([$newStatus, $notes, $id]);
    log_action(
        $pdo,
        'booking.' . $decision,
        'bookings',
        $id,
        ['booking_status' => 'pending'],
        ['booking_status' => $newStatus, 'note' => $note !== '' ? $note : null]
    );
    $pdo->commit();

    json_response(['message' => $decision === 'confirm' ? 'Booking dikonfirmasi.' : 'Booking ditolak.', 'booking_status' => $newStatus]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}