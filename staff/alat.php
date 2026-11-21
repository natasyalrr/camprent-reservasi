<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Alat & Kategori";
$bodyClass = "bg-surface font-body-md text-on-surface antialiased";
$activeMenu = 'alat-kategori';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="w-full pt-16 bg-surface"><div class="max-w-[1440px] mx-auto px-margin-desktop py-space-lg"><div class="flex flex-col w-full">
<!-- Top Page Header & Context Action Bar -->
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md mb-space-lg">
<div>
<div class="flex items-center gap-2 mb-1">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Katalog Logistik Gudang</span>
<span class="w-1.5 h-1.5 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Update: 10 Menit Lalu</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight leading-tight">
        Manajemen Inventaris Alat &amp; Kategori
      </h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl mt-1">
        Kelola katalog perlengkapan outdoor, stok unit operasional, unit dalam perbaikan/hilang, tarif sewa harian, dan struktur kategori pendakian Nusantara.
      </p>
</div>
<!-- Right Header Actions -->
<div class="flex items-center gap-3 self-start lg:self-end">
<button class="inline-flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">file_download</span>
<span>Ekspor CSV</span>
</button>
<button class="inline-flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg shadow-sm transition-all transform active:scale-98" id="btn-open-modal" onclick="openAddModal()" type="button">
<span class="material-symbols-outlined text-[20px]">add</span>
<span>Tambah Alat Baru</span>
</button>
</div>
</div>
<!-- Primary Tab Selector & Filter Bar -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md pb-space-md border-b border-surface-variant/70 mb-space-lg">
<!-- Tabs Switcher -->
<div class="inline-flex p-1 rounded-xl bg-surface-container-high" role="tablist">
<button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm transition-all" id="tab-btn-alat" onclick="switchMainTab('alat')" type="button">
<span class="material-symbols-outlined text-[18px]">inventory</span>
<span>Tab Alat</span>
<span class="px-2 py-0.5 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm ml-1">42 Item Terdaftar</span>
</button>
<button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-on-surface-variant hover:text-on-surface font-label-lg text-label-lg transition-colors" id="tab-btn-kategori" onclick="switchMainTab('kategori')" type="button">
<span class="material-symbols-outlined text-[18px]">category</span>
<span>Tab Kategori</span>
<span class="px-2 py-0.5 rounded-full bg-surface-container-highest text-on-surface font-label-sm text-label-sm ml-1">10 Kategori</span>
</button>
</div>
<!-- Filters & Search for Tab Alat -->
<div class="flex flex-wrap items-center gap-3" id="filter-controls-alat">
<!-- Search Input -->
<div class="relative min-w-[260px]">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
<input class="w-full pl-9 pr-3 py-2 text-on-surface placeholder:text-outline bg-surface-container-lowest rounded-xl font-body-sm text-body-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="Cari nama alat, SKU, atau kategori..." type="text"/>
</div>
<!-- Kategori Filter -->
<div class="relative">
<select class="appearance-none bg-surface-container-lowest text-on-surface pl-3 pr-8 py-2 rounded-xl font-label-lg text-label-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer">
<option value="all">Semua Kategori</option>
<option value="tenda">Tenda &amp; Shelter</option>
<option value="tas">Tas &amp; Hydropack</option>
<option value="masak">Masak &amp; Makan</option>
<option value="penerangan">Penerangan</option>
<option value="tidur">Alas &amp; Tidur</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">expand_more</span>
</div>
<!-- Status Filter -->
<div class="relative">
<select class="appearance-none bg-surface-container-lowest text-on-surface pl-3 pr-8 py-2 rounded-xl font-label-lg text-label-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer">
<option value="all">Kondisi: Semua</option>
<option value="prima">Kondisi Prima</option>
<option value="rusak">Perlu Servis / Rusak</option>
<option value="hilang">Unit Hilang</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">tune</span>
</div>
</div>
</div>
<!-- VIEW CONTAINER: TAB ALAT -->
<div class="flex flex-col gap-space-lg" id="view-tab-alat">
<!-- Summary Stat Banners -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
<!-- Stat 1: Total Stok Gudang -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Total Stok Gudang</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-display text-headline-lg font-bold text-on-surface">184</span>
<span class="font-label-sm text-label-sm text-primary font-bold">Unit</span>
</div>
<span class="font-body-sm text-body-sm text-primary flex items-center gap-1 mt-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
            92% Siap Digunakan / Layak
          </span>
