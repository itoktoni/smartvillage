<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Hub-and-spoke preview untuk 10 requirement Smart Village.
 * shortcut: data masih dummy inline; ganti dengan Model + DB saat CRUD tiap modul dibangun.
 */
class SmartVillageController extends Controller
{
    public function show(Request $request, string $module)
    {
        $modules = $this->modules();

        abort_unless(isset($modules[$module]), 404);

        return view('pages.smartvillage.show', [
            'slug' => $module,
            'page' => $modules[$module],
        ]);
    }

    private function modules(): array
    {
        return [
            'iuran' => [
                'title' => 'Iuran & Tagihan', 'icon' => 'payments',
                'desc' => 'Req 1 — Jenis iuran, penagihan WA otomatis, status Lunas/Belum/Sebagian, rekap + export PDF/Excel.',
                'stats' => [['Total Tagihan', 'Rp 4.250.000'], ['Terkumpul', 'Rp 3.100.000'], ['Belum Bayar', '23 KK']],
                'columns' => ['Jenis Iuran', 'Nominal', 'Periode', 'Jatuh Tempo', 'Status'],
                'rows' => [
                    ['Kebersihan', 'Rp 15.000', 'Bulanan', '10 Okt', 'Sebagian'],
                    ['Siskamling', 'Rp 10.000', 'Bulanan', '10 Okt', 'Belum'],
                    ['Arisan RT 05', 'Rp 50.000', 'Bulanan', '15 Okt', 'Lunas'],
                    ['Kas Gang Mawar', 'Rp 5.000', 'Insidental', '20 Okt', 'Belum'],
                ],
            ],
            'surat' => [
                'title' => 'Surat Keterangan', 'icon' => 'description',
                'desc' => 'Req 2 — Pengajuan warga, approve/tolak pengurus, generate PDF + tanda tangan digital, nomor register.',
                'stats' => [['Pending', '4'], ['Disetujui bln ini', '17'], ['Ditolak', '1']],
                'columns' => ['Nomor', 'Jenis Surat', 'Pemohon', 'Tanggal', 'Status'],
                'rows' => [
                    ['470/10/2026', 'Domisili', 'Budi Santoso (A6)', '21 Okt', 'Pending'],
                    ['469/10/2026', 'Tidak Mampu', 'Rina Marlina (A2)', '20 Okt', 'Disetujui'],
                    ['468/10/2026', 'Pengantar KTP', 'Joko Prasetyo (B3)', '19 Okt', 'Disetujui'],
                    ['467/10/2026', 'Keterangan Usaha', 'Dewi Lestari (B4)', '18 Okt', 'Ditolak'],
                ],
            ],
            'broadcast' => [
                'title' => 'Broadcast & Pengumuman', 'icon' => 'campaign',
                'desc' => 'Req 3 — Target semua/RW/RT/warga tertentu, teks+foto+lampiran, log status kirim WA.',
                'stats' => [['Terkirim bln ini', '12'], ['Penerima', '186'], ['Gagal', '2']],
                'columns' => ['Judul', 'Target', 'Waktu Kirim', 'Status'],
                'rows' => [
                    ['Kerja Bakti Minggu', 'Semua warga', '24 Okt 08:00', 'Terkirim'],
                    ['Jadwal Posyandu', 'RT 01–03', '23 Okt 16:00', 'Terkirim'],
                    ['Pemadaman Listrik', 'Blok C', '22 Okt 09:00', 'Sebagian gagal'],
                    ['Arisan RT 05', 'RT 05', '20 Okt 19:00', 'Terkirim'],
                ],
            ],
            'poling' => [
                'title' => 'Poling Komunitas', 'icon' => 'how_to_vote',
                'desc' => 'Req 4 — Satu warga satu suara, hasil real-time, tutup otomatis, notifikasi hasil via WA.',
                'stats' => [['Poling Aktif', '1'], ['Partisipasi', '64%'], ['Selesai', '8']],
                'columns' => ['Judul', 'Batas Waktu', 'Suara Masuk', 'Status'],
                'rows' => [
                    ['Jadwal Siskamling Baru', '31 Okt 23:59', '87 / 136', 'Berjalan'],
                    ['Pemilihan Ketua RT 05', '30 Sep', '112 / 130', 'Selesai'],
                    ['Warna Cat Pos Kamling', '15 Sep', '64 / 130', 'Selesai'],
                ],
            ],
            'warga' => [
                'title' => 'Warga & Rumah', 'icon' => 'group',
                'desc' => 'Req 5 — Direktori rumah: nomor, KK, anggota, telepon, status hunian + tombol WA. Lihat juga Denah.',
                'stats' => [['Total KK', '18'], ['Jiwa', '61'], ['Kontrak', '5']],
                'columns' => ['Rumah', 'Kepala Keluarga', 'Anggota', 'Telepon', 'Status'],
                'rows' => [
                    ['A1', 'H. Sutono', '4', '081234560101', 'Pemilik'],
                    ['A3', 'Dedi Kurniawan', '5', '081234560103', 'Kontrak'],
                    ['B2', 'Siti Rahayu', '5', '081234560202', 'Pemilik'],
                    ['C1', 'H. Mahmud', '6', '081234560301', 'Pemilik'],
                    ['C5', 'Tono Supriadi', '5', '081234560305', 'Kontrak'],
                ],
            ],
            'usaha' => [
                'title' => 'Usaha Warga', 'icon' => 'storefront',
                'desc' => 'Req 6 — Direktori commerce: nama usaha, kategori, produk + tombol Hubungi via WA.',
                'stats' => [['Usaha Aktif', '7'], ['Kategori', '4'], ['Produk', '23']],
                'columns' => ['Usaha', 'Kategori', 'Contoh Produk', 'Harga', 'Kontak'],
                'rows' => [
                    ['Warung Berkah', 'Sembako', 'Beras 5kg', 'Rp 62.000', 'WA'],
                    ['Ayam Geprek B2', 'Kuliner', 'Geprek level 3', 'Rp 12.000', 'WA'],
                    ['Servis HP Andi', 'Jasa', 'Ganti LCD', 'Rp 150.000', 'WA'],
                    ['Laundry Kinclong', 'Jasa', 'Cuci+setrika /kg', 'Rp 7.000', 'WA'],
                ],
            ],
            'papan' => [
                'title' => 'Papan Informasi', 'icon' => 'event',
                'desc' => 'Req 7 — Hajatan, sunatan, pengajian, duka cita, kegiatan sosial + RSVP, auto-arsip kedaluwarsa.',
                'stats' => [['Tayang', '5'], ['Bulan ini', '9'], ['Diarsipkan', '14']],
                'columns' => ['Judul', 'Kategori', 'Tanggal Acara', 'Lokasi'],
                'rows' => [
                    ['Hajatan Keluarga Bpk. Agus', 'Hajatan', '28 Okt 10:00', 'B1 — Balai RT'],
                    ['Pengajian Bulanan', 'Pengajian', '30 Okt 19:30', 'Masjid Al-Barokah'],
                    ['Sunatan Massal', 'Kegiatan Sosial', '02 Nov 08:00', 'Posyandu'],
                    ['Berita Duka Cita', 'Duka Cita', '24 Okt', 'C4'],
                ],
            ],
            'notif' => [
                'title' => 'Log WhatsApp', 'icon' => 'chat',
                'desc' => 'Req 9 — Bukti kirim read-only: waktu, tujuan, status. Retry maks 3x + scheduler (gateway tahap berikutnya).',
                'stats' => [['Terkirim', '342'], ['Gagal', '3'], ['Antre', '0']],
                'columns' => ['Waktu', 'Tujuan', 'Jenis Pesan', 'Status'],
                'rows' => [
                    ['25 Okt 07:00', '186 nomor', 'Tagihan iuran Okt', 'Terkirim'],
                    ['24 Okt 08:05', '186 nomor', 'Undangan kerja bakti', 'Terkirim'],
                    ['23 Okt 16:00', '58 nomor', 'Jadwal posyandu', 'Terkirim'],
                    ['23 Okt 07:00', '3 nomor', 'Reminder jatuh tempo', 'Gagal → retry'],
                ],
            ],
            'laporan' => [
                'title' => 'Laporan', 'icon' => 'assessment',
                'desc' => 'Req 10 — Ringkasan warga, iuran per periode/jenis/status, export PDF & Excel (agregat per RT/RW untuk Super Admin).',
                'stats' => [['Warga Aktif', '61 jiwa'], ['Iuran Terkumpul Okt', 'Rp 3.100.000'], ['Surat Pending', '4']],
                'columns' => ['Laporan', 'Periode', 'Filter', 'Format'],
                'rows' => [
                    ['Rekap Iuran', 'Okt 2026', 'Per jenis + status', 'PDF / Excel'],
                    ['Statistik Warga', 'Okt 2026', 'Aktif / baru / pindah', 'PDF / Excel'],
                    ['Riwayat Surat', '2026', 'Per jenis + status', 'PDF'],
                    ['Partisipasi Poling', '2026', 'Per poling', 'Excel'],
                ],
            ],
        ];
    }
}
