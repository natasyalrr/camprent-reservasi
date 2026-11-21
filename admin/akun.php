<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['admin']);
$pageTitle = "Manajemen Akun";
$bodyClass = "bg-surface font-body-md text-body-md text-on-surface antialiased";
$activeMenu = 'manajemen-akun';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="w-full pt-16 bg-surface min-h-[calc(100vh-4rem)] p-space-lg"><div class="flex flex-col w-full gap-space-lg">
<!-- Top Context Header & Breadcrumb -->
<div class="flex flex-col gap-space-sm">
<div class="flex flex-wrap items-center justify-between gap-space-sm">
<nav class="flex items-center gap-2 font-label-md text-label-md text-on-surface-variant">
<span>Administrasi &amp; Hak Akses</span>
<span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
<span class="text-primary font-semibold">Daftar Pengguna &amp; Staf</span>
</nav>
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[16px] text-secondary">verified_user</span>
<span>Sistem Terproteksi Multi-Role Auth</span>
</div>
</div>
<div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
<div class="flex flex-col">
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Manajemen Akun &amp; Hak Akses</h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl mt-1">
          Kelola kredensial, peran otorisasi (Super Admin, Staff Operasional, User), dan status keaktifan akun dalam ekosistem rental CampRent Nusantara.
        </p>