</div>
<div class="w-10 h-10 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
<span class="material-symbols-outlined text-[22px]">warehouse</span>
</div>
</div>
<!-- Stat 2: Sedang Disewa -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Disewa di Lapangan</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-display text-headline-lg font-bold text-on-surface">38</span>
<span class="font-label-sm text-label-sm text-tertiary font-bold">Unit</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 mt-1">
<span class="material-symbols-outlined text-[16px] text-tertiary">hiking</span>
            14 Tim Ekspedisi Aktif
          </span>
</div>
<div class="w-10 h-10 rounded-xl bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
<span class="material-symbols-outlined text-[22px]">terrain</span>
</div>
</div>
<!-- Stat 3: Rusak / Butuh Servis -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-error font-bold">Rusak / Servis</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-display text-headline-lg font-bold text-error">6</span>
<span class="font-label-sm text-label-sm text-error font-bold">Unit</span>
</div>
<span class="font-body-sm text-body-sm text-error flex items-center gap-1 mt-1">
<span class="material-symbols-outlined text-[16px]">build</span>
            Antrean reparasi workshop
          </span>
</div>
<div class="w-10 h-10 rounded-xl bg-error-container flex items-center justify-center text-on-error-container">
<span class="material-symbols-outlined text-[22px]">handyman</span>
</div>
</div>
<!-- Stat 4: Hilang Belum Diganti -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-start justify-between">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-error font-bold">Hilang Belum Diganti</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-display text-headline-lg font-bold text-error">2</span>
<span class="font-label-sm text-label-sm text-error font-bold">Unit</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 mt-1">
<span class="material-symbols-outlined text-[16px] text-error">receipt_long</span>
            Klaim ganti rugi peminjam
          </span>
