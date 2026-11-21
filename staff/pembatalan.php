<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_role(['staff', 'admin']);
$pageTitle = "Pembatalan";
$bodyClass = "bg-surface font-body-md text-on-surface antialiased";
$activeMenu = 'pembatalan';
require __DIR__ . '/../includes/layout_staff_top.php';
?>
<main class="relative pt-16 min-h-screen bg-surface w-full px-space-xl py-space-xl"><div class="flex flex-col w-full">
<!-- Top Ambient Banner & Atmosphere -->
<div class="relative w-full rounded-2xl overflow-hidden bg-primary mb-space-lg shadow-sm">
<div class="absolute inset-0 bg-cover bg-center opacity-25 mix-blend-luminosity" data-alt="Panoramic majestic view of Indonesian volcanic peaks rising above a soft sea of sunset clouds, an orange expedition tent perched on a rugged mountain ridge, warm golden dusk glow, ambient wilderness atmosphere matching deep forest greens and earth tones" style="background-image: url('<?= asset('images/tenda-dome.jpg') ?>')"></div>
<div class="relative z-10 p-space-lg md:p-space-xl flex flex-col md:flex-row md:items-center justify-between gap-space-md text-surface">
<div class="max-w-2xl">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-fixed/20 text-secondary-fixed font-label-sm text-label-sm uppercase tracking-wider mb-space-sm backdrop-blur-sm">
<span class="material-symbols-outlined text-[16px]">policy</span>
          Prosedur Standard Operasional H-1 &amp; Force Majeure
        </div>
<h1 class="font-headline-lg text-headline-lg font-headline-lg text-surface tracking-tight mb-space-xs">
          Pusat Permohonan &amp; Keputusan Pembatalan Sewa
        </h1>
<p class="font-body-md text-body-md text-secondary-fixed-dim leading-relaxed">
          Evaluasi klaim pembatalan sesuai ketentuan resmi: pembatalan <strong class="text-surface font-semibold">≥ H-1</strong> berhak atas pengembalian dana 100% ditambah deposit utuh. Pembatalan <strong class="text-surface font-semibold">hari H</strong> dikenakan penalti penahanan deposit, kecuali disertai surat edaran resmi cuaca ekstrem atau darurat medis.
        </p>
</div>
<!-- Quick Operational Metrics -->
<div class="flex items-center gap-space-md bg-[#1f3d2b]/80 backdrop-blur-md p-space-md rounded-xl border border-secondary/30 shrink-0">
<div class="w-12 h-12 rounded-xl bg-tertiary-container flex items-center justify-center text-on-tertiary-container shadow-sm">
<span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed-dim">Perlu Ditinjau</span>
<div class="flex items-baseline gap-1.5">
<span class="font-headline-md text-headline-md text-tertiary-fixed font-bold">2 Permohonan</span>
<span class="w-2 h-2 rounded-full bg-tertiary-fixed-dim animate-ping"></span>
</div>
<span class="font-label-sm text-label-sm text-surface-container-high/80">SLA respon &lt; 30 menit</span>
</div>
</div>
</div>
</div>
<!-- Section 1: Active Pending Requests -->
<div class="flex flex-col gap-space-md mb-space-xl">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<h2 class="font-headline-sm text-headline-sm text-on-surface tracking-tight">Menunggu Keputusan Staf</h2>
<span class="px-2.5 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-bold flex items-center gap-1 shadow-sm">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span>
          2 Antrean Prioritas
        </span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">sync</span>
        Sinkronisasi otomatis aktif
      </span>
</div>
<!-- Active Cards Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg">
<!-- CARD 1: CR-1110 (Target Penanganan Penuh) -->
<div class="flex flex-col bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden transition-all duration-300 hover:shadow-md" id="card-cr-1110">
<!-- Top bar meta -->
<div class="px-space-lg py-space-md bg-surface-container-low flex items-center justify-between border-b border-outline-variant/20">
<div class="flex items-center gap-space-sm">
<span class="font-headline-sm text-headline-sm text-primary font-bold tracking-tight">CR-1110</span>
<span class="px-2.5 py-0.5 rounded-full bg-tertiary-container/20 text-tertiary-container font-label-md text-label-md font-semibold border border-tertiary-container/30 flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary-container"></span>
              Menunggu Keputusan
            </span>
