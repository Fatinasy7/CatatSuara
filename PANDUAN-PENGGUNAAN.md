# Panduan Penggunaan CatatSuara

## Status aplikasi saat ini

Repositori ini saat ini masih berupa kerangka Laravel, belum berupa aplikasi pencatatan suara yang siap digunakan. Rute web hanya menampilkan halaman sambutan bawaan Laravel. Belum tersedia:

- halaman atau rute login;
- pendaftaran atau pengelolaan akun melalui antarmuka;
- halaman utama setelah login;
- fitur merekam, mengunggah, atau mengelola catatan suara.

Karena itu, setelah membuka `http://127.0.0.1:8000`, yang tampil adalah halaman sambutan Laravel. Belum ada akun yang bisa dipakai untuk masuk melalui browser.

## Akun pengguna uji di basis data

Jika inisialisasi dilakukan dengan `php artisan migrate --seed`, seeder membuat satu baris pengguna:

| Kolom | Nilai |
|---|---|
| Nama | Test User |
| Email | `test@example.com` |
| Kata sandi awal | `password` |

Kata sandi tersebut disimpan dalam bentuk hash di basis data. Akun ini hanya data pengguna uji; karena halaman dan rute autentikasi belum tersedia, email dan kata sandi tersebut **tidak dapat digunakan untuk login di aplikasi saat ini**. Akun ini juga bukan kredensial MySQL Laragon.

Jangan gunakan kata sandi contoh ini untuk akun atau lingkungan yang berisi data sungguhan.

## Penggunaan yang bisa dilakukan saat ini

1. Jalankan aplikasi sesuai [panduan instalasi Laragon](PANDUAN-LARAGON.md).
2. Buka `http://127.0.0.1:8000` di browser.
3. Halaman yang ditampilkan adalah halaman sambutan Laravel. Belum ada alur penggunaan CatatSuara lain yang dapat dilakukan.

Untuk menyediakan login dan fitur CatatSuara, aplikasi perlu dikembangkan lebih lanjut, termasuk menambahkan autentikasi, antarmuka, dan fungsi pencatatan suara. Jangan menganggap akun seeder sebagai bukti bahwa login sudah diimplementasikan.
