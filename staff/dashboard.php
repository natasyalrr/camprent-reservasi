<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Dashboard Staff";
$bodyClass = "bg-surface font-body-md text-body-md text-on-surface antialiased";
$activeMenu = 'dashboard';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="w-full pt-16 bg-surface"><div class="flex flex-col w-full">
<!-- Top Operational Banner & Controls -->
<div class="w-full px-8 pt-6 pb-6 flex flex-col gap-6">
<!-- Breadcrumb & Header Title Area -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
<div class="flex flex-col gap-1.5">
<div class="inline-flex items-center gap-2 self-start px-2.5 py-0.5 rounded-full bg-secondary-fixed/50 text-on-secondary-fixed">
<span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
<span class="font-label-sm text-label-sm uppercase tracking-wider font-bold">Operasional • Ringkasan Harian Basecamp</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface font-semibold tracking-tight">Dashboard Operasional Staf</h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl">
          Pantau performa harian sewa, antrean konfirmasi booking, kepatuhan batas pengembalian, dan ringkasan arus kas rental gear Nusantara secara real-time.
        </p>
</div>
<!-- Action Buttons -->
<div class="flex items-center flex-wrap gap-2.5">
<button class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface text-label-lg font-semibold transition-colors shadow-sm" id="btn-refresh">
<span class="material-symbols-outlined text-[19px] transition-transform duration-500" id="refresh-icon">refresh</span>
<span>Muat Ulang Data</span>
</button>
<button class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface text-label-lg font-semibold transition-colors shadow-sm">
<span class="material-symbols-outlined text-[19px] text-secondary">file_download</span>
<span>Ekspor Laporan Harian (.CSV)</span>
</button>
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-container text-on-primary text-label-lg font-bold transition-all shadow-md active:scale-95">
<span class="material-symbols-outlined text-[20px]">add_circle</span>
<span>+ Buat Reservasi Manual (Walk-in)</span>
</button>
</div>
</div>
<!-- 4 Main KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<!-- KPI 1: Sewa Hari Ini -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col justify-between transition-all hover:shadow-md relative overflow-hidden group">
<div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full bg-secondary-fixed/30 pointer-events-none group-hover:scale-110 transition-transform"></div>
<div class="flex items-start justify-between gap-3">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface-variant font-medium">Sewa Hari Ini</span>
<span class="font-headline-md text-headline-md text-on-surface font-bold mt-1">48 Unit</span>
</div>
<div class="w-11 h-11 rounded-xl bg-secondary-container text-on-secondary-fixed flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">camping</span>
</div>
</div>
<div class="mt-4 pt-3 flex flex-col gap-1.5">
<div class="inline-flex items-center gap-1.5 self-start px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">trending_up</span>
<span>+12.5% vs kemarin</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">36 Sedang di Lapangan • 12 Siap Ambil</span>
</div>
</div>
<!-- KPI 2: Pembatalan Menunggu -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col justify-between transition-all hover:shadow-md relative overflow-hidden group">
<div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full bg-tertiary-fixed/30 pointer-events-none group-hover:scale-110 transition-transform"></div>
<div class="flex items-start justify-between gap-3">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface-variant font-medium">Pembatalan Menunggu</span>
<span class="font-headline-md text-headline-md text-on-surface font-bold mt-1">2 Permohonan</span>
</div>
<div class="w-11 h-11 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">event_busy</span>
</div>
</div>
<div class="mt-4 pt-3 flex flex-col gap-1.5">
<div class="inline-flex items-center gap-1.5 self-start px-2 py-0.5 rounded-full bg-tertiary-fixed-dim text-on-tertiary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">warning</span>
<span>Perlu Tindakan H-1</span>
</div>
<div class="flex items-center justify-between text-label-sm font-label-sm mt-0.5">
<span class="text-on-surface-variant">1 Cuaca Ekstrem BMKG • 1 Pribadi</span>
<a class="text-tertiary hover:underline font-bold inline-flex items-center gap-0.5" href="#">Tinjau →</a>
</div>
</div>
</div>
<!-- KPI 3: Booking Perlu Konfirmasi -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col justify-between transition-all hover:shadow-md relative overflow-hidden group">
<div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full bg-primary-fixed/30 pointer-events-none group-hover:scale-110 transition-transform"></div>
<div class="flex items-start justify-between gap-3">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface-variant font-medium">Booking Perlu Konfirmasi</span>
<span class="font-headline-md text-headline-md text-on-surface font-bold mt-1">5 Pesanan</span>
</div>
<div class="w-11 h-11 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
</div>
</div>
<div class="mt-4 pt-3 flex flex-col gap-1.5">
<div class="inline-flex items-center gap-1.5 self-start px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">schedule</span>
<span>Prioritas &lt; 2 Jam</span>
</div>
<div class="flex items-center justify-between text-label-sm font-label-sm mt-0.5">
<span class="text-on-surface-variant">Total Nilai: Rp1.150.000</span>
<a class="text-primary hover:underline font-bold inline-flex items-center gap-0.5" href="#">Verifikasi →</a>
</div>
</div>
</div>
<!-- KPI 4: Pendapatan Bulan Ini -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col justify-between transition-all hover:shadow-md relative overflow-hidden group">
<div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full bg-secondary-fixed/40 pointer-events-none group-hover:scale-110 transition-transform"></div>
<div class="flex items-start justify-between gap-3">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface-variant font-medium">Pendapatan Bulan Ini</span>
<span class="font-headline-md text-headline-md text-primary font-bold mt-1">Rp94.620.000</span>
</div>
<div class="w-11 h-11 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">payments</span>
</div>
</div>
<div class="mt-4 pt-3 flex flex-col gap-1.5">
<div class="inline-flex items-center gap-1.5 self-start px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
<span>+18.2% vs target Q4</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Rerata Keranjang: Rp196.300/transaksi</span>
</div>
</div>
</div>
<!-- Middle Split: Chart Analytics (65%) & Operational Queue / Alerts (35%) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
<!-- Left Column: 14 Days Activity Visual Bar Chart (8 of 12 cols = ~66%) -->
<div class="lg:col-span-8 bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col gap-5">
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
<div class="flex flex-col">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[20px]">bar_chart</span>
<h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Penyewaan 14 Hari Terakhir</h2>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Fluktuasi volume gear keluar masuk basecamp 11 Okt - 24 Okt 2024</p>
</div>
<!-- Filter Category Pills -->
<div class="inline-flex p-1 rounded-xl bg-surface-container-low gap-1 overflow-x-auto max-w-full">
<button class="px-3 py-1 rounded-lg bg-surface-container-lowest text-on-surface text-label-sm font-bold shadow-xs whitespace-nowrap">Semua Gear</button>
<button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface text-label-sm font-medium transition-colors whitespace-nowrap">Tenda &amp; Shelter</button>
<button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface text-label-sm font-medium transition-colors whitespace-nowrap">Carrier &amp; Trekking</button>
<button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface text-label-sm font-medium transition-colors whitespace-nowrap">Cooking Set</button>
</div>
</div>
<!-- Chart Legend -->
<div class="flex items-center gap-6 pt-1 text-label-sm font-label-sm">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-primary"></span>
<span class="text-on-surface font-semibold">Selesai / Aktif di Lapangan</span>
</div>
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded bg-secondary-fixed-dim"></span>
<span class="text-on-surface font-semibold">Booking Baru Terkonfirmasi</span>
</div>
<div class="ml-auto hidden sm:flex items-center gap-1.5 text-on-surface-variant">
<span class="w-2 h-2 rounded-full bg-tertiary-fixed-dim"></span>
<span>Target Harian: 25 Unit</span>
</div>
</div>
<!-- Visual Bar Chart Container -->
<div class="relative w-full h-64 pt-6 pb-2 flex flex-col justify-between">
<!-- Background Y-Axis Gridlines -->
<div class="absolute inset-0 flex flex-col justify-between pointer-events-none pr-2">
<div class="flex items-center w-full gap-3">
<span class="font-label-sm text-label-sm text-outline w-6 text-right">40</span>
<div class="flex-1 border-b border-surface-container-highest opacity-70"></div>
</div>
<div class="flex items-center w-full gap-3">
<span class="font-label-sm text-label-sm text-outline w-6 text-right">30</span>
<div class="flex-1 border-b border-surface-container-highest opacity-70"></div>
</div>
<div class="flex items-center w-full gap-3">
<span class="font-label-sm text-label-sm text-outline w-6 text-right">20</span>
<div class="flex-1 border-b border-surface-container-highest opacity-70"></div>
</div>
<div class="flex items-center w-full gap-3">
<span class="font-label-sm text-label-sm text-outline w-6 text-right">10</span>
<div class="flex-1 border-b border-surface-container-highest opacity-70"></div>
</div>
<div class="flex items-center w-full gap-3">
<span class="font-label-sm text-label-sm text-outline w-6 text-right">0</span>
<div class="flex-1 border-b border-surface-container-highest"></div>
</div>
</div>
<!-- 14 Dynamic Day Bars -->
<div class="relative z-10 grid grid-cols-14 gap-1.5 sm:gap-2 h-48 pl-9 pr-1 items-end">
<!-- Day 1: 11 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 52%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 35%;"></div>
<div class="w-full bg-primary" style="height: 65%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2 group-hover:font-bold">11</span>
</div>
<!-- Day 2: 12 Okt (Weekend) -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 82%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 30%;"></div>
<div class="w-full bg-primary" style="height: 70%;"></div>
</div>
<span class="font-label-sm text-label-sm text-primary font-bold mt-2">12</span>
</div>
<!-- Day 3: 13 Okt (Weekend) -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 78%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 25%;"></div>
<div class="w-full bg-primary" style="height: 75%;"></div>
</div>
<span class="font-label-sm text-label-sm text-primary font-bold mt-2">13</span>
</div>
<!-- Day 4: 14 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 40%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 40%;"></div>
<div class="w-full bg-primary" style="height: 60%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">14</span>
</div>
<!-- Day 5: 15 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 45%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 35%;"></div>
<div class="w-full bg-primary" style="height: 65%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">15</span>
</div>
<!-- Day 6: 16 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 55%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 30%;"></div>
<div class="w-full bg-primary" style="height: 70%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">16</span>
</div>
<!-- Day 7: 17 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 65%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 38%;"></div>
<div class="w-full bg-primary" style="height: 62%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">17</span>
</div>
<!-- Day 8: 18 Okt (Weekend Peak - With Tooltip Badge) -->
<div class="flex flex-col items-center h-full justify-end relative group cursor-pointer">
<!-- Floating peak tooltip badge -->
<div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface px-2.5 py-1 rounded-lg text-label-sm whitespace-nowrap shadow-md z-20 flex items-center gap-1.5 pointer-events-none">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary-fixed"></span>
<span>Peak: 38 Unit</span>
</div>
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden ring-2 ring-tertiary/40 group-hover:ring-tertiary transition-all" style="height: 94%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 25%;"></div>
<div class="w-full bg-primary" style="height: 75%;"></div>
</div>
<span class="font-label-sm text-label-sm text-primary font-bold mt-2">18</span>
</div>
<!-- Day 9: 19 Okt (Weekend Peak) -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 90%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 28%;"></div>
<div class="w-full bg-primary" style="height: 72%;"></div>
</div>
<span class="font-label-sm text-label-sm text-primary font-bold mt-2">19</span>
</div>
<!-- Day 10: 20 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 60%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 35%;"></div>
<div class="w-full bg-primary" style="height: 65%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">20</span>
</div>
<!-- Day 11: 21 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 48%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 33%;"></div>
<div class="w-full bg-primary" style="height: 67%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">21</span>
</div>
<!-- Day 12: 22 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 58%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 30%;"></div>
<div class="w-full bg-primary" style="height: 70%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">22</span>
</div>
<!-- Day 13: 23 Okt -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: 70%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 42%;"></div>
<div class="w-full bg-primary" style="height: 58%;"></div>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary mt-2">23</span>
</div>
<!-- Day 14: 24 Okt (Hari Ini) -->
<div class="flex flex-col items-center h-full justify-end group cursor-pointer">
<div class="w-full flex flex-col gap-0.5 rounded-t-md overflow-hidden ring-2 ring-primary bg-primary/10" style="height: 80%;">
<div class="w-full bg-secondary-fixed-dim" style="height: 35%;"></div>
<div class="w-full bg-primary" style="height: 65%;"></div>
</div>
<span class="font-label-sm text-label-sm text-primary font-bold mt-2">Kini</span>
</div>
</div>
</div>
<!-- Summary Footer Pill -->
<div class="flex flex-wrap items-center justify-between gap-3 p-3.5 rounded-xl bg-surface-container-low text-label-sm font-label-sm text-on-surface-variant">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-[18px] text-primary">insights</span>
<span class="font-semibold text-on-surface">Rerata Harian: 28 Unit/Hari</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-2 h-2 rounded-full bg-primary"></span>
<span>Tingkat Utilisasi Gear Basecamp: <strong class="text-on-surface">84.6%</strong></span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px] text-tertiary">event_available</span>
<span>Puncak Aktivitas: <strong class="text-on-surface">Jumat &amp; Sabtu</strong></span>
</div>
</div>
</div>
<!-- Right Column: Queue & Inventory Alerts (4 of 12 cols = ~34%) -->
<div class="lg:col-span-4 flex flex-col gap-5">
<!-- Card 1: Antrean Siap Ambil Hari Ini -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col gap-4">
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[20px]">door_front</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Siap Ambil Hari Ini</h3>
</div>
<span class="px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm text-label-sm font-bold">3 Sesi</span>
</div>
<!-- Pickup queue list items -->
<div class="flex flex-col gap-3">
<!-- Item 1 -->
<div class="p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-2">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md font-bold text-on-surface">#CR-1110 • Ahmad Fauzi</span>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold">Siap Serah Terima</span>
</div>
<div class="flex items-center gap-2 text-label-sm font-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span>09:00 WIB • Basecamp Cihampelas</span>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant">1x Tenda Dome 4P Pro + Kompor Windproof</p>
</div>
<!-- Item 2 -->
<div class="p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-2">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md font-bold text-on-surface">#CR-1105 • Siti Rahmawati</span>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container-highest text-on-surface-variant font-bold">Packing Seal QC</span>
</div>
<div class="flex items-center gap-2 text-label-sm font-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span>11:30 WIB • Basecamp Cihampelas</span>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant">1x Carrier 60L Alpine + 2x Trekking Pole</p>
</div>
<!-- Item 3 -->
<div class="p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-2">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md font-bold text-on-surface">#CR-1118 • Hendra Wijaya</span>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-bold">Verifikasi Identitas</span>
</div>
<div class="flex items-center gap-2 text-label-sm font-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span>14:00 WIB • Pos Patakbanteng</span>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant">2x Sleeping Bag Goose-Down + Matras</p>
</div>
</div>
</div>
<!-- Card 2: Peringatan Stok Tipis & Reparasi -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col gap-3.5">
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary text-[20px]">build_circle</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Stok Tipis &amp; Reparasi</h3>
</div>
<span class="w-2 h-2 rounded-full bg-error animate-ping"></span>
</div>
<div class="flex flex-col gap-2.5">
<!-- Warning 1 -->
<div class="p-3 rounded-xl bg-error-container/40 flex items-start justify-between gap-2">
<div class="flex flex-col gap-0.5">
<span class="font-label-md text-label-md font-bold text-on-surface">Tenda Dome Kap-4 Java</span>
<span class="font-label-sm text-label-sm text-error font-medium">Sisa 2 unit tersedia (Tingkat sewa 93%)</span>
</div>
<button class="px-2.5 py-1 rounded-lg bg-surface-container-lowest hover:bg-surface text-on-surface font-label-sm text-label-sm font-bold shadow-xs shrink-0">
                Alokasi
              </button>
