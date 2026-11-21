<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Reservasi";
$bodyClass = "bg-surface font-body-md text-on-surface antialiased";
$activeMenu = 'reservasi';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="relative pt-16 min-h-screen bg-surface w-full px-space-xl py-space-xl"><div class="flex flex-col w-full">
<!-- Top Breadcrumb & Page Introduction Header -->
<div class="flex flex-col gap-space-xs mb-space-lg">
<nav class="flex items-center gap-2 text-on-surface-variant font-label-md text-label-md">
<span class="hover:text-primary transition-colors cursor-pointer">Operasional</span>
<span class="material-symbols-outlined text-[14px]">chevron_right</span>
<span class="text-primary font-bold">Manajemen Reservasi</span>
<span class="material-symbols-outlined text-[14px]">chevron_right</span>
<span class="text-outline text-label-sm">Daftar Aktif (Q4 2025)</span>
</nav>
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md pt-space-xs">
<div>
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight leading-tight">
          Manajemen Reservasi &amp; Booking Sewa
        </h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl mt-1">
          Verifikasi pesanan masuk, pantau status pembayaran, serah terima gear basecamp, dan kelola penerbitan surat jalan.
        </p>
</div>
<div class="flex items-center gap-space-sm flex-wrap">
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors font-label-lg text-label-lg shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px] text-primary">download</span>
<span>Ekspor Laporan (.CSV)</span>
</button>
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors font-label-lg text-label-lg shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px] text-primary">print</span>
<span>Cetak Jadwal Serah</span>
</button>
</div>
</div>
</div>
<!-- KPI Metrik Ringkas Grid (4 Cards) -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md mb-space-xl">
<!-- Total Booking -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Total Booking Hari Ini</span>
<span class="font-headline-md text-headline-md text-on-surface mt-1">48 Reservasi</span>
</div>
<div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[22px]">calendar_month</span>
</div>
</div>
<div class="mt-4 flex items-center gap-1.5 text-on-surface-variant font-label-sm text-label-sm">
<span class="inline-flex items-center text-primary font-bold">
<span class="material-symbols-outlined text-[16px]">trending_up</span>+12%
        </span>
<span>vs rata-rata kemarin (42 pesanan)</span>
</div>
</div>
<!-- Menunggu Konfirmasi -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary font-bold">Menunggu Konfirmasi</span>
<span class="font-headline-md text-headline-md text-tertiary-container mt-1">5 Pesanan</span>
</div>
<div class="w-10 h-10 rounded-lg bg-tertiary-fixed flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined text-[22px]">pending_actions</span>
</div>
</div>
<div class="mt-4 flex items-center justify-between">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary-container animate-pulse"></span>
          Perlu Validasi Segera
        </span>
<span class="font-label-sm text-label-sm text-outline">Prioritas 1-2 Jam</span>
</div>
</div>
<!-- Siap Ambil / Siap Serah -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Siap Ambil / Basecamp</span>
<span class="font-headline-md text-headline-md text-secondary mt-1">12 Pesanan</span>
</div>
<div class="w-10 h-10 rounded-lg bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
<span class="material-symbols-outlined text-[22px]">package_2</span>
</div>
</div>
<div class="mt-4 flex items-center justify-between">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-bold">
          Lolos QC Sanitasi 100%
        </span>
