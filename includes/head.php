<?php
/** head.php — <head> + pembuka <body>. Variabel: $pageTitle, $bodyClass. */
$pageTitle = $pageTitle ?? 'CampRent';
$bodyClass = $bodyClass ?? 'bg-surface font-body-md text-on-surface';
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?= e($pageTitle) ?> — CampRent</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,600;1,6..72,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<!-- Tailwind via CDN (tanpa build step). Token warna/spasi/font ada di assets/js/tailwind-config.js -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="<?= asset('js/tailwind-config.js') ?>"></script>
<link rel="stylesheet" href="<?= asset('css/app.css') ?>"/>
</head>
<body class="<?= e($bodyClass) ?>">