</div>
<div class="w-10 h-10 rounded-xl bg-error-container flex items-center justify-center text-on-error-container">
<span class="material-symbols-outlined text-[22px]">inventory_2</span>
</div>
</div>
</div>
<!-- Inventory Data Table Card -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
<div class="px-space-md py-3.5 bg-surface-container-low flex items-center justify-between">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-[18px] text-primary">view_list</span>
<span class="font-label-lg text-label-lg text-on-surface font-bold">Daftar Inventaris Unit Lapangan</span>
<span class="px-2 py-0.5 rounded-full bg-surface-variant text-on-surface-variant font-label-sm text-label-sm">Menampilkan 5 dari 42 data</span>
</div>
<div class="flex items-center gap-2">
<button class="p-1 rounded-lg hover:bg-surface-container text-on-surface-variant" title="Urutkan" type="button">
<span class="material-symbols-outlined text-[18px]">sort</span>
</button>
<button class="p-1 rounded-lg hover:bg-surface-container text-on-surface-variant" title="Pengaturan Kolom" type="button">
<span class="material-symbols-outlined text-[18px]">view_column</span>
</button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left text-on-surface">
<thead class="bg-surface-container font-label-md text-label-md uppercase tracking-wider text-on-surface-variant border-b border-surface-variant/40">
<tr>
<th class="py-3 px-space-md font-bold" scope="col">Alat &amp; Deskripsi Singkat</th>
<th class="py-3 px-space-md font-bold" scope="col">Kategori</th>
<th class="py-3 px-space-md font-bold" scope="col">Stok &amp; Status Alokasi</th>
<th class="py-3 px-space-md font-bold" scope="col">Kondisi Fisik</th>
<th class="py-3 px-space-md font-bold" scope="col">Tarif Sewa / Hari</th>
<th class="py-3 px-space-md font-bold text-center" scope="col">Status Katalog</th>
<th class="py-3 px-space-md font-bold text-right" scope="col">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-variant/30 font-body-sm text-body-sm">
<!-- Row 1: Tenda Kap-4 -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-container flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Tenda dome warna oranye cerah berkemah di atas puncak gunung dengan pemandangan awan putih halus dan latar belakang matahari terbit keemasan di lanskap pegunungan tropis Indonesia" src="<?= asset('images/tenda-dome.jpg') ?>"/>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-lg text-label-lg font-bold text-on-surface truncate">Tenda Kap-4 Pro Dome Series</span>
<span class="font-label-sm text-label-sm text-primary tracking-wide">SKU: TND-DOME-04</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate max-w-xs text-xs">Double layer PU3000mm, pasak alloy ringan</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[16px] text-primary">camping</span>
                  Tenda &amp; Shelter
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col gap-1">
<div class="flex items-center gap-2">
<span class="font-bold text-on-surface">15 Unit Total</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">(11 Tersedia)</span>
</div>
<!-- Mini Progress Bar -->
<div class="w-36 h-1.5 rounded-full bg-surface-container overflow-hidden flex">
<div class="bg-primary h-full" style="width: 73%" title="Tersedia: 11"></div>
<div class="bg-tertiary-fixed-dim h-full" style="width: 20%" title="Disewa: 3"></div>
<div class="bg-error h-full" style="width: 7%" title="Rusak: 1"></div>
</div>
<div class="flex items-center gap-2 text-xs text-on-surface-variant">
<span class="text-primary font-semibold">11 Siap</span> • 
                    <span class="text-tertiary font-semibold">3 Disewa</span> • 
                    <span class="text-error font-semibold">1 Rusak</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">error</span>
                  1 Frame Alloy Patah
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col">
<span class="font-bold text-primary text-base">Rp45.000<span class="text-xs font-normal text-on-surface-variant"> / hari</span></span>
<span class="text-xs text-outline line-through">Rp55.000</span>
</div>
</td>
<td class="py-3.5 px-space-md text-center">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>
                  Aktif
                </span>
</td>
<td class="py-3.5 px-space-md text-right">
<div class="inline-flex items-center gap-1">
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Edit Alat" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Riwayat Unit" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-error-container/40 flex items-center justify-center text-on-surface-variant hover:text-error transition-colors" title="Hapus" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 2: Carrier 60L -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-container flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Ransel pendaki gunung warna hijau army kapasitas 50 liter dengan tongkat trekking terpasang rapi di lantai hutan pinus berkabut tebal lumut hijau alami" src="<?= asset('images/carrier-hiking.jpg') ?>"/>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-lg text-label-lg font-bold text-on-surface truncate">Carrier 60L Alpine Expedition</span>
<span class="font-label-sm text-label-sm text-primary tracking-wide">SKU: CRR-ALP-60</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate max-w-xs text-xs">Torso adjustable, bantalan empuk honeycomb</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[16px] text-primary">backpack</span>
                  Tas &amp; Hydropack
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col gap-1">
<div class="flex items-center gap-2">
<span class="font-bold text-on-surface">12 Unit Total</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">(8 Tersedia)</span>
</div>
<div class="w-36 h-1.5 rounded-full bg-surface-container overflow-hidden flex">
<div class="bg-primary h-full" style="width: 67%" title="Tersedia: 8"></div>
<div class="bg-tertiary-fixed-dim h-full" style="width: 33%" title="Disewa: 4"></div>
</div>
<div class="flex items-center gap-2 text-xs text-on-surface-variant">
<span class="text-primary font-semibold">8 Siap</span> • 
                    <span class="text-tertiary font-semibold">4 Disewa</span> • 
                    <span class="text-on-surface-variant">0 Rusak</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">check_circle</span>
                  Kondisi Prima
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col">
<span class="font-bold text-primary text-base">Rp35.000<span class="text-xs font-normal text-on-surface-variant"> / hari</span></span>
</div>
</td>
<td class="py-3.5 px-space-md text-center">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>
                  Aktif
                </span>
