<?php
// POST -> hapus permanen kategori yang belum dipakai alat apa pun.
// Jika sudah dipakai, tolak dan sarankan menonaktifkan lewat save.php (is_active=false).
// Body: {"id": 3}   Header: X-CSRF-Token
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('POST');
require_staff();
csrf_verify();

$in = request_data();
$id = (int) ($in['id'] ?? 0);
if ($id <= 0) {
    fail(422, 'ID kategori tidak valid.');
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT name, is_active FROM categories WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    $old = $stmt->fetch();
    if (!$old) {
        $pdo->rollBack();
        fail(404, 'Kategori tidak ditemukan.');
    }

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM equipment WHERE category_id = ?');
    $stmt->execute([$id]);
    if ((int) $stmt->fetchColumn() > 0) {
        $pdo->rollBack();
        fail(409, 'Kategori masih dipakai oleh alat. Nonaktifkan saja, jangan dihapus.');
    }

    $pdo->prepare('DELETE FROM categories WHERE id = ?')->execute([$id]);
    log_action($pdo, 'category.delete', 'categories', $id, $old, null);
    $pdo->commit();
    json_response(['message' => 'Kategori dihapus.']);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}