<span class="font-label-sm text-label-sm text-outline">Basecamp Cihampelas</span>
</div>
</div>
<!-- Sedang Disewa Lapangan -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Sedang Disewa Lapangan</span>
<span class="font-headline-md text-headline-md text-primary mt-1">26 Unit Paket</span>
</div>
<div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
<span class="material-symbols-outlined text-[22px]">terrain</span>
</div>
</div>
<div class="mt-4 flex items-center justify-between">
<div class="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 78%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant font-bold ml-2">78%</span>
</div>
</div>
</div>
<!-- Filter, Search & Status Segment Toolbar -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm mb-space-lg flex flex-col gap-space-md">
<div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-space-md">
<!-- Search Input -->
<div class="relative flex-1 min-w-[280px]">
<span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
<input class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container transition-all" placeholder="Cari kode booking, nama penyewa, atau no. WA..." type="text"/>
</div>
<!-- Quick Date Range Picker simulation -->
<div class="flex items-center gap-space-sm flex-wrap">
<div class="flex items-center gap-2 px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px] text-primary">date_range</span>
<span class="font-bold">20 Des - 25 Des 2025</span>
<span class="material-symbols-outlined text-[16px] text-outline">arrow_drop_down</span>
</div>
<div class="flex items-center gap-2 px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px] text-primary">warehouse</span>
<span>Pos: Semua Hub (Bandung &amp; Sembalun)</span>
<span class="material-symbols-outlined text-[16px] text-outline">arrow_drop_down</span>
</div>
</div>
</div>
<!-- Status Horizontal Filter Pills -->
<div class="flex items-center gap-2 overflow-x-auto pb-1 text-label-md font-label-md">
<button class="px-3.5 py-1.5 rounded-full bg-primary text-on-primary font-bold shrink-0" type="button">
        Semua Status (48)
      </button>
<button class="px-3.5 py-1.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-bold flex items-center gap-1.5 shrink-0" type="button">
<span class="w-2 h-2 rounded-full bg-tertiary"></span>
        Menunggu Konfirmasi (5)
      </button>
<button class="px-3.5 py-1.5 rounded-full bg-surface-container text-on-surface-variant hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors font-medium shrink-0" type="button">
        Siap Ambil (12)
      </button>
<button class="px-3.5 py-1.5 rounded-full bg-surface-container text-on-surface-variant hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors font-medium shrink-0" type="button">
        Sedang Disewa (26)
      </button>
<button class="px-3.5 py-1.5 rounded-full bg-surface-container text-on-surface-variant hover:bg-surface-container-high transition-colors font-medium shrink-0" type="button">
        Selesai / Kembali (4)
      </button>
<button class="px-3.5 py-1.5 rounded-full bg-surface-container text-on-surface-variant hover:bg-error-container hover:text-on-error-container transition-colors font-medium shrink-0" type="button">
        Dibatalkan (1)
      </button>
</div>
</div>
<!-- Main Reservation Table Container -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-xl">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
<th class="py-3.5 px-space-md font-bold">KODE &amp; WAKTU</th>
<th class="py-3.5 px-space-md font-bold">PENYEWA &amp; KONTAK</th>
<th class="py-3.5 px-space-md font-bold">JADWAL &amp; DURASI</th>
<th class="py-3.5 px-space-md font-bold">UNIT PERLENGKAPAN</th>
<th class="py-3.5 px-space-md font-bold">BIAYA &amp; DEPOSIT</th>
<th class="py-3.5 px-space-md font-bold">PEMBAYARAN</th>
<th class="py-3.5 px-space-md font-bold">STATUS SEWA</th>
<th class="py-3.5 px-space-md font-bold text-right">AKSI CEPAT</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm">
<!-- Row 1 (Highlight Focus: Ahmad Fauzi) -->
<tr class="bg-secondary-fixed/15 hover:bg-secondary-fixed/25 transition-colors">
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-primary flex items-center gap-1">
                  #CR-1110
                  <span class="material-symbols-outlined text-[16px] text-tertiary-container" title="Menunggu Konfirmasi">notification_important</span>
</span>
<span class="text-outline text-label-sm font-label-sm mt-0.5">24 Okt 14:15 WIB</span>
<span class="mt-1 text-label-sm font-label-sm px-1.5 py-0.5 rounded bg-surface-container-high text-on-surface-variant inline-block w-max">Basecamp BDG</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex items-start gap-2.5">
<div class="w-9 h-9 rounded-full bg-primary-container text-on-primary-container font-bold flex items-center justify-center text-label-md shrink-0">
                  AF
                </div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Ahmad Fauzi</span>
