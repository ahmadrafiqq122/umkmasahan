# Panduan Instalasi - Peta Digital UMKM Asahan

## Sistem Requirement

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB >= 10.3
- Node.js >= 16.x dan NPM
- Web Server (Apache/Nginx)

## Langkah Instalasi

### 1. Clone atau Download Project

```bash
# Jika menggunakan git
git clone <repository-url> asahan-umkm
cd asahan-umkm

# Atau extract file ZIP jika di-download
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Konfigurasi Environment

```bash
# Copy file .env.example menjadi .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asahan_umkm
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Konfigurasi Email (SMTP)

Edit file `.env` untuk konfigurasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=disperindagkop.asahan@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="disperindagkop.asahan@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Catatan untuk Gmail:**
1. Aktifkan 2-Step Verification
2. Generate App Password di Google Account
3. Gunakan App Password sebagai MAIL_PASSWORD

### 7. Buat Database

Buat database MySQL:

```sql
CREATE DATABASE asahan_umkm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 8. Jalankan Migration dan Seeder

```bash
# Jalankan migration untuk membuat tabel
php artisan migrate

# Jalankan seeder untuk data awal (termasuk admin)
php artisan db:seed
```

### 9. Setup Storage Link

```bash
php artisan storage:link
```

### 10. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 11. Set Permission (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 12. Jalankan Aplikasi

**Development:**
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

**Production (Apache/Nginx):**
- Document root: `public/`
- Pastikan mod_rewrite aktif (Apache)
- Konfigurasi virtual host sesuai kebutuhan

## Login Default

### Admin
- Email: `admin@disperindagkop.asahan.go.id`
- Password: `Admin123!`

### User Demo (untuk testing)
- Email: `user@example.com`
- Password: `password`

## Konfigurasi Peta

Edit koordinat pusat peta di file `.env`:

```env
# Koordinat Kabupaten Asahan
MAP_CENTER_LAT=2.9833
MAP_CENTER_LNG=99.6167
MAP_ZOOM=11
```

## Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
php artisan clear-compiled
```

### Error Permission Denied
```bash
chmod -R 775 storage bootstrap/cache
```

### Error Migration
```bash
php artisan migrate:fresh --seed
```

### Cache Clear
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Konfigurasi Production

### 1. Set Environment
```env
APP_ENV=production
APP_DEBUG=false
```

### 2. Optimize Application
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### 3. Setup Queue (Optional)
```bash
php artisan queue:work
```

### 4. Setup Scheduler (Optional)
```bash
# Add to crontab
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Update Aplikasi

```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install
npm install

# Run migrations
php artisan migrate

# Clear cache
php artisan cache:clear

# Build assets
npm run build
```

## Backup Database

```bash
# Export database
mysqldump -u root -p asahan_umkm > backup_$(date +%Y%m%d).sql

# Import database
mysql -u root -p asahan_umkm < backup_20240101.sql
```

## Support

Untuk pertanyaan dan bantuan, hubungi:
- Email: disperindagkop@asahankab.go.id
- Website: https://asahankab.go.id
