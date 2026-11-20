<?php
// POST -> tambah paket (tanpa id) atau ubah paket (dengan id).
// Kirim sebagai multipart/form-data (jika ada gambar) atau JSON. Header: X-CSRF-Token
// Field: id, name, mountain_target, duration_label, capacity_label, daily_rate,
//        normal_daily_rate (kosong = dihitung otomatis dari alat), total_weight_kg (kosong = otomatis),
//        summary, is_active, image (file),
//        items = [{"equipment_id":"tent-borneo-2p","quantity":1}, ...]  (JSON string atau array;
//                wajib saat tambah; saat ubah, jika dikirim menggantikan seluruh isi paket)
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('POST');
$user = require_staff();
csrf_verify();

$in = request_data();

/* ---------- Validasi ---------- */

function paket_text($value, int $max, string $label, bool $required = false): ?string
{
    $value = trim((string) ($value ?? ''));
    if ($value === '') {
        if ($required) {
            fail(422, "$label wajib diisi.");
        }
        return null;
    }
    if (mb_strlen($value) > $max) {
        fail(422, "$label maksimal $max karakter.");
    }
    return $value;
}

function paket_money($value, string $label, bool $optional = false): ?float
{
    if ($optional && ($value === null || $value === '')) {
        return null;
    }
    if (!is_numeric($value) || (float) $value <= 0 || (float) $value > 99999999) {
        fail(422, "$label harus berupa angka lebih dari 0.");
    }
    return round((float) $value, 2);
}

$id       = paket_text($in['id'] ?? null, 80, 'ID');
$name     = paket_text($in['name'] ?? null, 180, 'Nama paket', true);
$target   = paket_text($in['mountain_target'] ?? null, 255, 'Target gunung');
$duration = paket_text($in['duration_label'] ?? null, 100, 'Durasi');
$capacity = paket_text($in['capacity_label'] ?? null, 100, 'Kapasitas');
$summary  = paket_text($in['summary'] ?? null, 5000, 'Ringkasan');
$rate     = paket_money($in['daily_rate'] ?? null, 'Tarif harian paket');
$normal   = paket_money($in['normal_daily_rate'] ?? null, 'Tarif normal', true);

$weight = $in['total_weight_kg'] ?? null;
if ($weight === null || $weight === '') {
    $weight = null;
} elseif (!is_numeric($weight) || (float) $weight < 0 || (float) $weight > 99999) {
    fail(422, 'Total berat tidak valid.');
} else {
    $weight = round((float) $weight, 3);
}

