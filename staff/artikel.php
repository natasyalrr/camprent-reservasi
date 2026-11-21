<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Artikel";
$bodyClass = "bg-surface font-body-md text-on-surface antialiased";
$activeMenu = 'artikel';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="w-full pt-16 bg-surface"><div class="max-w-[1440px] mx-auto px-margin-desktop py-space-lg"><div class="flex flex-col w-full">
<!-- Top Utility Bar: Title & High-level Statistics -->
<section class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md mb-space-lg">
<div class="flex flex-col gap-space-xs max-w-2xl">
<div class="inline-flex items-center gap-2 text-primary font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px]">menu_book</span>
<span class="tracking-wider uppercase">Pusat Publikasi &amp; Edukasi</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight leading-tight">
        Manajemen Artikel &amp; Edukasi Petualangan
      </h1>
<p class="font-body-md text-body-md text-on-surface-variant">
        Publikasi panduan keselamatan pendakian, review gear outdoor, tips Leave No Trace, dan informasi kondisi cuaca gunung Nusantara.
      </p>
</div>
<!-- Quick Metric Ribbons -->
<div class="flex items-center gap-space-sm bg-surface-container p-1.5 rounded-xl shadow-sm self-start lg:self-auto">
<div class="flex items-center gap-2 px-space-md py-2 bg-surface-container-lowest rounded-lg">
<span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Terbit</span>
<span class="font-label-lg text-label-lg text-on-surface">14 Artikel</span>
</div>
</div>
<div class="flex items-center gap-2 px-space-md py-2 bg-surface-container-lowest rounded-lg">
<span class="w-2.5 h-2.5 rounded-full bg-tertiary-fixed-dim"></span>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Draft</span>
<span class="font-label-lg text-label-lg text-on-surface">3 Menunggu</span>
</div>
</div>
<div class="flex items-center gap-2 px-space-md py-2 bg-surface-container-lowest rounded-lg">
<span class="material-symbols-outlined text-[18px] text-secondary">trending_up</span>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Bulan Ini</span>
<span class="font-label-lg text-label-lg text-on-surface">12.8k Pembaca</span>
</div>
</div>
</div>
</section>
<!-- Interactive Controls Bar -->
<section class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm mb-space-lg flex flex-col md:flex-row items-center justify-between gap-space-md">
<div class="flex flex-col sm:flex-row items-center gap-space-sm w-full md:w-auto flex-1">
<!-- Search -->
<div class="relative w-full sm:max-w-xs">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
<input class="w-full pl-9 pr-space-md py-2 text-body-sm font-body-sm bg-surface-container-low rounded-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20 placeholder:text-on-surface-variant" placeholder="Cari judul artikel, topik, atau kata kunci..." type="text"/>
</div>
<!-- Filter Status -->
<div class="relative w-full sm:w-auto">
<select class="w-full sm:w-auto appearance-none pl-3 pr-8 py-2 text-label-lg font-label-lg bg-surface-container-low text-on-surface rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/20">
<option>Semua Status</option>
<option>Terbit (Aktif)</option>
<option>Draft (Belum Rilis)</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px] pointer-events-none">expand_more</span>
</div>
<!-- Filter Kategori -->
<div class="relative w-full sm:w-auto">
<select class="w-full sm:w-auto appearance-none pl-3 pr-8 py-2 text-label-lg font-label-lg bg-surface-container-low text-on-surface rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/20">
<option>Semua Kategori</option>
<option>Panduan Pemula</option>
<option>Review Gear</option>
<option>Jalur &amp; Cuaca</option>
<option>Etika Alam</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px] pointer-events-none">expand_more</span>
</div>
</div>
<!-- Action Button -->
<button class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-space-md py-2.5 rounded-lg bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg transition-transform active:scale-95 shadow-sm" id="btnOpenModal" type="button">
<span class="material-symbols-outlined text-[20px]">add</span>
<span>Tulis Artikel Baru</span>
</button>
</section>
<!-- CRUD Table Component -->
<section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-xl">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
<th class="py-space-md px-space-md">Info Artikel</th>
<th class="py-space-md px-space-md">Kategori</th>
<th class="py-space-md px-space-md">Tanggal Update</th>
<th class="py-space-md px-space-md">Status</th>
<th class="py-space-md px-space-md">Total Dilihat</th>
<th class="py-space-md px-space-md text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container font-body-sm text-body-sm text-on-surface">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-space-md px-space-md max-w-md">
<div class="flex items-start gap-space-sm">
<img class="w-20 h-16 rounded-lg object-cover flex-shrink-0 bg-surface-container" data-alt="A mountaineer duo pitching a technical yellow geodesic tent on a rugged, misty Himalayan ridgeline during golden hour, surrounded by rocky terrain and sea of clouds." src="<?= asset('images/tenda-dome.jpg') ?>"/>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm font-semibold text-on-surface leading-snug line-clamp-1">
                    Tips Memilih Tenda Anti Badai untuk Pemula
                  </span>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-0.5">
                    Panduan detail memilih frame aluminium vs fiberglass, hydrostatic head min 3000mm, serta tips pasang guyline saat angin kencang.
                  </p>
