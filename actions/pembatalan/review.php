<?php
/**
 * Staff approve/reject pembatalan.
 * approved → booking cancelled, stok lepas (otomatis, karena hanya booking aktif yang menahan stok),
 *            refund/deposit dicatat; rejected → booking tetap berjalan. Semua tercatat di audit_logs.
 *
 * Field POST: csrf, id, decision (approve|reject), note (wajib untuk reject),
 *             refund_amount (kosong = penuh jika booking sudah paid), refund_processed (1 = sudah diproses)
 */
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/staff_helpers.php';
require_role(['staff', 'admin']);
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify()) {
    http_response_code(400);
    exit('Permintaan tidak valid.');
}

$pdo  = db();
$user = current_user();
$back = 'staff/pembatalan.php';

function review_fail(string $message, string $back): never
{
    staff_flash($message, 'error');
    redirect($back);
}

$id           = (int) ($_POST['id'] ?? 0);
$decision     = (string) ($_POST['decision'] ?? '');
$note         = trim((string) ($_POST['note'] ?? ''));
$processed    = !empty($_POST['refund_processed']);
$refundInput  = trim((string) ($_POST['refund_amount'] ?? ''));

if ($id <= 0) {
    review_fail('ID pembatalan tidak valid.', $back);
}
if (!in_array($decision, ['approve', 'reject'], true)) {
    review_fail('Keputusan harus approve atau reject.', $back);
}
if (mb_strlen($note) > 500) {
    review_fail('Catatan maksimal 500 karakter.', $back);
}
if ($decision === 'reject' && mb_strlen($note) < 3) {
    review_fail('Alasan penolakan wajib diisi.', $back);
}
if ($refundInput !== '' && (!is_numeric($refundInput) || (float) $refundInput < 0)) {
    review_fail('Nominal refund tidak valid.', $back);
}

try {
    $pdo->beginTransaction();
    $abort = function (string $message) use ($pdo, $back): never {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        review_fail($message, $back);
    };

    $stmt = $pdo->prepare('SELECT * FROM cancellations WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    $cancel = $stmt->fetch();
    if (!$cancel) {
        $abort('Pengajuan pembatalan tidak ditemukan.');
    }
    if ($cancel['status'] !== 'pending') {
        $abort('Pengajuan ini sudah diputuskan (' . $cancel['status'] . ').');
    }

    $stmt = $pdo->prepare('SELECT * FROM bookings WHERE id = ? FOR UPDATE');
    $stmt->execute([$cancel['booking_id']]);
    $booking = $stmt->fetch();
    $who   = $user['nama'] ?? 'staff';
    $stamp = date('Y-m-d H:i');

    if ($decision === 'reject') {
        $pdo->prepare(
            "UPDATE cancellations SET status = 'rejected', refund_amount = 0, refund_status = 'not_required',
                    refund_notes = ?, reviewed_by = ?, reviewed_at = NOW() WHERE id = ?"
        )->execute([$note, $user['id'], $id]);
        $pdo->prepare('UPDATE bookings SET notes = ? WHERE id = ?')->execute([
            trim(((string) $booking['notes']) . "\n[$stamp Pembatalan ditolak oleh $who] $note"), $booking['id'],
        ]);
        log_action($pdo, 'cancellation.reject', 'cancellations', $id,
            ['status' => 'pending'], ['status' => 'rejected', 'note' => $note, 'booking_id' => (int) $booking['id']]);
        $pdo->commit();
        staff_flash('Pembatalan ditolak. Booking tetap berjalan.');
        redirect($back);
    }

    // Approve
    if (!in_array($booking['booking_status'], ['pending', 'confirmed'], true)) {
        $abort('Booking berstatus ' . $booking['booking_status'] . ' tidak dapat dibatalkan.');
    }

    $total  = (float) $booking['total_amount'];
    $refund = $refundInput === ''
        ? ($booking['payment_status'] === 'paid' ? $total : 0.0)
        : round((float) $refundInput, 2);
    if ($refund > $total) {
        $abort('Nominal refund tidak boleh melebihi total booking.');
    }
    $refundStatus  = $refund <= 0 ? 'not_required' : ($processed ? 'processed' : 'pending');
    $paymentStatus = $refundStatus === 'processed' ? 'refunded' : $booking['payment_status'];

    $pdo->prepare(
        "UPDATE cancellations SET status = 'approved', refund_amount = ?, refund_status = ?,
                refund_notes = ?, reviewed_by = ?, reviewed_at = NOW() WHERE id = ?"
    )->execute([$refund, $refundStatus, $note !== '' ? $note : null, $user['id'], $id]);

    $entry = "[$stamp Pembatalan disetujui oleh $who]" . ($note !== '' ? " $note" : '');
    $pdo->prepare("UPDATE bookings SET booking_status = 'cancelled', payment_status = ?, notes = ? WHERE id = ?")
        ->execute([$paymentStatus, trim(((string) $booking['notes']) . "\n" . $entry), $booking['id']]);

    if ($refundStatus === 'processed') {
        $pdo->prepare("UPDATE payments SET payment_status = 'refunded' WHERE booking_id = ? AND payment_status = 'paid'")
            ->execute([$booking['id']]);
    }

    // Deposit yang sudah diterima ikut ditandai dikembalikan.
    $pdo->prepare(
        "UPDATE deposit_records SET deposit_status = 'refunded', refund_amount = deposit_amount,
                refunded_at = NOW(), processed_by = ?
         WHERE booking_id = ? AND deposit_status = 'received'"
    )->execute([$user['id'], $booking['id']]);

    log_action($pdo, 'cancellation.approve', 'cancellations', $id,
        ['status' => 'pending', 'booking_status' => $booking['booking_status']],
        ['status' => 'approved', 'booking_status' => 'cancelled', 'booking_id' => (int) $booking['id'],
         'refund_amount' => $refund, 'refund_status' => $refundStatus]);
    $pdo->commit();

    staff_flash('Pembatalan disetujui. Booking dibatalkan dan stok dilepas.');
    redirect($back);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log($e->getMessage());
    review_fail('Terjadi kesalahan pada server.', $back);
}