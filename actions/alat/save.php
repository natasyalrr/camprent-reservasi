<?php
// POST -> tambah alat (tanpa id) atau ubah alat (dengan id).
// Kirim sebagai multipart/form-data (jika ada gambar) atau JSON. Header: X-CSRF-Token
// Field: id, sku, name, category_id, brand, daily_rate, weight_kg, capacity_label, weather_rating,
//        dimensions, material, description, is_active, image (file),
//        stocks   = {"bandung":{"total_units":8,"unavailable_units":0}, ...}  (JSON string atau array)
//        checklist = ["1× Inner tent", "..."]  (JSON string atau array; jika dikirim, menggantikan seluruh checklist)
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('POST');
$user = require_staff();
csrf_verify();

$in = request_data();

/* ---------- Validasi ---------- */

function alat_text($value, int $max, string $label, bool $required = false): ?string
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

function alat_json_array($value, string $label): ?array
{
    if ($value === null || $value === '') {
        return null;
    }
    if (is_string($value)) {
        $value = json_decode($value, true);
    }
    if (!is_array($value)) {
        fail(422, "Format $label tidak valid.");
    }
    return $value;
}

$id         = alat_text($in['id'] ?? null, 80, 'ID');
$name       = alat_text($in['name'] ?? null, 180, 'Nama alat', true);
$sku        = strtoupper((string) alat_text($in['sku'] ?? null, 32, 'SKU', true));
$brand      = alat_text($in['brand'] ?? null, 120, 'Merek', true);
$capacity   = alat_text($in['capacity_label'] ?? null, 120, 'Kapasitas');
$weather    = alat_text($in['weather_rating'] ?? null, 180, 'Ketahanan cuaca');
$dimensions = alat_text($in['dimensions'] ?? null, 220, 'Dimensi');
$material   = alat_text($in['material'] ?? null, 250, 'Bahan');
$descr      = alat_text($in['description'] ?? null, 5000, 'Deskripsi');