</div>
<div class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant bg-surface-container px-3 py-1.5 rounded-lg self-start md:self-auto">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
<span>Audit Otentikasi: Sesuai SOP ISO 27001</span>
</div>
</div>
</div>
<!-- Quick Stats Cards with subtle graphical accents -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
<!-- Stat 1 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl flex flex-col justify-between shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total Akun Terdaftar</span>
<div class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[20px]">groups</span>
</div>
</div>
<div class="mt-4 flex items-baseline justify-between">
<span class="font-headline-lg text-headline-lg text-on-surface font-semibold">1,420</span>
<span class="font-label-sm text-label-sm text-secondary bg-secondary-container/50 px-2 py-0.5 rounded-full">Nasional</span>
</div>
<!-- Progress Bar micro-element -->
<div class="w-full bg-surface-container-high h-1.5 rounded-full mt-3 overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 88%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-2">Kapasitas auth aktif: 88%</span>
</div>
<!-- Stat 2 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl flex flex-col justify-between shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Staf Lapangan &amp; Kasir</span>
<div class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[20px]">badge</span>
</div>
</div>
<div class="mt-4 flex items-baseline justify-between">
<span class="font-headline-lg text-headline-lg text-on-surface font-semibold">18</span>
<span class="font-label-sm text-label-sm text-primary bg-primary-fixed/40 px-2 py-0.5 rounded-full">Personel Aktif</span>
</div>
<div class="flex items-center gap-1.5 mt-3 text-secondary font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[16px]">location_on</span>
<span>Tersebar di 7 Basecamp &amp; Hub</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-1">Presensi tugas hari ini: 100%</span>
</div>
<!-- Stat 3 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl flex flex-col justify-between shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Super Administrator</span>
<div class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined text-[20px]">shield_person</span>
</div>
</div>
<div class="mt-4 flex items-baseline justify-between">
<span class="font-headline-lg text-headline-lg text-on-surface font-semibold">3</span>
<span class="font-label-sm text-label-sm text-tertiary bg-tertiary-fixed/50 px-2 py-0.5 rounded-full">Kredensial Penuh</span>
</div>
<div class="flex items-center gap-1 mt-3 font-label-sm text-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] text-primary">key</span>
<span>Hardware Token + 2FA Enforced</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-1">Log audit sinkron</span>
</div>
<!-- Stat 4 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl flex flex-col justify-between shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Pertumbuhan Mingguan</span>
<div class="w-8 h-8 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-container">
<span class="material-symbols-outlined text-[20px]">trending_up</span>
</div>
</div>
<div class="mt-4 flex items-baseline justify-between">
<span class="font-headline-lg text-headline-lg text-primary font-semibold">+42</span>
<span class="font-label-sm text-label-sm text-secondary font-medium">7 Hari Terakhir</span>
</div>
<!-- Inline Sparkline SVG -->
<div class="mt-3 flex items-center gap-2">
<svg class="w-24 h-5 text-primary" fill="none" viewbox="0 0 100 20">
<path d="M0 16 L18 14 L36 17 L54 9 L72 12 L90 3 L100 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
</svg>
<span class="font-label-sm text-label-sm text-on-surface-variant">+14% vs minggu lalu</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-1">Mayoritas verifikasi via WhatsApp OTP</span>
</div>
</div>
<!-- Operational Filter & Action Toolbar -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col xl:flex-row items-stretch xl:items-center justify-between gap-space-md">
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-space-sm flex-1">
<!-- Search Input -->
<div class="relative flex-1 min-w-[280px]">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">person_search</span>
<input class="w-full h-11 pl-10 pr-4 bg-surface-container-low text-on-surface placeholder:text-outline rounded-lg font-body-sm text-body-sm focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Cari nama staf, email resmi (@camprent.id), atau no. WhatsApp..." type="text"/>
</div>
<!-- Role Filter -->
<div class="relative">
<select class="w-full sm:w-auto h-11 pl-3 pr-8 bg-surface-container-low text-on-surface font-label-md text-label-md rounded-lg focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
<option>Semua Peran (Super Admin, Staff, User)</option>
<option>Super Admin</option>
<option>Staff Operasional (Logistik &amp; Kasir)</option>
<option>Staff QC &amp; Retur Peralatan</option>
<option>Pelanggan / Member Ekspedisi</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[18px]">expand_more</span>
</div>
<!-- Hub / Wilayah Filter -->
<div class="relative">
<select class="w-full sm:w-auto h-11 pl-3 pr-8 bg-surface-container-low text-on-surface font-label-md text-label-md rounded-lg focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
<option>Semua Wilayah Operasi</option>
<option>Kantor Pusat Bandung</option>
<option>Basecamp Cihampelas (Bandung)</option>
<option>Basecamp Patakbanteng (Dieng)</option>
<option>Hub Sembalun (Lombok)</option>
<option>Hub Ranupani (Semeru)</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[18px]">expand_more</span>
</div>
<!-- Status Filter -->
<div class="relative">
<select class="w-full sm:w-auto h-11 pl-3 pr-8 bg-surface-container-low text-on-surface font-label-md text-label-md rounded-lg focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
<option>Semua Status</option>
<option>Aktif</option>
<option>Ditangguhkan (Suspend)</option>
<option>Menunggu Verifikasi</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
<!-- Right Action Buttons -->
<div class="flex items-center gap-space-sm self-end xl:self-center">
<button class="h-11 px-4 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center gap-2 transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">download</span>
<span>Ekspor Data (.CSV)</span>
</button>
<button class="h-11 px-5 rounded-lg bg-primary hover:bg-[#1f3d2b] text-on-primary font-label-md text-label-md flex items-center gap-2 shadow-sm transition-all active:scale-[0.98]" type="button">
<span class="material-symbols-outlined text-[20px]">person_add</span>
<span>+ Tambah Akun Baru</span>
</button>
</div>
</div>
<!-- User Management Data Table -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
<th class="py-3.5 px-space-md font-semibold">Pengguna &amp; Kontak</th>
<th class="py-3.5 px-space-md font-semibold">Peran &amp; Otorisasi</th>
<th class="py-3.5 px-space-md font-semibold">Wilayah / Pos Tugas</th>
<th class="py-3.5 px-space-md font-semibold">Status Akun</th>
<th class="py-3.5 px-space-md font-semibold">Terakhir Login</th>
<th class="py-3.5 px-space-md font-semibold text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm text-on-surface">
<!-- Row 1: Super Admin Bambang -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-headline-sm text-headline-sm font-semibold shrink-0">
                  BH
                </div>
