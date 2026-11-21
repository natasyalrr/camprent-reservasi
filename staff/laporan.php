<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Laporan & Analitik";
$bodyClass = "bg-surface font-body-md text-body-md text-on-surface antialiased";
$activeMenu = 'laporan';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="w-full pt-16 bg-surface min-h-[calc(100vh-4rem)] p-space-lg"><div class="flex flex-col w-full">
<!-- Top Breadcrumb & Live Sync Pill -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm mb-space-md">
<div class="flex items-center gap-2 font-label-md text-label-md text-on-surface-variant">
<span>Administrasi &amp; Audit</span>
<span class="material-symbols-outlined text-[14px] text-outline">chevron_right</span>
<span class="text-primary font-semibold">Laporan Kinerja &amp; Keuangan</span>
</div>
<div class="inline-flex items-center gap-2 px-space-sm py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm shadow-sm w-fit">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
<span class="material-symbols-outlined text-[16px] text-primary">sync</span>
<span>Data sinkronisasi: <strong>24 Okt 2024, 18:45 WIB</strong></span>
</div>
</div>
<!-- Page Header -->
<div class="flex flex-col xl:flex-row xl:items-end justify-between gap-space-lg mb-space-xl">
<div class="max-w-3xl">
<div class="inline-flex items-center gap-1.5 px-space-xs py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-sm text-label-sm uppercase tracking-wider mb-2">
<span class="material-symbols-outlined text-[14px]">insights</span>
        CampRent Intelligence
      </div>
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-2">
        Laporan &amp; Analitik Operasional
      </h1>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
        Analisis tren penyewaan alat outdoor, rasio klaim pembatalan, pertumbuhan pendapatan sewa, dan tingkat utilisasi inventaris gear Nusantara.
      </p>
</div>
<!-- Seasonal Highlight Alert Banner -->
<div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-primary-container via-primary to-secondary p-space-md text-on-primary shadow-md flex items-center gap-space-md min-w-[340px] xl:max-w-md">
<div class="w-12 h-12 rounded-xl bg-on-primary/10 flex items-center justify-center shrink-0 backdrop-blur-sm">
<span class="material-symbols-outlined text-[28px] text-tertiary-fixed">sunny</span>
</div>
<div class="flex flex-col">
<div class="flex items-center gap-1.5 font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed">
<span class="material-symbols-outlined text-[14px]">trending_up</span>
          Musim Pendakian Kering
        </div>
<div class="font-headline-sm text-headline-sm font-bold text-surface">Puncak Okupansi Peralatan</div>
<div class="font-body-sm text-body-sm text-surface-variant/90 mt-0.5">
          Kapasitas gear terpakai <span class="font-semibold text-tertiary-fixed">88.4%</span> di Gunung Gede, Prau, &amp; Rinjani.
        </div>