</div>
<div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span>Diajukan 2 jam yang lalu</span>
</div>
</div>
<div class="p-space-lg flex flex-col gap-space-md flex-1">
<!-- Penyewa & Info Sewa Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md p-space-md rounded-lg bg-surface-container/50 border border-outline-variant/20">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Penyewa Terdaftar</span>
<span class="font-label-lg text-label-lg text-on-surface font-bold mt-0.5">Ahmad Fauzi</span>
<a class="font-body-sm text-body-sm text-primary hover:underline flex items-center gap-1 mt-0.5" href="tel:081298765432">
<span class="material-symbols-outlined text-[15px]">call</span>
                0812-9876-5432
              </a>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Jadwal &amp; Biaya Sewa</span>
<span class="font-label-lg text-label-lg text-on-surface mt-0.5">20 - 22 Des 2025 (2 Malam)</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Total: <strong class="text-on-surface font-semibold">Rp230.000</strong> (Sewa Rp180k + Dep. Rp50k)</span>
</div>
<div class="sm:col-span-2 pt-space-xs border-t border-outline-variant/30 flex flex-wrap items-center gap-2">
<span class="font-label-sm text-label-sm text-on-surface-variant">Alat yang Dipesan:</span>
<span class="px-2 py-0.5 rounded-md bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1">
<span class="material-symbols-outlined text-[14px] text-primary">camping</span> 1x Tenda Kap-4 Pro
              </span>
<span class="px-2 py-0.5 rounded-md bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1">
<span class="material-symbols-outlined text-[14px] text-primary">backpack</span> 1x Carrier 45L
              </span>
</div>
</div>
<!-- Alasan Pembatalan & Dokumen -->
<div class="flex flex-col gap-space-xs">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Keterangan Alasan Pelanggan:</span>
<div class="p-space-md rounded-lg bg-surface-container-low border-l-4 border-tertiary-container flex flex-col gap-space-sm">
<p class="font-body-md text-body-md text-on-surface italic leading-relaxed">
                “Jalur pendakian Basecamp Patakbanteng ditutup sementara karena cuaca badai ekstrem dari peringatan BMKG.”
              </p>
<div class="flex items-center justify-between pt-space-xs border-t border-outline-variant/30">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-error text-[20px]">picture_as_pdf</span>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface font-semibold">Surat_Edaran_TNGR.pdf</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">1.4 MB • Disahkan Basecamp</span>
</div>
</div>
<button class="inline-flex items-center gap-1 px-3 py-1 rounded-md bg-surface-container-highest hover:bg-surface-variant text-on-surface font-label-sm text-label-sm transition-colors" type="button">
<span class="material-symbols-outlined text-[16px]">visibility</span>
                  Pratinjau File
                </button>
</div>
</div>
</div>
<!-- Panel Keputusan Staf -->
<form class="mt-auto pt-space-md border-t border-outline-variant/30 flex flex-col gap-space-sm" id="form-cr-1110" onsubmit="event.preventDefault(); handleAction('CR-1110', 'approve');">
<span class="font-label-md text-label-md text-primary font-bold flex items-center gap-1.5 uppercase tracking-wide">
<span class="material-symbols-outlined text-[18px]">gavel</span>
              Panel Keputusan &amp; Penyesuaian Dana
            </span>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
<div class="flex flex-col">
<label class="font-label-sm text-label-sm text-on-surface-variant mb-1">Nominal Refund Disetujui (Rp)</label>
<div class="relative">
<span class="absolute left-3 top-2.5 font-label-md text-label-md text-on-surface-variant">Rp</span>
<input class="w-full pl-9 pr-3 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-label-lg text-label-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary font-semibold" type="text" value="230.000"/>
</div>
<span class="font-label-sm text-label-sm text-primary mt-1 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">verified</span> 100% Full Refund (Force Majeure H-2)
                </span>
