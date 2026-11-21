<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Pengembalian & Kerusakan";
$bodyClass = "bg-surface font-body-md text-on-surface antialiased";
$activeMenu = 'pengembalian';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="relative pt-16 min-h-screen bg-surface w-full px-space-xl py-space-xl"><div class="flex flex-col w-full gap-space-xl">
<!-- Page Header & Ambient Banner -->
<section class="relative overflow-hidden rounded-xl bg-surface-container-low p-space-lg shadow-sm">
<div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-secondary-fixed/40 blur-3xl pointer-events-none"></div>
<div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-space-md">
<div class="space-y-1">
<div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-surface-container-high text-primary font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[16px]">assignment_return</span>
<span>Logistik &amp; Kendali Mutu Alat</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Pengembalian Alat &amp; Manajemen Kerusakan / Kehilangan</h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl">
          Pemeriksaan fisik unit kembali, validasi kelengkapan, dan penagihan denda kerusakan untuk armada ekspedisi Nusantara.
        </p>
</div>
<div class="flex items-center gap-space-sm shrink-0">
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-highest text-on-surface font-label-lg text-label-lg hover:bg-surface-container-high transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">history</span>
<span>Riwayat Arsip</span>
</button>
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-primary-container transition-transform active:scale-95" type="button">
<span class="material-symbols-outlined text-[18px]">qr_code_scanner</span>
<span>Pindai Barcode Unit</span>
</button>
</div>
</div>
</section>
<!-- Metric Summary Cards -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
<!-- Card 1 -->
<div class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex items-start justify-between">
<div class="space-y-2">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Menunggu Kembali Hari Ini</span>
<div class="flex items-baseline gap-2">
<span class="font-display text-display leading-none text-primary">8</span>
<span class="font-label-md text-label-md text-on-surface-variant">pesanan sewa</span>
</div>
<div class="inline-flex items-center gap-1.5 font-label-sm text-label-sm text-secondary">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span>5 dalam proses cek fisik</span>
</div>
</div>
<div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[24px]">inventory</span>
</div>
</div>
<!-- Card 2 -->
<div class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex items-start justify-between">
<div class="space-y-2">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Terlambat Kembali</span>
<div class="flex items-baseline gap-2">
<span class="font-display text-display leading-none text-error">2</span>
<span class="font-label-md text-label-md text-error">pesanan menunggak</span>
</div>
<div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-error animate-ping"></span>
<span>Membutuhkan follow-up segera</span>
</div>
</div>
<div class="w-12 h-12 rounded-xl bg-error-container text-error flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[24px]">alarm_on</span>
</div>
</div>
<!-- Card 3 -->
<div class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex items-start justify-between">
<div class="space-y-2">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Klaim Kerusakan Terbuka</span>
<div class="flex items-baseline gap-2">
<span class="font-display text-display leading-none text-tertiary">3</span>
<span class="font-label-md text-label-md text-tertiary">unit dalam rekonsiliasi</span>
</div>
<div class="inline-flex items-center gap-1.5 font-label-sm text-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] text-tertiary">handyman</span>
<span>Total klaim aktif: Rp185.000</span>
</div>
</div>
<div class="w-12 h-12 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[24px]">construction</span>
</div>
</div>
</section>
<!-- Section 1: Active Returning Table -->
<section class="flex flex-col gap-space-md">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-2.5 h-6 rounded-full bg-primary"></div>
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface tracking-tight">Daftar Sewa Aktif &amp; Sedang Kembali</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Pantau pesanan yang masuk gerbang drop-off pos pemeriksaan</p>
</div>
</div>
<div class="inline-flex items-center gap-2 bg-surface-container px-3 py-1.5 rounded-lg text-on-surface-variant font-label-md text-label-md">
<span class="material-symbols-outlined text-[16px]">filter_list</span>
<span>Filter Waktu: Hari Ini (20 Des 2025)</span>
</div>
</div>
<div class="overflow-x-auto rounded-xl bg-surface-container-lowest shadow-sm">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
<th class="py-3.5 px-space-md">Kode Booking</th>
<th class="py-3.5 px-space-md">Penyewa</th>
<th class="py-3.5 px-space-md">Periode Sewa</th>
<th class="py-3.5 px-space-md">Item yang Dipinjam</th>
<th class="py-3.5 px-space-md">Status Waktu</th>
<th class="py-3.5 px-space-md">Deposit Tersedia</th>
<th class="py-3.5 px-space-md text-right">Aksi Operasional</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm text-on-surface">
<!-- Row 1 (Highlight Active) -->
<tr class="bg-secondary-fixed/15 hover:bg-secondary-fixed/25 transition-colors">
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-primary">
              CR-1101
              <span class="block font-label-sm text-label-sm text-on-surface-variant font-normal">Pos Barat #02</span>