</div>
</div>
</div>
<!-- Filter & Action Toolbar -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm mb-space-xl flex flex-wrap items-center justify-between gap-space-md">
<div class="flex flex-wrap items-center gap-space-sm">
<!-- Date Range Select -->
<div class="relative">
<select class="appearance-none bg-surface-container-low text-on-surface font-label-md text-label-md py-2.5 pl-3.5 pr-9 rounded-lg focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary cursor-pointer shadow-sm">
<option selected="">30 Hari Terakhir</option>
<option>7 Hari Terakhir</option>
<option>Bulan Ini (Oktober 2024)</option>
<option>Kuartal 3 (Jul - Sep 2024)</option>
<option>Tahun Berjalan (YTD)</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-outline text-[18px]">expand_more</span>
</div>
<!-- Date Display Badge -->
<div class="inline-flex items-center gap-2 bg-surface-container px-3 py-2 rounded-lg font-label-sm text-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] text-primary">calendar_month</span>
<span class="font-medium text-on-surface">25 Sep 2024 – 24 Okt 2024</span>
</div>
<!-- Location Hub Filter -->
<div class="relative">
<select class="appearance-none bg-surface-container-low text-on-surface font-label-md text-label-md py-2.5 pl-9 pr-9 rounded-lg focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary cursor-pointer shadow-sm">
<option selected="">Semua Pos Basecamp (Jawa &amp; Bali)</option>
<option>Hub Jakarta (Cibubur Basecamp)</option>
<option>Hub Bandung (Dago Giri)</option>
<option>Hub Wonosobo (Dieng Gate)</option>
<option>Hub Malang (Bromo Route)</option>
<option>Hub Denpasar (Batur Hub)</option>
</select>
<span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-outline text-[18px]">location_on</span>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-outline text-[18px]">expand_more</span>
</div>
</div>
<!-- Export Action Buttons -->
<div class="flex items-center gap-space-sm ml-auto">
<button class="inline-flex items-center gap-2 px-space-md py-2.5 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high active:scale-95 transition-all shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px] text-secondary">table_view</span>
<span>Unduh Data CSV (Raw)</span>
</button>
<button class="inline-flex items-center gap-2 px-space-md py-2.5 rounded-lg bg-primary text-on-primary font-label-md text-label-md hover:bg-[#1f3d2b] active:scale-95 transition-all shadow-md" type="button">
<span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
<span>Ekspor PDF Laporan</span>
</button>
</div>
</div>
<!-- 4 Primary KPI Metric Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md mb-space-xl">
<!-- Card 1: Penyewaan -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center justify-between mb-space-sm">
<div class="w-10 h-10 rounded-lg bg-secondary-container text-on-secondary-container flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">backpack</span>
</div>
<span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
          +14.2%
        </span>
</div>
<div>
<div class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Total Penyewaan Gear</div>
<div class="font-headline-md text-headline-md text-on-surface font-bold mt-1">482 <span class="font-body-md text-body-md text-on-surface-variant font-normal">Transaksi</span></div>
</div>
<div class="mt-space-md pt-space-xs bg-surface-container-low rounded-lg p-2.5 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-primary font-medium">458 Selesai Tepat Waktu</span>
<span class="text-outline">|</span>
<span class="text-tertiary-container font-medium">24 Retur Telat</span>
</div>
</div>
<!-- Card 2: Pembatalan -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center justify-between mb-space-sm">
<div class="w-10 h-10 rounded-lg bg-error-container text-on-error-container flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">event_busy</span>
</div>
<span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px] text-primary">arrow_downward</span>
          -1.2% rasio
        </span>
</div>
<div>
<div class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Pembatalan &amp; Refund</div>
<div class="font-headline-md text-headline-md text-on-surface font-bold mt-1">28 <span class="font-body-md text-body-md text-on-surface-variant font-normal">Permohonan</span></div>
</div>
<div class="mt-space-md pt-space-xs bg-surface-container-low rounded-lg p-2.5 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-error font-medium">Rp4.850.000 Direfund</span>
<span class="text-outline">|</span>
<span class="text-primary font-medium">Rp1.2M Denda</span>
</div>
</div>
<!-- Card 3: Pendapatan -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center justify-between mb-space-sm">
<div class="w-10 h-10 rounded-lg bg-primary-fixed text-on-primary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">payments</span>
</div>
<span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
          +18.5% YoY
        </span>
</div>
<div>
<div class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Pendapatan Sewa Bersih</div>
<div class="font-headline-md text-headline-md text-primary font-bold mt-1">Rp94.620.000</div>
</div>
<div class="mt-space-md pt-space-xs bg-surface-container-low rounded-lg p-2.5 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-on-surface-variant">Rerata Keranjang Sewa:</span>
<span class="text-on-surface font-semibold">Rp196.300/trx</span>
</div>
</div>
<!-- Card 4: Inspeksi -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center justify-between mb-space-sm">
<div class="w-10 h-10 rounded-lg bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">build_circle</span>
</div>
<span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-surface-container text-tertiary-container font-label-sm text-label-sm font-semibold">
          Kompensasi: Rp1.42M
        </span>