</td>
<td class="py-3.5 px-space-md text-right">
<div class="inline-flex items-center gap-1">
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Edit Alat" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Riwayat Unit" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-error-container/40 flex items-center justify-center text-on-surface-variant hover:text-error transition-colors" title="Hapus" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 3: Kompor Ultralight Windproof -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-container flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Kompor gas portabel ultralight camping mendidihkan air dalam panci titanium kecil di meja kayu teras perkemahan dengan latar hutan pinus pegunungan megah" src="<?= asset('images/kompor-portable.jpg') ?>"/>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-lg text-label-lg font-bold text-on-surface truncate">Kompor Ultralight Windproof &amp; Adaptor</span>
<span class="font-label-sm text-label-sm text-primary tracking-wide">SKU: KMP-WND-01</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate max-w-xs text-xs">Pematik elektrik piezo, pelindung angin lipat</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[16px] text-tertiary">skillet</span>
                  Masak &amp; Makan
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col gap-1">
<div class="flex items-center gap-2">
<span class="font-bold text-on-surface">20 Unit Total</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">(15 Tersedia)</span>
</div>
<div class="w-36 h-1.5 rounded-full bg-surface-container overflow-hidden flex">
<div class="bg-primary h-full" style="width: 75%" title="Tersedia: 15"></div>
<div class="bg-tertiary-fixed-dim h-full" style="width: 20%" title="Disewa: 4"></div>
<div class="bg-error h-full" style="width: 5%" title="Hilang: 1"></div>
</div>
<div class="flex items-center gap-2 text-xs text-on-surface-variant">
<span class="text-primary font-semibold">15 Siap</span> • 
                    <span class="text-tertiary font-semibold">4 Disewa</span> • 
                    <span class="text-error font-semibold">1 Hilang</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">warning</span>
                  1 Unit Hilang (CR-1072)
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col">
<span class="font-bold text-primary text-base">Rp15.000<span class="text-xs font-normal text-on-surface-variant"> / hari</span></span>
<span class="text-xs text-outline line-through">Rp20.000</span>
</div>
</td>
<td class="py-3.5 px-space-md text-center">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>
                  Aktif
                </span>
</td>
<td class="py-3.5 px-space-md text-right">
<div class="inline-flex items-center gap-1">
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Edit Alat" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Riwayat Unit" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-error-container/40 flex items-center justify-center text-on-surface-variant hover:text-error transition-colors" title="Hapus" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 4: Headlamp LED 450 Lumens -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-container flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Headlamp senter kepala taktis warna hijau zaitun tahan air tergeletak di atas batu alam pegunungan basah dengan tali elastis kokoh" src="<?= asset('images/headlamp.jpg') ?>"/>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-lg text-label-lg font-bold text-on-surface truncate">Headlamp LED 450 Lumens Waterproof</span>
<span class="font-label-sm text-label-sm text-primary tracking-wide">SKU: LMP-HDL-02</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate max-w-xs text-xs">Rechargeable Type-C, Red light mode SOS</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[16px] text-tertiary-container">flashlight_on</span>
                  Penerangan
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col gap-1">
<div class="flex items-center gap-2">
<span class="font-bold text-on-surface">25 Unit Total</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">(22 Tersedia)</span>
</div>
<div class="w-36 h-1.5 rounded-full bg-surface-container overflow-hidden flex">
<div class="bg-primary h-full" style="width: 88%" title="Tersedia: 22"></div>
<div class="bg-tertiary-fixed-dim h-full" style="width: 12%" title="Disewa: 3"></div>
</div>
<div class="flex items-center gap-2 text-xs text-on-surface-variant">
<span class="text-primary font-semibold">22 Siap</span> • 
                    <span class="text-tertiary font-semibold">3 Disewa</span> • 
                    <span class="text-on-surface-variant">0 Rusak</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">check_circle</span>
                  Kondisi Prima
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col">
<span class="font-bold text-primary text-base">Rp12.000<span class="text-xs font-normal text-on-surface-variant"> / hari</span></span>
</div>
</td>
<td class="py-3.5 px-space-md text-center">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>
                  Aktif
                </span>
