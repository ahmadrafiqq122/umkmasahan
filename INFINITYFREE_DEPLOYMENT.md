# 🚀 DEPLOY KE INFINITYFREE - PANDUAN LENGKAP

## ✅ STEP 1: Daftar & Create Account (SELESAI)

Setelah website provisioning selesai di InfinityFree, Anda akan dapat:
- Website URL: `umkmasahan.rf.gd` (atau sesuai pilihan)
- cPanel URL
- FTP credentials

---

## 📂 STEP 2: Upload Files via FTP

### **A. Download FTP Client**

**Option 1: FileZilla (Recommended)**
- Download: https://filezilla-project.org/download.php?type=client
- Install di Mac Anda

**Option 2: Finder (Built-in Mac)**
- Bisa pakai Finder langsung untuk FTP

---

### **B. FTP Connection Details**

Dari InfinityFree Client Area → Klik website Anda → **"FTP Details"**

```
FTP Hostname: ftpupload.net (atau sesuai panel)
FTP Username: epiz_XXXXXXX (dari panel)
FTP Password: [password yang Anda buat]
FTP Port: 21
```

---

### **C. Connect via FileZilla**

1. Buka FileZilla
2. File → Site Manager → New Site
3. Isi:
   - **Host:** `ftpupload.net`
   - **Port:** `21`
   - **Protocol:** FTP
   - **Encryption:** Use explicit FTP over TLS if available
   - **Logon Type:** Normal
   - **User:** [FTP Username dari panel]
   - **Password:** [FTP Password]
4. Klik **"Connect"**

---

### **D. Upload Files**

**Di FileZilla:**

**Sisi Kiri (Local):** 
- Navigate ke: `/Applications/XAMPP/xamppfiles/htdocs/umkm`

**Sisi Kanan (Remote):**
- Navigate ke: `/htdocs/`

**Upload semua file & folder KECUALI:**
- ❌ `vendor/` (ukuran besar, akan install via Composer)
- ❌ `node_modules/` (tidak perlu)
- ❌ `.git/` (tidak perlu)
- ❌ `storage/logs/` (akan di-generate otomatis)

**Upload file/folder ini:**
- ✅ `app/`
- ✅ `bootstrap/`
- ✅ `config/`
- ✅ `database/`
- ✅ `public/`
- ✅ `resources/`
- ✅ `routes/`
- ✅ `storage/` (struktur folder saja, kosongkan logs)
- ✅ `.env.example`
- ✅ `.htaccess` (root)
- ✅ `artisan`
- ✅ `composer.json`
- ✅ `composer.lock`
- ✅ Semua file lainnya

**⏳ Upload memakan waktu 5-10 menit**

---

## 🗄️ STEP 3: Setup Database

### **A. Create Database**

1. Dari InfinityFree Client Area → Klik website → **"Control Panel"**
2. Di cPanel, cari **"MySQL Databases"**
3. **Create New Database:**
   - Database Name: `umkmasahan`
   - Klik **"Create Database"**

4. **Create Database User:**
   - Username: `umkm_user`
   - Password: [buat password kuat]
   - Klik **"Create User"**

5. **Add User to Database:**
   - User: `umkm_user`
   - Database: `umkmasahan`
   - Privileges: **ALL PRIVILEGES**
   - Klik **"Add"**

6. **Catat credentials:**
   ```
   DB_HOST: sql123.infinityfree.com (atau sesuai panel)
   DB_PORT: 3306
   DB_DATABASE: epiz_XXXXX_umkmasahan
   DB_USERNAME: epiz_XXXXX_umkm_user
   DB_PASSWORD: [password yang dibuat]
   ```

---

### **B. Import Database**

1. Di cPanel, buka **"phpMyAdmin"**
2. Klik database: `epiz_XXXXX_umkmasahan`
3. Tab **"Import"**
4. Klik **"Choose File"**
5. Upload file: `create_db.sql` (dari project Anda)
6. Klik **"Go"**

**ATAU Run Migrations via Artisan (lebih mudah):**
- Akan dijelaskan di STEP 5

---

## 🔧 STEP 4: Setup .env File

### **A. Via File Manager**

1. cPanel → **"Online File Manager"**
2. Navigate ke: `/htdocs/`
3. Copy file `.env.example` → rename jadi `.env`
4. Edit file `.env`:

```env
APP_NAME="Peta Digital UMKM Asahan"
APP_ENV=production
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXXXXX
APP_DEBUG=false
APP_URL=https://umkmasahan.rf.gd

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=sql123.infinityfree.com
DB_PORT=3306
DB_DATABASE=epiz_XXXXX_umkmasahan
DB_USERNAME=epiz_XXXXX_umkm_user
DB_PASSWORD=[your_db_password]

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=disperindagkop.asahan@gmail.com
MAIL_PASSWORD=[Gmail App Password]
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=disperindagkop.asahan@gmail.com
MAIL_FROM_NAME="Peta Digital UMKM Asahan"

MAP_CENTER_LAT=2.9833
MAP_CENTER_LNG=99.6167
MAP_ZOOM=11
```

5. **Save file**

---

### **B. Generate APP_KEY**

Di komputer lokal, jalankan:
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/umkm
php artisan key:generate --show
```

Copy hasilnya (contoh: `base64:xxxxx`) dan paste ke `.env` di server.

---

## 📦 STEP 5: Install Composer Dependencies

InfinityFree tidak support terminal SSH langsung, jadi kita gunakan alternatif:

### **Option A: Upload vendor/ (Mudah tapi lama)**

Di komputer lokal:
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/umkm
composer install --no-dev --optimize-autoloader
```

Upload folder `vendor/` ke server via FTP (akan lama karena banyak file).

### **Option B: Buat script PHP untuk install (Recommended)**

1. Buat file: `/htdocs/install.php`
2. Isi dengan:

```php
<?php
// Installer script - DELETE after use!
set_time_limit(300);

echo "<h1>Installing Composer Dependencies...</h1>";
echo "<pre>";

// Run composer install
$output = shell_exec('cd /home/epiz_XXXXX/htdocs && composer install --no-dev --optimize-autoloader 2>&1');
echo $output;

echo "\n\n<h2>Running Migrations...</h2>";
$output = shell_exec('cd /home/epiz_XXXXX/htdocs && php artisan migrate --force 2>&1');
echo $output;

echo "\n\n<h2>Seeding Database...</h2>";
$output = shell_exec('cd /home/epiz_XXXXX/htdocs && php artisan db:seed --force 2>&1');
echo $output;

echo "\n\n<h2>Creating Storage Link...</h2>";
$output = shell_exec('cd /home/epiz_XXXXX/htdocs && php artisan storage:link 2>&1');
echo $output;

echo "\n\n<h2>Caching Config...</h2>";
$output = shell_exec('cd /home/epiz_XXXXX/htdocs && php artisan config:cache 2>&1');
echo $output;

echo "</pre>";
echo "<h1 style='color: green;'>DONE! Delete this file now.</h1>";
?>
```

3. Ganti `/home/epiz_XXXXX/htdocs` dengan path yang benar (cek di cPanel)
4. Upload file ini
5. Akses: `https://umkmasahan.rf.gd/install.php`
6. Tunggu proses selesai
7. **DELETE file install.php setelah selesai!**

---

## ✅ STEP 6: Set Permissions

Via File Manager:
1. Folder `storage/` → Right click → Change Permissions → `755`
2. Folder `bootstrap/cache/` → Right click → Change Permissions → `755`

---

## 🎉 STEP 7: Akses Website

1. Buka: `https://umkmasahan.rf.gd` (atau subdomain Anda)
2. Website should load!
3. Login Admin:
   - Email: `admin@disperindagkop.asahan.go.id`
   - Password: `Admin123!`

---

## 🔧 TROUBLESHOOTING

### **Error 500**
- Cek `.env` sudah benar
- Cek `APP_KEY` sudah di-generate
- Cek database credentials

### **Composer not found**
- InfinityFree mungkin tidak support shell_exec
- Gunakan Option A: Upload vendor/ manual

### **Storage link failed**
- Normal di shared hosting
- Akses images via URL langsung: `/storage/app/public/`

### **Migration failed**
- Import `create_db.sql` via phpMyAdmin
- Atau jalankan migration via install.php

---

## 📊 CHECKLIST DEPLOYMENT

- [ ] Daftar InfinityFree
- [ ] Create website account
- [ ] Upload files via FTP (except vendor)
- [ ] Create database & user
- [ ] Setup .env file
- [ ] Generate APP_KEY
- [ ] Install composer dependencies
- [ ] Run migrations
- [ ] Seed database
- [ ] Set folder permissions
- [ ] Test website
- [ ] Login admin
- [ ] Test all features

---

## 🆘 BANTUAN

Jika stuck di step tertentu, beritahu saya:
1. Step mana yang bermasalah
2. Screenshot error
3. Apa yang sudah dicoba

**Good luck!** 🚀