</div>
<div>
<div class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Inspeksi &amp; Kerusakan Gear</div>
<div class="font-headline-md text-headline-md text-on-surface font-bold mt-1">12 <span class="font-body-md text-body-md text-on-surface-variant font-normal">Kasus Gear</span></div>
</div>
<div class="mt-space-md pt-space-xs bg-surface-container-low rounded-lg p-2.5 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-primary font-medium">10 Klaim Selesai</span>
<span class="text-outline">|</span>
<span class="text-tertiary font-medium">2 Investigasi Staf</span>
</div>
</div>
</div>
<!-- Two-Column Analytics Charts -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg mb-space-xl">
<!-- Left Column (60% ~ 7 cols): Transaction Trends & Revenue -->
<div class="lg:col-span-7 bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex flex-col justify-between">
<div>
<div class="flex flex-wrap items-center justify-between gap-space-sm mb-space-md">
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Tren Transaksi &amp; Pergerakan Pendapatan</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Distribusi harian volume penyewaan selesai vs pembatalan tiket sewa</p>
</div>
<!-- Legend -->
<div class="flex items-center gap-space-md font-label-sm text-label-sm">
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-sm bg-primary"></span>
<span class="text-on-surface-variant">Sewa Selesai</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-sm bg-error/70"></span>
<span class="text-on-surface-variant">Dibatalkan</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-2.5 h-0.5 bg-tertiary-container"></span>
<span class="text-on-surface-variant">Omzet (Jt Rp)</span>
</div>
</div>
</div>
<!-- Custom SVG Bar & Revenue Overlay Visualization with Interactive Tooltip Mock -->
<div class="relative w-full pt-4 pb-2">
<!-- Floating Tooltip anchored on Oct 16-18 peak -->
<div class="absolute top-2 left-[58%] -translate-x-1/2 bg-inverse-surface text-inverse-on-surface p-2.5 rounded-lg shadow-xl z-20 pointer-events-none font-label-sm text-label-sm">
<div class="font-bold flex items-center gap-1 text-primary-fixed">
<span class="material-symbols-outlined text-[14px]">event</span>
              16–18 Okt (Weekend Peak)
            </div>
