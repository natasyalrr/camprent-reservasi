<?php
declare(strict_types=1);

/**
 * Backend pengajuan pembatalan reservasi CampRent.
 * Pengajuan akan diproses oleh staff atau admin.
 */

require_once __DIR__ . '/../../includes/bootstrap.php';

// Hanya pengguna dengan role user.
require_role(['user']);

// Pastikan permintaan menggunakan metode POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

// Verifikasi keamanan formulir.
if (!csrf_verify()) {
    http_response_code(400);
    exit('Sesi formulir tidak valid.');
}

/**
 * Menyimpan pesan hasil pengajuan pembatalan.
 */
function cancellation_flash(
    bool $success,
    string $message
): void {
    $_SESSION['cancellation_flash'] = [
        'success' => $success,
        'message' => $message
    ];
}

// Ambil data pengguna yang sedang login.
$user = current_user();
$userId = (int) $user['id'];

// Ambil data dari formulir.
$bookingId = filter_var(
    $_POST['booking_id'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

$reason = isset($_POST['reason']) &&
    is_string($_POST['reason'])
        ? trim($_POST['reason'])
        : '';

$pdo = null;

try {

    // Validasi ID reservasi.
    if ($bookingId === false) {
        throw new DomainException(
            'ID reservasi tidak valid.'
        );
    }

    // Validasi alasan pembatalan.
    if (
        mb_strlen($reason) < 5 ||
        mb_strlen($reason) > 1000
    ) {
        throw new DomainException(
            'Alasan pembatalan harus 5–1000 karakter.'
        );
    }

    // Mulai transaksi database.
    $pdo = db();
    $pdo->beginTransaction();

    // Ambil reservasi milik pengguna yang sedang login.
    // Kunci data untuk mencegah pengajuan bersamaan.
    $stmt = $pdo->prepare(
        'SELECT id, booking_code, user_id,
                booking_status, payment_status,
                total_amount
         FROM bookings
         WHERE id = ? AND user_id = ?
         FOR UPDATE'
    );

    $stmt->execute([
        $bookingId,
        $userId
    ]);

    $booking = $stmt->fetch();

    // Pastikan reservasi tersedia dan dimiliki pengguna.
    if (!$booking) {
        throw new DomainException(
            'Reservasi tidak ditemukan atau bukan milik Anda.'
        );
    }

    // Hanya reservasi pending dan confirmed
    // yang dapat diajukan pembatalannya.
    if (!in_array(
        $booking['booking_status'],
        ['pending', 'confirmed'],
        true
    )) {
        throw new DomainException(
            'Reservasi dengan status ini tidak dapat dibatalkan.'
        );
    }

    // Periksa apakah sudah terdapat pengajuan aktif.
    $stmt = $pdo->prepare(
        "SELECT id, status
         FROM cancellations
         WHERE booking_id = ?
         AND status IN ('pending', 'approved')
         LIMIT 1
         FOR UPDATE"
    );

    $stmt->execute([$bookingId]);

    $existing = $stmt->fetch();

    if ($existing) {

        if ($existing['status'] === 'pending') {
            throw new DomainException(
                'Pengajuan pembatalan sedang menunggu persetujuan.'
            );
        }

        throw new DomainException(
            'Reservasi ini sudah memiliki pembatalan yang disetujui.'
        );
    }

    // Simpan pengajuan pembatalan.
    // Refund belum ditentukan karena masih menunggu review.
    $stmt = $pdo->prepare(
        "INSERT INTO cancellations (
            booking_id,
            reason,
            status,
            refund_amount,
            refund_status
        ) VALUES (
            ?, ?, 'pending', 0, 'not_required'
        )"
    );

    $stmt->execute([
        $bookingId,
        $reason
    ]);

    $cancellationId = (int) $pdo->lastInsertId();

    // Data sebelum pengajuan pembatalan.
    $oldValues = json_encode([
        'booking_id' => $bookingId,
        'booking_status' => $booking['booking_status'],
        'payment_status' => $booking['payment_status']
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

    // Data setelah pengajuan pembatalan.
    $newValues = json_encode([
        'cancellation_id' => $cancellationId,
        'booking_id' => $bookingId,
        'booking_code' => $booking['booking_code'],
        'reason' => $reason,
        'cancellation_status' => 'pending'
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

    // Catat aktivitas pembatalan ke audit_logs.
    $stmt = $pdo->prepare(
        'INSERT INTO audit_logs (
            user_id,
            action,
            entity_type,
            entity_id,
            old_values,
            new_values,
            ip_address
        ) VALUES (?, ?, ?, ?, ?, ?, ?)'
    );

    $stmt->execute([
        $userId,
        'request_cancellation',
        'cancellation',
        (string) $cancellationId,
        $oldValues,
        $newValues,
        $_SERVER['REMOTE_ADDR'] ?? null
    ]);

    // Simpan seluruh transaksi.
    $pdo->commit();

    cancellation_flash(
        true,
        'Pengajuan pembatalan berhasil dikirim. '
        . 'Silakan menunggu persetujuan staff.'
    );

} catch (Throwable $e) {

    // Batalkan transaksi apabila terjadi kesalahan.
    if ($pdo instanceof PDO && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    if ($e instanceof DomainException) {

        $message = $e->getMessage();

    } else {

        error_log(
            'Pengajuan pembatalan gagal: '
            . $e->getMessage()
        );

        $message =
            'Pengajuan pembatalan gagal. Silakan coba lagi.';
    }

    cancellation_flash(false, $message);
}

// Kembali ke halaman riwayat reservasi.
redirect('user/riwayat.php');