<div class="flex flex-col min-w-0">
<span class="font-semibold text-on-surface truncate">Bambang Hermawan</span>
<div class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
<span class="truncate">bambang.h@camprent.id</span>
<span>•</span>
<span class="shrink-0">0812-9876-5432</span>
</div>
</div>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">military_tech</span>
                Super Admin
              </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[18px] text-secondary">corporate_fare</span>
<span class="font-medium">Kantor Pusat &amp; Hub Bandung</span>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                Aktif
              </span>
</td>
<td class="py-3.5 px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-medium text-on-surface">5 menit yang lalu</span>
<span class="font-label-sm text-label-sm text-outline">Chrome (macOS)</span>
</div>
</td>
<td class="py-3.5 px-space-md text-right whitespace-nowrap">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors" title="Edit Data Pengguna" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors" title="Kirim Tautan Reset Sandi" type="button">
<span class="material-symbols-outlined text-[18px]">lock_reset</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors" title="Pilihan Lainnya" type="button">
<span class="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
<!-- Row 2: Sarah Melati -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-headline-sm text-headline-sm font-semibold shrink-0">
                  SM
                </div>
<div class="flex flex-col min-w-0">
<span class="font-semibold text-on-surface truncate">Sarah Melati</span>
<div class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
<span class="truncate">sarah.m@camprent.id</span>
<span>•</span>
<span class="shrink-0">0857-1122-3344</span>
</div>
</div>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">military_tech</span>
                Super Admin
              </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[18px] text-outline">terrain</span>
<span class="font-medium">Hub Sembalun (Lombok)</span>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                Aktif
              </span>
</td>
<td class="py-3.5 px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-medium text-on-surface">1 jam yang lalu</span>
<span class="font-label-sm text-label-sm text-outline">Safari (iPad OS)</span>
</div>
</td>
<td class="py-3.5 px-space-md text-right whitespace-nowrap">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors" title="Edit Data Pengguna" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors" title="Kirim Tautan Reset Sandi" type="button">
<span class="material-symbols-outlined text-[18px]">lock_reset</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
<!-- Row 3: Budi Santoso -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container text-primary flex items-center justify-center font-headline-sm text-headline-sm font-semibold shrink-0">
                  BS
                </div>
<div class="flex flex-col min-w-0">
<span class="font-semibold text-on-surface truncate">Budi Santoso</span>
<div class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
<span class="truncate">budi.s@camprent.id</span>
<span>•</span>
<span class="shrink-0">0813-4455-6677</span>
</div>
</div>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px] text-secondary">inventory_2</span>
                Staff Operasional (Logistik &amp; Kasir)
              </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[18px] text-outline">storefront</span>
<span>Pos Basecamp Cihampelas</span>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                Aktif
              </span>
</td>
<td class="py-3.5 px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-medium text-on-surface">Hari ini, 09:30 WIB</span>
<span class="font-label-sm text-label-sm text-outline">Aplikasi Kasir POS</span>
</div>
</td>
<td class="py-3.5 px-space-md text-right whitespace-nowrap">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors" title="Edit Data" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-error-container hover:text-error transition-colors" title="Tangguhkan Akun (Suspend)" type="button">
<span class="material-symbols-outlined text-[18px]">block</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
<!-- Row 4: Dian Lestari -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container text-primary flex items-center justify-center font-headline-sm text-headline-sm font-semibold shrink-0">
                  DL
                </div>
<div class="flex flex-col min-w-0">
<span class="font-semibold text-on-surface truncate">Dian Lestari</span>
<div class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
<span class="truncate">dian.l@camprent.id</span>
<span>•</span>
<span class="shrink-0">0821-3322-1100</span>
</div>
</div>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px] text-secondary">fact_check</span>
                Staff Operasional (QC &amp; Retur)
              </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[18px] text-outline">nature_people</span>
<span>Pos Patakbanteng (Dieng)</span>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                Aktif
              </span>
