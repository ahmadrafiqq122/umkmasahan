# Sistem Informasi Peta Digital Usaha Mikro
## Dinas Koperasi Perdagangan dan Perindustrian Kabupaten Asahan

### Deskripsi
Aplikasi web untuk pemetaan digital pelaku usaha mikro di Kabupaten Asahan dengan fitur manajemen data usaha dan visualisasi peta interaktif.

### Fitur Utama
- 🗺️ Peta Digital Interaktif Kabupaten Asahan
- 👥 Multi-role Authentication (Admin, User, Pengunjung)
- ✉️ Email Verification dengan Kode Validasi
- 📊 Dashboard Admin dengan Kontrol Penuh
- 📍 Marker Koordinat Usaha dengan Pop-up Detail
- 📸 Upload Foto Tempat Usaha dan Produk
- 🔍 Pencarian dan Filter Pelaku Usaha

### Teknologi
- Framework: Laravel 10.x
- Database: MySQL
- Frontend: HTML, CSS, JavaScript, Bootstrap 5
- Maps: Leaflet.js
- PHP Version: 8.1+

### Instalasi
```bash
# Clone repository
git clone <repository-url>

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Setup database di .env file
# DB_DATABASE=asahan_umkm
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed default admin
php artisan db:seed

# Setup storage link
php artisan storage:link

# Run application
php artisan serve
```



### Struktur Database
- users (Admin & Pelaku Usaha)
- businesses (Data Usaha Mikro)
- business_photos (Foto Usaha & Produk)
- verification_codes (Kode Verifikasi Email)

### Developer
AHMAD RAFIQ
