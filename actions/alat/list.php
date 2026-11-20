<?php
// GET -> semua alat (termasuk nonaktif) beserta kategori, stok per basecamp, dan checklist.
// Juga mengembalikan daftar basecamp dan kategori aktif untuk mengisi form, serta token CSRF.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('GET');
require_staff();

$equipment = $pdo->query(
    'SELECT e.id, e.sku, e.name, e.category_id, c.name AS category_name, e.brand, e.daily_rate,
            e.weight_kg, e.capacity_label, e.weather_rating, e.dimensions, e.material,
            e.image_path, e.description, e.is_active
     FROM equipment e
     JOIN categories c ON c.id = e.category_id
     ORDER BY e.name'
)->fetchAll();

$stockRows = $pdo->query(
    'SELECT equipment_id, basecamp_id, total_units, unavailable_units FROM equipment_stocks'
)->fetchAll();
$checkRows = $pdo->query(
    'SELECT equipment_id, item_text FROM equipment_checklists ORDER BY equipment_id, sort_order, id'
)->fetchAll();

$stocks = [];
foreach ($stockRows as $s) {
    $total = (int) $s['total_units'];
    $unavailable = (int) $s['unavailable_units'];
    $stocks[$s['equipment_id']][$s['basecamp_id']] = [
        'total_units'       => $total,
        'unavailable_units' => $unavailable,
        'usable_units'      => max(0, $total - $unavailable), // stok layak sewa (belum dikurangi booking aktif)
    ];
}
$checklists = [];
foreach ($checkRows as $c) {
    $checklists[$c['equipment_id']][] = $c['item_text'];
}

foreach ($equipment as &$e) {
    $e['category_id'] = (int) $e['category_id'];
    $e['daily_rate'] = (float) $e['daily_rate'];
    $e['weight_kg'] = $e['weight_kg'] !== null ? (float) $e['weight_kg'] : null;
    $e['is_active'] = (bool) $e['is_active'];
    $e['stocks'] = $stocks[$e['id']] ?? new stdClass();
    $e['total_units'] = array_sum(array_column($stocks[$e['id']] ?? [], 'total_units'));
    $e['usable_units'] = array_sum(array_column($stocks[$e['id']] ?? [], 'usable_units'));
    $e['checklist'] = $checklists[$e['id']] ?? [];
}
unset($e);

json_response([
    'data'       => $equipment,
    'basecamps'  => $pdo->query('SELECT id, city, branch_name FROM basecamps WHERE is_active = 1 ORDER BY city')->fetchAll(),
    'categories' => $pdo->query('SELECT id, name FROM categories WHERE is_active = 1 ORDER BY name')->fetchAll(),
    'csrf'       => csrf_token(),
]);