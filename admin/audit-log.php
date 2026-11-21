<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['admin']);
$pageTitle = "Catatan Tindakan Staff";
$bodyClass = "bg-surface font-body-md text-body-md text-on-surface antialiased";
$activeMenu = 'catatan-tindakan';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="w-full pt-16 bg-surface min-h-[calc(100vh-4rem)] p-space-lg"><div class="flex flex-col w-full gap-space-lg">
<!-- Top Breadcrumb & Live Stream Bar -->
<div class="flex flex-wrap items-center justify-between gap-space-sm">
<div class="flex items-center gap-2">
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Administrasi &amp; Keamanan</span>
<span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
<span class="font-label-sm text-label-sm font-semibold text-primary">Audit Trail &amp; Log Aktivitas</span>
</div>
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-container/60 text-on-secondary-container font-label-sm text-label-sm shadow-sm">
<span class="relative flex h-2 w-2">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
</span>
<span class="font-medium">Sirkulasi Otomatis: Aktif (Live Stream)</span>
</div>
</div>
<!-- Editorial Page Header -->
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-lg pb-space-xs">
<div class="flex flex-col gap-2 max-w-3xl">
<div class="inline-flex items-center gap-2 text-tertiary font-label-sm text-label-sm uppercase tracking-widest">
<span class="material-symbols-outlined text-[18px]">verified_user</span>
<span>Akuntabilitas Staf Operasional Nusantara</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface leading-tight">
        Catatan Tindakan &amp; Audit Log Staf
      </h1>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
        Rekam jejak digital aktivitas operasional sistem secara real-time untuk akuntabilitas verifikasi booking, pembatalan, denda kerusakan, dan pembaruan inventaris outdoor Nusantara.
      </p>
</div>
<div class="flex items-center gap-space-sm self-start lg:self-auto shrink-0">
<button class="inline-flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors font-label-md text-label-md shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px]">view_column</span>
<span>Kolom Tampilan</span>
</button>
<button class="inline-flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-primary text-on-primary hover:bg-[#1f3d2b] transition-all font-label-md text-label-md shadow-sm active:scale-95" type="button">
<span class="material-symbols-outlined text-[18px]">download</span>
<span>Ekspor Audit Log (.CSV)</span>
</button>
</div>
</div>
<!-- Metric Summary Cards (Bento Style) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
<!-- Card 1 -->
<div class="flex flex-col justify-between p-space-lg rounded-2xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
<div class="absolute -right-6 -bottom-6 w-28 h-28 rounded-full bg-secondary-container/20 pointer-events-none"></div>
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Total Tindakan Hari Ini</span>
<span class="font-headline-lg text-headline-lg text-on-surface mt-1">42 <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">Aktivitas</span></span>
</div>
<div class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[24px]">history</span>
</div>
</div>
<div class="mt-space-md pt-space-sm flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
<span class="inline-flex items-center gap-1.5 text-secondary">
<span class="material-symbols-outlined text-[16px]">sync</span>
          Sirkulasi real-time
        </span>
<span class="bg-surface-container px-2 py-0.5 rounded-md font-semibold text-on-surface">Rerata 5.2 aksi/jam</span>
</div>
</div>
<!-- Card 2 -->
<div class="flex flex-col justify-between p-space-lg rounded-2xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
<div class="absolute -right-6 -bottom-6 w-28 h-28 rounded-full bg-tertiary-fixed/30 pointer-events-none"></div>
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Aksi Sensitif (Refund/Denda)</span>
<span class="font-headline-lg text-headline-lg text-on-surface mt-1">8 <span class="font-body-sm text-body-sm text-tertiary font-semibold">Kasus Diputuskan</span></span>
</div>
<div class="w-11 h-11 rounded-xl bg-tertiary-fixed/40 flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined text-[24px]">gavel</span>
</div>
</div>
<div class="mt-space-md pt-space-sm flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
<span class="inline-flex items-center gap-1.5 text-primary">
<span class="material-symbols-outlined text-[16px]">verified</span>
          100% Sesuai SOP Finansial
        </span>