</td>
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg text-on-surface block">Dian Prasetyo</span>
<span class="text-on-surface-variant font-body-sm text-body-sm">0813-7766-5544</span>
</td>
<td class="py-4 px-space-md whitespace-nowrap">
<span class="block">17 - 20 Des 2025</span>
<span class="text-on-surface-variant font-label-sm text-label-sm">Batas: 12:00 WIB</span>
</td>
<td class="py-4 px-space-md">
<div class="flex flex-col gap-1 max-w-xs">
<span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span>1x Tenda Kap-4 Double Layer</span>
<span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span>2x Matras Foil Camping</span>
<span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span>1x Kompor Ultralight Windproof</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-md text-label-md font-bold">
<span class="material-symbols-outlined text-[14px]">warning</span>
                Terlambat 4 Jam
              </span>
</td>
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-on-surface">
              Rp50.000
            </td>
<td class="py-4 px-space-md text-right whitespace-nowrap">
<button class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-primary text-on-primary font-label-md text-label-md shadow-sm hover:bg-primary-container transition-all" type="button">
<span class="material-symbols-outlined text-[16px]">fact_check</span>
<span>Periksa Pengembalian (Inspeksi Fisik)</span>
</button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-on-surface">
              CR-1104
              <span class="block font-label-sm text-label-sm text-on-surface-variant font-normal">Pos Utara #01</span>
</td>
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg text-on-surface block">Galih Permana</span>
<span class="text-on-surface-variant font-body-sm text-body-sm">0821-4455-8899</span>
</td>
<td class="py-4 px-space-md whitespace-nowrap">
<span class="block">18 - 20 Des 2025</span>
<span class="text-on-surface-variant font-label-sm text-label-sm">Batas: 17:00 WIB</span>
</td>
<td class="py-4 px-space-md">
<div class="flex flex-col gap-1 max-w-xs">
<span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>1x Carrier 60L Ekspedisi</span>
<span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>2x Trekking Pole Carbon</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md font-bold">
<span class="material-symbols-outlined text-[14px]">check</span>
                Tepat Waktu
              </span>
</td>
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-on-surface">
              Rp50.000
            </td>
<td class="py-4 px-space-md text-right whitespace-nowrap">
<button class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-surface-container-highest text-on-surface hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors" type="button">
<span class="material-symbols-outlined text-[16px]">rule</span>
<span>Periksa Pengembalian</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
</section>
<!-- Section 2: Comprehensive Physical Inspection Panel / Active Modal -->
<section class="relative rounded-2xl bg-surface-container-lowest p-space-xl shadow-xl overflow-hidden">
<!-- Ambient top glow -->
<div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary via-secondary to-tertiary-fixed-dim"></div>
<!-- Modal Header -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between pb-space-lg mb-space-lg gap-space-md">
<div class="flex items-center gap-space-md">
<div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[28px]">biotech</span>
</div>
<div>
<div class="flex items-center gap-2">
<span class="px-2 py-0.5 rounded-full bg-primary text-on-primary font-label-sm text-label-sm font-bold">MODE INSPEKSI AKTIF</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Ruang Uji Mutu Gudang</span>
</div>
<h2 class="font-headline-md text-headline-md text-on-surface">Pemeriksaan Fisik Pengembalian - Kode Booking CR-1101</h2>
<div class="flex items-center gap-4 mt-0.5 text-on-surface-variant font-body-sm text-body-sm">
<span>Penyewa: <strong class="text-on-surface">Dian Prasetyo</strong> (0813-7766-5544)</span>
<span>•</span>
<span>Petugas Inspeksi: <strong class="text-on-surface">Bambang H.</strong></span>
</div>
</div>
</div>
<div class="flex items-center gap-2 self-start lg:self-center">
<span class="px-3 py-1.5 rounded-lg bg-surface-container font-label-sm text-label-sm text-on-surface-variant inline-flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px] text-tertiary">schedule</span>
          Status: Sedang Dihitung
        </span>
