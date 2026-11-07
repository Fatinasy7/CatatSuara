<laravel-boost-guidelines>
# Aplikasi Laravel

Repositori ini berisi aplikasi Laravel. Selesaikan persiapan berikut sebelum mengerjakan permintaan pengguna.

## Prasyarat

Pastikan PHP dan Composer tersedia:

```sh
php -v
composer -V
```

Jika salah satu perintah tidak tersedia, deteksi sistem operasi pengguna dan instal prasyarat dengan perintah yang sesuai:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

Setelah instalasi, minta pengguna memulai ulang terminalnya. Jika agen memerlukan shell yang telah dimulai ulang untuk melanjutkan, minta pengguna membuka ulang terminal dan menjalankan kembali permintaan awalnya.

## Penyiapan Agen

Instal Laravel Boost dari direktori utama aplikasi sebelum membuat perubahan pada aplikasi:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost mengganti petunjuk bootstrap ini dengan panduan yang disesuaikan untuk aplikasi. Setelah instalasi, baca kembali `AGENTS.md` dan lanjutkan permintaan pengguna menggunakan panduan yang dihasilkan.
</laravel-boost-guidelines>
