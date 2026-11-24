<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_login();
$pageTitle = "Profil Saya";
$bodyClass = "bg-surface text-on-surface font-body-md min-h-screen flex flex-col antialiased selection:bg-secondary-container";
$activeNav = 'profil';
require __DIR__ . '/../includes/layout_user_top.php';
?>
<header class="fixed top-0 w-full z-50 pt-safe bg-surface/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="h-16 px-margin flex items-center justify-between gap-space-sm"><div class="flex items-center gap-2"><img alt="CampRent Brand Logo" class="h-8 w-auto object-contain" src="<?= asset('images/logo.svg') ?>"/><span class="font-headline-sm text-headline-sm text-primary tracking-tight font-bold">CampRent</span></div><div class="flex items-center gap-space-xs"><a aria-label="Keranjang Penyewaan" class="relative w-11 h-11 flex items-center justify-center rounded-full text-on-surface hover:bg-surface-container active:scale-95 transition-all" data-path="keranjang-booking" href="#"><span class="material-symbols-outlined text-[24px]">shopping_bag</span><span class="absolute top-2 right-1.5 min-w-[18px] h-[18px] px-1 bg-tertiary-fixed-dim text-on-tertiary-fixed font-label-sm text-label-sm rounded-full flex items-center justify-center font-bold">2</span></a><a aria-label="Profil Saya" class="w-9 h-9 rounded-full bg-primary flex items-center justify-center shadow-sm ml-1 text-on-primary hover:opacity-90 active:scale-95 transition-all" data-path="profil-saya" href="#"><span class="material-symbols-outlined text-[20px]">person</span></a></div></div></header>
<main class="flex-1 w-full pt-16 pb-24 px-margin bg-surface"><div class="flex flex-col w-full pb-10 space-y-space-lg">
<!-- Profile Header Card -->
<section class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm relative overflow-hidden">
<!-- Subtle organic top accent banner -->
<div class="absolute top-0 left-0 right-0 h-20 bg-gradient-to-r from-secondary-container via-surface-container to-tertiary-fixed/30 -z-0"></div>
<div class="relative z-10 pt-4 flex flex-col items-center text-center">
<!-- Avatar with Explorer Badge -->
<div class="relative mb-3">
<div class="w-20 h-20 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-display text-2xl font-bold shadow-md ring-4 ring-surface-container-lowest">
          AF
        </div>
<div class="absolute bottom-0 right-0 bg-primary text-on-primary w-6 h-6 rounded-full flex items-center justify-center shadow-sm" title="Terverifikasi">
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
</div>
<!-- Identity & Tenure -->
<h1 class="font-headline-md text-headline-md text-on-surface">Ahmad Fauzi</h1>
<div class="flex items-center gap-1.5 mt-1">
<span class="inline-flex items-center px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-sm text-label-sm">
          Penyewa Terverifikasi
        </span>
<span class="text-outline text-xs">•</span>
<span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-0.5">
<span class="material-symbols-outlined text-[14px]">calendar_today</span>
          Member sejak Nov 2024
        </span>
</div>
<!-- 3 Quick Summary Metric Cards -->
<div class="grid grid-cols-3 gap-2 w-full mt-5 pt-4 bg-surface-container-low rounded-xl p-2.5">
<div class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-lowest text-center shadow-xs">
<span class="font-headline-sm text-headline-sm text-primary">6</span>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">Total Sewa</span>
</div>
<div class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-lowest text-center shadow-xs">
<div class="flex items-center gap-0.5">
<span class="font-headline-sm text-headline-sm text-secondary">0</span>
<span class="material-symbols-outlined text-[14px] text-secondary">check_circle</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">Keterlambatan</span>
</div>
<div class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-lowest text-center shadow-xs">
<span class="font-headline-sm text-headline-sm text-tertiary">50rb</span>
<span class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">Deposit Aktif</span>
</div>
</div>
</div>
</section>
<!-- Card 1: Data Pribadi -->
<section class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm">
<div class="flex items-center gap-2 mb-4">
<div class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
<span class="material-symbols-outlined text-[18px]">badge</span>
</div>
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface">Data Pribadi</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Informasi identitas resmi penyewaan logistik luar ruang.</p>
</div>
</div>
<form class="space-y-3.5" onsubmit="event.preventDefault(); showToast('Perubahan data berhasil disimpan!');">
<!-- Nama Lengkap -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="nama_lengkap">Nama Lengkap</label>
<div class="relative">
<input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all" id="nama_lengkap" name="nama_lengkap" required="" type="text" value="Ahmad Fauzi"/>
<span class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-outline">edit</span>
</div>
</div>
<!-- Email (Disabled / Readonly) -->
<div>
<div class="flex items-center justify-between mb-1">
<label class="font-label-md text-label-md text-on-surface" for="email_val">Email Terdaftar</label>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary">
<span class="material-symbols-outlined text-[13px]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
            Terverifikasi
          </span>