</div>
</div>
<!-- Visual Equipment Preview strip inspired by uploaded imagery -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md mb-space-lg">
<div class="relative h-28 rounded-xl overflow-hidden bg-surface-container flex items-center p-3 gap-3">
<img class="w-20 h-20 rounded-lg object-cover shrink-0" data-alt="Warm interior shot of a camping dome tent showing orange sleeping bag and aluminum support poles under atmospheric evening mountain light" src="<?= asset('images/sleeping-bag.jpg') ?>"/>
<div class="flex flex-col justify-center min-w-0">
<span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Unit 1/3</span>
<span class="font-label-lg text-label-lg text-on-surface truncate">Tenda Kap-4 Double Layer</span>
<span class="font-label-sm text-label-sm text-error font-semibold">1 Bagian Retak / Patah</span>
</div>
</div>
<div class="relative h-28 rounded-xl overflow-hidden bg-surface-container flex items-center p-3 gap-3">
<img class="w-20 h-20 rounded-lg object-cover shrink-0" data-alt="Reflective metallic silver thermal camping mat foil rolled neatly on top of dry pine forest needles in wilderness setting" src="<?= asset('images/sleeping-bag.jpg') ?>"/>
<div class="flex flex-col justify-center min-w-0">
<span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Unit 2/3</span>
<span class="font-label-lg text-label-lg text-on-surface truncate">Matras Foil Camping 1x2m (2 pcs)</span>
<span class="font-label-sm text-label-sm text-primary font-semibold">Kondisi Utuh &amp; Bersih</span>
</div>
</div>
<div class="relative h-28 rounded-xl overflow-hidden bg-surface-container flex items-center p-3 gap-3">
<img class="w-20 h-20 rounded-lg object-cover shrink-0" data-alt="Sturdy green tactical backpack with trekking poles strapped to exterior sitting in misty evergreen pine forest" src="<?= asset('images/carrier-hiking.jpg') ?>"/>
<div class="flex flex-col justify-center min-w-0">
<span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Unit 3/3</span>
<span class="font-label-lg text-label-lg text-on-surface truncate">Kompor Ultralight Windproof</span>
<span class="font-label-sm text-label-sm text-primary font-semibold">Lengkap &amp; Pemantik Nyala</span>
</div>
</div>
</div>
<!-- Per-Item Inspection Table -->
<div class="overflow-x-auto rounded-xl bg-surface-container-low mb-space-lg">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-high font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
<th class="py-3 px-space-md">Item Peralatan</th>
<th class="py-3 px-space-md">Jml Dipinjam</th>
<th class="py-3 px-space-md">Hasil Uji / Kondisi Fisik</th>
<th class="py-3 px-space-md">Biaya Ganti / Servis</th>
<th class="py-3 px-space-md">Catatan Teknis Staf</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm">
<!-- Item 1: Tent (Damaged) -->
<tr class="bg-surface-container-lowest">
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg font-bold text-on-surface block">Tenda Kap-4 Pro Dome</span>
<span class="text-on-surface-variant font-label-sm text-label-sm">Serial ID: TN-04-098</span>
</td>
<td class="py-4 px-space-md font-label-md text-label-md text-on-surface">
              1 Unit
            </td>