</td>
<td class="py-3.5 px-space-md text-right">
<div class="inline-flex items-center gap-1">
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Edit Alat" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Riwayat Unit" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-error-container/40 flex items-center justify-center text-on-surface-variant hover:text-error transition-colors" title="Hapus" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 5: Flysheet Shelter 4x6 -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-3.5 px-space-md">
<div class="flex items-center gap-3">
<div class="w-14 h-14 rounded-lg bg-surface-container-high flex items-center justify-center text-outline flex-shrink-0">
<span class="material-symbols-outlined text-[28px] text-on-surface-variant">roofing</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-lg text-label-lg font-bold text-on-surface truncate">Flysheet Shelter 4x6 Meter Waterproof</span>
<span class="font-label-sm text-label-sm text-primary tracking-wide">SKU: SHL-FLY-46</span>
<span class="font-body-sm text-body-sm text-on-surface-variant truncate max-w-xs text-xs">19 Loop gantungan kuat, bahan Oxford 210D</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[16px] text-primary">camping</span>
                  Tenda &amp; Shelter
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col gap-1">
<div class="flex items-center gap-2">
<span class="font-bold text-on-surface">8 Unit Total</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">(4 Tersedia)</span>
</div>
<div class="w-36 h-1.5 rounded-full bg-surface-container overflow-hidden flex">
<div class="bg-primary h-full" style="width: 50%" title="Tersedia: 4"></div>
<div class="bg-tertiary-fixed-dim h-full" style="width: 25%" title="Disewa: 2"></div>
<div class="bg-error h-full" style="width: 25%" title="Rusak: 2"></div>
</div>
<div class="flex items-center gap-2 text-xs text-on-surface-variant">
<span class="text-primary font-semibold">4 Siap</span> • 
                    <span class="text-tertiary font-semibold">2 Disewa</span> • 
                    <span class="text-error font-semibold">2 Rusak</span>
</div>
</div>
</td>
<td class="py-3.5 px-space-md">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">local_fire_department</span>
                  2 Sobek Bara Api
                </span>
</td>
<td class="py-3.5 px-space-md">
<div class="flex flex-col">
<span class="font-bold text-primary text-base">Rp20.000<span class="text-xs font-normal text-on-surface-variant"> / hari</span></span>
</div>
</td>
<td class="py-3.5 px-space-md text-center">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-container-highest text-on-surface-variant font-label-md text-label-md font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-outline inline-block"></span>
                  Nonaktif
                </span>
</td>
<td class="py-3.5 px-space-md text-right">
<div class="inline-flex items-center gap-1">
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Edit Alat" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Riwayat Unit" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
</button>
<button class="w-8 h-8 rounded-lg hover:bg-error-container/40 flex items-center justify-center text-on-surface-variant hover:text-error transition-colors" title="Hapus" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Footer -->
<div class="p-space-md bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-surface-variant/30">
<span class="font-body-sm text-body-sm text-on-surface-variant">Menampilkan <strong class="text-on-surface">1-5</strong> dari <strong class="text-on-surface">42</strong> item inventaris</span>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface-variant disabled:opacity-40" disabled="" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-bold" type="button">1</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container text-on-surface font-label-md text-label-md" type="button">2</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container text-on-surface font-label-md text-label-md" type="button">3</button>
<span class="px-1 text-outline">...</span>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container text-on-surface font-label-md text-label-md" type="button">9</button>
<button class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
<!-- VIEW CONTAINER: TAB KATEGORI (Initially hidden or toggled) -->
<div class="hidden flex-col gap-space-lg" id="view-tab-kategori">
<!-- Header Subtitle & Quick Add Category -->
<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Struktur Kategori Peralatan</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
          Atur pengelompokan perlengkapan pendakian untuk katalog booking tamu dan departemen logistik lapangan.
        </p>
