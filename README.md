# Portofolio Dinamis - Laravel 13 + MySQL (tema full biru navy)

Ini project lengkap. Tidak ada langkah "timpa/replace" - cukup ekstrak lalu jalankan `setup.bat`.

## Yang harus terpasang di komputer baru
1. **XAMPP** (hanya MySQL yang dipakai; Apache tidak wajib)
2. **PHP 8.3 atau lebih baru** yang terdaftar di PATH (cek: `php -v`).
   Catatan: Laravel 13 butuh PHP 8.3+. Jika XAMPP Anda PHP 8.2, pasang PHP 8.3+ terpisah.
3. **Composer** - https://getcomposer.org
4. Koneksi internet (untuk `composer install` dan CDN Bootstrap)

## Cara menjalankan
1. Buka XAMPP Control Panel, klik **Start** pada **MySQL**.
2. Ekstrak zip, masuk ke folder `portfolio`.
3. Klik dua kali **setup.bat**. Skrip ini otomatis: composer install, buat APP_KEY, buat database
   `portfolio_db`, migrate + seed, storage:link, lalu menjalankan server.
4. Buka http://127.0.0.1:8000

Lain kali cukup klik dua kali **jalankan.bat** (MySQL tetap harus menyala).

## Login admin
http://127.0.0.1:8000/login - `admin@portfolio.test` / `password123` (segera ganti).

## Lewat terminal (tanpa setup.bat)
```
copy .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```
Pastikan database `portfolio_db` sudah dibuat dulu (phpMyAdmin atau `mysql -u root -e "CREATE DATABASE portfolio_db"`).

## Mengubah isi
Semua isi (profil, foto, CV, keahlian, proyek, sertifikat, pendidikan, pengalaman) diubah lewat dashboard admin.
Warna ada di bagian bawah `public/css/style.css` (blok TEMA FULL BIRU NAVY).

## Masalah umum
- `could not find driver`: aktifkan `extension=pdo_mysql` di php.ini (cek lokasinya: `php --ini`).
- `Connection refused`: MySQL belum menyala.
- Gambar tidak tampil: `php artisan storage:link`.
- Mengulang dari awal: `php artisan migrate:fresh --seed` (semua data terhapus).
