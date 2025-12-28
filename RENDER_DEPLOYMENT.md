# 🚀 DEPLOY KE RENDER.COM - PANDUAN LENGKAP

## ✅ Kenapa Render.com?

- ✅ **100% GRATIS** untuk aplikasi web + database
- ✅ **Mudah Deploy** dari GitHub (auto-deploy)
- ✅ **MySQL/PostgreSQL Gratis**
- ✅ **SSL Certificate Gratis**
- ✅ **Custom Domain Support**
- ✅ **Auto Sleep** setelah 15 menit tidak aktif (free tier)

---

## 📋 LANGKAH DEPLOYMENT

### **STEP 1: Push File Konfigurasi ke GitHub**

File yang sudah dibuat:
- ✅ `render.yaml` - Konfigurasi deployment
- ✅ `render-build.sh` - Build script
- ✅ `.render-buildpacks.yml` - PHP buildpack

**Push ke GitHub:**

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/umkm
git add .
git commit -m "Add Render.com deployment configuration"
git push origin main
```

---

### **STEP 2: Buat Akun Render.com**

1. Buka **https://render.com**
2. Klik **"Get Started"** atau **"Sign Up"**
3. Pilih **"Sign up with GitHub"**
4. Authorize Render untuk akses GitHub
5. Verifikasi email jika diminta

---

### **STEP 3: Create New Web Service**

1. Di Render Dashboard, klik **"New +"**
2. Pilih **"Web Service"**
3. Connect ke GitHub repository: `ahmadrafiqq122/umkmasahan`
4. Klik **"Connect"**

---

### **STEP 4: Konfigurasi Web Service**

**Form Configuration:**

- **Name:** `umkmasahan`
- **Region:** `Oregon (US West)` atau pilih terdekat
- **Branch:** `main`
- **Root Directory:** (kosongkan)
- **Environment:** `PHP`
- **Build Command:**
  ```bash
  ./render-build.sh
  ```
- **Start Command:**
  ```bash
  php artisan migrate --force && php artisan db:seed --force || true && php -S 0.0.0.0:$PORT -t public
  ```

- **Plan:** **Free** (pilih ini!)

Klik **"Create Web Service"**

---

### **STEP 5: Create MySQL Database**

1. Di Render Dashboard, klik **"New +"**
2. Pilih **"MySQL"**
3. **Name:** `umkmasahan-db`
4. **Database:** `umkmasahan`
5. **User:** `umkmasahan_user`
6. **Region:** Sama dengan web service
7. **Plan:** **Free**
8. Klik **"Create Database"**

**⏳ Tunggu 2-3 menit** untuk provisioning database.

---

### **STEP 6: Set Environment Variables**

Kembali ke **Web Service `umkmasahan`** → Tab **"Environment"**

**Add Environment Variables:**

```
APP_NAME=Peta Digital UMKM Asahan
APP_ENV=production
APP_DEBUG=false
APP_KEY=[Will be auto-generated]
APP_URL=https://umkmasahan.onrender.com

DB_CONNECTION=mysql
DB_HOST=[Copy from MySQL service - Internal Database URL hostname]
DB_PORT=3306
DB_DATABASE=umkmasahan
DB_USERNAME=umkmasahan_user
DB_PASSWORD=[Copy from MySQL service]

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=disperindagkop.asahan@gmail.com
MAIL_PASSWORD=[Your Gmail App Password]
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=disperindagkop.asahan@gmail.com
MAIL_FROM_NAME=Peta Digital UMKM Asahan

MAP_CENTER_LAT=2.9833
MAP_CENTER_LNG=99.6167
MAP_ZOOM=11