<div class="flex items-center gap-1 text-outline font-label-sm text-label-sm mt-0.5">
<span class="material-symbols-outlined text-[14px] text-primary">verified</span>
<span>0812-9876-5432</span>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Gunung Prau Expedition</span>
</div>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">20 - 22 Des 2025</span>
<span class="text-primary font-bold font-label-sm text-label-sm mt-0.5 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">timelapse</span> 2 Hari Sewa
                </span>
<span class="text-label-sm font-label-sm text-outline">Ambil: 09:00 WIB</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<span class="text-on-surface font-medium truncate font-label-md text-label-md">• 1x Tenda Kap-4 Double Layer</span>
<span class="text-on-surface-variant truncate font-label-sm text-label-sm">• 1x Kompor Ultralight Windproof</span>
<span class="text-outline font-label-sm text-label-sm">+ 1 Unit Nesting DS-300</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Rp 230.000</span>
<span class="text-label-sm font-label-sm text-primary font-medium mt-0.5">Inc. Dep: Rp 50.000</span>
<span class="text-label-sm font-label-sm text-outline">Sewa: Rp 130.000</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Lunas (BCA VA)
              </span>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-bold font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary-container animate-ping"></span>
                Menunggu Konfirmasi
              </span>
</td>
<td class="py-4 px-space-md align-top text-right">
<div class="flex items-center justify-end gap-1.5">
<button class="p-1.5 rounded-lg bg-surface-container-high text-primary hover:bg-primary-fixed hover:text-on-primary-fixed transition-colors" title="Lihat Detail Booking" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="px-2.5 py-1.5 rounded-lg bg-primary text-on-primary font-label-sm text-label-sm font-bold hover:bg-secondary transition-colors" title="Konfirmasi Langsung" type="button">
                  Konfirmasi
                </button>
</div>
</td>
</tr>
<!-- Row 2 (Siti Rahmawati - Siap Ambil) -->
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">#CR-1105</span>
<span class="text-outline text-label-sm font-label-sm mt-0.5">24 Okt 11:30 WIB</span>
<span class="mt-1 text-label-sm font-label-sm px-1.5 py-0.5 rounded bg-surface-container-high text-on-surface-variant inline-block w-max">Hub Sembalun</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex items-start gap-2.5">
<div class="w-9 h-9 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold flex items-center justify-center text-label-md shrink-0">
                  SR
                </div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Siti Rahmawati</span>
<div class="flex items-center gap-1 text-outline font-label-sm text-label-sm mt-0.5">
<span class="material-symbols-outlined text-[14px] text-primary">verified</span>
<span>0857-1122-3344</span>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Rinjani Summit Trek</span>
</div>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">21 - 24 Des 2025</span>
<span class="text-primary font-bold font-label-sm text-label-sm mt-0.5 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">timelapse</span> 3 Hari Sewa
                </span>
<span class="text-label-sm font-label-sm text-outline">Ambil: 06:30 WITA</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<span class="text-on-surface font-medium truncate font-label-md text-label-md">• 1x Carrier 60L Alpine Pro</span>
<span class="text-on-surface-variant truncate font-label-sm text-label-sm">• 2x Trekking Pole Carbon</span>
<span class="text-outline font-label-sm text-label-sm">+ Matras Alumunium Foil</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Rp 315.000</span>
<span class="text-label-sm font-label-sm text-primary font-medium mt-0.5">Inc. Dep: Rp 75.000</span>
<span class="text-label-sm font-label-sm text-outline">Sewa: Rp 210.000</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Lunas (Mandiri VA)
              </span>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-bold font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Siap Ambil
              </span>
</td>
<td class="py-4 px-space-md align-top text-right">
<div class="flex items-center justify-end gap-1.5">
<button class="p-1.5 rounded-lg bg-surface-container-high text-primary hover:bg-primary-fixed hover:text-on-primary-fixed transition-colors" title="Lihat Detail Booking" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="p-1.5 rounded-lg bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest transition-colors" title="Cetak Surat Jalan" type="button">
<span class="material-symbols-outlined text-[18px]">print</span>
</button>
</div>
</td>
</tr>
<!-- Row 3 (Budi Santoso - Sedang Disewa) -->
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">#CR-1101</span>
<span class="text-outline text-label-sm font-label-sm mt-0.5">23 Okt 09:20 WIB</span>
<span class="mt-1 text-label-sm font-label-sm px-1.5 py-0.5 rounded bg-surface-container-high text-on-surface-variant inline-block w-max">Basecamp BDG</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex items-start gap-2.5">
<div class="w-9 h-9 rounded-full bg-surface-container-highest text-on-surface font-bold flex items-center justify-center text-label-md shrink-0">
                  BS
                </div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Budi Santoso</span>
