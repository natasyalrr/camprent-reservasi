# CampRent — Reservasi Persewaan Alat Camping

Aplikasi web manajemen reservasi persewaan alat camping.
Proyek UAS Pemrograman Web, Kelas A. Dibangun dengan **PHP Native** dan **MySQL** (tanpa framework backend).

| Anggota | Peran |
|---|---|
| Akhilla | Frontend User |
| Natasya | Frontend Staff & Admin |
| Difa | Backend User & inti reservasi |
| Ani | Backend Staff & Admin |

## Cara menjalankan di lokal

1. Pasang XAMPP, lalu jalankan **Apache** dan **MySQL**.
2. Clone repo ke dalam `htdocs`:
   ```
   git clone https://github.com/natasyalrr/camprent-reservasi.git
   ```
3. Buka phpMyAdmin, buat database baru, lalu impor `database/schema.sql` dan `database/seed.sql`.
4. Salin konfigurasi database lokal ke `config/database.local.php` (file ini tidak di-commit) dan isi host, nama database, user, dan password milikmu.
5. Buka `http://localhost/<path-ke-folder>/camprent-reservasi/` di browser.

## Struktur folder

```
camprent-reservasi/
├── index.php            # Halaman awal (landing page)
├── config/              # Konfigurasi aplikasi dan koneksi database
├── includes/            # Kode yang dipakai bersama oleh banyak halaman
├── assets/              # File statis: css, js, images
├── auth/                # Halaman login, register, logout
├── user/                # Halaman untuk User (setelah login)
├── staff/               # Halaman untuk Staff
├── admin/               # Halaman khusus Admin
├── actions/             # Proses backend (menerima form, mengubah data)
├── database/            # File SQL: skema dan data awal
└── README.md
```

### Penjelasan tiap folder

| Folder | Isi | Contoh file |
|---|---|---|
| `config/` | Koneksi database (PDO) dan konstanta aplikasi. Kredensial lokal disimpan di `database.local.php` dan **tidak boleh di-commit**. | `database.php` |
| `includes/` | Potongan kode yang dipanggil ulang: pemeriksaan login dan role, fungsi bantu, header, dan footer. | `auth.php`, `functions.php`, `header.php`, `footer.php` |
| `assets/` | `css/` untuk gaya, `js/` untuk skrip, `images/` untuk gambar. Gambar unggahan disimpan di `images/uploads/`. | |
| `auth/` | Halaman autentikasi. | `login.php`, `register.php`, `logout.php` |
| `user/` | Halaman User: katalog, detail alat, booking, riwayat, pembatalan, kartu pengambilan, profil. | `katalog.php`, `booking.php` |
| `staff/` | Halaman Staff: dashboard, reservasi, pembatalan, CRUD alat/paket/artikel, pengembalian. | `dashboard.php`, `alat.php` |
| `admin/` | Halaman khusus Admin: manajemen akun, laporan, audit log. | `users.php`, `audit-log.php` |
| `actions/` | File PHP yang **hanya memproses data** (tanpa tampilan), lalu redirect. Dikelompokkan per fitur: `auth/`, `booking/`, `alat/`, `pembatalan/`, `pengembalian/`. | |
| `database/` | `schema.sql` (struktur tabel) dan `seed.sql` (data awal dan akun demo). | |

### Pemisahan halaman dan action

- **Halaman** (`user/`, `staff/`, `admin/`) menampilkan data dan form.
- **Action** (`actions/`) memproses data dari form, memvalidasi di server, menyimpan ke database, lalu mengarahkan kembali ke halaman.
- Jangan menaruh logika penyimpanan data langsung di file halaman.

## Aturan keamanan dasar

- Pemeriksaan role dilakukan **di server** pada setiap halaman dan action yang dilindungi, bukan hanya dengan menyembunyikan menu.
- Gunakan **PDO prepared statements** untuk semua query.
- Password disimpan dengan `password_hash()` dan dicek dengan `password_verify()`.
- Form yang mengubah data wajib memakai **token CSRF**.
- Data dari pengguna di-escape dengan `htmlspecialchars()` saat ditampilkan.
- Jangan commit kredensial database atau file konfigurasi lokal.

## Aturan kerja tim

> Aturan di bawah ini usulan awal dan dapat disesuaikan setelah disepakati bersama.

**Branch**
- `main` berisi kode yang stabil dan sudah diuji.
- Kerjakan fitur di branch sendiri dengan format `peran/nama-fitur`, misalnya `backend/crud-alat` atau `frontend/katalog`.
- Jangan mengedit file yang sama dengan anggota lain tanpa berkoordinasi.

**Commit**
- Pesan commit singkat dan jelas dengan awalan: `feat:` (fitur baru), `fix:` (perbaikan), `docs:` (dokumentasi), `chore:` (hal teknis seperti struktur folder).
- Contoh: `feat: tambah CRUD kategori alat`.

**Merge**
- Perubahan kecil dan tidak berisiko (struktur folder, README, `.gitignore`): boleh di-merge sendiri.
- Perubahan yang dipakai orang lain (skema database, `includes/`, `config/`, autentikasi): minta minimal satu anggota meninjau dulu.
- Fitur yang hanya milik satu orang: boleh di-merge sendiri setelah diuji pembuatnya.
- Jalankan `git pull` sebelum mulai bekerja dan sebelum membuat pull request.

**Perubahan yang perlu diberitahukan ke tim**
- Nama tabel atau kolom database.
- Nama status (booking, pembayaran, pembatalan, pengembalian).
- Format data yang dikirim antara frontend dan backend.

## Akun demo

| Role | Email | Password |
|---|---|---|
| Admin | admin@demo.test | Admin#2026 |
| Staff | staff@demo.test | Staff#2026 |
| User | user@demo.test | User#2026 |

Akun ini hanya untuk demonstrasi. Password disimpan dalam bentuk hash di database.