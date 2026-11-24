<?php
require_once __DIR__ . '/../includes/bootstrap.php';

$flash = $_SESSION['register_flash'] ?? [];
unset($_SESSION['register_flash']);

$errors = $flash['errors'] ?? [];
$info = $flash['info'] ?? null;
$tab = $flash['tab'] ?? 'masuk';
$next = safe_next($_GET['next'] ?? null);

if (current_user()) {
    redirect(role_home(current_user()['role']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $errors[] = 'Sesi formulir kedaluwarsa. Muat ulang halaman lalu coba lagi.';
    } elseif (($_POST['action'] ?? '') === 'login') {
        $wait = login_locked_seconds();
        if ($wait > 0) {
            $errors[] = "Terlalu banyak percobaan. Coba lagi dalam {$wait} detik.";
        } else {
            $email = trim((string) ($_POST['email'] ?? ''));
            $user  = $email !== '' ? find_user_by_email($email) : null;
            if ($user && password_verify((string) ($_POST['password'] ?? ''), $user['password_hash'])) {
                login_user($user);
                redirect($next ?? role_home($user['role']));
            }
            login_register_failure();
            $errors[] = 'Email atau kata sandi salah.';
        }

    }
}

$pageTitle = 'Masuk & Daftar';
$bodyClass = 'bg-surface font-body-md text-on-surface';
require __DIR__ . '/../includes/layout_user_top.php';
?>
<header class="fixed top-0 w-full z-50 pt-safe bg-surface/95 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="h-16 px-margin flex items-center justify-between"><div class="flex items-center gap-space-sm"><button aria-label="Kembali" class="w-11 h-11 flex items-center justify-center rounded-full text-on-surface hover:bg-surface-container active:scale-95 transition-all" onclick="history.back()"><span class="material-symbols-outlined text-[24px]">arrow_back</span></button><div class="flex items-center gap-2"><img alt="CampRent Brand Logo" class="h-7 w-auto object-contain" src="<?= asset('images/logo.svg') ?>"/><h1 class="font-headline-sm text-headline-sm text-on-surface font-bold tracking-tight truncate max-w-[210px]">Masuk &amp; Daftar   Camprent</h1></div></div><div class="flex items-center gap-space-xs"><a aria-label="Bantuan WhatsApp" class="w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container active:scale-95 transition-all" href="#"><span class="material-symbols-outlined text-[22px]">help_outline</span></a></div></div></header>
<main class="flex-1 w-full pt-16 pb-safe px-margin bg-surface"><div class="flex flex-col w-full pb-8">
<!-- Warm Atmospheric Field Header -->
<div class="pt-4 pb-5 flex flex-col items-center text-center">
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-label-md font-label-md mb-2.5 shadow-sm">
<span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">forest</span>
<span>Basecamp Digital Petualang</span>
</div>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface tracking-tight">
      Mulai Petualangan Liar
    </h2>
<p class="font-body-sm text-body-sm text-on-surface-variant max-w-xs mt-1">
      Sewa tenda, perlengkapan bivak, hingga alat masak gunung terpercaya untuk penjelajahan Nusantara.
    </p>
</div>
<!-- Segmented Tab Switcher -->
<div class="bg-surface-container p-1 rounded-xl flex items-center mb-5 shadow-sm">
<button class="flex-1 py-2.5 rounded-lg font-headline-sm text-headline-sm transition-all flex items-center justify-center gap-1.5 bg-surface-container-lowest text-primary shadow-sm" id="tab-btn-masuk" onclick="switchAuthTab('masuk')" type="button">
<span class="material-symbols-outlined text-[18px]">login</span>
<span>Masuk</span>
</button>
<button class="flex-1 py-2.5 rounded-lg font-headline-sm text-headline-sm transition-all flex items-center justify-center gap-1.5 text-on-surface-variant hover:text-on-surface" id="tab-btn-daftar" onclick="switchAuthTab('daftar')" type="button">
<span class="material-symbols-outlined text-[18px]">person_add</span>
<span>Daftar</span>
</button>
</div>
<!-- TAB CONTENT 1: MASUK -->
<section class="flex flex-col gap-5 w-full" id="panel-masuk">
<?php if ($errors && $tab !== 'daftar'): ?><div role="alert" class="rounded-xl bg-error-container text-on-error-container p-3 font-label-lg text-label-lg"><?php foreach ($errors as $m): ?><div><?= e($m) ?></div><?php endforeach; ?></div><?php endif; ?>
<?php if ($info): ?><div role="status" class="rounded-xl bg-secondary-container text-on-secondary-container p-3 font-label-lg text-label-lg"><?= e($info) ?></div><?php endif; ?>

<!-- Main Form Card -->
<div class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm flex flex-col gap-4">
<div class="flex items-center justify-between pb-1">
<h3 class="font-headline-sm text-headline-sm text-on-surface">Masuk ke Akun</h3>
<span class="text-label-sm font-label-sm px-2.5 py-0.5 rounded-full bg-surface-container-high text-on-surface-variant">Sesi Aman</span>
</div>
<form class="flex flex-col gap-3.5" id="form-login" method="post" action="" novalidate>
<?= csrf_field() ?><input type="hidden" name="action" value="login"/>
<!-- Email Input -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface" for="login-email">Email Terdaftar</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">mail</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-4 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors placeholder:text-outline" id="login-email" name="email" placeholder="nama@email.com" type="email"/>
</div>
</div>
<!-- Password Input -->
<div class="flex flex-col gap-1.5">
<div class="flex items-center justify-between">
<label class="font-label-md text-label-md text-on-surface" for="login-password">Kata Sandi</label>
<a class="font-label-md text-label-md text-primary hover:underline" href="#">Lupa kata sandi?</a>
</div>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">lock</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-11 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors placeholder:text-outline" id="login-password" name="password" placeholder="Masukkan kata sandi" type="password"/>
<button aria-label="Lihat kata sandi" class="absolute right-2.5 w-8 h-8 flex items-center justify-center text-outline hover:text-on-surface rounded-full transition-colors" id="btn-toggle-login-pass" onclick="togglePasswordVisibility('login-password', 'icon-login-eye')" type="button">
<span class="material-symbols-outlined text-[20px]" id="icon-login-eye">visibility</span>
</button>
</div>
</div>
<!-- Submit Button -->
<button class="w-full mt-1.5 min-h-[48px] bg-primary-container hover:bg-primary text-on-primary rounded-xl font-label-lg text-label-lg font-semibold flex items-center justify-center gap-2 active:scale-[0.98] transition-all shadow-sm" type="submit">
<span class="material-symbols-outlined text-[20px]">explore</span>
<span>Masuk ke CampRent</span>
</button>
</form>
<!-- Prompt ke Daftar -->
<div class="text-center pt-2">
<p class="font-body-sm text-body-sm text-on-surface-variant">
          Belum punya akun?
          <button class="font-label-md text-label-md text-primary font-semibold hover:underline ml-1" onclick="switchAuthTab('daftar')" type="button">
            Daftar sekarang
          </button>
</p>
</div>
</div>
<!-- Quick Demo Accounts Box -->
<div class="bg-surface-container-low rounded-2xl p-4 shadow-sm flex flex-col gap-3">
<div class="flex items-center gap-2">
<div class="w-7 h-7 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
<span class="material-symbols-outlined text-[16px]">bolt</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-on-surface font-semibold">Akun Demo Cepat</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Klik untuk mengisi kredensial siap pakai</span>
</div>
</div>
<!-- Quick Action Buttons -->
<div class="flex flex-col gap-2">
<!-- Admin Role -->
<button class="w-full text-left bg-surface-container-lowest hover:bg-surface-container p-3 rounded-xl flex items-center justify-between transition-all active:scale-[0.99] group shadow-sm" onclick="fillDemoAccount('admin@demo.test', 'Admin#2026')" type="button">
<div class="flex items-center gap-3 min-w-0">
<span class="px-2 py-0.5 rounded-full bg-on-primary-fixed-variant text-on-primary text-label-sm font-label-sm shrink-0">Admin</span>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md text-on-surface truncate">admin@camprent.id</span>
<span class="font-body-sm text-[11px] text-on-surface-variant leading-none">Akses Gudang &amp; Inventaris</span>
</div>
</div>
<span class="font-label-sm text-label-sm text-primary group-hover:translate-x-0.5 transition-transform flex items-center shrink-0">
            Pakai <span class="material-symbols-outlined text-[16px] ml-0.5">chevron_right</span>
</span>
</button>
<!-- Staff Role -->
<button class="w-full text-left bg-surface-container-lowest hover:bg-surface-container p-3 rounded-xl flex items-center justify-between transition-all active:scale-[0.99] group shadow-sm" onclick="fillDemoAccount('staff@demo.test', 'Staff#2026')" type="button">
<div class="flex items-center gap-3 min-w-0">
<span class="px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container text-label-sm font-label-sm shrink-0">Staff</span>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md text-on-surface truncate">staff.basecamp@camprent.id</span>
<span class="font-body-sm text-[11px] text-on-surface-variant leading-none">Petugas Pick-up &amp; QC Tenda</span>
</div>
</div>
<span class="font-label-sm text-label-sm text-primary group-hover:translate-x-0.5 transition-transform flex items-center shrink-0">
            Pakai <span class="material-symbols-outlined text-[16px] ml-0.5">chevron_right</span>
</span>
</button>
<!-- User Role -->
<button class="w-full text-left bg-surface-container-lowest hover:bg-surface-container p-3 rounded-xl flex items-center justify-between transition-all active:scale-[0.99] group shadow-sm" onclick="fillDemoAccount('user@demo.test', 'User#2026')" type="button">
<div class="flex items-center gap-3 min-w-0">
<span class="px-2 py-0.5 rounded-full bg-surface-variant text-on-surface-variant text-label-sm font-label-sm shrink-0">User</span>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md text-on-surface truncate">ahmad.fauzi@gmail.com</span>
<span class="font-body-sm text-[11px] text-on-surface-variant leading-none">Penyewa Gunung Prau / Rinjani</span>
</div>
</div>
<span class="font-label-sm text-label-sm text-primary group-hover:translate-x-0.5 transition-transform flex items-center shrink-0">
            Pakai <span class="material-symbols-outlined text-[16px] ml-0.5">chevron_right</span>
</span>
</button>
</div>
<!-- Info Helper PHP Native -->
<div class="flex items-start gap-2 pt-1">
<span class="material-symbols-outlined text-outline text-[18px] shrink-0 mt-0.5">info</span>
<p class="font-body-sm text-[12px] text-on-surface-variant leading-relaxed">
          Akun demo siap pakai untuk pengujian sistem autentikasi dan otorisasi role-based backend PHP Native.
        </p>
</div>
</div>
</section>
<!-- TAB CONTENT 2: DAFTAR -->
<section class="hidden flex-col gap-5 w-full" id="panel-daftar">
<?php if ($errors && $tab === 'daftar'): ?><div role="alert" class="rounded-xl bg-error-container text-on-error-container p-3 font-label-lg text-label-lg"><?php foreach ($errors as $m): ?><div><?= e($m) ?></div><?php endforeach; ?></div><?php endif; ?>
<!-- Registration Card -->
<div class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm flex flex-col gap-4">
<div class="flex items-center justify-between pb-1">
<h3 class="font-headline-sm text-headline-sm text-on-surface">Registrasi Member</h3>
<span class="text-label-sm font-label-sm px-2.5 py-0.5 rounded-full bg-secondary-container text-on-secondary-container">Verifikasi Cepat</span>
</div>
<form class="flex flex-col gap-3.5" id="form-register" method="post" action="<?= e(url('actions/auth/register.php')) ?>" novalidate>
<?= csrf_field() ?><input type="hidden" name="action" value="register"/>
<!-- Field 1: Nama Lengkap -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between">
<label class="font-label-md text-label-md text-on-surface" for="reg-name">Nama Lengkap</label>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span>Valid</span>
</span>
</div>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">person</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-10 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors" id="reg-name" name="fullname" type="text" value="<?= e($_POST['fullname'] ?? '') ?>"/>
<span class="material-symbols-outlined absolute right-3 text-primary text-[20px]">check</span>
</div>
</div>
<!-- Field 2: Email -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between">
<label class="font-label-md text-label-md text-on-surface" for="reg-email">Alamat Email</label>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span>Tersedia</span>
</span>
</div>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">mail</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-10 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors" id="reg-email" name="email" type="email" value="<?= e($_POST['email'] ?? '') ?>"/>
<span class="material-symbols-outlined absolute right-3 text-primary text-[20px]">check</span>
</div>
</div>
<!-- Field 3: WhatsApp/Telepon -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between">
<label class="font-label-md text-label-md text-on-surface" for="reg-phone">Nomor WhatsApp / Telepon</label>
<span class="font-label-sm text-label-sm text-on-surface-variant">Konfirmasi Sewa</span>
</div>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">phone_iphone</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-4 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors" id="reg-phone" name="phone" type="tel" value="<?= e($_POST['phone'] ?? '') ?>"/>
</div>
</div>
<!-- Field 4: Password with strength meter -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface" for="reg-password">Kata Sandi Baru</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">lock_reset</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-11 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors" id="reg-password" name="password" type="password"/>
<button aria-label="Toggle password" class="absolute right-2.5 w-8 h-8 flex items-center justify-center text-outline hover:text-on-surface rounded-full transition-colors" onclick="togglePasswordVisibility('reg-password', 'icon-reg-eye')" type="button">
<span class="material-symbols-outlined text-[20px]" id="icon-reg-eye">visibility</span>
</button>
</div>
<!-- Password Visual Indicator -->
<div class="flex flex-col gap-1.5 pt-1">
<div class="flex items-center justify-between font-label-sm text-label-sm">
<span class="text-on-surface-variant">Kekuatan Sandi</span>
<span class="text-primary font-semibold">Sangat Kuat (Aman)</span>
</div>
<!-- Strength Segments Bar -->
<div class="grid grid-cols-4 gap-1.5 h-1.5 w-full">
<div class="bg-primary rounded-full h-full"></div>
<div class="bg-primary rounded-full h-full"></div>
<div class="bg-primary rounded-full h-full"></div>
<div class="bg-primary rounded-full h-full"></div>
</div>
<p class="font-body-sm text-[12px] text-on-surface-variant">
              Minimal 8 karakter, kombinasi huruf besar, angka &amp; simbol.
            </p>
</div>
</div>
<!-- Field 5: Confirm Password -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between">
<label class="font-label-md text-label-md text-on-surface" for="reg-confirm-password">Ulangi Kata Sandi</label>
<span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary font-bold">
<span class="material-symbols-outlined text-[16px]">verified</span>
<span>Cocok ✓</span>
</span>
</div>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">lock_clock</span>
<input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md pl-11 pr-10 py-3 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors" id="reg-confirm-password" name="confirm_password" type="password"/>
<span class="material-symbols-outlined absolute right-3 text-primary text-[20px]">check</span>
</div>
</div>
<!-- Consent Checkbox -->
<div class="pt-2">
<label class="flex items-start gap-2.5 cursor-pointer select-none">
<input checked="" class="mt-1 w-4 h-4 rounded text-primary focus:ring-0 accent-primary cursor-pointer shrink-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface-variant leading-snug">
              Saya menyetujui
              <a class="text-primary font-semibold hover:underline" href="#">Ketentuan Sewa</a>
              &amp;
              <a class="text-primary font-semibold hover:underline" href="#">Kebijakan Privasi CampRent</a>.
            </span>
</label>
</div>
<!-- Register Action Button -->
<button class="w-full mt-2 min-h-[48px] bg-primary-container hover:bg-primary text-on-primary rounded-xl font-label-lg text-label-lg font-semibold flex items-center justify-center gap-2 active:scale-[0.98] transition-all shadow-sm" type="submit">
<span class="material-symbols-outlined text-[20px]">backpack</span>
<span>Daftar Akun Baru</span>
</button>
</form>
<!-- Back to login prompt -->
<div class="text-center pt-2">
<p class="font-body-sm text-body-sm text-on-surface-variant">
          Sudah punya akun?
          <button class="font-label-md text-label-md text-primary font-semibold hover:underline ml-1" onclick="switchAuthTab('masuk')" type="button">
            Masuk
          </button>
</p>
</div>
</div>
<!-- Assurance Mini Feature -->
<div class="grid grid-cols-2 gap-3">
<div class="bg-surface-container-lowest p-3 rounded-xl flex items-center gap-2.5 shadow-sm">
<div class="w-8 h-8 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">
<span class="material-symbols-outlined text-[18px]">sanitizer</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md text-on-surface truncate">Steril &amp; Kering</span>
<span class="font-label-sm text-[11px] text-on-surface-variant">QC tiap pengembalian</span>
</div>
</div>
<div class="bg-surface-container-lowest p-3 rounded-xl flex items-center gap-2.5 shadow-sm">
<div class="w-8 h-8 rounded-lg bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed shrink-0">
<span class="material-symbols-outlined text-[18px]">verified_user</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-md text-label-md text-on-surface truncate">Garansi Tenda</span>
<span class="font-label-sm text-[11px] text-on-surface-variant">Bebas bocor badai</span>
</div>
</div>
</div>
</section>
<!-- Interactive JavaScript Logic -->
<script>
    function switchAuthTab(tab) {
      const panelMasuk = document.getElementById('panel-masuk');
      const panelDaftar = document.getElementById('panel-daftar');
      const btnMasuk = document.getElementById('tab-btn-masuk');
      const btnDaftar = document.getElementById('tab-btn-daftar');

      if (tab === 'masuk') {
        panelMasuk.classList.remove('hidden');
        panelMasuk.classList.add('flex');
        panelDaftar.classList.add('hidden');
        panelDaftar.classList.remove('flex');

        // Styles for active Masuk button
        btnMasuk.className = 'flex-1 py-2.5 rounded-lg font-headline-sm text-headline-sm transition-all flex items-center justify-center gap-1.5 bg-surface-container-lowest text-primary shadow-sm';
        btnDaftar.className = 'flex-1 py-2.5 rounded-lg font-headline-sm text-headline-sm transition-all flex items-center justify-center gap-1.5 text-on-surface-variant hover:text-on-surface';
      } else {
        panelDaftar.classList.remove('hidden');
        panelDaftar.classList.add('flex');
        panelMasuk.classList.add('hidden');
        panelMasuk.classList.remove('flex');

        // Styles for active Daftar button
        btnDaftar.className = 'flex-1 py-2.5 rounded-lg font-headline-sm text-headline-sm transition-all flex items-center justify-center gap-1.5 bg-surface-container-lowest text-primary shadow-sm';
        btnMasuk.className = 'flex-1 py-2.5 rounded-lg font-headline-sm text-headline-sm transition-all flex items-center justify-center gap-1.5 text-on-surface-variant hover:text-on-surface';
      }
    }

    function togglePasswordVisibility(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (!input || !icon) return;

      if (input.type === 'password') {
        input.type = 'text';
        icon.innerText = 'visibility_off';
      } else {
        input.type = 'password';
        icon.innerText = 'visibility';
      }
    }

    function fillDemoAccount(email, password) {
      const emailField = document.getElementById('login-email');
      const passField = document.getElementById('login-password');
      if (emailField && passField) {
        emailField.value = email;
        passField.value = password;

        // Visual subtle feedback highlight
        emailField.classList.add('bg-secondary-fixed');
        passField.classList.add('bg-secondary-fixed');
        setTimeout(() => {
          emailField.classList.remove('bg-secondary-fixed');
          passField.classList.remove('bg-secondary-fixed');
        }, 350);
      }
    }
  </script>
</div></main>
<?php if ($tab === 'daftar'): ?><script>document.addEventListener('DOMContentLoaded',function(){switchAuthTab('daftar');});</script><?php endif; ?>
</body>
</html>