</td>
<td class="py-3.5 px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-medium text-on-surface">Hari ini, 11:05 WIB</span>
<span class="font-label-sm text-label-sm text-outline">Mobile Scanner v2.1</span>
</div>
</td>
<td class="py-3.5 px-space-md text-right whitespace-nowrap">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors" title="Edit Data" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-error-container hover:text-error transition-colors" title="Tangguhkan Akun (Suspend)" type="button">
<span class="material-symbols-outlined text-[18px]">block</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
<!-- Row 5: Hendra Wijaya -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container text-outline flex items-center justify-center font-headline-sm text-headline-sm font-semibold shrink-0">
                  HW
                </div>
<div class="flex flex-col min-w-0">
<div class="flex items-center gap-2">
<span class="font-semibold text-on-surface truncate">Hendra Wijaya</span>
<span class="px-1.5 py-0.5 rounded bg-surface-container text-outline font-label-sm text-label-sm">Penyewa</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
<span class="truncate">hendra.w@gmail.com</span>
<span>•</span>
<span class="shrink-0">0819-2233-4455</span>
</div>
</div>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">hiking</span>
                Pelanggan Umum
              </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-1.5 text-on-surface-variant">
<span class="material-symbols-outlined text-[18px] text-outline">home_pin</span>
<span>Bandung Barat</span>
</div>
</td>
<td class="py-3.5 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                Aktif
              </span>
</td>
<td class="py-3.5 px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-medium text-on-surface">Kemarin, 20:15 WIB</span>
<span class="font-label-sm text-label-sm text-outline">Web Reservasi Mandiri</span>
</div>
</td>
<td class="py-3.5 px-space-md text-right whitespace-nowrap">
<div class="inline-flex items-center gap-2">
<button class="px-3 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm font-semibold transition-colors" type="button">
                  Detail Profil
                </button>
<button class="px-3 py-1 rounded-lg bg-secondary-container hover:bg-secondary-fixed text-on-secondary-container font-label-sm text-label-sm font-semibold transition-colors" type="button">
                  Riwayat Sewa
                </button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination Footer -->
<div class="p-space-md bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-space-sm text-on-surface-variant font-label-md text-label-md">
<div class="flex items-center gap-2">
<span>Menampilkan <strong>1 - 5</strong> dari <strong>1,420</strong> total akun terdata</span>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface-container hover:bg-surface-container-high transition-colors" disabled="" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center bg-primary text-on-primary font-semibold" type="button">1</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface-container hover:bg-surface-container-high transition-colors" type="button">2</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface-container hover:bg-surface-container-high transition-colors" type="button">3</button>
<span class="px-1">...</span>
<button class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface-container hover:bg-surface-container-high transition-colors" type="button">142</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface-container hover:bg-surface-container-high transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Detailed Open Modal Component: 'Tambah Akun Pengguna Baru' -->
<!-- Designed prominently in place as an active contextual modal/card with rich interaction states -->
<div class="relative w-full rounded-2xl bg-surface-container-lowest shadow-xl p-space-xl overflow-hidden mt-space-sm">
<!-- Subtle top accent bar -->
<div class="absolute top-0 left-0 right-0 h-1.5 bg-primary"></div>
<!-- Modal Header -->
<div class="flex items-start justify-between pb-space-lg">
<div class="flex items-center gap-space-md">
<div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-[28px]">person_add</span>
</div>
<div class="flex flex-col">
<div class="flex items-center gap-2">
<h2 class="font-headline-md text-headline-md text-on-surface">Tambah Akun Pengguna Baru</h2>
<span class="px-2.5 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">Formulir Kredensial Staf</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
            Berikan hak akses sistem yang sesuai dengan tanggung jawab kerja &amp; pos tugas operasional CampRent Nusantara.
          </p>
