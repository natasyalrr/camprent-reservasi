# Dokumentasi CampRent — Aplikasi Reservasi Persewaan Alat Camping

Kelas A • PHP Native + MySQL • Tailwind CSS (CDN) • Desain: Google Stitch

## 1. Jobdesk anggota
Lihat `docs/PEMBAGIAN-KERJA.md` (Akhilla: Frontend User, Natasya: Frontend Staff & Admin, Difa: Backend User & inti reservasi, Ani: Backend Staff & Admin).

## 2. Peran & hak akses
| Fitur | Pengunjung | User | Staff | Admin |
|---|:-:|:-:|:-:|:-:|
| Beranda, katalog, artikel | ✓ | ✓ | ✓ | ✓ |
| Booking, riwayat, batal, profil | – | ✓ | – | – |
| Dashboard, reservasi, pembatalan, pengembalian | – | – | ✓ | ✓ |
| CRUD alat/kategori/stok/tarif/artikel, laporan | – | – | ✓ | ✓ |
| Manajemen akun, log tindakan staff | – | – | – | ✓ |

## 3. Alur bisnis
### 3.1 Reservasi sampai pengembalian
```mermaid
flowchart TD
  A[Pengunjung lihat katalog/paket] --> B[Login / daftar]
  B --> C[Pilih alat/paket + tanggal + jumlah]
  C --> D{Stok tersedia\npada rentang tanggal?}
  D -- Tidak --> C
  D -- Ya --> E[Booking dibuat: pending\nkode booking]
  E --> F[Bayar sandbox → paid]
  F --> G[Staff konfirmasi: confirmed]
  G --> H[User tunjukkan kartu pengambilan\nkode + email/telepon]
  H --> I[Serah terima + checklist: rented]
  I --> J[Pengembalian oleh staff]
  J --> K{Alat rusak/hilang?}
  K -- Ya --> L[Catat damage_report\nuser wajib mengganti] --> M[Deposit dipotong/diproses]
  K -- Tidak --> M
  M --> N[Booking completed]
```
### 3.2 Pembatalan
```mermaid
flowchart TD
  A[User ajukan pembatalan + alasan\ncancellations: pending] --> B[Staff tinjau]
  B -- Tolak --> C[rejected + catatan\nbooking tetap berjalan]
  B -- Terima --> D[approved → booking cancelled]
  D --> E[Stok dilepas]
  D --> F[Catatan refund/deposit]
  D --> G[audit_logs mencatat tindakan staff]
```
### 3.3 Validasi stok
Stok tersedia = `total_units − unavailable_units − unit yang ditahan booking berstatus pending/confirmed/rented yang tanggalnya beririsan`. Paket diurai menjadi alat penyusunnya (`package_items`). Maks 14 hari per booking.

## 4. ERD (ringkas, dari `database/camprent_recovery.sql`)
```mermaid
erDiagram
  users ||--o{ bookings : membuat
  basecamps ||--o{ bookings : lokasi
  bookings ||--|{ booking_items : berisi
  bookings ||--o{ payments : dibayar
  bookings ||--o| cancellations : dibatalkan
  bookings ||--o| pickup_records : diambil
  bookings ||--o| returns : dikembalikan
  bookings ||--o| deposit_records : deposit
  returns ||--|{ return_items : rincian
  returns ||--o{ damage_reports : kerusakan
  categories ||--o{ equipment : mengelompokkan
  equipment ||--o{ equipment_stocks : stok
  basecamps ||--o{ equipment_stocks : per_basecamp
  equipment ||--o{ booking_items : disewa
  packages ||--|{ package_items : terdiri
  equipment ||--o{ package_items : komponen
  equipment ||--o{ equipment_checklists : checklist
  equipment ||--o{ equipment_inspections : inspeksi
  users ||--o{ articles : menulis
  users ||--o{ audit_logs : tindakan
```

## 5. Keamanan
Hash password (`password_hash`/bcrypt), prepared statement PDO, token CSRF di semua form POST, escape output `e()`, proteksi rute per peran (`require_login()`, `require_role()`), regenerasi sesi saat login, pembatas percobaan login, cookie sesi HttpOnly + SameSite.

## 6. Menjalankan & akun demo
Lihat `README.md`. Akun: admin@demo.test / Admin#2026, staff@demo.test / Staff#2026, user@demo.test / User#2026.

## 7. Struktur & panduan kontribusi
Lihat `README.md` (struktur folder) dan `docs/PANDUAN-TIM.md` (alur Git).
