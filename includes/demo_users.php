<?php
/**
 * Akun demo wajib UAS (password di-hash dengan bcrypt, bukan teks biasa):
 *   admin@demo.test / Admin#2026   staff@demo.test / Staff#2026   user@demo.test / User#2026
 * File ini hanya dipakai selama belum ada database. Dihapus saat backend siap.
 */
return [
    ['id' => 1, 'nama' => 'Admin CampRent', 'email' => 'admin@demo.test', 'role' => 'admin', 'password_hash' => '$2y$10$OrLrvL/LcYt..4xpLRlMk..4//OI.0M0hogD/NkeucSRTkk.HOxG6'],
    ['id' => 2, 'nama' => 'Staff CampRent', 'email' => 'staff@demo.test', 'role' => 'staff', 'password_hash' => '$2y$10$Q.medKFDPj88iNJTkuUJA.DTcIR3o3ClNrSSadxEJ/IpiAobVsb86'],
    ['id' => 3, 'nama' => 'User Demo',      'email' => 'user@demo.test',  'role' => 'user',  'password_hash' => '$2y$10$hU4iUBabodc265bMb3.a8uPgyejPkXI0WTkCY6Ejy0puMHa.Zjeki'],
];