<td class="py-4 px-space-md">
<div class="relative">
<select class="w-full bg-surface-container-low text-error font-label-md text-label-md font-bold px-3 py-2 rounded-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary">
<option selected="">Rusak Ringan (Frame patah 1 section)</option>
<option>Baik / Lengkap</option>
<option>Rusak Berat (Robek Total)</option>
<option>Hilang / Tidak Kembali</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">arrow_drop_down</span>
</div>
</td>
<td class="py-4 px-space-md">
<div class="font-label-lg text-label-lg font-bold text-error">
                Rp45.000
                <span class="block font-label-sm text-label-sm text-on-surface-variant font-normal">Section alloy 7001</span>
</div>
</td>
<td class="py-4 px-space-md">
<p class="font-body-sm text-body-sm text-on-surface-variant italic">
                “1 batang frame alloy nomor 3 retak/patah, flysheet bersih utuh.”
              </p>
</td>
</tr>
<!-- Item 2: Foil Mat -->
<tr class="bg-surface-container-lowest">
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg font-bold text-on-surface block">Matras Foil Camping 1x2m</span>
<span class="text-on-surface-variant font-label-sm text-label-sm">Serial ID: MT-FL-12 &amp; 13</span>
</td>
<td class="py-4 px-space-md font-label-md text-label-md text-on-surface">
              2 Unit
            </td>
<td class="py-4 px-space-md">
<div class="relative">
<select class="w-full bg-surface-container-low text-primary font-label-md text-label-md font-bold px-3 py-2 rounded-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary">
<option selected="">Baik / Lengkap</option>
<option>Kotor / Perlu Cuci Berat</option>
<option>Sobek Pinggir</option>
<option>Hilang 1 Unit</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">arrow_drop_down</span>
</div>
</td>
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg font-bold text-on-surface">
                Rp0
              </span>
</td>
<td class="py-4 px-space-md">
<p class="font-body-sm text-body-sm text-on-surface-variant">
                Kondisi bersih tanpa sobek, pouch lengkap.
              </p>
</td>
</tr>
<!-- Item 3: Stove -->
<tr class="bg-surface-container-lowest">
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg font-bold text-on-surface block">Kompor Ultralight Windproof</span>
<span class="text-on-surface-variant font-label-sm text-label-sm">Serial ID: KP-UL-401</span>
</td>
<td class="py-4 px-space-md font-label-md text-label-md text-on-surface">
              1 Unit
            </td>
<td class="py-4 px-space-md">
<div class="relative">
<select class="w-full bg-surface-container-low text-primary font-label-md text-label-md font-bold px-3 py-2 rounded-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary">
<option selected="">Baik / Lengkap</option>
<option>Pemantik Rusak</option>
<option>Kaki Longgar</option>
<option>Hilang Kotak Pelindung</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">arrow_drop_down</span>
</div>
</td>
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg font-bold text-on-surface">
                Rp0
              </span>
</td>
<td class="py-4 px-space-md">
<p class="font-body-sm text-body-sm text-on-surface-variant">
                Pemantik piezoelektrik berfungsi normal, tidak tersumbat.
              </p>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Settlement Reconciliation Panel & Narrative Note -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg mb-space-lg">
<!-- Notes & Refund Method -->
<div class="lg:col-span-7 flex flex-col justify-between gap-space-md bg-surface-container-low p-space-lg rounded-xl">
<div class="space-y-2">
<label class="font-label-md text-label-md text-on-surface font-bold flex items-center gap-1.5">
<span class="material-symbols-outlined text-[18px] text-primary">edit_note</span>
            Keterangan Akhir Pemeriksaan (Log Operasional)
          </label>