</div>
<!-- Quick Add Category Form -->
<form class="flex flex-wrap sm:flex-nowrap items-center gap-2" onsubmit="event.preventDefault();">
<input class="px-space-md py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary/20 min-w-[260px]" placeholder="Nama Kategori Baru (misal: Navigasi &amp; GPS)" type="text"/>
<div class="relative">
<select class="appearance-none px-space-md pr-8 py-2.5 rounded-xl bg-surface-container-low font-label-lg text-label-lg text-on-surface focus:outline-none cursor-pointer">
<option value="explore">🧭 Icon Navigasi</option>
<option value="health_and_safety">🩹 Icon Medis / P3K</option>
<option value="flash_on">⚡ Icon Power</option>
<option value="chair">🪑 Icon Furnitur</option>
<option value="snowshoeing">🥾 Icon Trekking</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">expand_more</span>
</div>
<button class="px-space-md py-2.5 rounded-xl bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg whitespace-nowrap flex items-center gap-1.5 transition-colors" type="submit">
<span class="material-symbols-outlined text-[18px]">add</span>
<span>Tambah Kategori</span>
</button>
</form>
</div>
<!-- Category Grid Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md">
<!-- Cat 1 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-start justify-between">
<div class="flex items-start gap-3">
<div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[24px]">camping</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Tenda &amp; Shelter</span>
<span class="font-label-sm text-label-sm text-primary font-bold mt-0.5">12 Alat Terdaftar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs mt-1">Dome, flysheet, bivy, tarp &amp; pasak alloy</span>
</div>
</div>
<div class="flex items-center gap-1">
<button class="p-1.5 rounded-lg hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg hover:bg-error-container/50 text-on-surface-variant hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Cat 2 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-start justify-between">
<div class="flex items-start gap-3">
<div class="w-12 h-12 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[24px]">backpack</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Tas &amp; Hydropack</span>
<span class="font-label-sm text-label-sm text-primary font-bold mt-0.5">8 Alat Terdaftar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs mt-1">Carrier 45L-75L, daypack, drybag, bladder</span>
</div>
</div>
<div class="flex items-center gap-1">
<button class="p-1.5 rounded-lg hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg hover:bg-error-container/50 text-on-surface-variant hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Cat 3 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-start justify-between">
<div class="flex items-start gap-3">
<div class="w-12 h-12 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[24px]">skillet</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Masak &amp; Makan</span>
<span class="font-label-sm text-label-sm text-tertiary font-bold mt-0.5">9 Alat Terdaftar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs mt-1">Kompor gas portabel, nesting, ketel, cutlery set</span>
</div>
</div>
<div class="flex items-center gap-1">
<button class="p-1.5 rounded-lg hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg hover:bg-error-container/50 text-on-surface-variant hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Cat 4 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-start justify-between">
<div class="flex items-start gap-3">
<div class="w-12 h-12 rounded-xl bg-surface-container-high text-on-surface flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[24px]">bed</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Alas &amp; Tidur</span>
<span class="font-label-sm text-label-sm text-primary font-bold mt-0.5">6 Alat Terdaftar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs mt-1">Matras angin ultralight, sleeping bag goose down</span>
</div>
</div>
<div class="flex items-center gap-1">
<button class="p-1.5 rounded-lg hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg hover:bg-error-container/50 text-on-surface-variant hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Cat 5 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-start justify-between">
<div class="flex items-start gap-3">
<div class="w-12 h-12 rounded-xl bg-tertiary-fixed-dim/30 text-tertiary flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[24px]">flashlight_on</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Penerangan &amp; Listrik</span>
<span class="font-label-sm text-label-sm text-primary font-bold mt-0.5">4 Alat Terdaftar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs mt-1">Headlamp, senter jarak jauh, lentera tenda</span>
</div>
</div>
<div class="flex items-center gap-1">
<button class="p-1.5 rounded-lg hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg hover:bg-error-container/50 text-on-surface-variant hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Cat 6 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm hover:shadow-md transition-shadow flex items-start justify-between">
<div class="flex items-start gap-3">
<div class="w-12 h-12 rounded-xl bg-primary-fixed text-on-primary-fixed flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[24px]">chair</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Furnitur Lipat</span>
<span class="font-label-sm text-label-sm text-primary font-bold mt-0.5">3 Alat Terdaftar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs mt-1">Kursi lipat ultralight, meja camping aluminium</span>
</div>
</div>
<div class="flex items-center gap-1">
<button class="p-1.5 rounded-lg hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="p-1.5 rounded-lg hover:bg-error-container/50 text-on-surface-variant hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
</div>
<!-- MODAL: TAMBAH ALAT BARU -->
<div class="fixed inset-0 z-50 flex items-center justify-center bg-inverse-surface/40 backdrop-blur-sm p-4 hidden" id="modal-tambah-alat">
<div class="bg-surface-container-lowest w-full max-w-2xl rounded-2xl shadow-xl overflow-hidden flex flex-col max-h-[921px] animate-in fade-in zoom-in duration-200">
<!-- Modal Header -->
<div class="p-space-lg bg-surface-container-low flex items-center justify-between border-b border-surface-variant/40">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-primary text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">add_circle</span>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface leading-tight">Tambah Alat Outdoor Baru</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Lengkapi data spesifikasi dan stok awal untuk katalog CampRent</p>
</div>
</div>
<button class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors" onclick="closeAddModal()" type="button">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
<!-- Modal Body (Scrollable) -->
<div class="p-space-lg overflow-y-auto flex flex-col gap-space-md">
<!-- Form Row: Name & SKU -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
<div class="md:col-span-2 flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Nama Alat Lengkap <span class="text-error">*</span></label>
<input class="px-space-md py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" type="text" value="Tenda Dome Kap-6 Double Layer Stormproof"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">SKU / Seri Unik <span class="text-error">*</span></label>
<input class="px-space-md py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface font-mono uppercase focus:outline-none focus:ring-2 focus:ring-primary/20" type="text" value="TND-STR-06"/>
</div>
</div>
<!-- Form Row: Category & Initial Stock -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Kategori Peralatan <span class="text-error">*</span></label>
<div class="relative">
<select class="w-full appearance-none px-space-md pr-8 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20">
<option selected="" value="tenda">Tenda &amp; Shelter</option>
<option value="tas">Tas &amp; Hydropack</option>
<option value="masak">Masak &amp; Makan</option>
<option value="alas">Alas &amp; Tidur</option>
<option value="penerangan">Penerangan &amp; Listrik</option>
<option value="furnitur">Furnitur Lipat</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">expand_more</span>
</div>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Stok Awal Gudang <span class="text-error">*</span></label>
<div class="flex items-center">
<input class="w-full px-space-md py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" min="1" type="number" value="5"/>
<span class="ml-2 font-label-md text-label-md text-on-surface-variant font-bold">Unit</span>
</div>
</div>
</div>
<!-- Form Row: Pricing -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Tarif Sewa Harian (Rp) <span class="text-error">*</span></label>
<div class="relative">
<span class="absolute left-3 top-1/2 -translate-y-1/2 font-label-md text-label-md text-outline font-bold">Rp</span>
<input class="w-full pl-9 pr-3 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface font-bold focus:outline-none focus:ring-2 focus:ring-primary/20" type="number" value="65000"/>
</div>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Harga Normal / Coret (Opsional)</label>
<div class="relative">
<span class="absolute left-3 top-1/2 -translate-y-1/2 font-label-md text-label-md text-outline">Rp</span>
<input class="w-full pl-9 pr-3 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="Biarkan kosong jika tidak promo" type="number" value="80000"/>
</div>
</div>
</div>
<!-- Photo Upload Preview Slot -->
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Foto Produk Alat</label>
<div class="flex items-center gap-4 p-3 rounded-xl bg-surface-container-low border border-surface-variant/50">
<div class="w-20 h-20 rounded-xl overflow-hidden bg-surface-container flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Pemandangan tenda perkemahan warna oranye tahan badai dipasang kokoh di puncak tebing berbatu pegunungan Indonesia dengan latar samudra awan dramatis saat fajar" src="<?= asset('images/tenda-dome.jpg') ?>"/>
</div>
<div class="flex flex-col gap-1">
<div class="flex items-center gap-2">
<button class="px-3 py-1.5 rounded-lg bg-surface-container-lowest hover:bg-surface-container text-on-surface font-label-md text-label-md shadow-sm transition-colors flex items-center gap-1.5" type="button">
<span class="material-symbols-outlined text-[16px] text-primary">upload</span>
<span>Ganti Gambar</span>
</button>
<button class="p-1.5 rounded-lg text-error hover:bg-error-container/40 transition-colors" title="Hapus foto" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs">Format PNG atau JPG maks 3MB. Disarankan rasio 4:3 latar bersih.</span>
</div>
</div>
</div>
<!-- Specs & Description -->
<div class="flex flex-col gap-1.5">
<label class="font-label-lg text-label-lg text-on-surface font-semibold">Deskripsi Singkat &amp; Spesifikasi Teknis</label>
<textarea class="px-space-md py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" rows="3">Bahan Polyester ripstop 210T PU3000mm, frame alloy 8.5mm, pasak 14 pcs, kapasitas 6 orang dewasa plus vestibule luas.</textarea>
</div>
<!-- Catalog Visibility Toggle -->
<label class="flex items-center gap-3 p-3 rounded-xl bg-surface-container-low cursor-pointer">
<input checked="" class="w-4 h-4 rounded text-primary accent-primary cursor-pointer" type="checkbox"/>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold text-on-surface">Tampilkan langsung di katalog publik</span>
<span class="font-body-sm text-body-sm text-on-surface-variant text-xs">Unit akan langsung dapat dipilih oleh penyewa di situs booking</span>
</div>
</label>
</div>
<!-- Modal Footer -->
<div class="p-space-md bg-surface-container-low flex items-center justify-end gap-3 border-t border-surface-variant/40">
<button class="px-space-md py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors" onclick="closeAddModal()" type="button">
          Batal
        </button>