$isActive = array_key_exists('is_active', $in)
    ? (filter_var($in['is_active'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0)
    : null;

// Isi paket
$itemsIn = $in['items'] ?? null;
if (is_string($itemsIn) && $itemsIn !== '') {
    $itemsIn = json_decode($itemsIn, true);
}
if ($itemsIn === '' ) {
    $itemsIn = null;
}
if ($itemsIn !== null && !is_array($itemsIn)) {
    fail(422, 'Format isi paket tidak valid.');
}
if ($id === null && ($itemsIn === null || count($itemsIn) === 0)) {
    fail(422, 'Paket baru harus berisi minimal satu alat.');
}

$autoNormal = null;
$autoWeight = null;
if ($itemsIn !== null) {
    if (count($itemsIn) === 0 || count($itemsIn) > 30) {
        fail(422, 'Isi paket harus 1 sampai 30 jenis alat.');
    }
    $clean = [];
    foreach ($itemsIn as $row) {
        $eid = is_array($row) ? trim((string) ($row['equipment_id'] ?? '')) : '';
        $qty = is_array($row)
            ? filter_var($row['quantity'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 99]])
            : false;
        if ($eid === '' || $qty === false) {
            fail(422, 'Tiap item paket harus punya equipment_id dan jumlah 1-99.');
        }
        if (isset($clean[$eid])) {
            fail(422, "Alat $eid dipilih lebih dari satu kali.");
        }
        $clean[$eid] = $qty;
    }
    $itemsIn = $clean; // [equipment_id => quantity]

    $ids = array_keys($itemsIn);
    $ph = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT id, daily_rate, weight_kg, is_active FROM equipment WHERE id IN ($ph)");
    $stmt->execute($ids);
    $found = [];
    foreach ($stmt->fetchAll() as $r) {
        $found[$r['id']] = $r;
    }
    $sumRate = 0.0;
    $sumWeight = 0.0;
    $allHaveWeight = true;
    foreach ($itemsIn as $eid => $qty) {
        if (!isset($found[$eid])) {
            fail(422, "Alat tidak ditemukan: $eid");
        }
        if (!$found[$eid]['is_active']) {
            fail(422, "Alat nonaktif tidak boleh masuk paket: $eid");
        }
        $sumRate += (float) $found[$eid]['daily_rate'] * $qty;
        if ($found[$eid]['weight_kg'] === null) {
            $allHaveWeight = false;
        } else {
            $sumWeight += (float) $found[$eid]['weight_kg'] * $qty;
        }
    }
    $autoNormal = round($sumRate, 2);
    $autoWeight = $allHaveWeight ? round($sumWeight, 3) : null;
}

/* ---------- Gambar ---------- */

$newImage = null;
if (isset($_FILES['image']) && ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
    try {
        $newImage = save_image($_FILES['image'], (int) $user['id']);
    } catch (Exception $e) {
        fail(422, $e->getMessage());
    }
}

$abort = function (int $status, string $message) use ($pdo, &$newImage): void {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    delete_upload($newImage);
    fail($status, $message);
};

/* ---------- Simpan ---------- */

try {
    $pdo->beginTransaction();
    $oldImage = null;

    if ($id === null) {
        $isNew = true;
        $id = unique_slug($pdo, 'packages', 'id', $name);
        $finalNormal = $normal ?? $autoNormal;
        $finalWeight = $weight ?? $autoWeight;
        $pdo->prepare(
            'INSERT INTO packages (id, name, mountain_target, duration_label, capacity_label, daily_rate,
                                   normal_daily_rate, total_weight_kg, summary, image_path, is_active)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        )->execute([$id, $name, $target, $duration, $capacity, $rate, $finalNormal, $finalWeight,
                    $summary, $newImage, $isActive ?? 1]);
        $old = null;
    } else {
        $isNew = false;
        $stmt = $pdo->prepare('SELECT * FROM packages WHERE id = ? FOR UPDATE');
        $stmt->execute([$id]);
        $old = $stmt->fetch();
        if (!$old) {
            $abort(404, 'Paket tidak ditemukan.');
        }
        $oldImage = $old['image_path'];
        if ($itemsIn !== null) {
            $finalNormal = $normal ?? $autoNormal;
            $finalWeight = $weight ?? $autoWeight;
        } else {
            $finalNormal = $normal ?? (float) $old['normal_daily_rate'];
            $finalWeight = $weight ?? ($old['total_weight_kg'] !== null ? (float) $old['total_weight_kg'] : null);
        }
        $pdo->prepare(
            'UPDATE packages SET name = ?, mountain_target = ?, duration_label = ?, capacity_label = ?,
                    daily_rate = ?, normal_daily_rate = ?, total_weight_kg = ?, summary = ?, image_path = ?, is_active = ?
             WHERE id = ?'
        )->execute([$name, $target, $duration, $capacity, $rate, $finalNormal, $finalWeight, $summary,
                    $newImage ?? $oldImage, $isActive ?? (int) $old['is_active'], $id]);
    }

    if ($itemsIn !== null) {
        $pdo->prepare('DELETE FROM package_items WHERE package_id = ?')->execute([$id]);
        $ins = $pdo->prepare('INSERT INTO package_items (package_id, equipment_id, quantity) VALUES (?, ?, ?)');
        foreach ($itemsIn as $eid => $qty) {
            $ins->execute([$id, $eid, $qty]);
        }
    }

    log_action(
        $pdo,
        $isNew ? 'package.create' : 'package.update',
        'packages',
        $id,
        $old ? ['name' => $old['name'], 'daily_rate' => (float) $old['daily_rate'], 'is_active' => (int) $old['is_active']] : null,
        ['name' => $name, 'daily_rate' => $rate, 'normal_daily_rate' => $finalNormal,
         'is_active' => $isActive ?? ($old ? (int) $old['is_active'] : 1),
         'items' => $itemsIn !== null ? $itemsIn : 'tidak diubah']
    );

    $pdo->commit();

    if ($newImage !== null && $oldImage !== null) {
        delete_upload($oldImage); // hanya menghapus file di uploads/, gambar bawaan seed aman
    }
    json_response(
        ['message' => $isNew ? 'Paket ditambahkan.' : 'Paket diperbarui.', 'id' => $id],
        $isNew ? 201 : 200
    );

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    delete_upload($newImage);
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}