<?php
declare(strict_types=1);

/**
 * Backend pembuatan reservasi CampRent.
 * Validasi tanggal, stok, harga, dan pembayaran sandbox.
 */

require_once __DIR__ . '/../../includes/bootstrap.php';

require_role(['user']);

// Hanya menerima permintaan POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

// Verifikasi CSRF.
if (!csrf_verify()) {
    http_response_code(400);
    exit('Sesi formulir tidak valid.');
}

/**
 * Menyimpan pesan booking ke dalam session.
 */
function booking_flash(
    bool $success,
    string $message,
    ?string $code = null
): void {
    $_SESSION['booking_flash'] = [
        'success' => $success,
        'message' => $message,
        'booking_code' => $code
    ];
}

/**
 * Validasi tanggal dengan format YYYY-MM-DD.
 */
function valid_booking_date(string $value): bool
{
    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);

    return $date !== false
        && $date->format('Y-m-d') === $value;
}

$user = current_user();

$userId = (int) $user['id'];

$basecampId = trim((string) ($_POST['basecamp_id'] ?? ''));
$startDate = trim((string) ($_POST['start_date'] ?? ''));
$endDate = trim((string) ($_POST['end_date'] ?? ''));

$renterName = trim((string) ($_POST['renter_name'] ?? ''));
$renterEmail = trim((string) ($_POST['renter_email'] ?? ''));
$renterPhone = trim((string) ($_POST['renter_phone'] ?? ''));

$destination = trim(
    (string) ($_POST['destination_mountain'] ?? '')
);

$notes = trim((string) ($_POST['notes'] ?? ''));

$items = $_POST['items'] ?? [];

$pdo = null;