</div>
</div>
<button aria-label="Tutup formulir" class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface-variant flex items-center justify-center transition-colors" type="button">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
<!-- Form Content -->
<form class="flex flex-col gap-space-lg pt-space-md">
<!-- 2-Column Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
<!-- Col 1: Nama Lengkap -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1">
<span>Nama Lengkap Staf / User</span>
<span class="text-error">*</span>
</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">badge</span>
<input class="w-full h-12 pl-10 pr-4 bg-surface text-on-surface font-body-md text-body-md rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" type="text" value="Ahmad Fauzi Rahman"/>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Sesuai kartu identitas (KTP/Passport) untuk keperluan verifikasi lapangan.</span>
</div>
<!-- Col 2: Alamat Email Resmi -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1">
<span>Alamat Email Resmi</span>
<span class="text-error">*</span>
</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
<input class="w-full h-12 pl-10 pr-4 bg-surface text-on-surface font-body-md text-body-md rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" type="email" value="ahmad.fauzi@camprent.id"/>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Gunakan domain resmi instansi untuk akun staf operasional.</span>
</div>
<!-- Col 1: Nomor Telepon / WA -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1">
<span>Nomor Telepon / WhatsApp Aktif</span>
<span class="text-error">*</span>
</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">call</span>
<input class="w-full h-12 pl-10 pr-4 bg-surface text-on-surface font-body-md text-body-md rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" type="tel" value="0812-3456-7890"/>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Digunakan untuk pengiriman One-Time Password (OTP) &amp; notifikasi darurat.</span>
</div>
<!-- Col 2: Peran Sistem (Role Otoritas) -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1">
<span>Peran Sistem (Role Otoritas)</span>
<span class="text-error">*</span>
</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">security</span>
<select class="w-full h-12 pl-10 pr-10 bg-surface text-on-surface font-body-md text-body-md rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
<option selected="">Staff Operasional (Logistik &amp; Kasir)</option>
<option>Super Admin (Akses Penuh)</option>
<option>Staff QC &amp; Retur Peralatan</option>
<option>Manajer Regional Wilayah</option>
<option>Pelanggan Reguler</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]">expand_more</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Menentukan akses modul kasir, peminjaman, serta izin pembatalan reservasi.</span>
</div>
<!-- Full row: Wilayah Operasional / Pos Basecamp Tugas -->
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1">
<span>Wilayah Operasional / Pos Basecamp Tugas</span>
<span class="text-error">*</span>
</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">warehouse</span>
<select class="w-full h-12 pl-10 pr-10 bg-surface text-on-surface font-body-md text-body-md rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
<option selected="">Pos Basecamp Cihampelas Bandung (Gudang Utama Jabar)</option>
<option>Kantor Pusat CampRent Nusantara (Bandung)</option>
<option>Pos Basecamp Patakbanteng (Dieng - Wonosobo)</option>
<option>Hub Basecamp Sembalun (Gunung Rinjani - Lombok)</option>
<option>Hub Ranupani (Taman Nasional Bromo Tengger Semeru)</option>
<option>Pos Pelayanan Kuta (Bali &amp; Jalur Penjelajah)</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]">expand_more</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Staf hanya dapat mengelola inventaris fisik dan transaksi kas di pos tugas yang ditentukan.</span>
</div>
<!-- Full row: Kata Sandi Sementara with Random Generator -->
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-md text-label-md text-on-surface font-semibold flex items-center justify-between">
<span class="flex items-center gap-1">
<span>Kata Sandi Sementara (Default)</span>
<span class="text-error">*</span>
</span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Tingkat Keamanan: Sangat Kuat</span>
</label>
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-space-sm">
<div class="relative flex-1">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
<input class="w-full h-12 pl-10 pr-10 bg-surface text-on-surface font-body-md text-body-md tracking-wider rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20" id="temp-password-input" type="password" value="Rinjani#Camp2024!Safe"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors" onclick="const input = document.getElementById('temp-password-input'); input.type = input.type === 'password' ? 'text' : 'password';" title="Lihat Sandi" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
<button class="h-12 px-4 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center justify-center gap-2 transition-colors shrink-0" type="button">
<span class="material-symbols-outlined text-[18px] text-primary">autorenew</span>
<span>Hasilkan Sandi Acak</span>
</button>
</div>
<!-- Helper Box -->
<div class="p-3 bg-surface-container rounded-xl flex items-start gap-2.5 mt-1">
<span class="material-symbols-outlined text-secondary text-[20px] shrink-0 mt-0.5">info</span>
<p class="font-label-sm text-label-sm text-on-surface-variant leading-relaxed">
              Minimal 8 karakter, kombinasi huruf besar, kecil, angka, dan simbol khusus. Staf diwajibkan mengganti kata sandi ini saat proses login pertama di sistem.
            </p>
