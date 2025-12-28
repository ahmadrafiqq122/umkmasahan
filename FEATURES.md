# Fitur Aplikasi Peta Digital UMKM Asahan

## 🎯 Fitur Utama

### 1. **Peta Digital Interaktif**
- Tampilan peta Kabupaten Asahan menggunakan Leaflet.js
- Marker untuk setiap lokasi usaha yang telah disetujui
- Pop-up informasi detail saat marker diklik
- Zoom dan pan untuk navigasi peta
- Responsive untuk mobile dan desktop

### 2. **Multi-Role Authentication**
- **Pengunjung (Guest)**
  - Melihat peta digital
  - Mencari usaha berdasarkan nama, jenis, dan kecamatan
  - Melihat detail usaha
  
- **User (Pelaku Usaha)**
  - Registrasi akun dengan email verification
  - Login dan logout
  - Mengelola data usaha sendiri (Create, Read, Update, Delete)
  - Upload foto usaha dan produk
  - Tracking status persetujuan (Pending, Approved, Rejected)
  
- **Admin**
  - Full control terhadap semua fitur
  - Dashboard statistik lengkap
  - Approve/Reject pendaftaran usaha
  - Manajemen user (CRUD)
  - Manajemen data usaha (CRUD)
  - Bulk operations (approve, delete)

### 3. **Email Verification**
- Kode verifikasi 6 digit dikirim via email
- Berlaku 15 menit
- Fitur resend kode
- Auto-format input kode
- Template email profesional dengan branding dinas

### 4. **Manajemen Data Usaha**

#### Informasi Dasar
- Nama usaha dan pemilik
- Jenis usaha (8 kategori: kuliner, fashion, kerajinan, pertanian, perikanan, jasa, perdagangan, lainnya)
- Skala usaha (mikro, kecil, menengah)
- Deskripsi lengkap
- Produk utama
- Tahun berdiri
- Jumlah karyawan
- Omzet bulanan

#### Informasi Kontak
- Nomor telepon
- WhatsApp (dengan link langsung)
- Email
- Media sosial (Instagram, Facebook)
- Website

#### Alamat & Lokasi
- Alamat lengkap
- Desa/Kelurahan
- Kecamatan (20 kecamatan di Kab. Asahan)
- Kode pos
- Koordinat GPS (Latitude/Longitude)
- Pin lokasi di peta interaktif

#### Legalitas
- NIB (Nomor Induk Berusaha)
- SIUP (Surat Izin Usaha Perdagangan)

#### Foto & Galeri
- Upload multiple photos
- Kategori foto (Tempat Usaha, Produk, Lainnya)
- Caption untuk setiap foto
- Set foto utama
- Preview dan delete foto

### 5. **Dashboard User**
- Statistik personal (Total, Approved, Pending, Rejected)
- Daftar usaha yang telah didaftarkan
- Status tracking real-time
- Quick actions (Edit, Delete, View)

### 6. **Dashboard Admin**

#### Statistik
- Total usaha terdaftar
- Usaha disetujui
- Usaha pending approval
- Total user pelaku usaha
- User aktif

#### Visualisasi Data
- Chart usaha per jenis
- Chart usaha per kecamatan
- Top 5 kecamatan dengan usaha terbanyak

#### Quick Actions
- List pending approvals dengan aksi cepat
- Recent businesses
- Bulk approve/reject
- Bulk delete

### 7. **Pencarian & Filter**

#### Halaman Publik
- Search by keyword (nama usaha, pemilik)
- Filter by jenis usaha
- Filter by kecamatan
- Real-time update di peta

#### Admin Panel
- Search by keyword
- Filter by status (pending, approved, rejected)
- Filter by jenis usaha
- Filter by kecamatan
- Pagination

### 8. **Manajemen User (Admin)**
- Daftar semua user
- View detail user dan usaha mereka
- Edit informasi user
- Aktifkan/Nonaktifkan user
- Create user baru (admin/user)
- Filter by role dan status
- Track aktivitas user

### 9. **Approval System**
- Review detail lengkap sebelum approve
- Approve dengan single click
- Reject dengan alasan yang jelas
- Notifikasi status ke user
- History approval (siapa dan kapan)

### 10. **Responsive Design**
- Mobile-first approach
- Bootstrap 5 framework
- Professional government template
- Gradient colors dan modern UI
- Card-based layout
- Smooth animations
- Touch-friendly untuk mobile

## 🔐 Keamanan

- Password hashing (bcrypt)
- CSRF protection
- XSS protection
- SQL injection prevention
- Email verification mandatory
- Role-based access control
- Session management
- File upload validation

## 📱 Teknologi

### Backend
- Laravel 10.x (PHP Framework)
- MySQL (Database)
- Eloquent ORM
- Blade Template Engine
- Laravel Mail

### Frontend
- HTML5, CSS3, JavaScript
- Bootstrap 5.3
- jQuery 3.7
- Leaflet.js 1.9 (Maps)
- SweetAlert2 (Notifications)
- Bootstrap Icons

### Tools
- Composer (PHP Package Manager)
- NPM (Node Package Manager)
- Vite (Asset Bundler)

## 📊 Data Sample

Aplikasi include sample data:
- 1 Admin default
- 1 User demo
- 5 Sample businesses di berbagai kecamatan
- Berbagai jenis usaha (kuliner, kerajinan, fashion, dll)
- Status bervariasi (approved, pending)

## 🗺️ Peta

### Fitur Peta
- OpenStreetMap tiles
- Custom markers dengan icon
- Clustering untuk banyak marker (opsional)
- Click to add location (form tambah usaha)
- Popup dengan info lengkap
- Zoom controls
- Full screen mode capable

### Koordinat Default
- Center: Kabupaten Asahan (2.9833, 99.6167)
- Zoom level: 11
- Dapat disesuaikan via .env file

## 📧 Notifikasi Email

### Template Email Professional
- Header dengan branding dinas
- Kode verifikasi besar dan jelas
- Warning dan instruksi lengkap
- Footer informasi kontak
- Responsive email design

### Kapan Email Dikirim
- Saat registrasi user baru
- Saat request resend verification code

## 🎨 Design System

### Colors
- Primary: Blue (#1e40af, #3b82f6)
- Success: Green (#10b981)
- Warning: Orange (#f59e0b)
- Danger: Red (#ef4444)
- Info: Sky Blue (#0ea5e9)

### Components
- Cards dengan shadow dan hover effect
- Gradient buttons
- Status badges
- Stat cards dengan icons
- Tables dengan hover
- Forms dengan validation feedback

## 🔄 Workflow

### User Registration Flow
1. User register → Email verification code sent
2. User input verification code → Email verified
3. User login → Access user dashboard
4. User add business data → Status: Pending
5. Admin review → Approve/Reject
6. If approved → Show on public map
7. If rejected → User can edit and resubmit

### Admin Workflow
1. Admin login → Admin dashboard
2. View pending approvals
3. Click to view detail
4. Approve or reject with reason
5. Manage users and businesses
6. View statistics and reports

## 📈 Scalability

- Database indexed untuk performa
- Pagination pada list data
- Lazy loading untuk images
- Cache support (config, route, view)
- Queue support untuk email (optional)
- CDN ready untuk assets

## 🌟 Best Practices

- MVC architecture
- Repository pattern ready
- Service layer separation
- Request validation
- Error handling
- Code comments
- PSR standards
- RESTful API ready
- SEO friendly URLs