<textarea class="w-full bg-surface-container-lowest text-on-surface p-3 rounded-lg font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary" rows="3">Penyewa kooperatif mengakui frame patah akibat tiupan angin kencang di camp. Sisa deposit Rp5.000 dikembalikan tunai.</textarea>
<span class="font-label-sm text-label-sm text-on-surface-variant">Catatan ini akan tersimpan otomatis ke Catatan Tindakan pelanggan.</span>
</div>
<div class="pt-space-md bg-surface-container-lowest p-space-md rounded-lg flex flex-col sm:flex-row items-start sm:items-center justify-between gap-space-sm">
<div>
<span class="font-label-md text-label-md font-bold text-on-surface block">Metode Pengembalian Sisa Deposit</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Pilih kanal penyaluran dana ke penyewa</span>
</div>
<div class="flex items-center gap-2">
<label class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-container text-on-surface font-label-sm text-label-sm cursor-pointer hover:bg-surface-container-high">
<input class="accent-primary" name="refund_method" type="radio"/>
<span>Transfer BCA</span>
</label>
<label class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary text-on-primary font-label-sm text-label-sm cursor-pointer shadow-sm">
<input checked="" class="accent-primary" name="refund_method" type="radio"/>
<span>Tunai di Tempat</span>
</label>
</div>
</div>
</div>
<!-- Financial Calculation Card -->
<div class="lg:col-span-5 bg-surface-container-high p-space-lg rounded-xl flex flex-col justify-between">
<div>
<div class="flex items-center justify-between pb-space-sm mb-space-sm">
<h3 class="font-headline-sm text-headline-sm text-on-surface">Rekapitulasi Deposit &amp; Denda</h3>
<span class="material-symbols-outlined text-[20px] text-secondary">receipt_long</span>
</div>
<div class="space-y-3 font-body-sm text-body-sm">
<div class="flex justify-between items-center text-on-surface-variant">
<span>Deposit Awal Penyewa</span>
<span class="font-label-lg text-label-lg font-bold text-on-surface">Rp50.000</span>
</div>
<div class="flex justify-between items-center text-error">
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">build</span>
                Biaya Ganti Kerusakan
              </span>
<span class="font-label-lg text-label-lg font-bold">-Rp45.000</span>
</div>
<div class="flex justify-between items-center text-on-surface-variant">
<div class="flex flex-col">
<span>Denda Keterlambatan</span>
<span class="font-label-sm text-label-sm text-secondary">Toleransi 4 Jam dibebaskan staf</span>
</div>
<span class="font-label-lg text-label-lg font-bold text-on-surface">Rp0</span>
</div>
</div>
</div>
<div class="mt-space-md pt-space-md bg-surface-container-lowest p-space-md rounded-xl">
<div class="flex justify-between items-baseline">
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant block">Sisa Deposit Dikembalikan</span>
<span class="font-headline-md text-headline-md text-primary font-bold">Rp5.000</span>
</div>
<span class="px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold">
              Kompensasi Sesuai
            </span>
</div>
</div>
</div>
</div>
<!-- Modal Action Buttons -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-space-md pt-space-md">
<div class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[18px] text-secondary">security_update_good</span>
<span>Sistem akan menerbitkan Bukti Serah Terima digital &amp; melepaskan inventaris ke stok aktif.</span>
</div>
<div class="flex items-center gap-space-sm w-full sm:w-auto justify-end">
<button class="px-4 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-surface-container-high transition-colors" type="button">
          Batal
        </button>
<button class="px-4 py-2.5 rounded-lg bg-surface-container-highest text-primary font-label-lg text-label-lg hover:bg-surface-container-high transition-colors" type="button">
          Simpan Draf Pemeriksaan
        </button>
