<?php
// POST -> tambah kategori (tanpa id) atau ubah kategori (dengan id).
// Body: {"id": 3, "name": "Aksesori", "is_active": true}   Header: X-CSRF-Token
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('POST');
require_staff();
csrf_verify();

$in = request_data();
$id = (isset($in['id']) && $in['id'] !== '') ? (int) $in['id'] : null;
$name = trim(preg_replace('/\s+/', ' ', (string) ($in['name'] ?? '')));
$isActive = array_key_exists('is_active', $in)
    ? (filter_var($in['is_active'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0)
    : null;

if ($name === '' || mb_strlen($name) > 100) {
    fail(422, 'Nama kategori wajib diisi (maksimal 100 karakter).');
}

try {
    $pdo->beginTransaction();

    if ($id === null) {
        $active = $isActive ?? 1;
        $pdo->prepare('INSERT INTO categories (name, is_active) VALUES (?, ?)')->execute([$name, $active]);
        $newId = (int) $pdo->lastInsertId();
        log_action($pdo, 'category.create', 'categories', $newId, null, ['name' => $name, 'is_active' => $active]);
        $pdo->commit();
        json_response(['message' => 'Kategori ditambahkan.', 'id' => $newId], 201);
    }

    $stmt = $pdo->prepare('SELECT name, is_active FROM categories WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    $old = $stmt->fetch();
    if (!$old) {
        $pdo->rollBack();
        fail(404, 'Kategori tidak ditemukan.');
    }
    $old['is_active'] = (int) $old['is_active'];

    $new = ['name' => $name, 'is_active' => $isActive ?? $old['is_active']];
    $pdo->prepare('UPDATE categories SET name = ?, is_active = ? WHERE id = ?')
        ->execute([$new['name'], $new['is_active'], $id]);
    log_action($pdo, 'category.update', 'categories', $id, $old, $new);
    $pdo->commit();
    json_response(['message' => 'Kategori diperbarui.', 'id' => $id]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    if ($e->getCode() === '23000') {
        fail(409, 'Nama kategori sudah dipakai.');
    }
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}