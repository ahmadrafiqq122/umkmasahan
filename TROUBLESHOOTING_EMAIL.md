# 🔧 Panduan Troubleshooting Email Verifikasi

## Masalah yang Ditemukan

Email verifikasi tidak terkirim karena:
1. ❌ `MAIL_PASSWORD` kosong di file `.env`
2. ❌ Gmail memblokir koneksi dari aplikasi

## Solusi Lengkap

### Opsi 1: Menggunakan Gmail dengan App Password (RECOMMENDED)

#### Langkah 1: Aktifkan 2-Step Verification di Gmail
1. Login ke akun Gmail: `disperindagkop.asahan@gmail.com`
2. Buka: https://myaccount.google.com/security
3. Cari **"2-Step Verification"** dan aktifkan
4. Ikuti petunjuk untuk setup (biasanya pakai nomor HP)

#### Langkah 2: Generate App Password
1. Setelah 2-Step Verification aktif, buka lagi: https://myaccount.google.com/security
2. Cari **"App passwords"** atau **"Sandi aplikasi"**
3. Klik untuk membuat app password baru
4. Pilih:
   - App: **Mail**
   - Device: **Other** (isi: "Laravel UMKM App")
5. Klik **Generate**
6. Google akan menampilkan 16 karakter password (contoh: `abcd efgh ijkl mnop`)
7. **SALIN PASSWORD INI!** (tanpa spasi)

#### Langkah 3: Update File .env
Edit file `.env` di root project:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=disperindagkop.asahan@gmail.com
MAIL_PASSWORD=abcdefghijklmnop  # <-- Paste 16 karakter app password (tanpa spasi)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="disperindagkop.asahan@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Langkah 4: Clear Cache Laravel
```bash
php artisan config:clear
php artisan cache:clear
```

#### Langkah 5: Test Email
Coba registrasi akun baru atau klik "Kirim Ulang Kode" di halaman verifikasi.

---

### Opsi 2: Menggunakan Mailtrap untuk Testing (Development Only)

Jika masih development dan ingin testing tanpa kirim email sungguhan:

1. Daftar gratis di: https://mailtrap.io
2. Buat inbox baru
3. Copy credentials yang diberikan
4. Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="disperindagkop.asahan@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

5. Clear cache: `php artisan config:clear`
6. Semua email akan masuk ke inbox Mailtrap (tidak ke email sungguhan)

---

### Opsi 3: Menggunakan Laravel Log Driver (Quick Testing)

Untuk testing cepat tanpa setup SMTP:

```env
MAIL_MAILER=log
```

Email akan disimpan di `storage/logs/laravel.log` (tidak terkirim sungguhan).

---

## Verifikasi Konfigurasi

Setelah setup, test dengan artisan tinker:

```bash
php artisan tinker
```

Lalu jalankan:

```php
Mail::raw('Test email', function ($message) {
    $message->to('test@example.com')->subject('Test');
});
```

Jika tidak ada error, konfigurasi sudah benar!

---

## Troubleshooting Tambahan

### Error: "Connection refused"
- Pastikan firewall tidak memblokir port 587
- Cek apakah ISP memblokir SMTP (beberapa ISP Indonesia memblokir)
- Coba gunakan port 465 dengan `MAIL_ENCRYPTION=ssl`

### Error: "Username and Password not accepted"
- Pastikan menggunakan App Password (bukan password Gmail biasa)
- Pastikan email dan app password benar
- Pastikan 2-Step Verification sudah aktif

### Error: "Too many login attempts"
- Gmail membatasi login, tunggu 15-30 menit
- Gunakan Mailtrap untuk development

### Email masuk ke Spam
- Tambahkan SPF record di DNS domain (untuk production)
- Gunakan domain email sendiri (bukan @gmail.com) untuk production

---

## Rekomendasi Production

Untuk production/deployment, gunakan layanan email profesional:
- **Amazon SES** (murah, reliable)
- **SendGrid** (free tier 100 email/hari)
- **Mailgun** (free tier 5000 email/bulan)
- **Postmark** (khusus transactional email)

Hindari menggunakan Gmail untuk production karena:
- Ada limit pengiriman (500 email/hari)
- Bisa kena suspend
- Tidak reliable untuk aplikasi serius
