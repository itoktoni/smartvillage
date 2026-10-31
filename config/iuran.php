<?php

// Master data iuran — seed awal keikutsertaan & status bayar per keluarga.
// Perubahan via halaman Master Iuran tersimpan di browser (localStorage);
// pindahkan ke tabel DB saat modul pembayaran dibangun.
return [
    'periode' => 'Oktober 2026',
    'kode' => 'TAG-202610',
    'kategori' => ['sampah' => 15000, 'arisan' => 50000, 'keamanan' => 10000],
    'katLabel' => ['sampah' => 'Sampah', 'arisan' => 'Arisan', 'keamanan' => 'Keamanan'],
    'katShort' => ['sampah' => 'Smp', 'arisan' => 'Ars', 'keamanan' => 'Kam'],
    'keluarga' => [
        ['blok' => 'A1', 'no' => 1, 'kk' => 'H. Sutono', 'telp' => '081234560101', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1], 'bayar' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1]],
        ['blok' => 'A1', 'no' => 2, 'kk' => 'Rina Marlina', 'telp' => '081234560102', 'ikut' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 1], 'bayar' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 1]],
        ['blok' => 'A1', 'no' => 3, 'kk' => 'Dedi Kurniawan', 'telp' => '081234560103', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1], 'bayar' => ['sampah' => 0, 'arisan' => 0, 'keamanan' => 0]],
        ['blok' => 'M1', 'no' => 1, 'kk' => 'Agus Wijaya', 'telp' => '081234560201', 'ikut' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 1], 'bayar' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 0]],
        ['blok' => 'M1', 'no' => 4, 'kk' => 'Dewi Lestari', 'telp' => '081234560204', 'ikut' => ['sampah' => 0, 'arisan' => 1, 'keamanan' => 1], 'bayar' => ['sampah' => 0, 'arisan' => 1, 'keamanan' => 1]],
        ['blok' => 'M2', 'no' => 2, 'kk' => 'Yuni Astuti', 'telp' => '081234560302', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 0], 'bayar' => ['sampah' => 0, 'arisan' => 1, 'keamanan' => 0]],
        ['blok' => 'N1', 'no' => 1, 'kk' => 'H. Mahmud', 'telp' => '081234560301', 'ikut' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 1], 'bayar' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 0]],
        ['blok' => 'N1', 'no' => 5, 'kk' => 'Tono Supriadi', 'telp' => '081234560305', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1], 'bayar' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1]],
        ['blok' => 'N2', 'no' => 3, 'kk' => 'Rudi Hartono', 'telp' => '081234560303', 'ikut' => ['sampah' => 0, 'arisan' => 0, 'keamanan' => 1], 'bayar' => ['sampah' => 0, 'arisan' => 0, 'keamanan' => 1]],
        ['blok' => 'N3', 'no' => 2, 'kk' => 'Siti Rahayu', 'telp' => '081234560202', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1], 'bayar' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1]],
        ['blok' => 'N4', 'no' => 6, 'kk' => 'Andi Gunawan', 'telp' => '081234560206', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 0], 'bayar' => ['sampah' => 1, 'arisan' => 0, 'keamanan' => 0]],
        ['blok' => 'N5', 'no' => 4, 'kk' => 'Nina Kurnia', 'telp' => '081234560304', 'ikut' => ['sampah' => 1, 'arisan' => 1, 'keamanan' => 1], 'bayar' => ['sampah' => 0, 'arisan' => 0, 'keamanan' => 0]],
    ],
];
