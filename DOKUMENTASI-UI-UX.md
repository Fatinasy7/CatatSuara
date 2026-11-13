# Dokumentasi UI/UX SoraFin

## Ringkasan

Antarmuka pada branch `UI-UX` mengadaptasi referensi visual SoraFin menjadi dashboard web responsif. Tampilan tersedia dalam Bahasa Indonesia dan menggunakan warna hijau, kartu ringkasan, grafik arus kas, tabel transaksi, serta navigasi desktop dan seluler.

## Halaman

- **Beranda** — ringkasan pemasukan, pengeluaran, estimasi laba, pencatatan suara/manual, grafik arus kas, dan transaksi terbaru.
- **Transaksi** — saldo, riwayat, pencarian, filter dompet/jenis transaksi, tambah/ubah/hapus transaksi, dan ekspor CSV.
- **Laporan KUR** — skor kelayakan contoh, ringkasan laba-rugi, data neraca, serta tampilan cetak yang dapat disimpan sebagai PDF melalui browser.
- **Pengaturan** — profil usaha, indikator penyimpanan/sinkronisasi, pengingat demo, ekspor data, dan penghapusan data demo.
- **Profil usaha** — formulir onboarding sederhana yang dibuka dari menu atau tombol profil.
- **Konfirmasi pencatatan** — dialog untuk memeriksa deskripsi, nominal, jenis, dan dompet sebelum transaksi ditambahkan.

## Interaksi

- Navigasi samping pada layar lebar dan navigasi bawah pada layar kecil membuka halaman tanpa memuat ulang.
- Formulir transaksi mendukung tambah dan ubah entri. Pencarian dan filter memperbarui tabel secara langsung.
- Contoh frasa suara mengisi dialog pencatatan. Jika browser mendukung Web Speech API dan pengguna memberi izin mikrofon, tombol mikrofon dapat mengisi deskripsi melalui pengenalan suara Bahasa Indonesia.
- Ekspor transaksi mengunduh CSV. Tombol laporan membuka dialog cetak browser; pilih **Simpan sebagai PDF** untuk membuat PDF.
- Perubahan profil, pengingat, dan transaksi hanya berlaku selama sesi halaman. Konfirmasi digunakan sebelum menghapus data demo.

## Batasan

Ini adalah implementasi UI/UX frontend dengan data contoh. Autentikasi, penyimpanan database, sinkronisasi cloud/Google Drive, WhatsApp, ekstraksi AI sungguhan, dan layanan pengajuan KUR belum dihubungkan. Angka laporan, status online, dan skor kelayakan adalah ilustrasi, bukan data keuangan aktual atau jaminan persetujuan pinjaman. Jangan memasukkan informasi pribadi atau keuangan sensitif.

## Menjalankan dan memverifikasi

```powershell
npm install --no-package-lock
npm run build
php artisan test --compact
```

Jalankan server pengembangan Laravel sesuai konfigurasi lokal proyek. Untuk fitur mikrofon, gunakan browser yang mendukung Web Speech API dan lingkungan aman (HTTPS atau localhost); input manual tetap tersedia bila pengenalan suara tidak tersedia.
