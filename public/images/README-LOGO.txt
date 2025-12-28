═══════════════════════════════════════════════════════════
  📝 PANDUAN UPLOAD LOGO RESMI
═══════════════════════════════════════════════════════════

Saat ini aplikasi menggunakan logo PLACEHOLDER (SVG).
Untuk mengganti dengan logo RESMI, ikuti langkah berikut:

📍 LOKASI FILE LOGO:
─────────────────────────────────────────────────────────

1. Logo Kabupaten Asahan:
   File: public/images/logo-asahan.png
   
2. Logo Dinas Kopdagin:
   File: public/images/logo-disperindagkop.png


📋 SPESIFIKASI FILE:
─────────────────────────────────────────────────────────

Format      : PNG (Portable Network Graphics)
Background  : TRANSPARAN (tidak ada background putih)
Ukuran      : 500 x 500 pixels (minimal 300x300)
Resolusi    : 300 DPI (untuk kualitas cetak)
File Size   : Maksimal 1 MB
Color Mode  : RGB


🎨 TIPS KUALITAS LOGO:
─────────────────────────────────────────────────────────

✓ Gunakan file vektor (SVG) jika memungkinkan
✓ Export ke PNG dengan resolusi tinggi
✓ Pastikan logo jelas terlihat saat diperkecil
✓ Gunakan background transparan
✓ Hindari logo yang blur/pecah


🔧 CARA UPLOAD:
─────────────────────────────────────────────────────────

OPSI 1: Manual Upload
  1. Buka folder: public/images/
  2. Copy file logo ke folder tersebut
  3. Rename file sesuai nama yang benar:
     - logo-asahan.png
     - logo-disperindagkop.png
  4. Refresh browser (Ctrl + F5)

OPSI 2: Via Terminal/Command Line
  cp /path/to/your/logo.png public/images/logo-asahan.png
  cp /path/to/your/logo-dinas.png public/images/logo-disperindagkop.png


📍 DIMANA LOGO AKAN MUNCUL:
─────────────────────────────────────────────────────────

✓ Navbar (kiri atas)
✓ Footer (bawah halaman)
✓ Login page (brand section)
✓ Register page (brand section)
✓ Email notifications
✓ Print/Export documents


🔍 VERIFIKASI LOGO SUDAH BENAR:
─────────────────────────────────────────────────────────

1. Buka http://localhost:8000
2. Cek navbar - logo muncul di kiri atas
3. Scroll ke footer - logo muncul
4. Buka halaman login - logo muncul di sidebar
5. Jika masih placeholder, cek nama file sudah benar


⚠️ TROUBLESHOOTING:
─────────────────────────────────────────────────────────

Logo tidak muncul?
  → Cek nama file harus PERSIS:
    - logo-asahan.png (huruf kecil semua)
    - logo-disperindagkop.png (huruf kecil semua)
  
  → Cek lokasi file di:
    public/images/ (bukan di folder lain)
  
  → Clear cache browser:
    Ctrl + Shift + R (Windows/Linux)
    Cmd + Shift + R (Mac)
  
  → Clear Laravel cache:
    php artisan cache:clear
    php artisan view:clear


📞 NEED HELP?
─────────────────────────────────────────────────────────

Jika kesulitan upload logo, hubungi developer atau
kirim file logo via email untuk di-upload kan.


═══════════════════════════════════════════════════════════
  Placeholder SVG sudah tersedia sebagai contoh
  Ganti dengan logo resmi untuk hasil terbaik
═══════════════════════════════════════════════════════════
