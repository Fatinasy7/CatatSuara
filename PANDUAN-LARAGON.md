# Panduan Menjalankan SoraFin dengan Laragon

Panduan ini untuk Windows dan Laragon. Ikuti langkahnya dari atas ke bawah. Perintah terminal di bawah dijalankan dari folder proyek, kecuali jika disebutkan lain.

## 1. Siapkan perangkat lunak

Pasang Laragon Full, lalu pastikan lingkungan yang digunakan menyediakan:

- PHP 8.3 atau lebih baru
- Composer 2
- MySQL atau MariaDB
- Node.js dan npm

Proyek ini menggunakan Laravel 13 dan mensyaratkan PHP 8.3+. Sesudah memasang Laragon, buka Laragon dan pilih **Start All**. Pastikan PHP, Composer, dan Node.js tersedia di terminal Laragon. Periksa versinya:

```powershell
php -v
composer -V
node -v
npm -v
```

Jika PHP di terminal bukan versi PHP Laragon yang dipilih, buka terminal melalui Laragon atau sesuaikan PATH dan versi PHP aktif Laragon.

## 2. Letakkan proyek di folder Laragon

Letakkan folder proyek sehingga struktur berikut tersedia:

```text
C:\laragon\www\SoraFin\artisan
```

Jika belum memiliki salinan proyek, clone dari GitHub di PowerShell:

```powershell
Set-Location C:\laragon\www
git clone https://github.com/Fatinasy7/CatatSuara.git SoraFin
Set-Location C:\laragon\www\SoraFin
```

Jika proyek sudah ada di lokasi lain, gunakan folder tersebut sebagai gantinya. Pastikan terminal berada di folder yang berisi file `artisan`.

## 3. Pasang dependensi PHP

```powershell
composer install
```

Perintah ini memasang paket yang didefinisikan proyek. Jalankan lagi setelah dependensi proyek diperbarui.

## 4. Buat basis data MySQL

Di Laragon, buka **Menu > Database** untuk membuka alat basis data yang tersedia (misalnya HeidiSQL). Sambungkan ke MySQL lokal dan buat basis data bernama `catatsuara`, dengan charset `utf8mb4` dan collation `utf8mb4_unicode_ci`.

Jika menggunakan konsol MySQL, perintahnya:

```sql
CREATE DATABASE catatsuara CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Laragon sering menggunakan pengguna `root` tanpa kata sandi secara lokal, tetapi konfigurasi bisa berbeda. Gunakan host, port, pengguna, dan kata sandi yang benar-benar berlaku di Laragon Anda.

## 5. Atur file lingkungan

Buat file `.env` dari contoh hanya jika belum ada:

```powershell
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
```

Jika `.env` sudah ada, jangan menimpanya; buka file tersebut dan sesuaikan nilai dasar berikut:

```dotenv
APP_NAME=SoraFin
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=catatsuara
DB_USERNAME=root
DB_PASSWORD=
```

Isi `DB_PASSWORD` jika MySQL Laragon Anda memakai kata sandi. Jangan membagikan atau mengunggah file `.env`; file ini berisi konfigurasi lokal dan kunci aplikasi.

## 6. Buat kunci aplikasi dan tabel

Jalankan:

```powershell
php artisan key:generate
php artisan migrate --seed
```

`key:generate` mengisi `APP_KEY` di `.env`. Migrasi membuat tabel yang dibutuhkan. Seeder awal membuat data pengguna uji; lihat [panduan penggunaan dan akun](PANDUAN-PENGGUNAAN.md).

Jangan menjalankan `php artisan migrate:fresh` pada basis data yang berisi data penting: perintah tersebut menghapus semua tabel sebelum membuatnya kembali.

## 7. Pasang dan bangun aset frontend

```powershell
npm install
npm run build
```

Ulangi `npm run build` setelah mengubah aset frontend untuk digunakan tanpa Vite dev server.

## 8. Jalankan aplikasi

Pastikan MySQL Laragon masih aktif. Di terminal pada folder proyek, jalankan:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

Buka alamat ini di browser:

```text
http://127.0.0.1:8000
```

Biarkan terminal tersebut tetap terbuka selama aplikasi digunakan. Untuk menghentikan server, tekan **Ctrl+C**. Jika port 8000 sedang dipakai, hentikan proses yang menggunakannya atau pilih port lain dan gunakan port yang sama pada alamat browser.

`artisan serve` menyediakan web server pengembangan Laravel, sehingga Apache Laragon tidak harus digunakan untuk menyajikan aplikasi ini. Laragon tetap digunakan untuk layanan MySQL. Jika memilih konfigurasi virtual host Apache/Nginx Laragon, document root situs Laravel harus diarahkan ke folder `public` proyek.

## 9. Saat menjalankan lagi

1. Buka Laragon dan pilih **Start All** (atau pastikan MySQL sudah aktif).
2. Buka terminal di folder proyek.
3. Jalankan `php artisan serve --host=127.0.0.1 --port=8000`.
4. Buka `http://127.0.0.1:8000`.

Tidak perlu mengulang `composer install`, `npm install`, `key:generate`, atau migrasi setiap kali aplikasi dijalankan.

## Pemecahan masalah singkat

- **`Unknown database 'catatsuara'`**: buat basis data dengan nama tersebut dan periksa `DB_DATABASE` di `.env`.
- **Koneksi MySQL ditolak**: pastikan MySQL Laragon aktif dan periksa `DB_HOST`, `DB_PORT`, `DB_USERNAME`, serta `DB_PASSWORD`.
- **`could not find driver`**: pastikan PHP Laragon yang aktif memiliki ekstensi PDO MySQL dan versi PHP yang benar sedang dipakai terminal.
- **`No application encryption key has been specified`**: jalankan `php artisan key:generate`.
- **Halaman tidak terbuka**: pastikan `php artisan serve` masih berjalan dan alamat serta port di browser sama dengan yang ditampilkan terminal.
- **Perubahan tampilan/aset tidak terlihat**: jalankan kembali `npm run build`, lalu muat ulang browser.
- **Konfigurasi lama masih terbaca setelah mengubah `.env`**: jalankan `php artisan config:clear`.

Untuk keterangan fitur aplikasi dan akun uji, baca [PANDUAN-PENGGUNAAN.md](PANDUAN-PENGGUNAAN.md).