</div>
</div>
<!-- Status Awal Akun Radio Group -->
<div class="flex flex-col gap-space-xs md:col-span-2">
<label class="font-label-md text-label-md text-on-surface font-semibold">Status Awal Akun Baru</label>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md mt-1">
<label class="flex items-start gap-3 p-3.5 rounded-xl bg-surface-container-low cursor-pointer transition-all hover:bg-surface-container">
<input checked="" class="mt-1 accent-primary w-4 h-4" name="status_awal" type="radio"/>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface font-semibold">Aktif Segera (Direkomendasikan)</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Staf langsung bisa login, mencatat peminjaman, dan membuka shift kasir.</span>
</div>
</label>
<label class="flex items-start gap-3 p-3.5 rounded-xl bg-surface-container-low cursor-pointer transition-all hover:bg-surface-container">
<input class="mt-1 accent-primary w-4 h-4" name="status_awal" type="radio"/>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface font-semibold">Tunda Aktivasi</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Kredensial disimpan tetapi belum diizinkan mengakses transaksi hingga diverifikasi admin wilayah.</span>
</div>
</label>
</div>
</div>
<!-- Email Notification Checkbox -->
<div class="md:col-span-2 bg-secondary-container/40 p-4 rounded-xl flex items-center justify-between gap-space-md">
<label class="flex items-center gap-3 cursor-pointer">
<input checked="" class="accent-primary w-4 h-4 rounded" type="checkbox"/>
<span class="font-label-md text-label-md text-on-surface">
              Kirimkan detail kredensial dan panduan login ke email resmi terdaftar (<strong class="text-primary font-semibold">ahmad.fauzi@camprent.id</strong>)
            </span>
</label>
<span class="material-symbols-outlined text-[20px] text-secondary shrink-0 hidden sm:block">outgoing_mail</span>
</div>
</div>
<!-- Modal Footer -->
<div class="flex flex-col sm:flex-row items-center justify-end gap-space-sm pt-space-lg">
<button class="w-full sm:w-auto h-12 px-6 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md transition-colors" type="button">
          Batal
        </button>
<button class="w-full sm:w-auto h-12 px-7 rounded-xl bg-primary hover:bg-[#1f3d2b] text-on-primary font-label-md text-label-md flex items-center justify-center gap-2 shadow-sm transition-all active:scale-[0.98]" type="button">
<span class="material-symbols-outlined text-[20px]">how_to_reg</span>
<span>+ Simpan &amp; Terbitkan Kredensial</span>
</button>
</div>
</form>
</div>
<!-- Bottom Compliance Notice Card -->
<div class="bg-surface-container p-space-md rounded-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-space-md">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-surface-container-lowest text-tertiary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[24px]">gavel</span>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface font-semibold">Kebijakan Keamanan Kredensial Nusantara</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">
          Semua akun staf wajib mengaktifkan 2-Factor Authentication (2FA) saat mengakses modul inventaris dan kas operasional. Sesi login otomatis kedaluwarsa setelah 12 jam tidak aktif.
        </p>
</div>
</div>
<a class="font-label-sm text-label-sm text-primary hover:underline font-semibold shrink-0 flex items-center gap-1 self-end md:self-auto" href="#">
<span>Baca SOP Hak Akses Lengkap</span>
<span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>
</div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