<button class="px-6 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-primary-container transition-transform active:scale-95 flex items-center gap-2" type="button">
<span class="material-symbols-outlined text-[18px]">verified</span>
<span>Selesaikan Pengembalian &amp; Tutup Transaksi</span>
</button>
</div>
</div>
</section>
<!-- Section 3: Unresolved Damage and Loss Claims Table -->
<section class="flex flex-col gap-space-md">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-2.5 h-6 rounded-full bg-tertiary"></div>
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface tracking-tight">Laporan Kerusakan &amp; Kehilangan Belum Tuntas</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Daftar kasus insiden peralatan luar ruang yang masih menunggu penyelesaian penagihan atau verifikasi fisik lanjutan</p>
</div>
</div>
<div class="flex items-center gap-2">
<button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-container text-on-surface-variant font-label-sm text-label-sm hover:bg-surface-container-high" type="button">
<span class="material-symbols-outlined text-[16px]">file_download</span>
<span>Ekspor CSV</span>
</button>
</div>
</div>
<div class="overflow-x-auto rounded-xl bg-surface-container-lowest shadow-sm">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
<th class="py-3.5 px-space-md">Kode Booking</th>
<th class="py-3.5 px-space-md">Penyewa</th>
<th class="py-3.5 px-space-md">Alat Rusak / Hilang</th>
<th class="py-3.5 px-space-md">Kondisi &amp; Bagian Rusak</th>
<th class="py-3.5 px-space-md">Biaya Kewajiban Ganti</th>
<th class="py-3.5 px-space-md">Status Pelunasan</th>
<th class="py-3.5 px-space-md text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm text-on-surface">
<!-- Row 1: Farhan Rizki -->
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-on-surface">
              CR-1072
            </td>
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg text-on-surface block">Farhan Rizki</span>
<span class="text-on-surface-variant font-body-sm text-body-sm">Penyewa Reguler</span>
</td>
<td class="py-4 px-space-md">
<span class="font-label-md text-label-md text-on-surface">1x Set Pasak Tenda &amp; Guyline</span>
</td>
<td class="py-4 px-space-md">
<span class="text-on-surface-variant">Hilang 4 pcs pasak aluminium segi enam</span>
</td>
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-on-surface">
              Rp20.000
            </td>
<td class="py-4 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md font-bold">
<span class="material-symbols-outlined text-[14px]">check_circle</span>
                Lunas (Dipotong Deposit)
              </span>
</td>
<td class="py-4 px-space-md text-right whitespace-nowrap">
<button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-container-highest text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors" type="button">
<span class="material-symbols-outlined text-[16px]">archive</span>
<span>Tandai Selesai (Arsip)</span>
</button>
</td>
</tr>
<!-- Row 2: Dimas Aditya -->
<tr class="hover:bg-surface-container-low transition-colors bg-tertiary-fixed/10">
<td class="py-4 px-space-md font-label-lg text-label-lg font-bold text-on-surface">
              CR-1065
            </td>
<td class="py-4 px-space-md">
<span class="font-label-lg text-label-lg text-on-surface block">Dimas Aditya</span>
<span class="text-on-surface-variant font-body-sm text-body-sm">0852-1122-3344</span>
</td>
<td class="py-4 px-space-md">
<span class="font-label-md text-label-md text-on-surface">Flysheet Tenda Kap-6 Geodesic</span>
</td>
<td class="py-4 px-space-md">
<span class="text-error font-medium">Sobek terkena bara api unggun 15cm (panel depan)</span>
</td>
<td class="py-4 px-space-md">
<div class="font-label-lg text-label-lg font-bold text-on-surface">
                Rp120.000
                <span class="block font-label-sm text-label-sm text-error font-semibold">Deposit Rp50rb, sisa: Rp70.000</span>
</div>
</td>
<td class="py-4 px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-label-md font-bold">
<span class="material-symbols-outlined text-[14px]">pending</span>
                Menunggu Transfer Sisa
              </span>
</td>
<td class="py-4 px-space-md text-right whitespace-nowrap">
<button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary text-on-primary font-label-md text-label-md hover:bg-primary-container shadow-sm transition-transform active:scale-95" type="button">
<span class="material-symbols-outlined text-[16px]">price_check</span>
<span>Konfirmasi Pembayaran Ganti Rugi</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
</section>
</div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