</div>
<div class="flex flex-col">
<label class="font-label-sm text-label-sm text-on-surface-variant mb-1">Rekening Pencairan Nasabah</label>
<div class="px-3 py-2 bg-surface-container-low rounded-lg border border-outline-variant/30 flex items-center justify-between">
<div class="flex flex-col truncate">
<span class="font-label-md text-label-md font-bold text-on-surface truncate">BCA 8820-192-331</span>
<span class="font-label-sm text-label-sm text-on-surface-variant truncate">a.n. Ahmad Fauzi</span>
</div>
<span class="material-symbols-outlined text-secondary text-[20px] shrink-0">account_balance</span>
</div>
</div>
</div>
<div class="flex flex-col">
<label class="font-label-sm text-label-sm text-on-surface-variant mb-1">Catatan Keputusan Resmi (Tercetak di Invoice Kredit)</label>
<textarea class="w-full p-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" rows="2">Permohonan disetujui. Lampiran surat edaran cuaca buruk valid. Dana dikembalikan utuh via transfer rekening.</textarea>
</div>
<!-- Action buttons -->
<div class="flex items-center gap-space-sm pt-space-xs">
<button class="flex-1 inline-flex items-center justify-center gap-2 px-space-md py-2.5 rounded-lg bg-primary hover:bg-[#1f3d2b] active:scale-[0.99] text-on-primary font-label-lg text-label-lg shadow-sm transition-all" type="submit">
<span class="material-symbols-outlined text-[18px]">check_circle</span>
                Setujui &amp; Proses Refund
              </button>
<button class="inline-flex items-center justify-center gap-1.5 px-space-md py-2.5 rounded-lg bg-transparent hover:bg-error/10 text-error border border-error/40 font-label-lg text-label-lg transition-colors" onclick="handleAction('CR-1110', 'reject')" type="button">
<span class="material-symbols-outlined text-[18px]">cancel</span>
                Tolak
              </button>
</div>
</form>
</div>
</div>
<!-- CARD 2: CR-1114 (Kasus Potensi Penalti / Hari H) -->
<div class="flex flex-col bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden transition-all duration-300 hover:shadow-md" id="card-cr-1114">
<!-- Top bar meta -->
<div class="px-space-lg py-space-md bg-surface-container-low flex items-center justify-between border-b border-outline-variant/20">
<div class="flex items-center gap-space-sm">
<span class="font-headline-sm text-headline-sm text-primary font-bold tracking-tight">CR-1114</span>
<span class="px-2.5 py-0.5 rounded-full bg-tertiary-container/20 text-tertiary-container font-label-md text-label-md font-semibold border border-tertiary-container/30 flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary-container"></span>
              Menunggu Keputusan
            </span>
</div>
<div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[16px] text-tertiary">history_toggle_off</span>
<span>Diajukan 35 menit yang lalu</span>
</div>
</div>
<div class="p-space-lg flex flex-col gap-space-md flex-1">
<!-- Warning Hari H Alert -->
<div class="flex items-start gap-space-sm p-3 rounded-lg bg-error-container/40 border border-error/20 text-on-error-container">
<span class="material-symbols-outlined text-error text-[20px] shrink-0 mt-0.5">warning</span>
<div class="flex flex-col font-body-sm text-body-sm leading-tight">
<strong class="font-label-md text-label-md text-error font-semibold">Pelanggaran Batas Waktu Pembatalan</strong>
<span>Diajukan kurang dari 12 jam sebelum waktu serah-terima sewa (Hari H). Sesuai S&amp;K, deposit jaminan sebesar Rp50.000 berhak dipotong / hangus.</span>
</div>
</div>
<!-- Penyewa & Info Sewa Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md p-space-md rounded-lg bg-surface-container/50 border border-outline-variant/20">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Penyewa Terdaftar</span>
<span class="font-label-lg text-label-lg text-on-surface font-bold mt-0.5">Rian Hidayat</span>
<a class="font-body-sm text-body-sm text-primary hover:underline flex items-center gap-1 mt-0.5" href="tel:082155431109">
<span class="material-symbols-outlined text-[15px]">call</span>
                0821-5543-1109
              </a>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Jadwal &amp; Biaya Sewa</span>
<span class="font-label-lg text-label-lg text-on-surface mt-0.5">Hari Ini, 24 Okt 2024 (1 Malam)</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Total: <strong class="text-on-surface font-semibold">Rp115.000</strong> (Sewa Rp65k + Dep. Rp50k)</span>
</div>
<div class="sm:col-span-2 pt-space-xs border-t border-outline-variant/30 flex flex-wrap items-center gap-2">
<span class="font-label-sm text-label-sm text-on-surface-variant">Alat yang Dipesan:</span>
<span class="px-2 py-0.5 rounded-md bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1">
<span class="material-symbols-outlined text-[14px] text-primary">outdoor_grill</span> 1x Kompor Ultralight Windproof
              </span>
