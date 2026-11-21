@echo off
cd /d "%~dp0"
echo === Instalasi Portofolio Laravel ===

where php >nul 2>nul || (echo PHP tidak ditemukan di PATH. Pasang PHP 8.3+ dulu. & pause & exit /b)
where composer >nul 2>nul || (echo Composer tidak ditemukan. Pasang dari getcomposer.org & pause & exit /b)

if not exist .env copy .env.example .env >nul

echo.
echo [1/5] composer install ...
call composer install --no-interaction
if errorlevel 1 (echo composer install gagal. & pause & exit /b)

echo.
echo [2/5] Membuat APP_KEY ...
php artisan key:generate --force

echo.
echo [3/5] Membuat database portfolio_db (butuh MySQL XAMPP menyala) ...
if exist "C:\xampp\mysql\bin\mysql.exe" (
  "C:\xampp\mysql\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
) else (
  echo MySQL XAMPP tidak ditemukan di C:\xampp. Buat database "portfolio_db" manual, lalu tekan tombol apa saja.
  pause
)

echo.
echo [4/5] Membuat tabel dan data awal ...
php artisan migrate --seed --force
if errorlevel 1 (echo Migrasi gagal. Pastikan MySQL menyala dan isi .env benar. & pause & exit /b)

echo.
echo [5/5] Menautkan folder upload ...
php artisan storage:link

echo.
echo Selesai! Membuka server di http://127.0.0.1:8000
echo Login admin: admin@portfolio.test / password123
start http://127.0.0.1:8000
php artisan serve
