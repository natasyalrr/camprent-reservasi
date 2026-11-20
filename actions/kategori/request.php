<?php
/**
 * Helper khusus endpoint JSON (actions/).
 */

/** Paksa respons galat (fail/require_*) berbentuk JSON. Panggil paling awal di tiap action. */
function force_json(): void
{
    $_SERVER['HTTP_ACCEPT'] = 'application/json';
}

/** Ambil data request: body JSON atau form biasa ($_POST). */
function request_data(): array
{
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (stripos($contentType, 'application/json') !== false) {
        $data = json_decode(file_get_contents('php://input'), true);
        return is_array($data) ? $data : [];
    }
    return $_POST;
}