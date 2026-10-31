# Requirements Document

## Introduction

Aplikasi RT/RW/Desa adalah platform digital berbasis mobile dan web yang memudahkan pengelolaan administrasi komunitas tingkat RT, RW, hingga Desa. Aplikasi ini dirancang untuk mempermudah interaksi antara pengurus (RT/RW/Desa) dan warga dalam hal pembayaran iuran, pembuatan surat, penyebaran informasi, poling komunitas, direktori warga, dan marketplace lokal. Notifikasi tagihan dan broadcast menggunakan WhatsApp sebagai kanal utama komunikasi.

---

## Requirements

### Requirement 1 — Manajemen Iuran & Tagihan

**User Story:** Sebagai pengurus RT/RW, saya ingin mengelola dan menagih iuran warga secara otomatis via WhatsApp, agar proses penagihan lebih mudah dan tercatat.

#### Acceptance Criteria

1. WHEN pengurus membuat jenis iuran baru (kebersihan, siskamling, arisan RT, dll) THEN sistem SHALL menyimpan nama iuran, nominal, dan periode (bulanan/tahunan/insidental).
2. WHEN jadwal tagihan tiba (misal awal bulan) THEN sistem SHALL otomatis mengirim pesan WhatsApp ke setiap warga berisi total list iuran yang belum dibayar beserta nominal masing-masing.
3. WHEN warga melakukan pembayaran THEN pengurus SHALL dapat mencatat pembayaran per iuran per warga dengan status: Lunas / Belum Lunas / Sebagian.
4. WHEN warga membayar THEN sistem SHALL mengirim notifikasi konfirmasi pembayaran via WhatsApp ke warga.
5. IF warga belum membayar setelah tanggal jatuh tempo THEN sistem SHALL mengirim pesan pengingat otomatis via WhatsApp.
6. WHEN pengurus membuka dashboard iuran THEN sistem SHALL menampilkan rekapitulasi: total tagihan, total terkumpul, dan daftar warga yang belum bayar.
7. WHEN akhir bulan THEN pengurus SHALL dapat mengunduh laporan iuran dalam format PDF atau Excel.
8. WHEN pengurus membuat iuran arisan THEN sistem SHALL mendukung fitur pengelolaan giliran penerima arisan.

---

### Requirement 2 — Pembuatan Surat Keterangan

**User Story:** Sebagai warga, saya ingin mengajukan dan menerima surat keterangan secara digital, agar tidak perlu datang langsung ke pengurus.

#### Acceptance Criteria

1. WHEN warga mengajukan permohonan surat THEN sistem SHALL menyediakan pilihan jenis surat: Surat Keterangan Domisili, Surat Keterangan Tidak Mampu, Surat Pengantar KTP/KK, Surat Keterangan Usaha, Surat Keterangan Kelahiran, Surat Keterangan Kematian, dan lainnya.
2. WHEN warga mengisi form permohonan surat THEN sistem SHALL meminta data yang relevan sesuai jenis surat yang dipilih.
3. WHEN permohonan surat dikirim THEN pengurus SHALL menerima notifikasi dan dapat menyetujui atau menolak permohonan.
4. WHEN pengurus menyetujui permohonan THEN sistem SHALL generate surat otomatis menggunakan template yang sudah dikonfigurasi, dilengkapi tanda tangan digital dan cap RT/RW.
5. WHEN surat selesai diproses THEN sistem SHALL mengirim notifikasi ke warga dan surat dapat diunduh dalam format PDF.
6. WHEN pengurus membuka riwayat surat THEN sistem SHALL menampilkan semua surat yang pernah diterbitkan beserta statusnya.
7. IF pengurus menolak permohonan surat THEN sistem SHALL mengirim notifikasi ke warga beserta alasan penolakan.

---

### Requirement 3 — Broadcast & Pengumuman

**User Story:** Sebagai pengurus RT/RW, saya ingin menyebarkan informasi dan undangan kegiatan ke seluruh warga sekaligus, agar komunikasi lebih efisien.

#### Acceptance Criteria

1. WHEN pengurus membuat broadcast THEN sistem SHALL menyediakan pilihan target penerima: semua warga, per RW, per RT, atau warga tertentu.
2. WHEN pengurus mengirim broadcast THEN sistem SHALL mengirimkan pesan ke WhatsApp seluruh warga yang dituju secara otomatis.
3. WHEN pengurus membuat broadcast THEN sistem SHALL mendukung konten teks, gambar, dan lampiran dokumen.
4. WHEN broadcast dikirim THEN sistem SHALL mencatat status pengiriman dan waktu pengiriman.
5. WHEN pengurus membuat broadcast kegiatan (arisan, kerja bakti, posyandu, dll) THEN sistem SHALL menyertakan detail: tanggal, waktu, lokasi, dan deskripsi kegiatan.
6. WHEN warga membuka aplikasi THEN sistem SHALL menampilkan papan pengumuman dengan semua broadcast terbaru.