<span class="px-2 py-0.5 rounded-md bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1">
<span class="material-symbols-outlined text-[14px] text-primary">skillet</span> 1x Nesting DS-308
              </span>
</div>
</div>
<!-- Alasan Pembatalan -->
<div class="flex flex-col gap-space-xs">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Keterangan Alasan Pelanggan:</span>
<div class="p-space-md rounded-lg bg-surface-container-low border-l-4 border-error/50 flex flex-col gap-space-sm">
<p class="font-body-md text-body-md text-on-surface italic leading-relaxed">
                “Mendadak ada urusan keluarga di luar kota, jadi tidak jadi berangkat kemping sore ini. Mohon bantu dibatalkan.”
              </p>
<div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm pt-space-xs border-t border-outline-variant/30">
<span class="material-symbols-outlined text-[16px]">info</span>
<span>Tanpa lampiran dokumen resmi / force majeure.</span>
</div>
</div>
</div>
<!-- Panel Keputusan Staf -->
<form class="mt-auto pt-space-md border-t border-outline-variant/30 flex flex-col gap-space-sm" id="form-cr-1114" onsubmit="event.preventDefault(); handleAction('CR-1114', 'approve');">
<span class="font-label-md text-label-md text-primary font-bold flex items-center gap-1.5 uppercase tracking-wide">
<span class="material-symbols-outlined text-[18px]">gavel</span>
              Panel Keputusan &amp; Penalti Deposit
            </span>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
<div class="flex flex-col">
<label class="font-label-sm text-label-sm text-on-surface-variant mb-1">Nominal Pengembalian / Refund</label>
<div class="relative">
<span class="absolute left-3 top-2.5 font-label-md text-label-md text-on-surface-variant">Rp</span>
<input class="w-full pl-9 pr-3 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-label-lg text-label-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary font-semibold" id="cr-1114-refund-input" type="text" value="65.000"/>
</div>
<div class="flex items-center gap-2 mt-1">
<label class="flex items-center gap-1.5 cursor-pointer font-label-sm text-label-sm text-on-surface">
<input checked="" class="accent-primary rounded" onchange="togglePenalty(this)" type="checkbox"/>
<span>Terapkan potong deposit Rp50.000</span>
</label>
</div>
</div>
<div class="flex flex-col">
<label class="font-label-sm text-label-sm text-on-surface-variant mb-1">Rekening Pencairan Nasabah</label>
<div class="px-3 py-2 bg-surface-container-low rounded-lg border border-outline-variant/30 flex items-center justify-between">
<div class="flex flex-col truncate">
<span class="font-label-md text-label-md font-bold text-on-surface truncate">Mandiri 1370-0099-2311</span>
<span class="font-label-sm text-label-sm text-on-surface-variant truncate">a.n. Rian Hidayat</span>
</div>
<span class="material-symbols-outlined text-secondary text-[20px] shrink-0">account_balance</span>
</div>
</div>
</div>
<div class="flex flex-col">
<label class="font-label-sm text-label-sm text-on-surface-variant mb-1">Catatan Keputusan Resmi</label>
<textarea class="w-full p-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" rows="2">Pembatalan hari H disetujui bersyarat. Biaya sewa Rp65.000 dikembalikan; deposit Rp50.000 ditahan sebagai penalti batas waktu.</textarea>
</div>
<!-- Action buttons -->
<div class="flex items-center gap-space-sm pt-space-xs">
<button class="flex-1 inline-flex items-center justify-center gap-2 px-space-md py-2.5 rounded-lg bg-primary hover:bg-[#1f3d2b] active:scale-[0.99] text-on-primary font-label-lg text-label-lg shadow-sm transition-all" type="submit">
<span class="material-symbols-outlined text-[18px]">done_all</span>
                Setujui Parsial &amp; Cairkan
              </button>
<button class="inline-flex items-center justify-center gap-1.5 px-space-md py-2.5 rounded-lg bg-transparent hover:bg-error/10 text-error border border-error/40 font-label-lg text-label-lg transition-colors" onclick="handleAction('CR-1114', 'reject')" type="button">
<span class="material-symbols-outlined text-[18px]">cancel</span>
                Tolak Total
              </button>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Notification Toast Simulation -->
