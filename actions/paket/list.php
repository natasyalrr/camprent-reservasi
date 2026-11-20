<?php
// GET -> semua paket (termasuk nonaktif) beserta isi paket.
// Juga mengembalikan daftar alat aktif (untuk memilih isi paket) dan token CSRF.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('GET');
require_staff();

$packages = $pdo->query(
    'SELECT id, name, mountain_target, duration_label, capacity_label, daily_rate, normal_daily_rate,
            total_weight_kg, summary, image_path, is_active
     FROM packages
     ORDER BY name'
)->fetchAll();

$itemRows = $pdo->query(
    'SELECT pi.package_id, pi.equipment_id, pi.quantity, e.name, e.daily_rate
     FROM package_items pi
     JOIN equipment e ON e.id = pi.equipment_id
     ORDER BY pi.package_id, pi.id'
)->fetchAll();

$items = [];
foreach ($itemRows as $r) {
    $items[$r['package_id']][] = [
        'equipment_id' => $r['equipment_id'],
        'name'         => $r['name'],
        'quantity'     => (int) $r['quantity'],
        'daily_rate'   => (float) $r['daily_rate'],
    ];
}

foreach ($packages as &$p) {
    $p['daily_rate'] = (float) $p['daily_rate'];
    $p['normal_daily_rate'] = (float) $p['normal_daily_rate'];
    $p['total_weight_kg'] = $p['total_weight_kg'] !== null ? (float) $p['total_weight_kg'] : null;
    $p['is_active'] = (bool) $p['is_active'];
    $p['items'] = $items[$p['id']] ?? [];
}
unset($p);

json_response([
    'data'      => $packages,
    'equipment' => $pdo->query('SELECT id, name, daily_rate, weight_kg FROM equipment WHERE is_active = 1 ORDER BY name')->fetchAll(),
    'csrf'      => csrf_token(),
]);