</div>
<div class="relative">
<input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-variant text-on-surface-variant font-body-md text-body-md cursor-not-allowed opacity-90 pl-9" disabled="" id="email_val" type="email" value="ahmad.fauzi@gmail.com"/>
<span class="material-symbols-outlined absolute left-3 top-3 text-[18px] text-outline">lock</span>
</div>
</div>
<!-- Nomor WhatsApp -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="no_wa">Nomor WhatsApp</label>
<div class="relative">
<input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all" id="no_wa" required="" type="tel" value="0812-9876-5432"/>
<span class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-outline">chat</span>
</div>
</div>
<!-- Alamat Lengkap -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="alamat_lengkap">Alamat Domisili Pengiriman</label>
<textarea class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all resize-none" id="alamat_lengkap" rows="2">Jl. Melati No. 14, RT 03/RW 05, Cilandak, Jakarta Selatan</textarea>
</div>
<!-- Kontak Darurat -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="kontak_darurat">Kontak Darurat (Keluarga)</label>
<div class="relative">
<input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all" id="kontak_darurat" required="" type="text" value="Rina Fauzi - 0813-1122-3344"/>
<span class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-outline">emergency</span>
</div>
</div>
<div class="pt-2">
<button class="w-full h-12 bg-primary-container hover:bg-primary active:scale-[0.99] text-on-primary font-label-lg text-label-lg rounded-xl flex items-center justify-center gap-2 shadow-sm transition-all" type="submit">
<span class="material-symbols-outlined text-[18px]">save</span>
          Simpan Perubahan Data
        </button>
</div>
</form>
</section>
<!-- Card 2: Ganti Kata Sandi -->
<section class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm">
<div class="flex items-center gap-2 mb-4">
<div class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
<span class="material-symbols-outlined text-[18px]">key</span>
</div>
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface">Ganti Kata Sandi</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Jaga keamanan akun untuk melindungi data deposit dan sewa.</p>
</div>
</div>
<form class="space-y-3.5" onsubmit="event.preventDefault(); showToast('Kata sandi berhasil diperbarui!'); this.reset(); resetPwdStrength();">
<!-- Kata Sandi Lama -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="pwd_lama">Kata Sandi Lama</label>
<div class="relative">
<input class="w-full px-3.5 py-2.5 pr-10 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all" id="pwd_lama" placeholder="Masukkan kata sandi saat ini" required="" type="password"/>
<button class="absolute right-3 top-2.5 text-outline hover:text-on-surface" onclick="togglePasswordVisibility('pwd_lama', this)" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
</div>
<!-- Kata Sandi Baru -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="pwd_baru">Kata Sandi Baru</label>
<div class="relative">
<input class="w-full px-3.5 py-2.5 pr-10 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all" id="pwd_baru" oninput="checkPasswordStrength(this.value)" placeholder="Minimal 8 karakter kombinasi" required="" type="password"/>
<button class="absolute right-3 top-2.5 text-outline hover:text-on-surface" onclick="togglePasswordVisibility('pwd_baru', this)" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
<!-- Password Strength Meter -->
<div class="mt-2 space-y-1">
<div class="flex h-1.5 w-full bg-surface-container rounded-full overflow-hidden gap-1">
<div class="h-full w-1/3 bg-outline-variant transition-colors duration-300" id="pwd_bar_1"></div>
<div class="h-full w-1/3 bg-outline-variant transition-colors duration-300" id="pwd_bar_2"></div>
<div class="h-full w-1/3 bg-outline-variant transition-colors duration-300" id="pwd_bar_3"></div>
</div>
<div class="flex justify-between items-center">
<span class="font-label-sm text-label-sm text-on-surface-variant" id="pwd_strength_text">Kekuatan: Belum diisi</span>
<span class="font-label-sm text-label-sm text-outline">Huruf, angka &amp; simbol</span>
</div>
</div>
</div>
<!-- Ulangi Kata Sandi Baru -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-1" for="pwd_konfirmasi">Ulangi Kata Sandi Baru</label>
<div class="relative">
<input class="w-full px-3.5 py-2.5 pr-10 rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all" id="pwd_konfirmasi" placeholder="Ketik ulang kata sandi baru" required="" type="password"/>
<button class="absolute right-3 top-2.5 text-outline hover:text-on-surface" onclick="togglePasswordVisibility('pwd_konfirmasi', this)" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
</div>
<div class="pt-2">
<button class="w-full h-12 bg-surface-container-low hover:bg-surface-container text-primary font-label-lg text-label-lg rounded-xl flex items-center justify-center gap-2 active:scale-[0.99] transition-all" type="submit">
<span class="material-symbols-outlined text-[18px]">lock_reset</span>
          Perbarui Kata Sandi
        </button>