<button class="px-space-md py-2.5 rounded-xl bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg shadow-sm transition-colors flex items-center gap-1.5" onclick="closeAddModal()" type="button">
<span class="material-symbols-outlined text-[18px]">save</span>
<span>Simpan Alat ke Inventaris</span>
</button>
</div>
</div>
</div>
</div>
<script>
  function switchMainTab(tabName) {
    const tabBtnAlat = document.getElementById('tab-btn-alat');
    const tabBtnKategori = document.getElementById('tab-btn-kategori');
    const viewAlat = document.getElementById('view-tab-alat');
    const viewKategori = document.getElementById('view-tab-kategori');
    const filterControlsAlat = document.getElementById('filter-controls-alat');

    if (tabName === 'alat') {
      tabBtnAlat.className = "inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm transition-all";
      tabBtnKategori.className = "inline-flex items-center gap-2 px-4 py-2 rounded-lg text-on-surface-variant hover:text-on-surface font-label-lg text-label-lg transition-colors";
      viewAlat.classList.remove('hidden');
      viewAlat.classList.add('flex');
      viewKategori.classList.add('hidden');
      viewKategori.classList.remove('flex');
      filterControlsAlat.style.display = 'flex';
    } else {
      tabBtnKategori.className = "inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm transition-all";
      tabBtnAlat.className = "inline-flex items-center gap-2 px-4 py-2 rounded-lg text-on-surface-variant hover:text-on-surface font-label-lg text-label-lg transition-colors";
      viewKategori.classList.remove('hidden');
      viewKategori.classList.add('flex');
      viewAlat.classList.add('hidden');
      viewAlat.classList.remove('flex');
      filterControlsAlat.style.display = 'none';
    }
  }

  function openAddModal() {
    const modal = document.getElementById('modal-tambah-alat');
    if (modal) {
      modal.classList.remove('hidden');
    }
  }

  function closeAddModal() {
    const modal = document.getElementById('modal-tambah-alat');
    if (modal) {
      modal.classList.add('hidden');
    }
  }
</script></div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