---

### Requirement 4 — Poling / Voting Komunitas

**User Story:** Sebagai pengurus RT/RW, saya ingin mengadakan poling untuk pengambilan keputusan bersama warga, agar proses demokrasi komunitas lebih transparan.

#### Acceptance Criteria

1. WHEN pengurus membuat poling THEN sistem SHALL meminta: judul poling, deskripsi, pilihan jawaban, dan batas waktu voting.
2. WHEN poling dibuat THEN sistem SHALL mengirim notifikasi via WhatsApp ke seluruh warga yang berhak memilih beserta link poling.
3. WHEN warga mengakses poling THEN sistem SHALL memastikan setiap warga hanya bisa memilih satu kali (one vote per warga).
4. WHEN warga telah memilih THEN sistem SHALL menampilkan hasil sementara poling secara real-time.
5. WHEN batas waktu poling berakhir THEN sistem SHALL menutup poling otomatis dan menampilkan hasil final.
6. WHEN poling selesai THEN sistem SHALL mengirim notifikasi hasil poling ke semua warga via WhatsApp.
7. WHEN pengurus membuka riwayat poling THEN sistem SHALL menampilkan semua poling beserta hasil dan rekap partisipasi warga.
8. WHEN poling bertipe pemilihan pengurus (RT/RW) THEN sistem SHALL mendukung upload foto dan profil singkat kandidat.

---

### Requirement 5 — Direktori Warga & Data Rumah

**User Story:** Sebagai warga, saya ingin melihat data penghuni setiap rumah di lingkungan saya, agar mudah mengenal tetangga dan menghubungi mereka.

#### Acceptance Criteria

1. WHEN warga membuka direktori THEN sistem SHALL menampilkan list rumah berupa nomor rumah, alamat, dan daftar penghuni.
2. WHEN warga memilih satu rumah THEN sistem SHALL menampilkan detail: nama KK, nama anggota keluarga, nomor telepon, dan status hunian (pemilik/kontrak).
3. WHEN warga ingin menghubungi penghuni THEN sistem SHALL menyediakan tombol langsung ke WhatsApp nomor yang bersangkutan.
4. WHEN pengurus menambah warga baru THEN sistem SHALL meminta data: nama, NIK, nomor rumah, nomor telepon, dan status hunian.
5. WHEN warga pindah atau meninggal THEN pengurus SHALL dapat mengupdate atau menonaktifkan data warga tersebut.
6. WHEN warga membuka direktori THEN sistem SHALL mendukung fitur pencarian berdasarkan nama atau nomor rumah.
7. IF warga belum terdaftar THEN sistem SHALL memungkinkan pengurus untuk mendaftarkan warga baru.
8. WHEN data warga diupdate THEN sistem SHALL mencatat riwayat perubahan data beserta waktu dan siapa yang mengubah.

---

### Requirement 6 — Direktori Commerce / Usaha Warga

**User Story:** Sebagai warga, saya ingin mengetahui usaha atau jasa yang dimiliki tetangga saya, agar dapat mendukung ekonomi lokal dan memudahkan pencarian layanan.

#### Acceptance Criteria

1. WHEN warga mendaftarkan usaha THEN sistem SHALL meminta: nama usaha, kategori (jasa/produk), deskripsi, foto produk/usaha, dan nomor WhatsApp.
2. WHEN warga membuka direktori commerce THEN sistem SHALL menampilkan list usaha warga dengan filter berdasarkan kategori (jasa servis HP, jasa bersih-bersih, sembako, kuliner, dll).
3. WHEN warga memilih satu usaha THEN sistem SHALL menampilkan detail usaha beserta foto dan daftar produk/layanan.
4. WHEN warga ingin memesan atau bertanya THEN sistem SHALL menyediakan tombol "Hubungi via WhatsApp" yang langsung terhubung ke nomor pemilik usaha.
5. WHEN pemilik usaha mengupdate produk THEN sistem SHALL menyimpan daftar produk dengan nama, harga, dan foto.
6. WHEN warga mencari layanan tertentu THEN sistem SHALL mendukung pencarian berdasarkan nama usaha atau kategori.
7. WHEN usaha warga tidak aktif lagi THEN pemilik atau pengurus SHALL dapat menonaktifkan listing usaha tersebut.

---

### Requirement 7 — Papan Informasi / Pengumuman Komunitas