</div>
</form>
</section>
<!-- Card 3: Status Pengajuan Pembatalan & Refund -->
<section class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm">
<div class="flex items-center justify-between mb-4">
<div class="flex items-center gap-2">
<div class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
<span class="material-symbols-outlined text-[18px]">currency_exchange</span>
</div>
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface">Status Pembatalan &amp; Refund</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Histori tiket refund transaksi persewaan tenda &amp; alat.</p>
</div>
</div>
</div>
<!-- Refund List -->
<div class="space-y-3">
<!-- Item 1: Menunggu Keputusan -->
<div class="bg-surface-container-low p-3.5 rounded-xl space-y-2.5">
<div class="flex items-start justify-between gap-2">
<div>
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md text-primary font-bold">CR-1110</span>
<span class="text-xs text-outline">•</span>
<span class="font-body-sm text-body-sm text-on-surface font-semibold">Tenda Dome 4P &amp; Matras</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
<span class="font-semibold text-on-surface">Alasan:</span> Cuaca badai Gunung Merbabu
            </p>
</div>
<!-- Badge Kuning Menunggu -->
<span class="inline-flex items-center px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm whitespace-nowrap shrink-0">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary mr-1.5 animate-pulse"></span>
            Menunggu Keputusan
          </span>
</div>
<div class="bg-surface-container-lowest p-2.5 rounded-lg flex items-start gap-2">
<span class="material-symbols-outlined text-tertiary text-[18px] shrink-0 mt-0.5">support_agent</span>
<div>
<p class="font-label-sm text-label-sm text-tertiary font-bold">Catatan Tim CampRent:</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Sedang diverifikasi pengelola basecamp dan prakiraan BMKG setempat.</p>
</div>
</div>
</div>
<!-- Item 2: Disetujui -->
<div class="bg-surface-container-low p-3.5 rounded-xl space-y-2.5">
<div class="flex items-start justify-between gap-2">
<div>
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md text-primary font-bold">CR-1088</span>
<span class="text-xs text-outline">•</span>
<span class="font-body-sm text-body-sm text-on-surface font-semibold">Carrier 60L + Nesting Set</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
<span class="font-semibold text-on-surface">Alasan:</span> Jalur pendakian ditutup resmi
            </p>
</div>
<!-- Badge Hijau Disetujui -->
<span class="inline-flex items-center px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-sm text-label-sm whitespace-nowrap shrink-0">
<span class="material-symbols-outlined text-[13px] mr-1" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            Disetujui
          </span>
</div>
<div class="bg-surface-container-lowest p-2.5 rounded-lg flex items-start gap-2">
<span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">account_balance_wallet</span>
<div>
<p class="font-label-sm text-label-sm text-secondary font-bold">Catatan Tim CampRent:</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Dana Rp170.000 dikembalikan penuh via transfer BCA (Ref: TRF-8823190).</p>
</div>
</div>
</div>
<!-- Item 3: Ditolak -->
<div class="bg-surface-container-low p-3.5 rounded-xl space-y-2.5">
<div class="flex items-start justify-between gap-2">
<div>
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md text-primary font-bold">CR-1045</span>
<span class="text-xs text-outline">•</span>
<span class="font-body-sm text-body-sm text-on-surface font-semibold">Kompor Windproof &amp; Gas</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
<span class="font-semibold text-on-surface">Alasan:</span> Pembatalan sepihak hari H
            </p>
</div>
<!-- Badge Merah Ditolak -->
<span class="inline-flex items-center px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm whitespace-nowrap shrink-0">
<span class="material-symbols-outlined text-[13px] mr-1">cancel</span>
            Ditolak
          </span>
</div>
<div class="bg-surface-container-lowest p-2.5 rounded-lg flex items-start gap-2">
<span class="material-symbols-outlined text-error text-[18px] shrink-0 mt-0.5">info</span>
<div>
<p class="font-label-sm text-label-sm text-error font-bold">Catatan Tim CampRent:</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Melewati batas toleransi H-1, deposit hangus sesuai S&amp;K sewa luar ruang.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Logout / Tombol Keluar -->
<div class="pt-2">
<button class="w-full h-12 rounded-xl bg-error-container/60 hover:bg-error-container text-on-error-container font-label-lg text-label-lg flex items-center justify-center gap-2 active:scale-[0.99] transition-all" onclick="handleLogout()" type="button">
<span class="material-symbols-outlined text-[20px] text-error">logout</span>
      Keluar dari Akun
    </button>