<div class="flex items-center gap-1 text-outline font-label-sm text-label-sm mt-0.5">
<span class="material-symbols-outlined text-[14px] text-primary">verified</span>
<span>0813-4455-6677</span>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Gunung Gede Pangrango</span>
</div>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">23 - 25 Des 2025</span>
<span class="text-secondary font-bold font-label-sm text-label-sm mt-0.5 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">hiking</span> Hari ke-2 dari 3
                </span>
<span class="text-label-sm font-label-sm text-outline">Kembali: 25 Des 18:00</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<span class="text-on-surface font-medium truncate font-label-md text-label-md">• 2x Sleeping Bag Goose-Down</span>
<span class="text-on-surface-variant truncate font-label-sm text-label-sm">• 1x Lampu Tenda Rechargeable</span>
<span class="text-outline font-label-sm text-label-sm">+ Flysheet 3x4 Waterproof</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Rp 185.000</span>
<span class="text-label-sm font-label-sm text-primary font-medium mt-0.5">Inc. Dep: Rp 40.000</span>
<span class="text-label-sm font-label-sm text-outline">Sewa: Rp 120.000</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Lunas (QRIS)
              </span>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed-dim text-on-primary-fixed font-bold font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Sedang Disewa
              </span>
</td>
<td class="py-4 px-space-md align-top text-right">
<div class="flex items-center justify-end gap-1.5">
<button class="p-1.5 rounded-lg bg-surface-container-high text-primary hover:bg-primary-fixed hover:text-on-primary-fixed transition-colors" title="Lihat Detail Booking" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="p-1.5 rounded-lg bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest transition-colors" title="Pantau Pengembalian" type="button">
<span class="material-symbols-outlined text-[18px]">assignment_return</span>
</button>
</div>
</td>
</tr>
<!-- Row 4 (Dian Prasetyo - Selesai) -->
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">#CR-1098</span>
<span class="text-outline text-label-sm font-label-sm mt-0.5">22 Okt 16:40 WIB</span>
<span class="mt-1 text-label-sm font-label-sm px-1.5 py-0.5 rounded bg-surface-container-high text-on-surface-variant inline-block w-max">Hub Sembalun</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex items-start gap-2.5">
<div class="w-9 h-9 rounded-full bg-surface-container text-on-surface-variant font-bold flex items-center justify-center text-label-md shrink-0">
                  DP
                </div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Dian Prasetyo</span>
<div class="flex items-center gap-1 text-outline font-label-sm text-label-sm mt-0.5">
<span class="material-symbols-outlined text-[14px] text-primary">verified</span>
<span>0821-3322-1100</span>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Solo Hiking Merbabu</span>
</div>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">22 - 24 Des 2025</span>
<span class="text-outline font-bold font-label-sm text-label-sm mt-0.5 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">done_all</span> Kembali Tepat Waktu
                </span>
<span class="text-label-sm font-label-sm text-outline">Deposit Dikembalikan</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<span class="text-on-surface font-medium truncate font-label-md text-label-md">• 1x Tenda Solo Ultralight</span>
<span class="text-on-surface-variant truncate font-label-sm text-label-sm">• 1x Matras Tiup Inflatable</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Rp 140.000</span>
<span class="text-label-sm font-label-sm text-outline font-medium mt-0.5">Dep. Rp 30.000 (Refunded)</span>
<span class="text-label-sm font-label-sm text-outline">Total Sewa Bersih: Rp 110.000</span>
</div>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
              </span>
</td>
<td class="py-4 px-space-md align-top">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-bold font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">task_alt</span>
                Selesai
              </span>