**User Story:** Sebagai warga, saya ingin melihat informasi kegiatan dan acara di lingkungan saya, agar tidak ketinggalan acara penting seperti hajatan, sunatan, atau pengajian.

#### Acceptance Criteria

1. WHEN warga atau pengurus memposting informasi THEN sistem SHALL menampilkan di papan informasi dengan kategori: Hajatan, Sunatan, Pengajian/Tabligh Akbar, Duka Cita, Kegiatan Sosial, dan Lainnya.
2. WHEN informasi diposting THEN sistem SHALL menampilkan: judul, isi informasi, tanggal acara, lokasi, dan foto (opsional).
3. WHEN informasi baru diposting THEN sistem SHALL mengirim notifikasi ke warga via push notification atau WhatsApp (berdasarkan konfigurasi).
4. WHEN warga membuka papan informasi THEN sistem SHALL menampilkan informasi terurut dari yang terbaru, dengan filter berdasarkan kategori.
5. WHEN informasi sudah kedaluwarsa (tanggal acara sudah lewat) THEN sistem SHALL secara otomatis mengarsipkan informasi tersebut.
6. WHEN warga melihat informasi hajatan THEN sistem SHALL menampilkan tombol konfirmasi kehadiran (RSVP) opsional.

---

### Requirement 8 — Manajemen Pengguna & Role

**User Story:** Sebagai administrator sistem, saya ingin mengelola role pengguna dengan berbeda-beda level akses, agar keamanan dan kewenangan data terjaga.

#### Acceptance Criteria

1. WHEN sistem dikonfigurasi THEN sistem SHALL mendukung role: Super Admin (Desa/Kelurahan), Admin RW, Admin RT, dan Warga.
2. WHEN Admin RT login THEN sistem SHALL memberikan akses penuh hanya untuk data RT-nya sendiri.
3. WHEN Admin RW login THEN sistem SHALL memberikan akses ke semua data RT di bawah RW-nya.
4. WHEN Super Admin login THEN sistem SHALL memberikan akses ke semua data RW dan RT di wilayahnya.
5. WHEN warga login THEN sistem SHALL memberikan akses terbatas: hanya bisa melihat data yang relevan, mengajukan surat, membayar iuran, dan berpartisipasi dalam poling.
6. WHEN pengguna mendaftar THEN sistem SHALL memerlukan verifikasi dari admin sebelum akun aktif.
7. WHEN admin menonaktifkan akun THEN sistem SHALL segera mencabut akses pengguna tersebut.

---

### Requirement 9 — Notifikasi & Integrasi WhatsApp

**User Story:** Sebagai warga, saya ingin menerima notifikasi penting via WhatsApp, agar saya tetap terinformasi meskipun tidak membuka aplikasi.

#### Acceptance Criteria

1. WHEN sistem mengirim pesan WhatsApp THEN sistem SHALL menggunakan WhatsApp Business API atau gateway WhatsApp yang terintegrasi.
2. WHEN pesan tagihan dikirim THEN sistem SHALL menyertakan detail: nama warga, daftar iuran, nominal masing-masing, total tagihan, dan link/cara pembayaran.
3. WHEN notifikasi dikirim THEN sistem SHALL mencatat log pengiriman: waktu kirim, nomor tujuan, status (terkirim/gagal).
4. IF pengiriman WhatsApp gagal THEN sistem SHALL mencoba ulang pengiriman maksimal 3 kali dan mencatat kegagalan.
5. WHEN pengurus mengatur jadwal pengiriman notifikasi THEN sistem SHALL mendukung penjadwalan otomatis (cron/scheduler).

---

### Requirement 10 — Dashboard & Laporan

**User Story:** Sebagai pengurus RT/RW, saya ingin melihat ringkasan kondisi lingkungan saya di satu halaman, agar mudah memantau keadaan RT/RW.

#### Acceptance Criteria

1. WHEN pengurus membuka dashboard THEN sistem SHALL menampilkan: total warga aktif, total iuran terkumpul bulan ini, iuran yang belum terbayar, dan jumlah pengajuan surat pending.
2. WHEN pengurus membuka laporan iuran THEN sistem SHALL dapat memfilter berdasarkan periode, jenis iuran, dan status pembayaran.
3. WHEN pengurus membuka laporan warga THEN sistem SHALL menampilkan statistik: warga aktif, warga baru bulan ini, dan warga yang pindah.
4. WHEN pengurus membutuhkan laporan THEN sistem SHALL menyediakan export ke format PDF dan Excel.
5. WHEN Super Admin membuka dashboard THEN sistem SHALL menampilkan agregat data dari semua RT dan RW di bawah wilayahnya.