<p class="text-center font-label-sm text-label-sm text-outline mt-3">CampRent versi 2.4.1 — Sahabat Petualangan Alam</p>
</div>
</div>
<!-- Inline Micro-interactions & Toast Notification Logic -->
<div class="fixed bottom-20 left-1/2 -translate-x-1/2 z-50 bg-inverse-surface text-inverse-on-surface px-4 py-2.5 rounded-full font-label-md text-label-md shadow-lg flex items-center gap-2 transition-all opacity-0 pointer-events-none transform translate-y-2" id="profile_toast">
<span class="material-symbols-outlined text-[18px] text-primary-fixed">check_circle</span>
<span id="profile_toast_msg">Perubahan berhasil</span>
</div>
<script>
  function togglePasswordVisibility(inputId, triggerBtn) {
    const input = document.getElementById(inputId);
    const icon = triggerBtn.querySelector('.material-symbols-outlined');
    if (!input || !icon) return;
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = 'visibility_off';
    } else {
      input.type = 'password';
      icon.textContent = 'visibility';
    }
  }

  function checkPasswordStrength(val) {
    const bar1 = document.getElementById('pwd_bar_1');
    const bar2 = document.getElementById('pwd_bar_2');
    const bar3 = document.getElementById('pwd_bar_3');
    const text = document.getElementById('pwd_strength_text');
    if (!bar1 || !bar2 || !bar3 || !text) return;

    if (!val || val.length === 0) {
      resetPwdStrength();
      return;
    }

    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/\d/.test(val) || /[^A-Za-z0-9]/.test(val)) score++;

    if (score === 1) {
      bar1.className = 'h-full w-1/3 bg-error transition-colors duration-300';
      bar2.className = 'h-full w-1/3 bg-surface-container transition-colors duration-300';
      bar3.className = 'h-full w-1/3 bg-surface-container transition-colors duration-300';
      text.textContent = 'Kekuatan: Lemah';
      text.className = 'font-label-sm text-label-sm text-error';
    } else if (score === 2) {
      bar1.className = 'h-full w-1/3 bg-tertiary-fixed-dim transition-colors duration-300';
      bar2.className = 'h-full w-1/3 bg-tertiary-fixed-dim transition-colors duration-300';
      bar3.className = 'h-full w-1/3 bg-surface-container transition-colors duration-300';
      text.textContent = 'Kekuatan: Sedang';
      text.className = 'font-label-sm text-label-sm text-tertiary';
    } else if (score >= 3) {
      bar1.className = 'h-full w-1/3 bg-primary transition-colors duration-300';
      bar2.className = 'h-full w-1/3 bg-primary transition-colors duration-300';
      bar3.className = 'h-full w-1/3 bg-primary transition-colors duration-300';
      text.textContent = 'Kekuatan: Sangat Kuat';
      text.className = 'font-label-sm text-label-sm text-primary';
    }
  }

  function resetPwdStrength() {
    const bar1 = document.getElementById('pwd_bar_1');
    const bar2 = document.getElementById('pwd_bar_2');
    const bar3 = document.getElementById('pwd_bar_3');
    const text = document.getElementById('pwd_strength_text');
    if (bar1 && bar2 && bar3 && text) {
      bar1.className = 'h-full w-1/3 bg-outline-variant transition-colors duration-300';
      bar2.className = 'h-full w-1/3 bg-outline-variant transition-colors duration-300';
      bar3.className = 'h-full w-1/3 bg-outline-variant transition-colors duration-300';
      text.textContent = 'Kekuatan: Belum diisi';
      text.className = 'font-label-sm text-label-sm text-on-surface-variant';
    }
  }

  function showToast(message) {
    const toast = document.getElementById('profile_toast');
    const msg = document.getElementById('profile_toast_msg');
    if (!toast || !msg) return;

    msg.textContent = message;
    toast.classList.remove('opacity-0', 'translate-y-2', 'pointer-events-none');
    toast.classList.add('opacity-100', 'translate-y-0');

    setTimeout(() => {
      toast.classList.remove('opacity-100', 'translate-y-0');
      toast.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
    }, 2800);
  }

  function handleLogout() {
    if (confirm('Apakah Anda yakin ingin keluar dari akun CampRent?')) {
      showToast('Sesi Anda telah diakhiri.');
    }
  }
</script></main>
<?php require __DIR__ . '/../includes/layout_user_bottom.php'; ?>