</td>
<td class="py-4 px-space-md align-top text-right">
<div class="flex items-center justify-end gap-1.5">
<button class="p-1.5 rounded-lg bg-surface-container-high text-primary hover:bg-primary-fixed hover:text-on-primary-fixed transition-colors" title="Lihat Arsip Booking" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination Footer -->
<div class="px-space-md py-3.5 bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-space-sm">
<span class="text-on-surface-variant font-label-sm text-label-sm">
        Menampilkan <span class="font-bold text-on-surface">1 - 4</span> dari total <span class="font-bold text-on-surface">48</span> reservasi aktif
      </span>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-outline hover:bg-surface-container-high transition-colors" disabled="" type="button">
<span class="material-symbols-outlined text-[16px]">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-label-sm text-label-sm font-bold" type="button">1</button>
<button class="w-8 h-8 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors font-label-sm text-label-sm font-medium" type="button">2</button>
<button class="w-8 h-8 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors font-label-sm text-label-sm font-medium" type="button">3</button>
<span class="px-1 text-outline font-label-sm text-label-sm">...</span>
<button class="w-8 h-8 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors font-label-sm text-label-sm font-medium" type="button">12</button>
<button class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-on-surface hover:bg-surface-container-high transition-colors" type="button">
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Interactive Active Detail Panel / Modal Section for CR-1110 -->
<div class="bg-surface-container-lowest rounded-2xl shadow-xl overflow-hidden mb-space-xl">
<!-- Modal Top Bar -->
<div class="bg-[#1f3d2b] text-surface px-space-lg py-4 flex flex-col md:flex-row md:items-center justify-between gap-space-sm">
<div class="flex items-center gap-space-sm flex-wrap">
<div class="w-9 h-9 rounded-lg bg-secondary-fixed flex items-center justify-center text-[#1f3d2b]">
<span class="material-symbols-outlined text-[20px]">assignment</span>
</div>
<div>
<div class="flex items-center gap-2">
<h2 class="font-headline-sm text-headline-sm text-surface tracking-tight">Detail Reservasi #CR-1110</h2>
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-bold font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
              Menunggu Konfirmasi
            </span>
</div>
<span class="text-secondary-fixed-dim font-label-sm text-label-sm">
            Dibuat melalui Web CampRent: 24 Oktober 2024, 14:15 WIB (Hub Basecamp Cihampelas Bandung)
          </span>
</div>
</div>
<div class="flex items-center gap-2">
<span class="font-label-sm text-label-sm text-[#a2d2aa] px-2.5 py-1 rounded bg-[#275334]">Staff Verifikator: Bambang Hermawan</span>
<button class="text-secondary-fixed-dim hover:text-surface transition-colors p-1" title="Tutup Panel" type="button">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
</div>
<!-- Modal Content: 2 Columns Split Grid -->
<div class="p-space-lg grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
<!-- Kolom Kiri (Data Penyewa, Basecamp & Catatan Khusus) - span 6 -->
<div class="lg:col-span-6 flex flex-col gap-space-md">
<!-- Card 1: Data Identitas Penyewa -->
<div class="bg-surface-container-low rounded-xl p-space-md shadow-sm">
<div class="flex items-center justify-between mb-space-sm">
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-primary flex items-center gap-1.5">
<span class="material-symbols-outlined text-[18px]">person_check</span>
              Data Identitas Penyewa
            </span>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary font-bold px-2 py-0.5 rounded-full bg-secondary-fixed">
<span class="material-symbols-outlined text-[14px]">check</span> e-KTP Valid
            </span>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm font-body-sm text-body-sm">
<div class="flex flex-col">
<span class="text-outline font-label-sm text-label-sm">Nama Lengkap</span>
<span class="font-bold text-on-surface">Ahmad Fauzi</span>
</div>
<div class="flex flex-col">
<span class="text-outline font-label-sm text-label-sm">Nomor WhatsApp Aktif</span>
<span class="font-bold text-primary flex items-center gap-1">
                0812-9876-5432
                <span class="material-symbols-outlined text-[14px]">chat</span>