try {
    // Validasi informasi penyewa.
    if (
        $renterName === '' ||
        mb_strlen($renterName) > 120
    ) {
        throw new DomainException('Nama penyewa tidak valid.');
    }

    if (
        !filter_var($renterEmail, FILTER_VALIDATE_EMAIL) ||
        strlen($renterEmail) > 190
    ) {
        throw new DomainException('Email penyewa tidak valid.');
    }

    $renterPhone = preg_replace('/[\s-]/', '', $renterPhone);

    if (!preg_match('/^(\+62|62|0)8\d{7,12}$/', $renterPhone)) {
        throw new DomainException('Nomor telepon tidak valid.');
    }

    if (mb_strlen($destination) > 180) {
        throw new DomainException('Nama tujuan terlalu panjang.');
    }

    // Validasi tanggal sewa.
    if (
        !valid_booking_date($startDate) ||
        !valid_booking_date($endDate)
    ) {
        throw new DomainException('Format tanggal sewa tidak valid.');
    }

    $timezone = new DateTimeZone('Asia/Jakarta');

    $start = new DateTimeImmutable($startDate, $timezone);
    $end = new DateTimeImmutable($endDate, $timezone);
    $today = new DateTimeImmutable('today', $timezone);

    if ($start < $today) {
        throw new DomainException(
            'Tanggal mulai tidak boleh sebelum hari ini.'
        );
    }

    if ($end < $start) {
        throw new DomainException(
            'Tanggal selesai tidak boleh sebelum tanggal mulai.'
        );
    }

    $totalDays = (int) $start->diff($end)->days + 1;

    if ($totalDays > 14) {
        throw new DomainException(
            'Durasi penyewaan maksimal 14 hari.'
        );
    }

    if (!is_array($items) || !$items || count($items) > 100) {
        throw new DomainException(
            'Pilih minimal satu alat atau paket penyewaan.'
        );
    }

    // Gunakan transaksi agar data tersimpan secara konsisten.
    $pdo = db();
    $pdo->beginTransaction();

    // Periksa basecamp aktif dan kunci reservasi pada basecamp.
    $stmt = $pdo->prepare(
        'SELECT id
         FROM basecamps
         WHERE id = ? AND is_active = 1
         FOR UPDATE'
    );

    $stmt->execute([$basecampId]);

    if (!$stmt->fetch()) {
        throw new DomainException('Basecamp tidak tersedia.');
    }

    $bookingItems = [];
    $requiredStocks = [];
    $totalCents = 0;

    // Proses setiap barang yang akan disewa.
    foreach ($items as $item) {

        if (!is_array($item)) {
            throw new DomainException('Data barang tidak valid.');
        }

        $type = (string) ($item['type'] ?? '');
        $itemId = trim((string) ($item['id'] ?? ''));

        $quantity = filter_var(
            $item['quantity'] ?? null,
            FILTER_VALIDATE_INT,
            ['options' => [
                'min_range' => 1,
                'max_range' => 100
            ]]
        );

        if (
            $itemId === '' ||
            $quantity === false ||
            !in_array($type, ['equipment', 'package'], true)
        ) {
            throw new DomainException('Data barang tidak valid.');
        }

        $equipmentId = null;
        $packageId = null;

        if ($type === 'equipment') {

            // Ambil data dan harga alat langsung dari database.
            $stmt = $pdo->prepare(
                'SELECT id, name, daily_rate
                 FROM equipment
                 WHERE id = ? AND is_active = 1'
            );

            $stmt->execute([$itemId]);
            $product = $stmt->fetch();

            if (!$product) {
                throw new DomainException('Alat tidak tersedia.');
            }

            $equipmentId = $itemId;

            $requiredStocks[$itemId] =
                ($requiredStocks[$itemId] ?? 0) + $quantity;

        } else {

            // Ambil data paket.
            $stmt = $pdo->prepare(
                'SELECT id, name, daily_rate
                 FROM packages
                 WHERE id = ? AND is_active = 1'
            );

            $stmt->execute([$itemId]);
            $product = $stmt->fetch();

            if (!$product) {
                throw new DomainException('Paket tidak tersedia.');
            }

            $packageId = $itemId;

            // Periksa komponen alat dalam paket.
            $stmt = $pdo->prepare(
                'SELECT equipment_id, quantity
                 FROM package_items
                 WHERE package_id = ?'
            );

            $stmt->execute([$itemId]);
            $components = $stmt->fetchAll();

            if (!$components) {
                throw new DomainException(
                    'Komponen paket belum tersedia.'
                );
            }

            foreach ($components as $component) {

                $id = $component['equipment_id'];

                $needed = (int) $component['quantity']
                    * $quantity;

                $requiredStocks[$id] =
                    ($requiredStocks[$id] ?? 0) + $needed;
            }
        }

        // Hitung harga dalam satuan sen untuk menghindari
        // kesalahan pembulatan pada perhitungan uang.
        $rateCents = (int) round(
            (float) $product['daily_rate'] * 100
        );

        if ($rateCents < 0) {
            throw new DomainException('Harga sewa tidak valid.');
        }

        $subtotalCents = $rateCents * $quantity * $totalDays;

        $totalCents += $subtotalCents;

        $bookingItems[] = [
            'equipment_id' => $equipmentId,
            'package_id' => $packageId,
            'item_name' => $product['name'],
            'quantity' => $quantity,
            'daily_rate' => $rateCents / 100,
            'subtotal' => $subtotalCents / 100
        ];
    }

    // Urutkan ID stok agar penguncian konsisten.
    ksort($requiredStocks);

    // Periksa ketersediaan stok setiap hari.
    foreach ($requiredStocks as $equipmentId => $needed) {

        $stmt = $pdo->prepare(
            'SELECT es.total_units, es.unavailable_units
             FROM equipment_stocks es
             JOIN equipment e ON e.id = es.equipment_id
             WHERE es.equipment_id = ?
             AND es.basecamp_id = ?
             AND e.is_active = 1
             FOR UPDATE'
        );

        $stmt->execute([$equipmentId, $basecampId]);

        $stock = $stmt->fetch();

        if (!$stock) {
            throw new DomainException(
                'Stok alat tidak tersedia: ' . $equipmentId
            );
        }

        $usableStock = (int) $stock['total_units']
            - (int) $stock['unavailable_units'];

        // Periksa setiap hari dalam rentang sewa.
        for (
            $day = $start;
            $day <= $end;
            $day = $day->modify('+1 day')
        ) {
            $date = $day->format('Y-m-d');

            // Hitung stok yang tertahan oleh booking alat.
            $stmt = $pdo->prepare(
                "SELECT COALESCE(SUM(bi.quantity), 0)
                 FROM booking_items bi
                 JOIN bookings b ON b.id = bi.booking_id
                 WHERE bi.equipment_id = ?
                 AND b.basecamp_id = ?
                 AND b.booking_status IN
                     ('pending', 'confirmed', 'rented')
                 AND b.start_date <= ?
                 AND b.end_date >= ?"
            );

            $stmt->execute([
                $equipmentId,
                $basecampId,
                $date,
                $date
            ]);

            $reservedEquipment = (int) $stmt->fetchColumn();

            // Hitung stok yang tertahan oleh booking paket.
            $stmt = $pdo->prepare(
                "SELECT COALESCE(
                    SUM(bi.quantity * pi.quantity), 0
                 )
                 FROM booking_items bi
                 JOIN bookings b ON b.id = bi.booking_id
                 JOIN package_items pi
                     ON pi.package_id = bi.package_id
                 WHERE pi.equipment_id = ?
                 AND b.basecamp_id = ?
                 AND b.booking_status IN
                     ('pending', 'confirmed', 'rented')
                 AND b.start_date <= ?
                 AND b.end_date >= ?"
            );

            $stmt->execute([
                $equipmentId,
                $basecampId,
                $date,
                $date
            ]);

            $reservedPackages = (int) $stmt->fetchColumn();

            $available = $usableStock
                - $reservedEquipment
                - $reservedPackages;

            if ($needed > $available) {
                throw new DomainException(
                    'Stok tidak mencukupi untuk '
                    . $equipmentId
                    . ' pada tanggal '
                    . $date
                    . '.'
                );
            }
        }
    }

    if ($totalCents > 999999999999) {
        throw new DomainException('Total biaya terlalu besar.');
    }

    $totalAmount = $totalCents / 100;

    // Buat kode reservasi unik.
    $bookingCode = 'CR-'
        . date('Ymd')
        . '-'
        . strtoupper(bin2hex(random_bytes(6)));

    // Simpan data utama reservasi.
    $stmt = $pdo->prepare(
        "INSERT INTO bookings (
            booking_code,
            user_id,
            basecamp_id,
            start_date,
            end_date,
            renter_name,
            renter_email,
            renter_phone,
            destination_mountain,
            total_days,
            subtotal,
            total_amount,
            booking_status,
            payment_status,
            notes
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            'pending', 'pending', ?
        )"
    );

    $stmt->execute([
        $bookingCode,
        $userId,
        $basecampId,
        $startDate,
        $endDate,
        $renterName,
        $renterEmail,
        $renterPhone,
        $destination ?: null,
        $totalDays,
        $totalAmount,
        $totalAmount,
        $notes ?: null
    ]);

    $bookingId = (int) $pdo->lastInsertId();

    // Simpan detail barang yang disewa.
    $stmt = $pdo->prepare(
        'INSERT INTO booking_items (
            booking_id,
            equipment_id,
            package_id,
            item_name,
            quantity,
            daily_rate,
            subtotal
        ) VALUES (?, ?, ?, ?, ?, ?, ?)'
    );

    foreach ($bookingItems as $item) {

        $stmt->execute([
            $bookingId,
            $item['equipment_id'],
            $item['package_id'],
            $item['item_name'],
            $item['quantity'],
            $item['daily_rate'],
            $item['subtotal']
        ]);
    }

    // Buat pembayaran sandbox.
    $paymentCode = 'PAY-'
        . strtoupper(bin2hex(random_bytes(8)));

    $stmt = $pdo->prepare(
        "INSERT INTO payments (
            booking_id,
            payment_code,
            payment_method,
            amount,
            payment_status
        ) VALUES (?, ?, 'dummy', ?, 'pending')"
    );

    $stmt->execute([
        $bookingId,
        $paymentCode,
        $totalAmount
    ]);

    // Simpan seluruh transaksi.
    $pdo->commit();

    booking_flash(
        true,
        'Reservasi berhasil dibuat.',
        $bookingCode
    );

    redirect('user/riwayat.php');

} catch (Throwable $e) {

    // Batalkan seluruh transaksi apabila terjadi kesalahan.
    if ($pdo instanceof PDO && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    if ($e instanceof DomainException) {
        $message = $e->getMessage();
    } else {
        error_log('Booking gagal: ' . $e->getMessage());

        $message = 'Reservasi gagal dibuat. Silakan coba lagi.';
    }

    booking_flash(false, $message);

    redirect('user/booking.php');
}
