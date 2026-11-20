# Panduan Tim — Cara Commit & Menyatukan Kode

Berlaku untuk Akhilla, Natasya, Difa, Ani. Ikuti urutannya agar tidak bentrok.

## 0. Persiapan (sekali saja)
```bash
git clone https://github.com/natasyalrr/camprent-reservasi.git
cd camprent-reservasi
git config user.name "Nama Kamu"          # harus sesuai akun GitHub agar commit tercatat
git config user.email "email-github-kamu"
```
Jalankan lokal: XAMPP (Apache + MySQL), folder di `htdocs`, impor `database/camprent_recovery.sql`,
salin `config/database.example.php` → `config/database.local.php` lalu isi kredensial.
Tanpa XAMPP (cek tampilan saja): `php -S localhost:8080` dari root proyek.

## 1. Urutan merge (penting)
1. **Natasya** commit `0-pondasi-bersama.zip` → PR ke `dev` → merge. (Jika branch `dev` belum ada: `git checkout -b dev && git push -u origin dev`.)
2. Semua orang tarik `dev`: `git checkout dev && git pull`.
3. Lalu masing-masing commit bagiannya (zip 1–4), urutan bebas.

> Zip 1 dan 2 butuh zip 0 (semua halaman memanggil `includes/bootstrap.php`).

## 2. Langkah commit satu bagian
```bash
git checkout dev && git pull
git checkout -b feat/<bagian>-<fitur>      # contoh: feat/user-skeleton, feat/staff-skeleton
# ekstrak zip bagianmu ke ROOT repo (folder sudah berstruktur, timpa jika ditanya — kecuali README.md)
git status                                  # pastikan hanya file bagianmu yang berubah
git add .
git commit -m "feat(user): tambah kerangka halaman user"
git push -u origin feat/<bagian>-<fitur>
```
Buka GitHub → **Compare & pull request** → base: `dev` → minta anggota lain me-review → merge.
Setelah merge, branch lama boleh dihapus.

## 3. Aturan agar tidak bentrok
- Edit hanya file wilayahmu (lihat `docs/PEMBAGIAN-KERJA.md`). File bersama (`assets/`, `bootstrap.php`, `auth.php`) → lewat PR + review.
- Selalu `git pull` dari `dev` sebelum mulai kerja dan sebelum push.
- Satu fitur = satu branch kecil. Commit sering, pesan jelas: `feat(...)`, `fix(...)`, `docs: ...`.
- Jangan commit `config/database.local.php` (sudah di-.gitignore) atau password asli.
- Konflik merge: buka file bertanda `<<<<<<<`, pilih/gabungkan isinya, `git add`, `git commit`. Bingung? Tanya sebelum menimpa.
- Branch `main` hanya berisi hasil final dari `dev` (yang dinilai dosen).

## 4. Cara frontend ↔ backend bekerja sama
- Frontend menandai data dummy dengan `<!-- TODO(backend): ... -->`; backend mengganti blok itu dengan query PDO (`db()` di `includes/db.php`), tanpa menulis ulang HTML.
- Data dummy artikel: `includes/artikel_dummy.php` → ganti ke tabel `articles`.
- Login: ganti `find_user_by_email()` dan `register_user()` di `includes/auth.php` ke tabel `users`.
- Form selalu `method="post"` + `<?= csrf_field() ?>`; di `actions/...` panggil `csrf_verify()`. Output selalu `e()`. Query selalu prepared statement.

## 5. Jadwal
| Tanggal | Target |
|---|---|
| 20–22 Nov | Pondasi + kerangka masuk `dev`; backend mulai koneksi DB, login, stok |
| 23–29 Nov | Fitur: booking+stok, pembatalan, pengembalian/kerusakan, CRUD, laporan |
| 30 Nov | Semua fitur selesai (feature freeze) |
| 1–5 Des | Uji (semua role), perbaikan bug, deploy hosting, dokumentasi final |
| 6–7 Des | Cadangan, cek akun demo & URL live |
| 8 Des 23:59 | Deadline (kumpulkan sebelum siang) |

## 6. Checklist pengumpulan
- [ ] URL live bisa dibuka + 3 akun demo berfungsi
- [ ] Link repo + nama branch yang dinilai (`main`)
- [ ] Dokumentasi PDF/MD: jobdesk, alur bisnis, ERD, cara menjalankan
- [ ] Commit history rapi atas nama tiap anggota