</span>
</div>
<div class="flex flex-col">
<span class="text-outline font-label-sm text-label-sm">Email Terdaftar</span>
<span class="text-on-surface">ahmad.fauzi@gmail.com</span>
</div>
<div class="flex flex-col">
<span class="text-outline font-label-sm text-label-sm">Kontak Darurat (Emergency)</span>
<span class="text-on-surface font-medium">Rina Fauzi (Istri) • 0812-1111-2222</span>
</div>
<div class="sm:col-span-2 flex flex-col">
<span class="text-outline font-label-sm text-label-sm">Alamat Domisili KTP</span>
<span class="text-on-surface">Jl. Dago Asri No. 14, Coblong, Kota Bandung, Jawa Barat</span>
</div>
</div>
</div>
<!-- Card 2: Titik Pengambilan & Jadwal Basecamp -->
<div class="bg-surface-container-low rounded-xl p-space-md shadow-sm">
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-primary flex items-center gap-1.5 mb-space-sm">
<span class="material-symbols-outlined text-[18px]">location_on</span>
            Jadwal &amp; Titik Serah Terima
          </span>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm font-body-sm text-body-sm">
<div class="p-3 rounded-lg bg-surface-container-lowest">
<div class="flex items-center gap-1.5 text-primary font-bold font-label-sm text-label-sm mb-1">
<span class="material-symbols-outlined text-[16px]">outbox</span> Pengambilan Gear
              </div>
<span class="font-headline-sm text-headline-sm text-on-surface block leading-tight">20 Des 2025</span>
<span class="font-label-md text-label-md text-on-surface-variant font-medium">Pukul 09:00 WIB</span>
<span class="text-outline font-label-sm text-label-sm block mt-1">Basecamp Cihampelas Bandung</span>
</div>
<div class="p-3 rounded-lg bg-surface-container-lowest">
<div class="flex items-center gap-1.5 text-on-surface-variant font-bold font-label-sm text-label-sm mb-1">
<span class="material-symbols-outlined text-[16px]">inbox</span> Pengembalian Gear
              </div>
<span class="font-headline-sm text-headline-sm text-on-surface block leading-tight">22 Des 2025</span>
<span class="font-label-md text-label-md text-on-surface-variant font-medium">Maksimal 18:00 WIB</span>
<span class="text-outline font-label-sm text-label-sm block mt-1">Basecamp Cihampelas Bandung</span>
</div>
</div>
<div class="mt-3 flex items-center gap-2 p-2.5 rounded-lg bg-surface-container text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[18px] text-primary">explore</span>
<span>Destinasi Ekspedisi Rombongan: <strong>Gunung Prau via Dieng (3 Orang Anggota)</strong></span>
</div>
</div>
<!-- Card 3: Catatan Khusus Penyewa -->
<div class="bg-tertiary-fixed/30 rounded-xl p-space-md shadow-sm">
<div class="flex items-center gap-2 text-tertiary font-bold font-label-sm text-label-sm uppercase tracking-wider mb-2">
<span class="material-symbols-outlined text-[18px]">sticky_note_2</span>
            Catatan Penting dari Penyewa
          </div>
<p class="font-body-sm text-body-sm text-on-surface italic leading-relaxed">
            “Mohon dicek tenda dipastikan seal seam tape-nya aman dan tidak ada rembesan air karena perkiraan cuaca hujan rintik di Gunung Prau. Kompor tolong dipastikan selang regulatornya rapat serta pemantik piezo-nya berfungsi normal. Terima kasih CampRent!”
          </p>
</div>
</div>
<!-- Kolom Kanan (Pratinjau Gear Foto, Rincian Sewa, & Ringkasan Biaya) - span 6 -->
<div class="lg:col-span-6 flex flex-col gap-space-md">
<!-- Visual Gear Preview with authentic photography placeholders -->
<div class="bg-surface-container-low rounded-xl p-space-md shadow-sm">
<div class="flex items-center justify-between mb-space-sm">
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-primary flex items-center gap-1.5">
<span class="material-symbols-outlined text-[18px]">backpack</span>
              Rincian Unit Gear Disewa
            </span>
