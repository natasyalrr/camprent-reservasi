<?php
// GET  -> daftar kategori (termasuk yang nonaktif) + token CSRF untuk request berikutnya.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('GET');
require_staff();

$rows = $pdo->query(
    'SELECT c.id, c.name, c.is_active,
            (SELECT COUNT(*) FROM equipment e WHERE e.category_id = c.id) AS equipment_count
     FROM categories c
     ORDER BY c.name'
)->fetchAll();

foreach ($rows as &$row) {
    $row['id'] = (int) $row['id'];
    $row['is_active'] = (bool) $row['is_active'];
    $row['equipment_count'] = (int) $row['equipment_count'];
}
unset($row);

json_response(['data' => $rows, 'csrf' => csrf_token()]);