</div>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[14px] text-primary">school</span>
                Panduan Pemula
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg">22 Okt 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">14:30 WIB</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Terbit
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap font-label-md text-label-md">
<div class="flex items-center gap-1 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">visibility</span>
<span>4.250 pembaca</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap text-right">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Lihat di Web" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Edit Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container transition-colors" title="Hapus Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-space-md px-space-md max-w-md">
<div class="flex items-start gap-space-sm">
<img class="w-20 h-16 rounded-lg object-cover flex-shrink-0 bg-surface-container" data-alt="A warm campfire night gathering in a pine forest with outdoor campers toasting marshmallows under a sparkling Milky Way star-filled mountain sky." src="<?= asset('images/api-unggun.jpg') ?>"/>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm font-semibold text-on-surface leading-snug line-clamp-1">
                    Checklist Wajib Alat Camping 2 Hari 1 Malam di Musim Hujan
                  </span>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-0.5">
                    Daftar periksa esensial mulai dari drybag, flysheet cadangan, matras foil, kompor windproof, hingga pakaian polar isolasi.
                  </p>
</div>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[14px] text-tertiary">construction</span>
                Review Gear
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg">19 Okt 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">09:15 WIB</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Terbit
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap font-label-md text-label-md">
<div class="flex items-center gap-1 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">visibility</span>
<span>3.120 pembaca</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap text-right">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Lihat di Web" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Edit Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container transition-colors" title="Hapus Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-space-md px-space-md max-w-md">
<div class="flex items-start gap-space-sm">
<img class="w-20 h-16 rounded-lg object-cover flex-shrink-0 bg-surface-container" data-alt="Interior view looking out from inside a cozy camping tent with warm sleeping bag laid on an aluminum foil sleeping pad facing dramatic rugged alpine peaks at sunrise." src="<?= asset('images/sleeping-bag.jpg') ?>"/>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm font-semibold text-on-surface leading-snug line-clamp-1">
                    Etika Leave No Trace: Panduan Bebas Sampah di Gunung Prau &amp; Merbabu
                  </span>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-0.5">
                    Prinsip 7 dasar LNT, teknik membawa turun sampah organik &amp; anorganik, serta larangan membuat api unggun di sembarang tempat.
                  </p>
</div>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[14px] text-secondary">eco</span>
                Etika Alam
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg">15 Okt 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">11:00 WIB</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Terbit
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap font-label-md text-label-md">
<div class="flex items-center gap-1 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">visibility</span>
<span>2.840 pembaca</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap text-right">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Lihat di Web" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Edit Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container transition-colors" title="Hapus Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 4 (Draft) -->
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-space-md px-space-md max-w-md">
<div class="flex items-start gap-space-sm">
<div class="w-20 h-16 rounded-lg bg-surface-container-high flex items-center justify-center flex-shrink-0 text-on-surface-variant">
<span class="material-symbols-outlined text-[24px]">draft</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-headline-sm text-headline-sm font-semibold text-on-surface leading-snug line-clamp-1">
                    Komparasi Gas Canister vs Gas Butane Portabel untuk Dataran Tinggi
                  </span>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-0.5">
                    Analisis titik beku gas butane vs isobutane camp saat suhu drop di bawah 5 derajat Celcius di Surya Kencana.
                  </p>
</div>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-md text-label-md">
<span class="material-symbols-outlined text-[14px] text-tertiary">construction</span>
                Review Gear
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-lg text-label-lg">24 Okt 2024</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">08:00 WIB</span>
</div>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-label-md">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary-fixed-dim"></span>
                Draft
              </span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap font-label-md text-label-md text-on-surface-variant">
              -
            </td>