<span class="bg-surface-container px-2 py-0.5 rounded-md font-semibold text-tertiary">Total Rp740.000</span>
</div>
</div>
<!-- Card 3 -->
<div class="flex flex-col justify-between p-space-lg rounded-2xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
<div class="absolute -right-6 -bottom-6 w-28 h-28 rounded-full bg-primary-fixed/20 pointer-events-none"></div>
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Staf Paling Aktif</span>
<span class="font-headline-md text-headline-md text-on-surface mt-1 truncate">Bambang Hermawan</span>
</div>
<div class="w-11 h-11 rounded-xl bg-primary-container text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">badge</span>
</div>
</div>
<div class="mt-space-md pt-space-sm flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
<span class="inline-flex items-center gap-1.5">
<span class="w-2 h-2 rounded-full bg-primary"></span>
          Super Admin
        </span>
<span class="bg-primary-fixed text-on-primary-fixed-variant px-2.5 py-0.5 rounded-full font-semibold">18 Tindakan operasional</span>
</div>
</div>
</div>
<!-- Filter & Operational Toolbar -->
<div class="p-space-md rounded-2xl bg-surface-container-lowest shadow-sm flex flex-col md:flex-row items-stretch md:items-center justify-between gap-space-sm">
<div class="flex-1 flex flex-wrap items-center gap-space-sm">
<!-- Search Input -->
<div class="relative min-w-[280px] flex-1">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
<input class="w-full h-11 pl-10 pr-4 bg-surface-container-low text-on-surface placeholder:text-outline rounded-xl font-body-sm text-body-sm focus:outline-none focus:bg-surface-container-lowest transition-all" placeholder="Cari pesanan, alat, pelanggan, atau kode aksi (cth: CR-1110)..." type="search"/>
</div>
<!-- Date Filter -->
<button class="h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface hover:bg-surface-container transition-colors inline-flex items-center gap-2 font-label-sm text-label-sm" type="button">
<span class="material-symbols-outlined text-[18px] text-outline">calendar_month</span>
<span>Hari Ini (24 Okt 2024)</span>
<span class="material-symbols-outlined text-[16px] text-outline">arrow_drop_down</span>
</button>
<!-- Action Type Filter -->
<div class="relative">
<select class="appearance-none h-11 pl-3.5 pr-9 rounded-xl bg-surface-container-low text-on-surface font-label-sm text-label-sm focus:outline-none cursor-pointer">
<option>Semua Jenis Tindakan</option>
<option>Konfirmasi Booking</option>
<option>Setujui Pembatalan</option>
<option>Penagihan Kerusakan</option>
<option>Tambah Alat Baru</option>
<option>Ubah Hak Akses</option>
<option>Pembaruan Stok</option>
</select>
<span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-[18px] text-outline">expand_more</span>
</div>
<!-- Staff Member Filter -->
<div class="relative">
<select class="appearance-none h-11 pl-3.5 pr-9 rounded-xl bg-surface-container-low text-on-surface font-label-sm text-label-sm focus:outline-none cursor-pointer">
<option>Semua Staf &amp; Admin</option>
<option>Bambang Hermawan (Super Admin)</option>
<option>Sarah Melati (Super Admin)</option>
<option>Budi Santoso (Staff Operasional)</option>
<option>Dian Lestari (Staff Operasional)</option>
<option>Sistem Otomatis (CampRent Cron)</option>
</select>
<span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-[18px] text-outline">expand_more</span>
</div>
</div>
<!-- Refresh Button -->
<div class="flex items-center justify-end gap-2">
<button class="w-11 h-11 rounded-xl bg-surface-container-low hover:bg-surface-container-high text-on-surface flex items-center justify-center transition-colors" title="Muat Ulang Data" type="button">
<span class="material-symbols-outlined text-[20px]">refresh</span>
</button>
</div>
</div>
<!-- Detailed Chronological Audit Table -->
<div class="rounded-2xl bg-surface-container-lowest shadow-sm overflow-hidden flex flex-col">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">
<th class="py-3.5 px-space-md">Waktu &amp; Tanggal</th>
<th class="py-3.5 px-space-md">Aktor / Pelaksana</th>
<th class="py-3.5 px-space-md">Jenis Tindakan</th>
<th class="py-3.5 px-space-md">Objek Terkait</th>
<th class="py-3.5 px-space-md min-w-[340px]">Rincian Tindakan &amp; Keterangan</th>
<th class="py-3.5 px-space-md">IP &amp; Perangkat</th>
</tr>
</thead>
<tbody class="font-body-sm text-body-sm text-on-surface divide-y-0">
<!-- Entry 1 -->
<tr class="hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">14:15 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-xs">BH</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Bambang Hermawan</span>
<span class="font-label-sm text-label-sm text-primary">Super Admin</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Konfirmasi Booking
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-primary">CR-1110</span>
<span class="font-label-sm text-label-sm text-outline">Penyewa: Ahmad Fauzi</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Memverifikasi pembayaran transfer BCA &amp; menerbitkan Kartu Pengambilan resmi. Unit: <span class="font-medium text-on-surface">Tenda Kap-4 + Kompor Ultralight</span>.
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-on-surface">182.253.110.42</span>
<span class="text-outline">Chrome / macOS</span>
</div>
</td>
</tr>
<!-- Entry 2 -->
<tr class="bg-surface-container-lowest hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">13:40 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-on-surface font-bold text-xs">BS</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Budi Santoso</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Staff Operasional</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                Setujui Pembatalan
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-error">CR-1108</span>
<span class="font-label-sm text-label-sm text-outline">Penyewa: Hendra Wijaya</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Persetujuan refund 100% senilai <span class="font-semibold text-on-surface">Rp170.000</span> akibat force majeure (penutupan jalur resmi Basecamp Patakbanteng Dieng). Bukti surat edaran diverifikasi.
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-on-surface">180.254.88.19</span>
<span class="text-outline">Chrome / Windows</span>
</div>
</td>
</tr>
<!-- Entry 3 -->
<tr class="hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">12:20 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-xs">BH</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Bambang Hermawan</span>
<span class="font-label-sm text-label-sm text-primary">Super Admin</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                Penagihan Kerusakan
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-tertiary">CR-1101</span>
<span class="font-label-sm text-label-sm text-outline">Penyewa: Dian Prasetyo</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Input klaim kerusakan frame alloy Tenda Kap-4 patah 1 section. Pemotongan deposit <span class="font-semibold text-tertiary">Rp45.000</span>, sisa jaminan Rp5.000 ditransfer balik ke e-wallet penyewa.
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-on-surface">182.253.110.42</span>
<span class="text-outline">Chrome / macOS</span>
</div>
</td>
</tr>
<!-- Entry 4 -->
<tr class="hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">11:05 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed font-bold text-xs">DL</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Dian Lestari</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Staff Operasional</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px] text-secondary">add_circle</span>
                Tambah Alat Baru
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">SKU-HMK-01</span>
<span class="font-label-sm text-label-sm text-outline">Katalog Gear Baru</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Menambahkan produk baru 'Hammock Double Ultralight 200kg', alokasi stok awal 10 unit di Basecamp Bandung, tarif sewa Rp15.000/hari.
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-on-surface">114.124.201.55</span>
<span class="text-outline">Firefox / Windows</span>
</div>
</td>
</tr>
<!-- Entry 5 -->
<tr class="hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">10:15 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-xs">SM</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Sarah Melati</span>
<span class="font-label-sm text-label-sm text-primary">Super Admin</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-tertiary-fixed/60 text-on-tertiary-fixed-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">lock_reset</span>
                Ubah Hak Akses
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">Staff DL</span>
<span class="font-label-sm text-label-sm text-outline">dian.lestari@camprent.id</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Mengubah status akun menjadi Staff Operasional Aktif dan menugaskan otorisasi inventaris ke Pos Basecamp Garut (Gunung Papandayan &amp; Guntur).
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-on-surface">103.28.14.70</span>
<span class="text-outline">Safari / iOS</span>
</div>
</td>
</tr>
<!-- Entry 6 -->
<tr class="hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">09:30 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-on-surface font-bold text-xs">BS</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Budi Santoso</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Staff Operasional</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">inventory_2</span>
                Pembaruan Stok
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">TND-DOME-04</span>
<span class="font-label-sm text-label-sm text-outline">Tenda Dome 4P Pro</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Penyesuaian stok pasca-servis: 2 unit tenda dome selesai reparasi re-sealing seam tape flysheet dan kembali ke status <span class="text-secondary font-semibold">Tersedia Siap Pakai</span>.
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-on-surface">180.254.88.19</span>
<span class="text-outline">Chrome / Windows</span>
</div>
</td>
</tr>
<!-- Entry 7 -->
<tr class="hover:bg-surface-container-low/70 transition-colors">
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">08:45 WIB</span>
<span class="font-label-sm text-label-sm text-outline">24 Okt 2024</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex items-center gap-2.5">
<div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-outline font-bold text-xs">
<span class="material-symbols-outlined text-[16px]">smart_toy</span>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">Sistem Otomatis</span>
<span class="font-label-sm text-label-sm text-outline">CampRent Cron</span>
</div>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">notifications_active</span>
                Peringatan Tempo
              </span>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col">