<span class="font-label-sm text-label-sm text-outline">Kondisi: Siap Pakai (Inspeksi QC Ok)</span>
</div>
<!-- Product Item Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm mb-space-md">
<!-- Item 1: Tenda -->
<div class="bg-surface-container-lowest rounded-lg p-2.5 flex items-center gap-3">
<div class="w-16 h-16 rounded-md overflow-hidden shrink-0 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Modern orange and gray dome camping tent pitched on a scenic misty mountain ridge overlooking layered peaks during warm golden sunset light with dramatic clouds" src="<?= asset('images/tenda-dome.jpg') ?>"/>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md font-bold text-on-surface truncate">Tenda Kap-4 Double Layer</span>
<span class="font-label-sm text-label-sm text-outline">Seri: Borneo 4 Pro Waterproof</span>
<span class="font-label-sm text-label-sm font-bold text-primary mt-1">Rp 45.000 / hari (x2)</span>
</div>
</div>
<!-- Item 2: Kompor Gas Portable -->
<div class="bg-surface-container-lowest rounded-lg p-2.5 flex items-center gap-3">
<div class="w-16 h-16 rounded-md overflow-hidden shrink-0 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Ultralight stainless steel camping stove boiling water in an anodized pot outdoors on a rustic wooden platform with majestic forested pine mountains backdrop" src="<?= asset('images/kompor-portable.jpg') ?>"/>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md font-bold text-on-surface truncate">Kompor Ultralight Windproof</span>
<span class="font-label-sm text-label-sm text-outline">Seri: FireMaple FMS-105 Stove</span>
<span class="font-label-sm text-label-sm font-bold text-primary mt-1">Rp 20.000 / hari (x2)</span>
</div>
</div>
</div>
<!-- Unit Gear Table Breakdown -->
<div class="overflow-hidden rounded-lg bg-surface-container-lowest">
<table class="w-full text-left font-body-sm text-body-sm">
<thead>
<tr class="bg-surface-container font-label-sm text-label-sm text-on-surface-variant">
<th class="py-2 px-3 font-bold">Item Perlengkapan</th>
<th class="py-2 px-3 font-bold text-center">Durasi</th>
<th class="py-2 px-3 font-bold text-right">Tarif / Hari</th>
<th class="py-2 px-3 font-bold text-right">Subtotal</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container">
<tr>
<td class="py-2.5 px-3">
<span class="font-bold text-on-surface block">1x Tenda Dome 4-P (Double Layer)</span>
<span class="text-outline text-label-sm font-label-sm">Barcode: TN-4P-022</span>
</td>
<td class="py-2.5 px-3 text-center text-on-surface font-medium">2 Hari</td>
<td class="py-2.5 px-3 text-right text-on-surface-variant">Rp 45.000</td>
<td class="py-2.5 px-3 text-right font-bold text-on-surface">Rp 90.000</td>
</tr>
<tr>
<td class="py-2.5 px-3">
<span class="font-bold text-on-surface block">1x Kompor Ultralight Windproof</span>
<span class="text-outline text-label-sm font-label-sm">Barcode: KP-UL-081</span>
</td>
<td class="py-2.5 px-3 text-center text-on-surface font-medium">2 Hari</td>
<td class="py-2.5 px-3 text-right text-on-surface-variant">Rp 20.000</td>
<td class="py-2.5 px-3 text-right font-bold text-on-surface">Rp 40.000</td>
</tr>
</tbody>
</table>
</div>
</div>
<!-- Ringkasan Finansial, Deposit, dan Pembayaran Status -->
<div class="bg-surface-container-low rounded-xl p-space-md shadow-sm">
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-primary flex items-center justify-between mb-space-sm">
<span class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[18px]">receipt_long</span>
              Ringkasan Pembayaran &amp; Deposit
            </span>
<span class="text-on-secondary-container bg-secondary-fixed px-2 py-0.5 rounded font-label-sm text-label-sm font-bold">
              VA BCA - Terverifikasi
            </span>