<td class="py-space-md px-space-md whitespace-nowrap text-right">
<div class="inline-flex items-center gap-1">
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Lihat di Web" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors" title="Edit Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container transition-colors" title="Hapus Artikel" type="button">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination -->
<div class="flex items-center justify-between px-space-md py-3 bg-surface-container-low border-t border-surface-container text-body-sm font-body-sm text-on-surface-variant">
<span>Menampilkan 1-4 dari total 17 entri edukasi</span>
<div class="inline-flex items-center gap-1">
<button class="px-2.5 py-1 rounded bg-surface-container-lowest text-on-surface disabled:opacity-50" disabled="">Sebelumnya</button>
<button class="px-3 py-1 rounded bg-primary text-on-primary font-label-md text-label-md">1</button>
<button class="px-3 py-1 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface">2</button>
<button class="px-2.5 py-1 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface">Selanjutnya</button>
</div>
</div>
</section>
<!-- MODAL: Tulis / Edit Artikel (Structured, Rich, and Highly Styled) -->
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm flex items-center justify-center p-space-md overflow-y-auto" id="articleModal">
<div class="bg-surface-container-lowest rounded-xl shadow-xl w-full max-w-4xl max-h-[921px] flex flex-col overflow-hidden my-auto animate-fadeIn">
<!-- Modal Header -->
<div class="flex items-center justify-between px-space-lg py-4 border-b border-surface-container bg-surface-container-low">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[24px]">edit_note</span>
<div class="flex flex-col">
<h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Editor Artikel Edukasi CampRent</h3>
<span class="font-label-sm text-label-sm text-on-surface-variant">Formulir kurasi materi panduan mendaki dan konservasi</span>
</div>
</div>
<button class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors" id="btnCloseModal" type="button">
<span class="material-symbols-outlined text-[18px]">close</span>
</button>
</div>
<!-- Modal Body (Scrollable form) -->
<div class="p-space-lg overflow-y-auto flex flex-col gap-space-md">
<!-- Main Identifiers -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
<div class="md:col-span-2 flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Judul Artikel <span class="text-error">*</span></label>
<input class="w-full px-space-md py-2 text-body-md font-body-md bg-surface-container-low rounded-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" type="text" value="Tips Memilih Tenda Anti Badai untuk Pemula"/>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Kategori Topik</label>
<select class="w-full px-space-md py-2 text-body-md font-body-md bg-surface-container-low rounded-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer">
<option selected="">Panduan Pemula</option>
<option>Review Gear</option>
<option>Jalur &amp; Cuaca</option>
<option>Etika Alam</option>
</select>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Penulis / Kontributor</label>
<input class="w-full px-space-md py-2 text-body-md font-body-md bg-surface-container-low rounded-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" type="text" value="Bambang Hermawan (Staf Logistik)"/>
</div>
<!-- Cover Media -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Gambar Sampul / Cover</label>
<div class="flex items-center gap-space-sm bg-surface-container-low p-2 rounded-lg">
<img class="w-16 h-10 rounded object-cover flex-shrink-0" data-alt="Technical yellow mountaineering dome tent assembled at high altitude ridge overlooking snow-capped mountain tops with alpine sunset." src="<?= asset('images/tenda-dome.jpg') ?>"/>
<div class="flex flex-col min-w-0 flex-1">
<span class="font-label-md text-label-md text-on-surface truncate">cover_geodesic_ridge.jpg</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">1.4 MB • Rasio 16:9</span>
</div>
<button class="px-3 py-1 bg-surface-container-lowest text-primary font-label-md text-label-md rounded shadow-sm hover:bg-surface-container" type="button">
                Ganti Foto
              </button>