SEED_DATABASE=true
```

**📝 Cara Dapat Database Credentials:**
1. Klik MySQL service `umkmasahan-db`
2. Tab **"Connect"**
3. Copy: **Internal Database URL** atau individual credentials
4. Paste ke environment variables web service

**Save Environment Variables**

---

### **STEP 7: Deploy!**

Render akan otomatis deploy setelah konfigurasi selesai.

**Monitor Deployment:**
1. Tab **"Logs"** - lihat progress real-time
2. Tunggu sampai status: **"Live"** (10-15 menit pertama kali)

**Log yang harus muncul:**
```
✅ Installing Composer dependencies
✅ Generating APP_KEY
✅ Caching configuration
✅ Running migrations
✅ Seeding database
✅ Server started
✅ Your service is live
```

---

### **STEP 8: Akses Website**

1. Di Web Service, lihat **URL** di bagian atas (misal: `umkmasahan.onrender.com`)
2. Klik URL atau buka di browser
3. Website Anda live! 🎉

**Login Admin:**
- Email: `admin@disperindagkop.asahan.go.id`
- Password: `Admin123!`

---

## ⚙️ KONFIGURASI TAMBAHAN

### **Custom Domain (Opsional)**

1. Web Service → Tab **"Settings"**
2. Scroll ke **"Custom Domains"**
3. Klik **"Add Custom Domain"**
4. Masukkan domain Anda: `umkm.asahankab.go.id`
5. Update DNS di domain registrar:
   - Type: `CNAME`
   - Name: `umkm` (atau `@` untuk root domain)
   - Value: `umkmasahan.onrender.com`
6. Render otomatis provision SSL certificate

### **Auto-Deploy dari GitHub**

Render sudah auto-deploy by default. Setiap push ke GitHub akan trigger deployment baru.

**Disable Auto-Deploy (jika perlu):**
1. Web Service → Tab **"Settings"**
2. **Auto-Deploy:** Toggle OFF

---

## 📊 FREE TIER LIMITS

Render Free Tier memberikan:
- ✅ **750 jam/bulan** (cukup untuk 1 app 24/7)
- ✅ **MySQL 1GB storage**
- ✅ **Auto-sleep** setelah 15 menit tidak aktif
- ✅ **Startup time ~30 detik** setelah sleep
- ✅ **100GB bandwidth/bulan**

**⚠️ Catatan:** Website akan sleep setelah 15 menit tidak ada traffic. Saat ada visitor baru, butuh ~30 detik untuk wake up.

---

## 🔄 UPDATE WEBSITE

Setiap kali ada perubahan:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/umkm
git add .
git commit -m "Update: deskripsi perubahan"
git push origin main
```

**Render akan otomatis re-deploy!**

---

## 🆘 TROUBLESHOOTING

| Error | Solusi |
|-------|--------|
| **Build Failed** | Cek Logs, pastikan `render-build.sh` executable: `chmod +x render-build.sh` |
| **Database Connection Failed** | Cek DB credentials di Environment Variables, pastikan DB sudah provisioned |
| **500 Error** | Cek Logs untuk detail, biasanya APP_KEY atau database issue |
| **Email Tidak Terkirim** | Pastikan Gmail App Password benar, 2FA aktif |
| **Slow First Load** | Normal untuk free tier (cold start ~30 detik) |

---

## ✅ CHECKLIST POST-DEPLOYMENT

- [ ] Website bisa diakses
- [ ] Login admin berhasil
- [ ] Database terisi (ada user admin)
- [ ] Email verifikasi terkirim (test register user baru)
- [ ] Form input usaha tampil dengan border tebal
- [ ] Responsive di HP
- [ ] Map berfungsi
- [ ] Upload foto bekerja
- [ ] Ubah password admin
- [ ] Set `SEED_DATABASE=false` setelah deploy pertama

---

## 🎯 KESIMPULAN

Render.com adalah solusi sempurna untuk deploy Laravel gratis dengan fitur lengkap!

**Keuntungan:**
- ✅ Gratis selamanya (free tier)
- ✅ Easy setup
- ✅ Auto-deploy dari GitHub
- ✅ SSL gratis
- ✅ MySQL/PostgreSQL gratis

**Kekurangan:**
- ⏰ Auto-sleep setelah 15 menit (startup ~30 detik)
- 📊 Limit 750 jam/bulan (cukup untuk 1 app)

---

**Website Anda siap online dengan Render.com!** 🚀
