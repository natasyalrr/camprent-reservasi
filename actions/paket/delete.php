<?php
// POST -> hapus permanen paket yang belum pernah dipesan. Isi paket ikut terhapus (ON DELETE CASCADE).
// Jika sudah pernah dipesan: tolak (nonaktifkan saja lewat save.php dengan is_active=false).
// Body: {"id": "bundle-prau-pemula"}   Header: X-CSRF-Token
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/request.php';

force_json();
require_method('POST');
require_staff();
csrf_verify();

$in = request_data();
$id = trim((string) ($in['id'] ?? ''));
if ($id === '') {
    fail(422, 'ID paket tidak valid.');
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT id, name, image_path FROM packages WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    $old = $stmt->fetch();
    if (!$old) {
        $pdo->rollBack();
        fail(404, 'Paket tidak ditemukan.');
    }

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM booking_items WHERE package_id = ?');
    $stmt->execute([$id]);
    if ((int) $stmt->fetchColumn() > 0) {
        $pdo->rollBack();
        fail(409, 'Paket sudah pernah dipesan. Nonaktifkan saja, jangan dihapus.');
    }

    $pdo->prepare('DELETE FROM packages WHERE id = ?')->execute([$id]);
    log_action($pdo, 'package.delete', 'packages', $id, ['name' => $old['name']], null);
    $pdo->commit();

    delete_upload($old['image_path']);
    json_response(['message' => 'Paket dihapus.']);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}