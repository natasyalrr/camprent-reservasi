<?php
/**
 * Pembuka layout Staff/Admin (desktop): sidebar kiri + header atas.
 * Variabel: $pageTitle, $bodyClass, $activeMenu. Pemanggil sudah memanggil require_role().
 */
require __DIR__ . '/head.php';

$me = current_user();
$isAdmin = $me['role'] === 'admin';

$menuOperasional = [
    ['dashboard',     'staff/dashboard.php',    'space_dashboard',   'Dashboard'],
    ['reservasi',     'staff/reservasi.php',    'event_available',   'Reservasi'],
    ['pembatalan',    'staff/pembatalan.php',   'event_busy',        'Pembatalan'],
    ['pengembalian',  'staff/pengembalian.php', 'assignment_return', 'Pengembalian'],
    ['alat-kategori', 'staff/alat.php',         'backpack',          'Alat & Kategori'],
    ['artikel',       'staff/artikel.php',      'article',           'Artikel'],
    ['laporan',       'staff/laporan.php',      'bar_chart',         'Laporan'],
];
$menuAdmin = [
    ['manajemen-akun',  'admin/akun.php',       'manage_accounts', 'Manajemen Akun'],
    ['catatan-tindakan', 'admin/audit-log.php', 'history',         'Catatan Tindakan'],
];
$linkOff = 'text-secondary-fixed-dim hover:bg-[#275334] hover:text-surface';
$linkOn  = 'bg-[#275334] text-secondary-fixed font-bold';
?>
<aside class="fixed left-0 top-0 h-full w-72 bg-[#1f3d2b] z-50 flex flex-col justify-between overflow-y-auto">
  <div class="flex flex-col">
    <div class="px-space-lg pt-space-lg pb-space-md">
      <div class="flex items-center gap-space-sm">
        <div class="w-9 h-9 rounded-lg bg-secondary-fixed flex items-center justify-center"><span class="material-symbols-outlined text-[#1f3d2b] text-[22px]">camping</span></div>
        <div class="flex flex-col"><span class="font-headline-sm text-headline-sm text-surface tracking-tight leading-tight">CampRent</span><span class="font-label-sm text-label-sm text-[#a2d2aa] uppercase tracking-wider">Nusantara Gear</span></div>
      </div>
      <div class="mt-space-md inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#275334] border border-[#3f6b4a]">
        <span class="w-2 h-2 rounded-full bg-secondary-fixed animate-pulse"></span><span class="font-label-sm text-label-sm text-secondary-fixed"><?= e(role_label($me['role'])) ?></span>
      </div>
    </div>

    <div class="px-space-md py-space-xs">
      <span class="px-space-sm font-label-sm text-label-sm text-[#a2d2aa] uppercase tracking-wider">Operasional</span>
      <nav class="mt-space-xs flex flex-col gap-1" aria-label="Menu operasional">
        <?php foreach ($menuOperasional as [$key, $href, $icon, $label]): $on = ($key === ($activeMenu ?? '')); ?>
        <a class="flex items-center gap-space-sm px-space-sm py-2 rounded-lg transition-colors font-label-lg text-label-lg <?= $on ? $linkOn : $linkOff ?>" href="<?= e(url($href)) ?>"<?= $on ? ' aria-current="page"' : '' ?>>
          <span class="material-symbols-outlined text-[20px]"><?= $icon ?></span><span><?= e($label) ?></span>
        </a>
        <?php endforeach; ?>
      </nav>
    </div>

    <?php if ($isAdmin): ?>
    <div class="px-space-md pt-space-md pb-space-xs">
      <span class="px-space-sm font-label-sm text-label-sm text-[#a2d2aa] uppercase tracking-wider">Administrasi</span>
      <nav class="mt-space-xs flex flex-col gap-1" aria-label="Menu administrasi">
        <?php foreach ($menuAdmin as [$key, $href, $icon, $label]): $on = ($key === ($activeMenu ?? '')); ?>
        <a class="flex items-center gap-space-sm px-space-sm py-2 rounded-lg transition-colors font-label-lg text-label-lg <?= $on ? $linkOn : $linkOff ?>" href="<?= e(url($href)) ?>"<?= $on ? ' aria-current="page"' : '' ?>>
          <span class="material-symbols-outlined text-[20px]"><?= $icon ?></span><span><?= e($label) ?></span>
        </a>
        <?php endforeach; ?>
      </nav>
    </div>
    <?php endif; ?>
  </div>

  <div class="p-space-md flex flex-col gap-1 border-t border-[#275334]">
    <a class="flex items-center gap-space-sm px-space-sm py-2 rounded-lg transition-colors font-label-lg text-label-lg <?= $linkOff ?>" href="<?= e(url('index.php')) ?>">
      <span class="material-symbols-outlined text-[20px]">travel_explore</span><span>Lihat website</span>
    </a>
    <form method="post" action="<?= e(url('auth/logout.php')) ?>">
      <?= csrf_field() ?>
      <button type="submit" class="w-full flex items-center gap-space-sm px-space-sm py-2 rounded-lg text-[#ffdad6] hover:bg-[#ba1a1a]/20 hover:text-surface transition-colors font-label-lg text-label-lg">
        <span class="material-symbols-outlined text-[20px]">logout</span><span>Keluar</span>
      </button>
    </form>
  </div>
</aside>

<div class="pl-72">
  <header class="fixed top-0 left-72 right-0 h-16 bg-surface/90 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-space-xl">
    <div class="flex items-center gap-space-md">
      <div class="flex items-center gap-space-xs px-space-sm py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">
        <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span><span><?= e(tanggal_id()) ?></span>
      </div>
    </div>
    <div class="flex items-center gap-space-sm">
      <div class="flex flex-col text-right">
        <span class="font-label-lg text-label-lg text-on-surface leading-tight"><?= e($me['nama']) ?></span>
        <span class="font-label-sm text-label-sm text-primary font-bold"><?= e(role_label($me['role'])) ?></span>
      </div>
      <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span class="material-symbols-outlined text-on-primary text-[18px]">person</span></div>
    </div>
  </header>