if (!preg_match('/^[A-Z0-9-]{3,32}$/', $sku)) {
    fail(422, 'SKU hanya boleh huruf, angka, dan tanda hubung (3-32 karakter).');
}
$categoryId = filter_var($in['category_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($categoryId === false) {
    fail(422, 'Kategori wajib dipilih.');
}
$rate = $in['daily_rate'] ?? null;
if (!is_numeric($rate) || (float) $rate <= 0 || (float) $rate > 99999999) {
    fail(422, 'Tarif harian harus berupa angka lebih dari 0.');
}
$rate = round((float) $rate, 2);

$weight = $in['weight_kg'] ?? null;
if ($weight === null || $weight === '') {
    $weight = null;
} elseif (!is_numeric($weight) || (float) $weight < 0 || (float) $weight > 99999) {
    fail(422, 'Berat tidak valid.');
} else {
    $weight = round((float) $weight, 3);
}

$isActive = array_key_exists('is_active', $in)
    ? (filter_var($in['is_active'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0)
    : null;

$stocksIn = alat_json_array($in['stocks'] ?? null, 'stok');
$checklistIn = alat_json_array($in['checklist'] ?? null, 'checklist');
if ($checklistIn !== null) {
    $checklistIn = array_values(array_filter(array_map(fn($t) => trim((string) $t), $checklistIn), fn($t) => $t !== ''));
    if (count($checklistIn) > 30) {
        fail(422, 'Checklist maksimal 30 item.');
    }
    foreach ($checklistIn as $t) {
        if (mb_strlen($t) > 255) {
            fail(422, 'Tiap item checklist maksimal 255 karakter.');
        }
    }
}

// Kategori harus ada dan aktif
$stmt = $pdo->prepare('SELECT is_active FROM categories WHERE id = ?');
$stmt->execute([$categoryId]);
$cat = $stmt->fetch();
if (!$cat || !$cat['is_active']) {
    fail(422, 'Kategori tidak ditemukan atau nonaktif.');
}

// Basecamp yang valid
$basecampIds = $pdo->query('SELECT id FROM basecamps')->fetchAll(PDO::FETCH_COLUMN);
if ($stocksIn !== null) {
    foreach ($stocksIn as $bc => $row) {
        if (!in_array((string) $bc, $basecampIds, true) || !is_array($row)) {
            fail(422, "Basecamp tidak valid: $bc");
        }
        $t = filter_var($row['total_units'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 100000]]);
        if ($t === false) {
            fail(422, "Stok total basecamp $bc harus bilangan bulat 0 atau lebih.");
        }
        if (isset($row['unavailable_units']) && $row['unavailable_units'] !== '') {
            $u = filter_var($row['unavailable_units'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
            if ($u === false || $u > $t) {
                fail(422, "Unit tidak layak sewa basecamp $bc tidak boleh melebihi stok total.");
            }
        }
    }
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

// Batalkan transaksi, hapus gambar baru, lalu hentikan dengan pesan galat.
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
        $id = unique_slug($pdo, 'equipment', 'id', $name);
        $pdo->prepare(
            'INSERT INTO equipment (id, sku, name, category_id, brand, daily_rate, weight_kg, capacity_label,
                                    weather_rating, dimensions, material, image_path, description, is_active)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        )->execute([$id, $sku, $name, $categoryId, $brand, $rate, $weight, $capacity, $weather,
                    $dimensions, $material, $newImage, $descr, $isActive ?? 1]);
        $old = null;
        $isNew = true;
    } else {
        $stmt = $pdo->prepare('SELECT * FROM equipment WHERE id = ? FOR UPDATE');
        $stmt->execute([$id]);
        $old = $stmt->fetch();
        if (!$old) {
            $abort(404, 'Alat tidak ditemukan.');
        }
        $oldImage = $old['image_path'];
        $pdo->prepare(
            'UPDATE equipment SET sku = ?, name = ?, category_id = ?, brand = ?, daily_rate = ?, weight_kg = ?,
                    capacity_label = ?, weather_rating = ?, dimensions = ?, material = ?, image_path = ?,
                    description = ?, is_active = ?
             WHERE id = ?'
        )->execute([$sku, $name, $categoryId, $brand, $rate, $weight, $capacity, $weather, $dimensions,
                    $material, $newImage ?? $oldImage, $descr, $isActive ?? (int) $old['is_active'], $id]);
        $isNew = false;
    }

    // Stok per basecamp
    $existing = [];
    $stmt = $pdo->prepare('SELECT basecamp_id, total_units, unavailable_units FROM equipment_stocks WHERE equipment_id = ?');
    $stmt->execute([$id]);
    foreach ($stmt->fetchAll() as $r) {
        $existing[$r['basecamp_id']] = $r;
    }

    $upsert = $pdo->prepare(
        'INSERT INTO equipment_stocks (equipment_id, basecamp_id, total_units, unavailable_units)
         VALUES (?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE total_units = VALUES(total_units), unavailable_units = VALUES(unavailable_units)'
    );
    $finalStocks = [];
    foreach ($basecampIds as $bc) {
        $row = $stocksIn[$bc] ?? null;
        if ($row === null && !$isNew) {
            continue; // saat ubah, basecamp yang tidak dikirim dibiarkan
        }
        $total = $row !== null ? (int) $row['total_units'] : 0;
        if (isset($row['unavailable_units']) && $row['unavailable_units'] !== '') {
            $unavailable = (int) $row['unavailable_units'];
        } else {
            $unavailable = (int) ($existing[$bc]['unavailable_units'] ?? 0);
        }
        if ($unavailable > $total) {
            $abort(422, "Unit tidak layak sewa basecamp $bc ($unavailable) melebihi stok total ($total).");
        }
        $upsert->execute([$id, $bc, $total, $unavailable]);
        $finalStocks[$bc] = ['total_units' => $total, 'unavailable_units' => $unavailable];
    }

    // Checklist serah terima
    if ($checklistIn !== null) {
        $pdo->prepare('DELETE FROM equipment_checklists WHERE equipment_id = ?')->execute([$id]);
        $ins = $pdo->prepare('INSERT INTO equipment_checklists (equipment_id, item_text, sort_order) VALUES (?, ?, ?)');
        foreach ($checklistIn as $i => $text) {
            $ins->execute([$id, $text, $i + 1]);
        }
    }

    log_action(
        $pdo,
        $isNew ? 'equipment.create' : 'equipment.update',
        'equipment',
        $id,
        $old ? ['sku' => $old['sku'], 'name' => $old['name'], 'category_id' => (int) $old['category_id'],
                'daily_rate' => (float) $old['daily_rate'], 'is_active' => (int) $old['is_active']] : null,
        ['sku' => $sku, 'name' => $name, 'category_id' => $categoryId, 'daily_rate' => $rate,
         'is_active' => $isActive ?? ($old ? (int) $old['is_active'] : 1), 'stocks' => $finalStocks]
    );

    $pdo->commit();

    if ($newImage !== null && $oldImage !== null) {
        delete_upload($oldImage); // hanya menghapus file di folder uploads/, gambar bawaan seed aman
    }
    json_response(
        ['message' => $isNew ? 'Alat ditambahkan.' : 'Alat diperbarui.', 'id' => $id],
        $isNew ? 201 : 200
    );

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    delete_upload($newImage);
    if (($e->errorInfo[1] ?? 0) === 1062) {
        fail(409, 'SKU sudah dipakai alat lain.');
    }
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}