# Pembagian Kerja

| Anggota | Peran | Wilayah file |
|---|---|---|
| Akhilla | Frontend User | `index.php`, `user/*`, `auth/*`, `includes/layout_user_*`, `includes/head.php` |
| Natasya | Frontend Staff & Admin | `staff/*`, `admin/*`, `includes/layout_staff_*` |
| Difa | Backend User & inti reservasi | `includes/db.php`, `includes/auth.php`, `actions/auth`, `actions/booking` (stok per tanggal, kode booking, pembayaran sandbox, pembatalan oleh user) |
| Ani | Backend Staff & Admin | `actions/pembatalan`, `actions/pengembalian`, `actions/alat` (approve/reject, kerusakan, CRUD alat/artikel/akun, laporan, audit_logs) |

File bersama (`assets/*`, `includes/bootstrap.php`, `database/*`): ubah lewat PR dan minta review.

## Serah-terima Frontend ↔ Backend
- Halaman sekarang memakai data dummy. Backend mengganti blok dummy dengan query PDO dan memanggil fungsi di `includes/`, tanpa menulis ulang HTML.
- Form: `method="post"` ke `actions/...` + `<?= csrf_field() ?>`; di action panggil `csrf_verify()`. Output selalu dibungkus `e()`.
- Login memakai `find_user_by_email()` dan `register_user()` di `includes/auth.php` (sementara dari `includes/demo_users.php`). Ganti isinya ke tabel `users`; fungsi lain tidak perlu diubah.
- Nama tabel/kolom mengikuti `database/camprent_recovery.sql` (bookings, booking_items, cancellations, equipment_stocks, dst.).

## Alur Git
- `main` (dinilai) ← `dev` ← `feat/<area>-<fitur>`; satu fitur = satu branch = satu PR, direview anggota lain.
- Commit: `feat(user): halaman katalog`, `feat(backend): validasi stok`, `docs: ...`
- Jangan commit `config/database.local.php`.
- Target fitur selesai ±30 Nov; 1–7 Des untuk uji, dokumentasi, deploy.