<div class="fixed bottom-6 right-6 hidden bg-inverse-surface text-inverse-on-surface px-space-md py-space-sm rounded-xl shadow-xl z-50 flex items-center gap-3 transition-opacity" id="toast-action">
<span class="material-symbols-outlined text-primary-fixed" id="toast-icon">check_circle</span>
<span class="font-label-md text-label-md" id="toast-msg">Tindakan berhasil disimpan.</span>
</div>
<!-- Section 2: Audit Trail / Historical Table -->
<div class="flex flex-col bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden mb-space-lg">
<!-- Header Tabel -->
<div class="p-space-lg bg-surface-container-low flex flex-col md:flex-row md:items-center justify-between gap-space-md border-b border-outline-variant/20">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight">Riwayat Keputusan Pembatalan</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Audit log resmi keputusan refund, penahanan deposit, dan pembatalan sewa CampRent Nusantara.</p>
</div>
<!-- Quick filters -->
<div class="flex items-center gap-2">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-on-surface-variant">search</span>
<input class="pl-9 pr-3 py-1.5 bg-surface-container-lowest rounded-lg border border-outline-variant/40 font-label-sm text-label-sm text-on-surface focus:outline-none focus:border-primary w-48 lg:w-64" placeholder="Cari kode/penyewa..." type="text"/>
</div>
<button class="inline-flex items-center gap-1 px-3 py-1.5 bg-surface-container-high rounded-lg font-label-sm text-label-sm text-on-surface hover:bg-surface-variant transition-colors" type="button">
<span class="material-symbols-outlined text-[16px]">filter_list</span>
<span>Semua Status</span>
</button>
<button class="inline-flex items-center gap-1 px-3 py-1.5 bg-surface-container-high rounded-lg font-label-sm text-label-sm text-on-surface hover:bg-surface-variant transition-colors" type="button">
<span class="material-symbols-outlined text-[16px]">download</span>
<span>Ekspor CSV</span>
</button>
</div>
</div>
<!-- Responsive Table -->
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="border-b border-outline-variant/30 bg-surface-container-high/40">
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Kode Booking</th>
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Nama Penyewa</th>
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Alasan Pembatalan</th>
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Status Keputusan</th>
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Catatan Staf Logistik</th>
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Nominal Refund</th>
<th class="py-space-sm px-space-md font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Petugas &amp; Waktu</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/20 font-body-sm text-body-sm">
<!-- Row 1: Hendra Wijaya -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-space-md px-space-md font-label-md text-label-md font-bold text-primary">CR-1088</td>
<td class="py-space-md px-space-md font-label-md text-label-md text-on-surface">
<div class="flex flex-col">
<span class="font-bold">Hendra Wijaya</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">0813-2210-9944</span>
</div>
</td>
<td class="py-space-md px-space-md text-on-surface-variant max-w-xs">
<span class="line-clamp-2">Penutupan resmi jalur pendakian Gunung Merbabu akibat perbaikan jembatan shelter.</span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold border border-secondary-fixed-dim">
<span class="material-symbols-outlined text-[14px]">check</span>
                Disetujui
              </span>
</td>
<td class="py-space-md px-space-md text-on-surface max-w-xs">
<div class="flex flex-col">
<span class="text-secondary font-medium">Refund sukses via BCA</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Sewa Rp120rb + Deposit Rp50rb</span>
</div>
</td>
<td class="py-space-md px-space-md font-label-md text-label-md font-bold text-primary whitespace-nowrap">
              Rp170.000
            </td>
<td class="py-space-md px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface font-semibold">Staff Budi S.</span>
<span class="font-label-sm text-label-sm text-outline">18 Des 2025 • 14:10 WIB</span>
</div>
</td>
</tr>
<!-- Row 2: Rizky Pratama (Ditolak / Denda) -->
<tr class="hover:bg-surface-container-low/60 transition-colors bg-surface-container-low/30">
<td class="py-space-md px-space-md font-label-md text-label-md font-bold text-primary">CR-1045</td>
<td class="py-space-md px-space-md font-label-md text-label-md text-on-surface">
<div class="flex flex-col">
<span class="font-bold">Rizky Pratama</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">0856-7890-1234</span>
</div>
</td>
<td class="py-space-md px-space-md text-on-surface-variant max-w-xs">
<span class="line-clamp-2">Pembatalan sepihak hari H tanpa surat keterangan medis / kedaruratan alam.</span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold border border-error/30">
<span class="material-symbols-outlined text-[14px]">block</span>
                Ditolak / Denda Hangus
              </span>