<div class="flex items-center justify-between gap-4 mt-1 text-xs">
<span class="text-inverse-on-surface/80">38 Sewa Berhasil</span>
<span class="text-inverse-on-surface font-semibold">Rp8.240.000</span>
</div>
<div class="text-[10px] text-inverse-on-surface/60 mt-0.5">Tenda Dome Kap-4 ludes 100%</div>
<!-- Arrow -->
<div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-inverse-surface rotate-45"></div>
</div>
<!-- Chart Area -->
<div class="h-64 w-full flex items-end justify-between gap-2 px-2 border-b border-surface-variant pb-2 relative">
<!-- Background Revenue Line SVG -->
<svg class="absolute inset-0 h-full w-full pointer-events-none overflow-visible" preserveaspectratio="none" viewbox="0 0 100 100">
<path d="M 5,75 Q 15,68 25,60 T 45,55 T 60,20 T 75,40 T 95,30" fill="none" opacity="0.8" stroke="#805b00" stroke-dasharray="3 3" stroke-width="2.5"></path>
<circle cx="60" cy="20" fill="#fabc3e" r="3.5" stroke="#805b00" stroke-width="1.5"></circle>
</svg>
<!-- Bars for Time Buckets -->
<!-- Week 1: 25-28 Sep -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 52%" title="22 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 10%" title="3 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">25–28 Sep</span>
</div>
<!-- Week 2: 29 Sep - 2 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 64%" title="29 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 12%" title="4 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">29 Sep–02 Okt</span>
</div>
<!-- Week 3: 03 - 06 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 58%" title="26 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 8%" title="2 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">03–06 Okt</span>
</div>
<!-- Week 4: 07 - 10 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 70%" title="31 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 14%" title="5 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">07–10 Okt</span>
</div>
<!-- Week 5: 11 - 14 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 75%" title="34 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 10%" title="3 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">11–14 Okt</span>
</div>
<!-- Peak Highlight Week: 15 - 18 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative bg-primary-fixed/20 rounded-lg p-0.5">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t shadow-sm" style="height: 96%" title="38 Sewa Peak"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 8%" title="2 Batal"></div>
</div>
<span class="font-label-sm text-[10px] font-bold text-primary">15–18 Okt ★</span>
</div>
<!-- Week 7: 19 - 21 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 62%" title="27 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 6%" title="2 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">19–21 Okt</span>
</div>
<!-- Week 8: 22 - 24 Okt -->
<div class="flex-1 flex flex-col items-center gap-1 group relative">
<div class="w-full flex items-end justify-center gap-1 h-44">
<div class="w-3 sm:w-4 bg-primary rounded-t transition-all group-hover:brightness-110" style="height: 80%" title="35 Sewa"></div>
<div class="w-2 sm:w-2.5 bg-error/70 rounded-t" style="height: 12%" title="4 Batal"></div>
</div>
<span class="font-label-sm text-[10px] text-on-surface-variant">22–24 Okt</span>
</div>
</div>
</div>
</div>
<!-- Footer Quick Metrics -->
<div class="mt-space-md pt-space-md border-t border-surface-variant/40 grid grid-cols-2 sm:grid-cols-3 gap-space-md">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Rata-rata Durasi Sewa</span>
<span class="font-headline-sm text-headline-sm text-on-surface font-bold">2.4 Hari <span class="font-body-sm text-body-sm font-normal text-on-surface-variant">/ paket</span></span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Hari Terpadat Rental</span>
<span class="font-headline-sm text-headline-sm text-primary font-bold">Jumat &amp; Sabtu</span>
</div>
<div class="flex flex-col col-span-2 sm:col-span-1">
<span class="font-label-sm text-label-sm text-on-surface-variant">Efisiensi Serah Terima</span>
<span class="font-headline-sm text-headline-sm text-secondary font-bold">96.8% <span class="font-body-sm text-body-sm font-normal text-on-surface-variant">on-time</span></span>
</div>
</div>
</div>
<!-- Right Column (40% ~ 5 cols): Category Distribution Donut -->
<div class="lg:col-span-5 bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-md">
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Kategori Terlaris</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Kontribusi nilai sewa per segmen perlengkapan</p>
</div>
<span class="px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">5 Kategori</span>
</div>
<!-- Donut Visual Layout -->
<div class="flex flex-col sm:flex-row items-center gap-space-lg my-space-sm">
<!-- Donut SVG -->
<div class="relative w-40 h-40 shrink-0">
<svg class="w-full h-full -rotate-90" viewbox="0 0 36 36">
<!-- Background Ring -->
<circle cx="18" cy="18" fill="none" r="14" stroke="#ede8de" stroke-width="4.5"></circle>
<!-- Segments (circumference = ~88) -->
<!-- Tenda 42% -> 37 -->
<circle cx="18" cy="18" fill="none" r="14" stroke="#275334" stroke-dasharray="36.96 88" stroke-dashoffset="0" stroke-width="4.5"></circle>
<!-- Carrier 24% -> 21.12 -->
<circle cx="18" cy="18" fill="none" r="14" stroke="#466551" stroke-dasharray="21.12 88" stroke-dashoffset="-36.96" stroke-width="4.5"></circle>
<!-- Masak 18% -> 15.84 -->
<circle cx="18" cy="18" fill="none" r="14" stroke="#805b00" stroke-dasharray="15.84 88" stroke-dashoffset="-58.08" stroke-width="4.5"></circle>
<!-- Lampu 11% -> 9.68 -->
<circle cx="18" cy="18" fill="none" r="14" stroke="#fabc3e" stroke-dasharray="9.68 88" stroke-dashoffset="-73.92" stroke-width="4.5"></circle>
<!-- Furnitur 5% -> 4.4 -->
<circle cx="18" cy="18" fill="none" r="14" stroke="#a2d2aa" stroke-dasharray="4.4 88" stroke-dashoffset="-83.6" stroke-width="4.5"></circle>
</svg>
<div class="absolute inset-0 flex flex-col items-center justify-center text-center">
<span class="font-headline-sm text-headline-sm font-bold text-on-surface leading-tight">Rp94.6M</span>
<span class="font-label-sm text-[10px] text-on-surface-variant uppercase tracking-wider">Gross Total</span>
</div>
</div>
<!-- Category Breakdown List -->
<div class="flex flex-col gap-2 w-full">
<div class="flex items-center justify-between p-1.5 rounded-lg hover:bg-surface-container-low transition-colors">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-primary shrink-0"></span>
<span class="font-label-md text-label-md text-on-surface font-medium">Tenda &amp; Shelter</span>
</div>
<div class="text-right">
<div class="font-label-md text-label-md font-bold text-primary">42%</div>
<div class="font-label-sm text-[11px] text-on-surface-variant">Rp39.740.000</div>
</div>
</div>
<div class="flex items-center justify-between p-1.5 rounded-lg hover:bg-surface-container-low transition-colors">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-secondary shrink-0"></span>
<span class="font-label-md text-label-md text-on-surface font-medium">Tas &amp; Carrier</span>
</div>
<div class="text-right">
<div class="font-label-md text-label-md font-bold text-on-surface">24%</div>
<div class="font-label-sm text-[11px] text-on-surface-variant">Rp22.710.000</div>
</div>
</div>
<div class="flex items-center justify-between p-1.5 rounded-lg hover:bg-surface-container-low transition-colors">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-tertiary-container shrink-0"></span>
<span class="font-label-md text-label-md text-on-surface font-medium">Masak &amp; Makan</span>
</div>
<div class="text-right">
<div class="font-label-md text-label-md font-bold text-on-surface">18%</div>
<div class="font-label-sm text-[11px] text-on-surface-variant">Rp17.030.000</div>
</div>
</div>
<div class="flex items-center justify-between p-1.5 rounded-lg hover:bg-surface-container-low transition-colors">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-tertiary-fixed-dim shrink-0"></span>
<span class="font-label-md text-label-md text-on-surface font-medium">Penerangan &amp; Alas</span>
</div>
<div class="text-right">
<div class="font-label-md text-label-md font-bold text-on-surface">11%</div>
<div class="font-label-sm text-[11px] text-on-surface-variant">Rp10.410.000</div>
</div>
</div>
<div class="flex items-center justify-between p-1.5 rounded-lg hover:bg-surface-container-low transition-colors">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-inverse-primary shrink-0"></span>
<span class="font-label-md text-label-md text-on-surface font-medium">Furnitur Lipat</span>
</div>
<div class="text-right">
<div class="font-label-md text-label-md font-bold text-on-surface">5%</div>
<div class="font-label-sm text-[11px] text-on-surface-variant">Rp4.730.000</div>
</div>
</div>
</div>
</div>
</div>
<div class="mt-space-sm pt-space-xs bg-surface-container-low rounded-lg p-2.5 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-on-surface-variant">Kategori Pertumbuhan Tertinggi:</span>
<span class="text-primary font-bold inline-flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
          Carrier 60L (+31% MoM)
        </span>