</div>
</div>
</div>
<!-- Ringkasan Singkat -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Ringkasan Singkat (Excerpt)</label>
<textarea class="w-full px-space-md py-2 text-body-sm font-body-sm bg-surface-container-low rounded-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" rows="2">Panduan detail memilih frame aluminium vs fiberglass, hydrostatic head min 3000mm, serta tips pasang guyline saat angin kencang.</textarea>
</div>
<!-- Rich Text WYSIWYG Mockup -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Isi Lengkap Artikel Edukasi</label>
<div class="rounded-lg bg-surface-container-low overflow-hidden">
<!-- Formatting Toolbar -->
<div class="flex flex-wrap items-center gap-1 p-2 bg-surface-container border-b border-surface-container-high text-on-surface-variant">
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">format_bold</span></button>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">format_italic</span></button>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">format_underlined</span></button>
<span class="w-[1px] h-4 bg-outline-variant mx-1"></span>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">format_list_bulleted</span></button>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">format_list_numbered</span></button>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">format_quote</span></button>
<span class="w-[1px] h-4 bg-outline-variant mx-1"></span>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">link</span></button>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">image</span></button>
<button class="p-1 hover:text-on-surface rounded hover:bg-surface-container-lowest" type="button"><span class="material-symbols-outlined text-[18px]">table_chart</span></button>
</div>
<!-- Content Area -->
<div class="p-space-md flex flex-col gap-space-sm font-body-md text-body-md text-on-surface leading-relaxed max-h-56 overflow-y-auto">
<p>
                Kondisi cuaca gunung di Indonesia seringkali sulit diprediksi, terutama saat memasuki masa pancaroba. Terpaan angin kencang di punggungan terbuka seperti Plawangan Sembalun atau Surya Kencana menuntut tenda dengan integritas struktural yang andal agar tidak patah atau roboh.
              </p>
<p>
                Faktor pertama yang wajib diperhatikan adalah material tiang (frame poles). Hindari material fiberglass standar jika berencana bermalam di atas ketinggian 2.500 mdpl. Pilihlah frame berbahan duralumin alloy 7001-T6 yang memiliki elastisitas tinggi dan mampu menyerap hentakan angin tanpa bengkok permanen.
              </p>
<p>
                Kedua, perhatikan indeks ketahanan air (hydrostatic head rating) pada flysheet dan alas tenda (bathtub floor). Minimal carilah angka 3.000mm untuk kain pelindung luar berbahan ripstop nylon atau polyester berlapis silikon/PU, serta pastikan setiap sambungan jahitan telah memiliki seam-tape utuh tanpa gelembung udara.
              </p>
<p>
                Terakhir, kuasai teknik pasang pasak dengan sudut 45 derajat berlawanan arah tarikan tali guyline. Gunakan bebatuan kokoh sebagai pemberat tambahan jika tekstur tanah gembur atau berpasir, dan selalu hadapkan bagian vestibule membelakangi arah angin dominan.
              </p>
</div>
</div>
</div>
<!-- Publishing Checkboxes -->
<div class="flex flex-col sm:flex-row gap-space-md pt-2 border-t border-surface-container">
<label class="flex items-center gap-2 cursor-pointer">
<input checked="" class="w-4 h-4 rounded text-primary focus:ring-primary accent-primary" type="checkbox"/>
<span class="font-label-lg text-label-lg text-on-surface">Terbitkan langsung ke beranda publik</span>
</label>
<label class="flex items-center gap-2 cursor-pointer">
<input checked="" class="w-4 h-4 rounded text-primary focus:ring-primary accent-primary" type="checkbox"/>
<span class="font-label-lg text-label-lg text-on-surface">Sematkan ke Rekomendasi Unggulan (Pinned Article)</span>
</label>
</div>
</div>
<!-- Modal Footer -->
<div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-space-sm px-space-lg py-4 border-t border-surface-container bg-surface-container-low">
<button class="w-full sm:w-auto px-space-md py-2 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors" id="btnCancelModal" type="button">
          Batal
        </button>
<div class="flex items-center gap-space-sm w-full sm:w-auto">
<button class="flex-1 sm:flex-initial px-space-md py-2 rounded-lg font-label-lg text-label-lg text-primary border border-primary/30 hover:bg-surface-container transition-colors" type="button">
            Simpan sebagai Draft
          </button>
<button class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-space-lg py-2 rounded-lg bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg shadow-sm transition-transform active:scale-95" type="button">
<span class="material-symbols-outlined text-[18px]">check_circle</span>
<span>Terbitkan Sekarang</span>
</button>
</div>
</div>
</div>
</div>
<!-- Inline Script for Interactive Modal Toggle -->
<script>
    (function() {
      const modal = document.getElementById('articleModal');
      const openBtn = document.getElementById('btnOpenModal');
      const closeBtn = document.getElementById('btnCloseModal');
      const cancelBtn = document.getElementById('btnCancelModal');

      function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      }

      function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }

      if (openBtn) openBtn.addEventListener('click', openModal);
      if (closeBtn) closeBtn.addEventListener('click', closeModal);
      if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

      // Close modal on backdrop click
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeModal();
        }
      });
    })();
  </script>
</div></div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
