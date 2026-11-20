<?php
// POST -> hapus permanen alat yang belum pernah dipakai.
// Jika sudah pernah dipakai di booking, paket, pengembalian, kerusakan, atau inspeksi: tolak (nonaktifkan saja).
// Body: {"id": "tent-borneo-2p"}   Header: X-CSRF-Token
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
    fail(422, 'ID alat tidak valid.');
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT id, sku, name, image_path FROM equipment WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    $old = $stmt->fetch();
    if (!$old) {
        $pdo->rollBack();
        fail(404, 'Alat tidak ditemukan.');
    }

    foreach (['booking_items', 'package_items', 'return_items', 'damage_reports', 'equipment_inspections'] as $table) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE equipment_id = ?");
        $stmt->execute([$id]);
        if ((int) $stmt->fetchColumn() > 0) {
            $pdo->rollBack();
            fail(409, 'Alat sudah pernah dipakai (booking, paket, pengembalian, atau inspeksi). Nonaktifkan saja, jangan dihapus.');
        }
    }

    $pdo->prepare('DELETE FROM equipment_stocks WHERE equipment_id = ?')->execute([$id]);
    $pdo->prepare('DELETE FROM equipment WHERE id = ?')->execute([$id]); // checklist ikut terhapus (ON DELETE CASCADE)
    log_action($pdo, 'equipment.delete', 'equipment', $id, ['sku' => $old['sku'], 'name' => $old['name']], null);
    $pdo->commit();

    delete_upload($old['image_path']);
    json_response(['message' => 'Alat dihapus.']);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log($e->getMessage());
    fail(500, 'Terjadi kesalahan pada server.');
}