</div>
</div>
</div>
<!-- Detailed Inventory Health & Utilization Table Section -->
<div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm mb-space-xl">
<div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md mb-space-lg">
<div>
<div class="inline-flex items-center gap-1 text-primary font-label-sm text-label-sm uppercase tracking-wider mb-1">
<span class="material-symbols-outlined text-[15px]">inventory_2</span>
          Kinerja Perangkat
        </div>
<h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Utilisasi &amp; Kesehatan Stok Inventaris</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Monitoring 10 Alat Outdoor dengan Frekuensi Pemakaian &amp; Tingkat Keausan Tertinggi selama periode aktif.</p>
</div>
<!-- Filter Pills -->
<div class="flex items-center gap-1.5 bg-surface-container-low p-1 rounded-xl">
<button class="px-3 py-1.5 rounded-lg bg-surface-container-lowest text-primary font-label-sm text-label-sm font-semibold shadow-xs" type="button">Semua Alat</button>
<button class="px-3 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-label-sm transition-colors" type="button">Tenda &amp; Shelter</button>
<button class="px-3 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-label-sm transition-colors" type="button">Carrier</button>
<button class="px-3 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-label-sm transition-colors" type="button">Peralatan Masak</button>
</div>
</div>
<!-- Table -->
<div class="overflow-x-auto">
<table class="w-full text-left font-body-sm text-body-sm">
<thead>
<tr class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
<th class="py-3.5 px-4 rounded-l-lg">No</th>
<th class="py-3.5 px-4">Nama Alat &amp; SKU</th>
<th class="py-3.5 px-4">Kategori</th>
<th class="py-3.5 px-4 text-center">Total Unit</th>
<th class="py-3.5 px-4 text-center">Hari Disewa</th>
<th class="py-3.5 px-4 min-w-[200px]">Tingkat Utilisasi (30 Hari)</th>
<th class="py-3.5 px-4 rounded-r-lg">Kondisi Fisik / Servis</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-variant/40">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-4 font-label-md text-label-md text-outline">01</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-3">
<div class="w-12 h-10 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img class="w-full h-full object-cover" data-alt="Rugged green 4-person dome tent standing on rocky alpine grass with mist in background, professional outdoor gear photography, warm sunlight, crisp details" src="<?= asset('images/tenda-dome.jpg') ?>"/>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">Tenda Kap-4 Pro Dome Series</span>
<span class="font-label-sm text-label-sm text-outline">SKU: TND-DOME-04</span>
</div>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">Tenda &amp; Shelter</span>
</td>
<td class="py-3.5 px-4 text-center font-semibold text-on-surface">15 Unit</td>
<td class="py-3.5 px-4 text-center font-medium text-on-surface">28 Hari</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2.5">
<div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
<div class="bg-primary h-2.5 rounded-full" style="width: 93%"></div>
</div>
<span class="font-label-sm text-label-sm font-bold text-primary w-9 text-right">93%</span>
</div>
</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2">
<span class="px-2 py-0.5 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">13 Prima</span>
<span class="px-2 py-0.5 rounded-md bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-medium">2 Servis Frame</span>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-4 font-label-md text-label-md text-outline">02</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-3">
<div class="w-12 h-10 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img class="w-full h-full object-cover" data-alt="Heavy duty 60L mountaineering backpack in deep olive and terracotta trim, equipped with trekking pole loops, studio lighting against warm neutral backdrop" src="<?= asset('images/carrier-hiking.jpg') ?>"/>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">Carrier 60L Alpine Expedition</span>
<span class="font-label-sm text-label-sm text-outline">SKU: CRR-ALP-60</span>
</div>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-label-sm text-label-sm">Tas &amp; Carrier</span>
</td>
<td class="py-3.5 px-4 text-center font-semibold text-on-surface">12 Unit</td>
<td class="py-3.5 px-4 text-center font-medium text-on-surface">25 Hari</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2.5">
<div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
<div class="bg-primary h-2.5 rounded-full" style="width: 86%"></div>
</div>
<span class="font-label-sm text-label-sm font-bold text-primary w-9 text-right">86%</span>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2.5 py-0.5 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">12 Prima (100%)</span>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-4 font-label-md text-label-md text-outline">03</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-3">
<div class="w-12 h-10 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img class="w-full h-full object-cover" data-alt="Compact ultralight titanium camping stove connected to small gas canister with blue flame burning, macro detail, outdoor expedition context" src="<?= asset('images/kompor-portable.jpg') ?>"/>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">Kompor Ultralight Windproof &amp; Adaptor</span>
<span class="font-label-sm text-label-sm text-outline">SKU: KMP-WND-01</span>
</div>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm">Masak &amp; Makan</span>
</td>
<td class="py-3.5 px-4 text-center font-semibold text-on-surface">20 Unit</td>
<td class="py-3.5 px-4 text-center font-medium text-on-surface">23 Hari</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2.5">
<div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
<div class="bg-secondary h-2.5 rounded-full" style="width: 78%"></div>
</div>
<span class="font-label-sm text-label-sm font-bold text-secondary w-9 text-right">78%</span>
</div>
</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2">
<span class="px-2 py-0.5 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">18 Prima</span>
<span class="px-2 py-0.5 rounded-md bg-error-container text-on-error-container font-label-sm text-label-sm font-medium">1 Hilang (Diklaim)</span>
</div>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-4 font-label-md text-label-md text-outline">04</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-3">
<div class="w-12 h-10 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img class="w-full h-full object-cover" data-alt="Modern waterproof headlamp with elastic strap resting on weathered wood log, illuminated beam in misty dawn atmosphere" src="<?= asset('images/headlamp.jpg') ?>"/>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">Headlamp LED 450 Lumens Waterproof</span>
<span class="font-label-sm text-label-sm text-outline">SKU: LMP-HDL-02</span>
</div>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-label-sm text-label-sm">Penerangan</span>
</td>
<td class="py-3.5 px-4 text-center font-semibold text-on-surface">25 Unit</td>
<td class="py-3.5 px-4 text-center font-medium text-on-surface">20 Hari</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2.5">
<div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
<div class="bg-secondary h-2.5 rounded-full" style="width: 72%"></div>
</div>
<span class="font-label-sm text-label-sm font-bold text-secondary w-9 text-right">72%</span>
</div>
</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2">
<span class="px-2 py-0.5 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">24 Prima</span>
<span class="px-2 py-0.5 rounded-md bg-error-container text-on-error-container font-label-sm text-label-sm font-medium">1 Sakelar Rusak</span>
</div>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-4 font-label-md text-label-md text-outline">05</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-3">
<div class="w-12 h-10 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img class="w-full h-full object-cover" data-alt="High quality dark green ripstop flysheet tarp pitched with guy lines in dense pine forest, rainwater beading off waterproof coating" src="<?= asset('images/tenda-dome.jpg') ?>"/>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">Flysheet Shelter 4x6 Meter Waterproof</span>
<span class="font-label-sm text-label-sm text-outline">SKU: SHL-FLY-46</span>
</div>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">Tenda &amp; Shelter</span>
</td>
<td class="py-3.5 px-4 text-center font-semibold text-on-surface">8 Unit</td>
<td class="py-3.5 px-4 text-center font-medium text-on-surface">26 Hari</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2.5">
<div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
<div class="bg-primary h-2.5 rounded-full" style="width: 91%"></div>
</div>
<span class="font-label-sm text-label-sm font-bold text-primary w-9 text-right">91%</span>
</div>
</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2">
<span class="px-2 py-0.5 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">6 Prima</span>
<span class="px-2 py-0.5 rounded-md bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-medium">2 Tambal Seam</span>
</div>
</td>
</tr>
<!-- Row 6 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-4 font-label-md text-label-md text-outline">06</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-3">
<div class="w-12 h-10 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img class="w-full h-full object-cover" data-alt="Cozy mummy down sleeping bag packed lightly in compression sack with mountain backdrop, crisp natural lighting" src="<?= asset('images/sleeping-bag.jpg') ?>"/>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-on-surface">Sleeping Bag Mummy Down 0°C</span>
<span class="font-label-sm text-label-sm text-outline">SKU: SLP-MMY-01</span>
</div>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-label-sm text-label-sm">Perlengkapan Tidur</span>
</td>
<td class="py-3.5 px-4 text-center font-semibold text-on-surface">18 Unit</td>
<td class="py-3.5 px-4 text-center font-medium text-on-surface">18 Hari</td>
<td class="py-3.5 px-4">
<div class="flex items-center gap-2.5">
<div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
<div class="bg-secondary h-2.5 rounded-full" style="width: 65%"></div>
</div>
<span class="font-label-sm text-label-sm font-bold text-secondary w-9 text-right">65%</span>
</div>
</td>
<td class="py-3.5 px-4">
<span class="px-2.5 py-0.5 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">18 Prima (Bersih)</span>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination / Summary Note -->
<div class="mt-space-md pt-space-sm flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
<span>Menampilkan 6 dari 10 alat outdoor teratas (Total inventaris: 148 unit aktif)</span>
<div class="flex items-center gap-2">
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors" type="button">Sebelumnya</button>
<button class="px-3 py-1.5 rounded-lg bg-primary text-on-primary" type="button">1</button>
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors" type="button">2</button>
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors" type="button">Berikutnya</button>
</div>
</div>
</div>
<!-- Bottom Summary Insight Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg mb-space-md">
<!-- Insight 1: Rekomendasi Restok -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border-l-4 border-tertiary-container flex flex-col justify-between">
<div>
<div class="flex items-center gap-2 text-tertiary-container mb-2">
<span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider">Rekomendasi Restok (Q4)</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-1">Defisit Tenda Dome 4-P</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Diproyeksikan kekurangan <strong>6 unit</strong> tenda berkapasitas 4 orang pada libur akhir tahun (Desember). Estimasi alokasi belanja modal: <strong>Rp14.500.000</strong>.
        </p>