<span class="font-semibold text-on-surface">CR-1094</span>
<span class="font-label-sm text-label-sm text-outline">Penyewa: Fajar Nugraha</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<p class="text-on-surface leading-snug">
                Mengirimkan notifikasi WhatsApp otomatis H-1 jadwal pengembalian gear beserta link konfirmasi kepulangan basecamp.
              </p>
</td>
<td class="py-4 px-space-md whitespace-nowrap align-top">
<div class="flex flex-col font-label-sm text-label-sm">
<span class="font-mono text-outline">10.0.0.1</span>
<span class="text-outline">System Worker</span>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination Footer -->
<div class="p-space-md bg-surface-container-low/50 flex flex-col sm:flex-row items-center justify-between gap-space-sm font-label-sm text-label-sm text-on-surface-variant">
<span>Menampilkan <strong class="text-on-surface font-semibold">1-7</strong> dari <strong class="text-on-surface font-semibold">42</strong> catatan tindakan hari ini</span>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-outline hover:bg-surface-container disabled:opacity-40 transition-colors" disabled="" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-semibold flex items-center justify-center shadow-sm" type="button">1</button>
<button class="w-8 h-8 rounded-lg text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors" type="button">2</button>
<button class="w-8 h-8 rounded-lg text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors" type="button">3</button>
<button class="w-8 h-8 rounded-lg text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors" type="button">4</button>
<button class="h-8 px-2 rounded-lg text-on-surface hover:bg-surface-container flex items-center gap-1 transition-colors" type="button">
<span>Selanjutnya</span>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Bottom Immutability & Security Card -->
<div class="p-space-lg rounded-2xl bg-surface-container-low shadow-sm flex flex-col gap-space-md relative overflow-hidden">
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-space-sm">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-primary text-on-primary flex items-center justify-center shadow-sm shrink-0">
<span class="material-symbols-outlined text-[24px]">rotate_90_degrees_ccw</span>
</div>
<div class="flex flex-col">
<h2 class="font-headline-sm text-headline-sm text-on-surface">Catatan Integritas &amp; Immutability Data</h2>
<span class="font-label-sm text-label-sm text-outline">Kepatuhan Audit Standar Operasional Sewa Outdoor</span>
</div>
</div>
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-label-sm text-label-sm font-semibold shadow-xs">
<span class="material-symbols-outlined text-[16px]">lock</span>
<span>Terenkripsi SHA-256</span>
</div>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-4xl leading-relaxed">
      Semua rekaman tindakan staf terlindungi oleh sistem immutability log database. Setiap perubahan status inventaris outdoor, penerbitan voucher refund, dan transaksi potongan deposit tersimpan permanen dan tidak dapat diubah maupun dihapus bahkan oleh Super Admin.
    </p>
<div class="pt-space-sm flex flex-wrap items-center gap-y-2 gap-x-space-lg font-label-sm text-label-sm text-outline">
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px] text-secondary">verified</span>
<span>Retention Policy: <strong class="text-on-surface font-semibold">7 Tahun</strong></span>
</div>
<span class="hidden sm:inline text-surface-container-highest">•</span>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px] text-secondary">shield</span>
<span>ISO/IEC 27001 Terverifikasi</span>
</div>
<span class="hidden sm:inline text-surface-container-highest">•</span>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px] text-secondary">location_on</span>
<span>Pos Pengawasan Aktif: <strong class="text-on-surface font-semibold">Basecamp Patakbanteng &amp; Papandayan</strong> (31 unit tersertifikasi)</span>
</div>
</div>
</div>
</div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