</td>
<td class="py-space-md px-space-md text-on-surface max-w-xs">
<span class="text-error font-medium line-clamp-2">Melewati batas toleransi pembatalan H-1. Deposit Rp50.000 hangus sesuai klausul S&amp;K No. 4.</span>
</td>
<td class="py-space-md px-space-md font-label-md text-label-md font-bold text-outline whitespace-nowrap">
<div class="flex flex-col">
<span>Rp0</span>
<span class="font-label-sm text-label-sm text-error font-normal">(Deposit Ditahan)</span>
</div>
</td>
<td class="py-space-md px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface font-semibold">Staff Budi S.</span>
<span class="font-label-sm text-label-sm text-outline">14 Des 2025 • 08:30 WIB</span>
</div>
</td>
</tr>
<!-- Row 3: Maya Anggraini -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-space-md px-space-md font-label-md text-label-md font-bold text-primary">CR-1032</td>
<td class="py-space-md px-space-md font-label-md text-label-md text-on-surface">
<div class="flex flex-col">
<span class="font-bold">Maya Anggraini</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">0819-3321-7788</span>
</div>
</td>
<td class="py-space-md px-space-md text-on-surface-variant max-w-xs">
<span class="line-clamp-2">Sakit demam tinggi mendadak (melampirkan surat rawat inap klinik dr. Soetomo).</span>
</td>
<td class="py-space-md px-space-md whitespace-nowrap">
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold border border-secondary-fixed-dim">
<span class="material-symbols-outlined text-[14px]">check</span>
                Disetujui
              </span>
</td>
<td class="py-space-md px-space-md text-on-surface max-w-xs">
<span class="text-secondary font-medium line-clamp-2">Disetujui pembebasan biaya pembatalan darurat medis. Dana dikirim via Mandiri.</span>
</td>
<td class="py-space-md px-space-md font-label-md text-label-md font-bold text-primary whitespace-nowrap">
              Rp210.000
            </td>
<td class="py-space-md px-space-md text-on-surface-variant whitespace-nowrap">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface font-semibold">Staff Andi R.</span>
<span class="font-label-sm text-label-sm text-outline">10 Des 2025 • 16:45 WIB</span>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Pagination Footer -->
<div class="px-space-lg py-space-sm bg-surface-container-low flex items-center justify-between border-t border-outline-variant/20 font-label-sm text-label-sm text-on-surface-variant">
<span>Menampilkan 3 dari 48 keputusan pembatalan bulan ini</span>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-md bg-surface-container flex items-center justify-center hover:bg-surface-variant text-on-surface transition-colors disabled:opacity-40" disabled="" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<span class="px-3 py-1 rounded-md bg-primary text-on-primary font-bold">1</span>
<button class="w-8 h-8 rounded-md bg-surface-container flex items-center justify-center hover:bg-surface-variant text-on-surface transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Micro-interactions logic -->
<script>
    function togglePenalty(checkbox) {
      const input = document.getElementById('cr-1114-refund-input');
      if (checkbox.checked) {
        input.value = '65.000';
      } else {
        input.value = '115.000';
      }
    }

    function handleAction(bookingCode, type) {
      const card = document.getElementById('card-' + bookingCode.toLowerCase());
      const toast = document.getElementById('toast-action');
      const toastMsg = document.getElementById('toast-msg');
      const toastIcon = document.getElementById('toast-icon');

      if (type === 'approve') {
        toastMsg.textContent = 'Keputusan permohonan ' + bookingCode + ' BERHASIL DISETUJUI & dana masuk antrean transfer!';
        toastIcon.textContent = 'check_circle';
        toastIcon.className = 'material-symbols-outlined text-secondary-fixed';
      } else {
        toastMsg.textContent = 'Permohonan ' + bookingCode + ' DITOLAK. Notifikasi S&K dikirim ke penyewa.';
        toastIcon.textContent = 'cancel';
        toastIcon.className = 'material-symbols-outlined text-error-container';
      }

      // Animasi kartu keluar
      if (card) {
        card.classList.add('opacity-40', 'pointer-events-none', 'scale-[0.98]');
      }

      // Show toast
      toast.classList.remove('hidden');
      setTimeout(() => {
        toast.classList.add('hidden');
      }, 4000);
    }
  </script>
</div></main>
<?php require __DIR__ . '/../includes/layout_staff_bottom.php'; ?>