</span>
<div class="flex flex-col gap-2 font-body-sm text-body-sm">
<div class="flex items-center justify-between text-on-surface-variant">
<span>Subtotal Sewa Perlengkapan (2 Unit x 2 Hari)</span>
<span class="font-medium text-on-surface">Rp 130.000</span>
</div>
<div class="flex items-center justify-between text-on-surface-variant">
<span class="flex items-center gap-1">
                Jaminan Kerusakan (Deposit Refundable)
                <span class="material-symbols-outlined text-[14px] text-outline cursor-help" title="Akan ditransfer kembali 100% setelah pengecekan fisik saat pengembalian">help</span>
</span>
<span class="font-medium text-primary">Rp 50.000</span>
</div>
<div class="flex items-center justify-between text-on-surface-variant">
<span>Biaya Sanitasi Higienis &amp; Packing Seal</span>
<span class="font-medium text-on-surface">Rp 50.000</span>
</div>
<div class="pt-2 mt-1 border-t border-surface-container flex items-center justify-between">
<div>
<span class="font-headline-sm text-headline-sm font-bold text-on-surface block leading-tight">Total Pelunasan</span>
<span class="font-label-sm text-label-sm text-outline">Termasuk PPN 11% &amp; Deposit Pengaman</span>
</div>
<span class="font-headline-md text-headline-md font-bold text-primary">Rp 230.000</span>
</div>
</div>
</div>
</div>
</div>
<!-- Modal Footer Actions Toolbar -->
<div class="px-space-lg py-4 bg-surface-container flex flex-col sm:flex-row items-center justify-between gap-space-sm">
<div class="flex items-center gap-2 w-full sm:w-auto">
<button class="w-full sm:w-auto px-4 py-2.5 rounded-lg bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest transition-colors font-label-lg text-label-lg font-bold" type="button">
          Tutup
        </button>
<button class="w-full sm:w-auto px-4 py-2.5 rounded-lg bg-error-container text-on-error-container hover:bg-error hover:text-on-error transition-colors font-label-lg text-label-lg font-bold flex items-center justify-center gap-1" type="button">
<span class="material-symbols-outlined text-[18px]">block</span>
<span>Tolak Booking</span>
</button>
</div>
<div class="flex items-center gap-space-sm w-full sm:w-auto">
<button class="w-full sm:w-auto px-4 py-2.5 rounded-lg bg-surface-container-lowest text-primary hover:bg-secondary-fixed transition-colors font-label-lg text-label-lg font-bold shadow-sm flex items-center justify-center gap-1.5" type="button">
<span class="material-symbols-outlined text-[18px]">print</span>
<span>Cetak Surat Jalan</span>
</button>
<button class="w-full sm:w-auto px-6 py-2.5 rounded-lg bg-primary text-on-primary hover:bg-[#1f3d2b] transition-colors font-label-lg text-label-lg font-bold shadow-sm flex items-center justify-center gap-2" type="button">
<span class="material-symbols-outlined text-[20px]">task_alt</span>
<span>Konfirmasi &amp; Terbitkan Kartu Ambil</span>
</button>
</div>
</div>
</div>
<!-- Operational Flow Quick Guidelines Note Card -->
<div class="bg-surface-container rounded-xl p-space-md flex flex-col md:flex-row items-start md:items-center justify-between gap-space-md">
<div class="flex items-center gap-space-sm">
<div class="w-10 h-10 rounded-full bg-secondary-fixed text-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[20px]">security</span>
</div>
<div>
<h3 class="font-label-lg text-label-lg text-on-surface font-bold">SOP Serah Terima Basecamp Nusantara</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">
          Pastikan fisik tenda diuji resleting dan frame alumunium di depan penyewa sebelum penandatanganan Surat Jalan Fisik.
        </p>
</div>
</div>
<div class="flex items-center gap-3 shrink-0">
<a class="font-label-sm text-label-sm font-bold text-primary hover:underline flex items-center gap-1" href="#">
<span>Buka Panduan Checklist QC Gear</span>
<span class="material-symbols-outlined text-[14px]">arrow_forward</span>
</a>
</div>
</div>
</div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
