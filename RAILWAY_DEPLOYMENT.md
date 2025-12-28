# 🚂 Panduan Deploy ke Railway - Peta Digital UMKM Asahan

## 📋 Prasyarat
- Akun Railway (daftar di [railway.app](https://railway.app))
- GitHub account (untuk connect repository)
- Project sudah di-push ke GitHub

---

## 🚀 Langkah Deploy

### 1️⃣ **Setup Project di Railway**

1. Login ke [Railway Dashboard](https://railway.app)
2. Klik **"New Project"**
3. Pilih **"Deploy from GitHub repo"**
4. Pilih repository project Anda
5. Railway akan auto-detect Laravel project

### 2️⃣ **Tambah MySQL Database**

1. Di project Railway, klik **"+ New"**
2. Pilih **"Database"** → **"Add MySQL"**
3. Railway akan otomatis membuat database dan connection string
4. Database variables akan otomatis ter-inject ke aplikasi

### 3️⃣ **Set Environment Variables**

Klik tab **"Variables"** pada service Laravel Anda, lalu tambahkan:

#### **Required Variables:**
```bash
# Application
APP_NAME="Peta Digital UMKM Asahan"
APP_ENV=production
APP_DEBUG=false
APP_KEY=                          # Akan auto-generate
APP_URL=${{ RAILWAY_PUBLIC_DOMAIN }}  # Railway auto-inject

# Database - Railway auto-inject dari MySQL service:
# DB_CONNECTION=mysql
# DB_HOST=${{ MYSQL_HOST }}
# DB_PORT=${{ MYSQL_PORT }}
# DB_DATABASE=${{ MYSQL_DATABASE }}
# DB_USERNAME=${{ MYSQL_USER }}
# DB_PASSWORD=${{ MYSQL_PASSWORD }}

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Email (Gmail SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=disperindagkop.asahan@gmail.com
MAIL_PASSWORD=                    # ⚠️ Gunakan App Password Gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=disperindagkop.asahan@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# Map Configuration
MAP_CENTER_LAT=2.9833
MAP_CENTER_LNG=99.6167
MAP_ZOOM=11

# Deployment Options
SEED_DATABASE=true                # Set 'true' untuk seed admin pertama kali
```

#### **📧 Cara Dapat Gmail App Password:**
1. Buka [Google Account Security](https://myaccount.google.com/security)
2. Enable **2-Step Verification** (wajib)
3. Buka **App Passwords** (atau cari "app passwords")
4. Generate password untuk "Mail"
5. Copy password 16 karakter → paste ke `MAIL_PASSWORD`

### 4️⃣ **Database Connection (Auto)**

Railway MySQL akan otomatis inject variables:
- `MYSQL_HOST` → `DB_HOST`
- `MYSQL_PORT` → `DB_PORT`  
- `MYSQL_DATABASE` → `DB_DATABASE`
- `MYSQL_USER` → `DB_USERNAME`
- `MYSQL_PASSWORD` → `DB_PASSWORD`

**Anda tidak perlu set manual!** Railway sudah handle ini.

### 5️⃣ **Deploy & Monitor**

1. **Push ke GitHub** → Railway auto-deploy
2. **Lihat Logs** di tab "Deployments" untuk monitoring
3. **Check Build** - pastikan tidak ada error
4. **Akses Domain** - Railway berikan domain gratis: `xxx.railway.app`

### 6️⃣ **First Time Setup (Setelah Deploy)**

Jika `SEED_DATABASE=true`, admin default sudah dibuat:
- **Email:** admin@disperindagkop.asahan.go.id
- **Password:** Admin123!

**⚠️ PENTING:** Setelah login pertama kali, segera:
1. Ubah password admin
2. Set `SEED_DATABASE=false` di Railway variables

---

## 🔧 Update/Redeploy

### Auto Deploy (Recommended)
Push perubahan ke GitHub branch yang terconnect:
```bash
git add .
git commit -m "Update feature"
git push origin main
```
Railway akan otomatis deploy!

### Manual Redeploy
Di Railway Dashboard → **"Deployments"** → **"Redeploy"**

### Rollback
Di Railway Dashboard → **"Deployments"** → Pilih deployment lama → **"Redeploy"**

---

## 🐛 Troubleshooting

### ❌ Error: "Please provide a valid APP_KEY"
**Solusi:**
```bash
# Di Railway service settings → Variables
APP_KEY=base64:xxxxxxxxxxxxx
```
Generate key: `php artisan key:generate --show` di local, copy hasilnya

### ❌ Error: "SQLSTATE[HY000] [2002] Connection refused"
**Penyebab:** Database belum terconnect

**Solusi:**
1. Pastikan MySQL service sudah dibuat
2. Cek tab "Variables" - apakah ada `MYSQL_*` variables?
3. Restart deployment

### ❌ Error: "Storage link not created"
**Normal!** Railway akan handle ini di `railway-entrypoint.sh`

### ❌ Email tidak terkirim
**Cek:**
1. `MAIL_PASSWORD` sudah App Password (bukan password Gmail biasa)
2. 2-Step Verification sudah aktif di Gmail
3. Coba kirim test email dari aplikasi, cek log Railway

### ❌ 500 Internal Server Error
**Cek Railway Logs:**
```
Railway Dashboard → Service → Logs
```
Lihat error detail di sana

---

## 💰 Biaya Railway

### Free Tier (Hobby Plan):
- ✅ $5 credit/bulan (cukup untuk 1 project kecil)
- ✅ MySQL database included
- ✅ Custom domain support
- ⚠️ Server sleep jika tidak ada traffic (startup ~10s)

### Pro Plan ($20/bulan):
- ✅ No sleep
- ✅ Multiple projects
- ✅ Better performance

**Estimasi project ini:** ~$3-5/bulan (masuk free tier)

---

## 📁 File-File Railway

Project ini sudah include:
- ✅ `Procfile` - Command untuk start aplikasi
- ✅ `nixpacks.toml` - Build configuration
- ✅ `railway-entrypoint.sh` - Deployment script

**Jangan dihapus!** File ini diperlukan Railway.

---

## 🌐 Custom Domain (Opsional)

1. Beli domain (Niagahoster, Rumahweb, dll)
2. Di Railway → Service → **"Settings"** → **"Domains"**
3. Tambah custom domain
4. Update DNS domain Anda:
   ```
   Type: CNAME
   Name: @ atau www
   Value: xxx.railway.app
   ```
5. Update `APP_URL` di Railway variables ke domain baru

---

## ✅ Checklist Deployment

- [ ] Push project ke GitHub
- [ ] Buat project baru di Railway
- [ ] Tambah MySQL database
- [ ] Set environment variables (terutama `MAIL_PASSWORD`)
- [ ] Deploy & tunggu selesai (cek logs)
- [ ] Akses domain Railway
- [ ] Login dengan admin default
- [ ] Ubah password admin
- [ ] Set `SEED_DATABASE=false`
- [ ] Test fitur registrasi & email verification
- [ ] Test upload foto usaha
- [ ] Test peta interaktif

---

## 📞 Support

Jika ada masalah:
1. Cek Railway logs terlebih dahulu
2. Cek file `TROUBLESHOOTING_EMAIL.md` untuk masalah email
3. Review konfigurasi environment variables

---

**✨ Selamat! Project Anda siap di-deploy ke Railway!**

> **Database Railway menggunakan `localhost`?**  
> **TIDAK!** Railway MySQL service punya host sendiri yang otomatis ter-inject via environment variables. Anda tidak perlu set manual.