</div>
<!-- Warning 2 -->
<div class="p-3 rounded-xl bg-surface-container-low flex items-start justify-between gap-2">
<div class="flex flex-col gap-0.5">
<span class="font-label-md text-label-md font-bold text-on-surface">Matras Inflatable Air-Lock</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">1 unit antrean tambal di workshop basecamp</span>
</div>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container-highest text-on-surface font-semibold shrink-0">
                Dalam Servis
              </span>
</div>
</div>
</div>
</div>
</div>
<!-- Full Width Table Section: Transaksi Terbaru & Antrean Operasional -->
<div class="w-full bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col gap-5">
<!-- Table Header Bar -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
<div class="flex flex-col">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[22px]">receipt_long</span>
<h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Transaksi &amp; Reservasi Terbaru</h2>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Daftar reservasi terkini yang membutuhkan pemrosesan serah terima dan verifikasi staf.</p>
</div>
<!-- Filter and Search Toolbar -->
<div class="flex flex-wrap items-center gap-3">
<div class="relative flex items-center min-w-[260px]">
<span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[18px]">search</span>
<input class="w-full pl-9 pr-3 py-2 rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline text-label-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Cari kode booking, nama..." type="text"/>
</div>
<div class="flex items-center gap-2">
<select class="px-3 py-2 rounded-xl bg-surface-container-low text-on-surface text-label-md font-medium focus:outline-none focus:ring-2 focus:ring-primary cursor-pointer">
<option>Status: Semua</option>
<option>Menunggu Konfirmasi</option>
<option>Siap Ambil</option>
<option>Sedang Disewa</option>
<option>Selesai</option>
</select>
<select class="px-3 py-2 rounded-xl bg-surface-container-low text-on-surface text-label-md font-medium focus:outline-none focus:ring-2 focus:ring-primary cursor-pointer">
<option>Pos: Semua Basecamp</option>
<option>Basecamp Bandung</option>
<option>Basecamp Wonosobo</option>
<option>Basecamp Malang</option>
</select>
</div>
<a class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-surface-container hover:bg-surface-container-high text-primary font-label-lg text-label-lg font-bold transition-colors" href="#">
<span>Semua (48)</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
</div>
</div>
<!-- Modern Responsive Table -->
<div class="overflow-x-auto -mx-6 px-6">
<table class="w-full text-left border-collapse min-w-[980px]">
<thead>
<tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
<th class="py-3.5 px-4 rounded-l-xl">Kode &amp; Waktu</th>
<th class="py-3.5 px-4">Penyewa &amp; Tujuan</th>
<th class="py-3.5 px-4">Unit Gear Disewa</th>
<th class="py-3.5 px-4">Jadwal Sewa</th>
<th class="py-3.5 px-4">Total &amp; Bayar</th>
<th class="py-3.5 px-4">Status</th>
<th class="py-3.5 px-4 text-right rounded-r-xl">Aksi Operasional</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-primary">#CR-1110</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">24 Okt • 14:15 WIB</span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Basecamp BDG</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md font-bold text-on-surface">Ahmad Fauzi</span>
<span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">0812-9876-5432</span>
<div class="inline-flex items-center gap-1 text-label-sm text-tertiary mt-1">
<span class="material-symbols-outlined text-[14px]">hiking</span>
<span>Gn. Prau (2.565 mdpl)</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Compact olive green dome tent packed tightly in waterproof ripstop compression bag on sand ground" src="<?= asset('images/tenda-dome.jpg') ?>"/>
<span class="text-on-surface leading-tight font-medium text-label-sm">1x Tenda Dome 4P Double Layer</span>
</div>
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Portable brass camping gas stove ultralight folding burner gear for hiking adventures" src="<?= asset('images/kompor-portable.jpg') ?>"/>
<span class="text-on-surface-variant leading-tight text-label-sm">1x Kompor Windproof Ultralight</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">20 - 22 Des 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Durasi: 2 Hari (Weekend)</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1">
<span class="font-label-md text-label-md font-bold text-on-surface">Rp230.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Inc. Dep Rp50k</span>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
<span>Lunas (BCA VA)</span>
</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">hourglass_top</span>
<span>Menunggu Konfirmasi</span>
</span>
</td>
<td class="py-4 px-4 align-top text-right">
<div class="inline-flex items-center gap-1.5">
<button class="px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-container text-on-primary font-label-sm text-label-sm font-bold transition-colors">
                    Konfirmasi
                  </button>