</div>
<div class="mt-space-md pt-2 border-t border-surface-variant/40 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-tertiary-container font-semibold">Tingkat Urgensi: Tinggi</span>
<button class="text-primary hover:underline font-semibold flex items-center gap-0.5" type="button">
          Buat PO Pengadaan
          <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
</button>
</div>
</div>
<!-- Insight 2: Audit Keausan -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border-l-4 border-secondary flex flex-col justify-between">
<div>
<div class="flex items-center gap-2 text-secondary mb-2">
<span class="material-symbols-outlined text-[20px]">handyman</span>
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider">Audit Keausan Gear</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-1">Re-Coating Waterproofing DWR</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
<strong>18 unit</strong> flysheet &amp; outer tenda telah melampaui 120 jam pemakaian hujan. Dijadwalkan spray coating pelindung hidrofobik pada 28 Oktober 2024.
        </p>
</div>
<div class="mt-space-md pt-2 border-t border-surface-variant/40 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-secondary font-semibold">Status: Jadwal Terkonfirmasi</span>
<button class="text-primary hover:underline font-semibold flex items-center gap-0.5" type="button">
          Lihat Log Servis
          <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
</button>
</div>
</div>
<!-- Insight 3: Asuransi & Deposit -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border-l-4 border-primary flex flex-col justify-between">
<div>
<div class="flex items-center gap-2 text-primary mb-2">
<span class="material-symbols-outlined text-[20px]">verified</span>
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider">Asuransi &amp; Deposit</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-1">Rasio Penyelesaian Klaim 98%</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Kompensasi kerusakan alat lewat skema deposit pelanggan tertagih dengan kepatuhan tinggi. Indeks efektivitas SOP inspeksi fisik tercatat pada <strong>94.2%</strong>.
        </p>
</div>
<div class="mt-space-md pt-2 border-t border-surface-variant/40 flex items-center justify-between font-label-sm text-label-sm">
<span class="text-primary font-semibold">Toleransi Risiko: Aman</span>
<button class="text-primary hover:underline font-semibold flex items-center gap-0.5" type="button">
          Audit Deposit
          <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
</button>
</div>
</div>
</div>
</div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
