<?php
/**
 * Data artikel sementara (cermin tabel `articles`: title, slug, excerpt, content, published_at).
 * TODO(backend): ganti dengan SELECT ... FROM articles WHERE status='published' ORDER BY published_at DESC
 * dan SELECT ... WHERE slug = ? untuk detail.
 */
return [
    [
        'slug' => 'tips-memilih-tenda-untuk-pemula', 'title' => 'Tips Memilih Tenda untuk Pemula',
        'excerpt' => 'Cara mencocokkan kapasitas, berat, dan ketahanan air tenda.',
        'icon' => 'camping', 'label' => 'Panduan', 'menit' => 3, 'tanggal' => '2026-11-17',
        'content' => "Sesuaikan kapasitas tenda dengan jumlah pengguna. Pilih kapasitas satu orang lebih banyak dari jumlah pendaki agar ada ruang untuk tas.\n\nPeriksa ketahanan hujan (rating kolom air), berat bawaan, kelengkapan pasak dan flysheet, serta lokasi pendirian tenda: hindari cekungan dan dekat pohon tumbang.\n\nUntuk pemula, tenda dome double layer adalah pilihan paling aman: cepat dipasang dan stabil terhadap angin.",
    ],
    [
        'slug' => 'checklist-alat-camping', 'title' => 'Checklist Alat Camping Sebelum Berangkat',
        'excerpt' => 'Perlengkapan dasar yang perlu dicek sebelum perjalanan.',
        'icon' => 'checklist', 'label' => 'Checklist', 'menit' => 3, 'tanggal' => '2026-11-17',
        'content' => "Periksa tenda, sleeping bag, lampu, peralatan masak, pakaian hangat, P3K, air minum, dan perangkat komunikasi.\n\nPastikan kondisi setiap alat layak digunakan. Saat mengambil alat sewaan, cocokkan dengan daftar serah terima di kartu pengambilan dan laporkan kekurangan sebelum meninggalkan basecamp.",
    ],
    [
        'slug' => 'panduan-camping-minimalis', 'title' => 'Panduan Camping Ringan dan Minimalis',
        'excerpt' => 'Strategi membawa alat seperlunya tanpa mengabaikan keselamatan.',
        'icon' => 'backpack', 'label' => 'Tips', 'menit' => 4, 'tanggal' => '2026-11-17',
        'content' => "Rencanakan kebutuhan sesuai cuaca, durasi, dan jumlah peserta. Pilih alat multifungsi dan utamakan keselamatan, navigasi, serta pengelolaan sampah.\n\nBawa sampahmu kembali. Alat yang lebih ringan membuat perjalanan lebih nyaman, tetapi jangan mengurangi perlengkapan keselamatan.",
    ],
];