<button class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface-variant hover:text-on-surface transition-colors" title="Lihat Rincian">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-primary">#CR-1105</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">24 Okt • 11:20 WIB</span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Basecamp BDG</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md font-bold text-on-surface">Siti Rahmawati</span>
<span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">0857-1122-3344</span>
<div class="inline-flex items-center gap-1 text-label-sm text-tertiary mt-1">
<span class="material-symbols-outlined text-[14px]">hiking</span>
<span>Gn. Gede Pangrango</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Rugged mountain expedition backpack 60 liters deep forest green with straps and rain cover on clean studio background" src="<?= asset('images/carrier-hiking.jpg') ?>"/>
<span class="text-on-surface leading-tight font-medium text-label-sm">1x Carrier 60L Alpine Pro</span>
</div>
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Pair of carbon fiber collapsible trekking poles with cork grips resting on rock terrain" src="<?= asset('images/carrier-hiking.jpg') ?>"/>
<span class="text-on-surface-variant leading-tight text-label-sm">2x Trekking Pole Carbon</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">21 - 24 Des 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Durasi: 3 Hari</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1">
<span class="font-label-md text-label-md font-bold text-on-surface">Rp315.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Inc. Dep Rp75k</span>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
<span>Lunas (Mandiri VA)</span>
</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">check_circle</span>
<span>Siap Ambil</span>
</span>
</td>
<td class="py-4 px-4 align-top text-right">
<div class="inline-flex items-center gap-1.5">
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm font-bold transition-colors inline-flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">print</span>
<span>Surat Jalan</span>
</button>
<button class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface-variant hover:text-on-surface transition-colors" title="Lihat Rincian">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-primary">#CR-1101</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">23 Okt • 18:45 WIB</span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Basecamp WNSB</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md font-bold text-on-surface">Budi Santoso</span>
<span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">0813-4455-6677</span>
<div class="inline-flex items-center gap-1 text-label-sm text-tertiary mt-1">
<span class="material-symbols-outlined text-[14px]">hiking</span>
<span>Gn. Sindoro Kledung</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Technical lightweight goose down sleeping bag rolled in stuff sack warm yellow and charcoal fabric" src="<?= asset('images/sleeping-bag.jpg') ?>"/>
<span class="text-on-surface leading-tight font-medium text-label-sm">2x Sleeping Bag Goose-Down</span>
</div>
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Waterproof silicone coated camping flysheet tarp green neatly folded with guy lines" src="<?= asset('images/tenda-dome.jpg') ?>"/>
<span class="text-on-surface-variant leading-tight text-label-sm">1x Flysheet 3x4 Hexa</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">23 - 25 Des 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Durasi: 2 Hari</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1">
<span class="font-label-md text-label-md font-bold text-on-surface">Rp185.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Inc. Dep Rp40k</span>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
<span>Lunas (QRIS)</span>
</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">terrain</span>
<span>Sedang Disewa</span>
</span>
</td>
<td class="py-4 px-4 align-top text-right">
<div class="inline-flex items-center gap-1.5">
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm font-bold transition-colors inline-flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">assignment_turned_in</span>
<span>Inspeksi Kembali</span>
</button>
<button class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface-variant hover:text-on-surface transition-colors" title="Lihat Rincian">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
</div>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-bold text-primary">#CR-1098</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">22 Okt • 09:10 WIB</span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Basecamp BDG</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md font-bold text-on-surface">Dian Prasetyo</span>
<span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">0821-3322-1100</span>
<div class="inline-flex items-center gap-1 text-label-sm text-tertiary mt-1">
<span class="material-symbols-outlined text-[14px]">hiking</span>
<span>Taman Hutan Dago</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1 max-w-[200px]">
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Lightweight 1 person solo backpacking tent ultralight setup orange and grey on mountain ridge" src="<?= asset('images/carrier-hiking.jpg') ?>"/>
<span class="text-on-surface leading-tight font-medium text-label-sm">1x Tenda Solo Ultralight 1P</span>
</div>
<div class="flex items-center gap-2">
<img class="w-8 h-8 rounded-lg object-cover bg-surface-container shrink-0" data-alt="Compact self-inflating camping sleep pad mat rolled up with strap" src="<?= asset('images/sleeping-bag.jpg') ?>"/>
<span class="text-on-surface-variant leading-tight text-label-sm">1x Matras Tiup Pad</span>
</div>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col">
<span class="font-label-md text-label-md font-semibold text-on-surface">22 - 24 Des 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Durasi: 2 Hari</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<div class="flex flex-col gap-1">
<span class="font-label-md text-label-md font-bold text-on-surface">Rp140.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Deposit Rp30k Dikembalikan</span>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-on-surface-variant font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-outline"></span>
<span>Selesai (BCA VA)</span>
</span>
</div>
</td>
<td class="py-4 px-4 align-top">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-bold">
<span class="material-symbols-outlined text-[14px]">task_alt</span>
<span>Selesai / Kembali</span>
</span>
</td>
<td class="py-4 px-4 align-top text-right">
<div class="inline-flex items-center gap-1.5">
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm font-bold transition-colors">
                    Arsip
                  </button>
<button class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface-variant hover:text-on-surface transition-colors" title="Lihat Rincian">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination Bar -->
<div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 text-label-sm font-label-sm text-on-surface-variant">
<span>Menampilkan <strong>4</strong> dari <strong>48</strong> reservasi aktif • Halaman <strong>1</strong> dari <strong>12</strong></span>
<div class="flex items-center gap-1">
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold transition-colors disabled:opacity-50" disabled="">
            Sebelumnya
          </button>
<button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-bold">1</button>
<button class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold transition-colors">2</button>
<button class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold transition-colors">3</button>
<span class="px-1 text-outline">...</span>
<button class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold transition-colors">12</button>
<button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold transition-colors">
            Selanjutnya
          </button>
</div>
</div>
</div>
</div>
</div>
<script>
  // Simple micro-interaction for refresh button spin
  document.getElementById('btn-refresh')?.addEventListener('click', function() {
    const icon = document.getElementById('refresh-icon');
    if (icon) {
      icon.classList.add('rotate-180');
      setTimeout(() => {
        icon.classList.remove('rotate-180');
      }, 500);
    }
  });
</script></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
