<?php $__env->startSection('title', 'Tambah Data Usaha'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .page-header {
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .form-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .form-card .card-header {
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        color: white;
        padding: 1.25rem 1.5rem;
        border: none;
    }
    
    .form-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    /* BORDER INPUT DIPERJELAS - Membuat kotak input SANGAT jelas */
    .form-control, .form-select {
        border: 3px solid #7f8c8d !important;
        border-radius: 10px !important;
        padding: 0.75rem 1rem !important;
        font-size: 1.05rem !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
        background-color: #ffffff !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--asahan-green) !important;
        border-width: 3px !important;
        box-shadow: 0 0 0 0.3rem rgba(45, 95, 63, 0.25) !important;
        background-color: #f0fff4 !important;
        outline: none !important;
    }
    
    .form-control:hover, .form-select:hover {
        border-color: #5a6c7d !important;
        border-width: 3px !important;
    }
    
    /* Placeholder text lebih jelas */
    .form-control::placeholder {
        color: #95a5a6 !important;
        font-weight: 500 !important;
        opacity: 0.8 !important;
    }
    
    /* Label SANGAT tebal dan jelas */
    .form-label {
        font-weight: 700 !important;
        color: #1a252f !important;
        margin-bottom: 0.6rem !important;
        font-size: 1rem !important;
        letter-spacing: 0.3px !important;
    }
    
    /* Text bantuan di bawah input - lebih bold */
    small.text-muted {
        display: block;
        margin-top: 0.35rem;
        font-size: 0.875rem;
        color: #5a6c7d !important;
        font-weight: 500 !important;
    }
    
    /* Tanda bintang merah lebih besar */
    .text-danger {
        font-size: 1.1rem !important;
        font-weight: 700 !important;
    }
    
    /* ============================================ */
    /* RESPONSIVE DESIGN UNTUK SEMUA JENIS HP */
    /* ============================================ */
    
    /* Untuk HP kecil (iPhone SE, Samsung A series lama, dll) - max 576px */
    @media (max-width: 576px) {
        .page-header {
            padding: 1.5rem 0 !important;
        }
        
        .page-header h1 {
            font-size: 1.5rem !important;
        }
        
        .page-header p {
            font-size: 0.9rem !important;
        }
        
        .form-card {
            margin-bottom: 1rem !important;
        }
        
        .form-card .card-header {
            padding: 1rem !important;
        }
        
        .form-card .card-header h5 {
            font-size: 1rem !important;
        }
        
        .form-card .card-body {
            padding: 1rem !important;
        }
        
        /* Input dan select lebih besar untuk mobile */
        .form-control, .form-select {
            font-size: 16px !important; /* Prevent zoom on iOS */
            padding: 0.75rem !important;
        }
        
        .form-label {
            font-size: 0.95rem !important;
            margin-bottom: 0.4rem !important;
        }
        
        small.text-muted {
            font-size: 0.8rem !important;
        }
        
        /* Tombol full width di mobile */
        .btn {
            width: 100% !important;
            padding: 0.75rem !important;
            font-size: 1rem !important;
        }
        
        /* Map lebih pendek di mobile */
        .map-container-form {
            height: 350px !important;
        }
        
        /* Alert/instruction lebih compact */
        .map-instruction {
            padding: 0.75rem !important;
            font-size: 0.85rem !important;
        }
        
        .map-instruction i {
            font-size: 1.2rem !important;
        }
        
        /* Photo upload section */
        .photo-item {
            margin-bottom: 0.75rem !important;
        }
        
        .photo-item .col-md-5,
        .photo-item .col-md-4,
        .photo-item .col-md-3,
        .photo-item .col-md-2 {
            width: 100% !important;
            margin-bottom: 0.5rem !important;
        }
        
        /* Container padding lebih kecil */
        .container {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }
    
    /* Untuk HP sedang (iPhone 12/13/14, Samsung A series baru) - 577px sampai 767px */
    @media (min-width: 577px) and (max-width: 767px) {
        .form-control, .form-select {
            font-size: 16px !important; /* Prevent zoom on iOS */
        }
        
        .map-container-form {
            height: 400px !important;
        }
        
        /* 2 kolom untuk form yang cocok */
        .col-md-4 {
            width: 50% !important;
        }
    }
    
    /* Untuk tablet kecil dan HP besar landscape - 768px sampai 991px */
    @media (min-width: 768px) and (max-width: 991px) {
        .map-container-form {
            height: 450px !important;
        }
    }
    
    /* Touch-friendly: Perbesar area klik untuk mobile */
    @media (max-width: 768px) {
        .form-check-input {
            width: 1.5rem !important;
            height: 1.5rem !important;
        }
        
        .form-check-label {
            padding-left: 0.5rem !important;
        }
        
        /* Dropdown option lebih mudah diklik */
        select.form-select option {
            padding: 1rem !important;
        }
    }
    
    /* Landscape mode untuk HP */
    @media (max-width: 768px) and (orientation: landscape) {
        .map-container-form {
            height: 300px !important;
        }
        
        .page-header {
            padding: 1rem 0 !important;
        }
    }
    
    .map-container-form {
        height: 500px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 3px solid var(--asahan-gold);
    }
    
    .map-instruction {
        background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
        border: 2px solid var(--asahan-gold);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: pulse 2s ease-in-out infinite;
    }
    
    .map-instruction i {
        font-size: 1.5rem;
        color: var(--asahan-gold-dark);
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }
    
    .coord-display {
        background: var(--gray-50);
        border: 2px solid var(--asahan-green);
        border-radius: 8px;
        padding: 0.75rem;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: var(--asahan-green);
    }
    
    #useMyLocation {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    #useMyLocation:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    }
    
    #useMyLocation:active {
        transform: translateY(0);
    }
    
    #useMyLocation.loading {
        pointer-events: none;
        opacity: 0.7;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="container">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-plus-circle"></i> Tambah Data Usaha
        </h1>
        <p class="mb-0">Lengkapi formulir di bawah untuk mendaftarkan usaha Anda</p>
    </div>
</div>

<div class="container my-4">
    <form action="<?php echo e(route('user.business.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <!-- Informasi Dasar -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Dasar Usaha</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="business_name" class="form-control <?php $__errorArgs = ['business_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('business_name')); ?>" required
                               placeholder="Contoh: Warung Makan Bu Siti">
                        <small class="text-muted">Masukkan nama lengkap usaha Anda</small>
                        <?php $__errorArgs = ['business_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                        <input type="text" name="owner_name" class="form-control <?php $__errorArgs = ['owner_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('owner_name', auth()->user()->name)); ?>" required
                               placeholder="Contoh: Siti Aminah">
                        <small class="text-muted">Nama pemilik/penanggung jawab usaha</small>
                        <?php $__errorArgs = ['owner_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Usaha <span class="text-danger">*</span></label>
                        <select name="business_type" class="form-select <?php $__errorArgs = ['business_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Pilih Jenis Usaha</option>
                            <option value="kuliner" <?php echo e(old('business_type') == 'kuliner' ? 'selected' : ''); ?>>Kuliner (Makanan & Minuman)</option>
                            <option value="fashion" <?php echo e(old('business_type') == 'fashion' ? 'selected' : ''); ?>>Fashion (Pakaian & Aksesoris)</option>
                            <option value="kerajinan" <?php echo e(old('business_type') == 'kerajinan' ? 'selected' : ''); ?>>Kerajinan (Handmade)</option>
                            <option value="pertanian" <?php echo e(old('business_type') == 'pertanian' ? 'selected' : ''); ?>>Pertanian (Sayur, Buah, dll)</option>
                            <option value="perikanan" <?php echo e(old('business_type') == 'perikanan' ? 'selected' : ''); ?>>Perikanan (Ikan & Hasil Laut)</option>
                            <option value="jasa" <?php echo e(old('business_type') == 'jasa' ? 'selected' : ''); ?>>Jasa (Layanan)</option>
                            <option value="perdagangan" <?php echo e(old('business_type') == 'perdagangan' ? 'selected' : ''); ?>>Perdagangan (Toko/Retail)</option>
                            <option value="lainnya" <?php echo e(old('business_type') == 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                        </select>
                        <small class="text-muted">Pilih kategori usaha yang sesuai</small>
                        <?php $__errorArgs = ['business_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Skala Usaha <span class="text-danger">*</span></label>
                        <select name="business_scale" class="form-select <?php $__errorArgs = ['business_scale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="mikro" <?php echo e(old('business_scale') == 'mikro' ? 'selected' : ''); ?>>Mikro (Aset &lt; 50 Juta)</option>
                            <option value="kecil" <?php echo e(old('business_scale') == 'kecil' ? 'selected' : ''); ?>>Kecil (Aset 50 Juta - 500 Juta)</option>
                            <option value="menengah" <?php echo e(old('business_scale') == 'menengah' ? 'selected' : ''); ?>>Menengah (Aset &gt; 500 Juta)</option>
                        </select>
                        <small class="text-muted">Berdasarkan nilai aset usaha</small>
                        <?php $__errorArgs = ['business_scale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Berdiri</label>
                        <input type="number" name="established_year" class="form-control <?php $__errorArgs = ['established_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('established_year')); ?>" min="1900" max="<?php echo e(date('Y')); ?>"
                               placeholder="Contoh: 2020">
                        <small class="text-muted">Tahun usaha mulai beroperasi (opsional)</small>
                        <?php $__errorArgs = ['established_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi Usaha <span class="text-danger">*</span></label>
                    <textarea name="description" rows="4" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                              placeholder="Ceritakan tentang usaha Anda, produk/layanan yang ditawarkan, keunggulan, dan hal menarik lainnya..."><?php echo e(old('description')); ?></textarea>
                    <small class="text-muted">Jelaskan usaha Anda secara detail untuk menarik perhatian pengunjung (minimal 50 karakter)</small>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Produk Utama</label>
                        <input type="text" name="main_product" class="form-control <?php $__errorArgs = ['main_product'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('main_product')); ?>"
                               placeholder="Contoh: Kue Kering, Tas Anyaman, Ikan Segar">
                        <small class="text-muted">Sebutkan produk/layanan unggulan (opsional)</small>
                        <?php $__errorArgs = ['main_product'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Jumlah Karyawan</label>
                        <input type="number" name="employee_count" class="form-control <?php $__errorArgs = ['employee_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('employee_count', 1)); ?>" min="1"
                               placeholder="1">
                        <small class="text-muted">Total pegawai termasuk pemilik</small>
                        <?php $__errorArgs = ['employee_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Omzet/Bulan (Rp)</label>
                        <input type="number" name="monthly_revenue" class="form-control <?php $__errorArgs = ['monthly_revenue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('monthly_revenue')); ?>" min="0"
                               placeholder="5000000">
                        <small class="text-muted">Perkiraan pendapatan per bulan</small>
                        <?php $__errorArgs = ['monthly_revenue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-telephone"></i> Informasi Kontak</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('phone', auth()->user()->phone)); ?>" required
                               placeholder="0821xxxxxxxx">
                        <small class="text-muted">Nomor yang bisa dihubungi</small>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('whatsapp')); ?>"
                               placeholder="0821xxxxxxxx">
                        <small class="text-muted">Untuk kontak via WhatsApp (opsional)</small>
                        <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('email')); ?>"
                               placeholder="email@contoh.com">
                        <small class="text-muted">Email usaha Anda (opsional)</small>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alamat -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Alamat & Lokasi</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="address" rows="2" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                              placeholder="Contoh: Jl. Merdeka No. 123, RT 001/RW 002, Dekat Pasar Kisaran"><?php echo e(old('address')); ?></textarea>
                    <small class="text-muted">Tulis alamat selengkap mungkin termasuk patokan/landmark agar mudah ditemukan</small>
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                        <input type="text" name="village" class="form-control <?php $__errorArgs = ['village'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('village')); ?>" required
                               placeholder="Contoh: Sei Merah">
                        <small class="text-muted">Nama desa atau kelurahan</small>
                        <?php $__errorArgs = ['village'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select name="district" class="form-select <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Pilih Kecamatan di Kabupaten Asahan</option>
                            <option value="Aek Kuasan">Aek Kuasan</option>
                            <option value="Aek Ledong">Aek Ledong</option>
                            <option value="Air Batu">Air Batu</option>
                            <option value="Air Joman">Air Joman</option>
                            <option value="Bandar Pasir Mandoge">Bandar Pasir Mandoge</option>
                            <option value="Bandar Pulau">Bandar Pulau</option>
                            <option value="Buntu Pane">Buntu Pane</option>
                            <option value="Kisaran Barat">Kisaran Barat</option>
                            <option value="Kisaran Timur">Kisaran Timur</option>
                            <option value="Meranti">Meranti</option>
                            <option value="Pulau Rakyat">Pulau Rakyat</option>
                            <option value="Rawang Panca Arga">Rawang Panca Arga</option>
                            <option value="Sei Dadap">Sei Dadap</option>
                            <option value="Sei Kepayang">Sei Kepayang</option>
                            <option value="Sei Semayang">Sei Semayang</option>
                            <option value="Setia Janji">Setia Janji</option>
                            <option value="Simpang Empat">Simpang Empat</option>
                            <option value="Silau Laut">Silau Laut</option>
                            <option value="Tanjung Balai">Tanjung Balai</option>
                            <option value="Teluk Dalam">Teluk Dalam</option>
                        </select>
                        <small class="text-muted">Pilih kecamatan lokasi usaha</small>
                        <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="postal_code" class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('postal_code')); ?>" maxlength="5"
                               placeholder="21224">
                        <small class="text-muted">Kode pos wilayah (opsional)</small>
                        <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                
                <div class="map-instruction">
                    <i class="bi bi-cursor-fill"></i>
                    <div>
                        <strong>CARA MENANDAI LOKASI USAHA:</strong>
                        <br>1️⃣ Klik tombol hijau "Gunakan Lokasi Saya" untuk otomatis mendeteksi posisi Anda
                        <br>2️⃣ Atau klik langsung pada peta untuk menandai lokasi usaha secara manual
                        <br>3️⃣ Gunakan kontrol layer di pojok kanan atas untuk ganti tampilan (Satelit/Peta Jalan)
                    </div>
                </div>
                
                <div class="mb-3">
                    <button type="button" class="btn btn-success btn-lg w-100" id="useMyLocation" onclick="useMyLocation()">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span id="locationBtnText">🎯 Gunakan Lokasi Saya Sekarang</span>
                        <span id="locationBtnLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                    </button>
                    <small class="text-muted d-block mt-2 text-center">
                        <i class="bi bi-exclamation-triangle-fill text-warning"></i> <strong>PENTING:</strong> Pastikan Anda mengizinkan akses lokasi ketika browser meminta izin. Jika ditolak, tandai lokasi secara manual dengan klik pada peta.
                    </small>
                </div>
                
                <div id="map" class="map-container-form mb-3"></div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Latitude (Garis Lintang) <span class="text-danger">*</span></label>
                        <input type="text" name="latitude" id="latitude" class="form-control coord-display <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('latitude')); ?>" required readonly placeholder="Akan terisi otomatis setelah Anda klik peta">
                        <small class="text-muted">Koordinat latitude akan terisi otomatis</small>
                        <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Longitude (Garis Bujur) <span class="text-danger">*</span></label>
                        <input type="text" name="longitude" id="longitude" class="form-control coord-display <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('longitude')); ?>" required readonly placeholder="Akan terisi otomatis setelah Anda klik peta">
                        <small class="text-muted">Koordinat longitude akan terisi otomatis</small>
                        <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legalitas & Media Sosial -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-text"></i> Legalitas & Media Sosial</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Induk Berusaha (NIB)</label>
                        <input type="text" name="nib" class="form-control <?php $__errorArgs = ['nib'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('nib')); ?>"
                               placeholder="Contoh: 1234567890123">
                        <small class="text-muted">NIB dari OSS (opsional, jika sudah ada)</small>
                        <?php $__errorArgs = ['nib'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">P-IRT</label>
                        <input type="text" name="pirt" class="form-control <?php $__errorArgs = ['pirt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('pirt')); ?>" placeholder="Contoh: 1234567890">
                        <small class="text-muted">Nomor P-IRT untuk produk pangan olahan (opsional)</small>
                        <?php $__errorArgs = ['pirt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Sertifikat Halal</label>
                        <input type="text" name="halal_certificate" class="form-control <?php $__errorArgs = ['halal_certificate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('halal_certificate')); ?>" placeholder="Contoh: 00000000000000000000">
                        <small class="text-muted">Nomor sertifikat halal dari MUI (opsional, jika sudah memiliki)</small>
                        <?php $__errorArgs = ['halal_certificate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control <?php $__errorArgs = ['instagram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('instagram')); ?>" placeholder="@usaha_saya">
                        <small class="text-muted">Username Instagram usaha Anda (opsional)</small>
                        <?php $__errorArgs = ['instagram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="text" name="facebook" class="form-control <?php $__errorArgs = ['facebook'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('facebook')); ?>"
                               placeholder="UsahaSaya">
                        <small class="text-muted">Nama halaman Facebook usaha (opsional)</small>
                        <?php $__errorArgs = ['facebook'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-control <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('website')); ?>"
                               placeholder="https://usahasaya.com">
                        <small class="text-muted">Website atau toko online Anda (opsional)</small>
                        <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-images"></i> Foto Usaha & Produk</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill"></i> <strong>Panduan Upload Foto:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Upload <strong>minimal 1 foto</strong> usaha atau produk Anda</li>
                        <li>Format foto: <strong>JPG atau PNG</strong></li>
                        <li>Ukuran maksimal: <strong>2MB per foto</strong></li>
                        <li>Gunakan foto yang jelas dan menarik untuk menarik perhatian pengunjung</li>
                    </ul>
                </div>
                
                <div id="photoContainer">
                    <div class="row mb-3 photo-item">
                        <div class="col-md-5">
                            <input type="file" name="photos[]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <select name="photo_types[]" class="form-select">
                                <option value="tempat_usaha">Tempat Usaha</option>
                                <option value="produk" selected>Produk</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="photo_captions[]" class="form-control" placeholder="Keterangan">
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary" onclick="addPhotoField()">
                    <i class="bi bi-plus-circle"></i> Tambah Foto
                </button>
            </div>
        </div>

        <!-- Submit -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-save"></i> Simpan Data Usaha
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Map with FULL HYBRID View (Same as Homepage)
    const mapCenter = [<?php echo e(env('MAP_CENTER_LAT', 2.9833)); ?>, <?php echo e(env('MAP_CENTER_LNG', 99.6167)); ?>];
    const map = L.map('map', {
        center: mapCenter,
        zoom: 13,
        zoomControl: true,
        scrollWheelZoom: true,
        maxZoom: 20,
        minZoom: 10
    });
    
    // Add scale control
    L.control.scale({
        imperial: false,
        metric: true,
        position: 'bottomleft'
    }).addTo(map);
    
    // ============================================
    // BASE LAYERS (Background Map)
    // ============================================
    
    // 1. Street Map Layer (OpenStreetMap)
    const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        maxNativeZoom: 19,
        attribution: '© OpenStreetMap contributors'
    });
    
    // 2. Google Satellite (Recommended)
    const googleSatellite = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        maxNativeZoom: 20,
        attribution: '© Google'
    });
    
    // 3. Esri Satellite (backup)
    const esriSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 18,
        maxNativeZoom: 18,
        attribution: '© Esri'
    });
    
    // ============================================
    // LABEL LAYERS (Detail Jalan + Tempat)
    // ============================================
    
    // 4. Google Hybrid Labels
    const googleLabels = L.tileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        maxNativeZoom: 20,
        attribution: '© Google'
    });
    
    // 5. OpenStreetMap Labels
    const osmLabels = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        maxNativeZoom: 19,
        opacity: 0.5,
        attribution: '© OpenStreetMap'
    });
    
    // ============================================
    // SET DEFAULT: GOOGLE SATELLITE + LABELS
    // ============================================
    googleSatellite.addTo(map);
    googleLabels.addTo(map);
    
    // ============================================
    // LAYER CONTROL
    // ============================================
    const baseMaps = {
        "<i class='bi bi-globe-americas me-1'></i> <strong>Satelit Google (Recommended)</strong>": googleSatellite,
        "<i class='bi bi-satellite me-1'></i> Satelit Esri": esriSatellite,
        "<i class='bi bi-map-fill me-1'></i> Peta Jalan": streetLayer
    };
    
    const overlayMaps = {
        "<i class='bi bi-signpost-fill me-1'></i> <strong>Label Lengkap (Jalan + Tempat)</strong>": googleLabels,
        "<i class='bi bi-geo-alt-fill me-1'></i> Label OSM Tambahan": osmLabels
    };
    
    const layerControl = L.control.layers(baseMaps, overlayMaps, {
        position: 'topright',
        collapsed: false
    }).addTo(map);
    
    // Style layer control
    setTimeout(() => {
        const layerControlDiv = document.querySelector('.leaflet-control-layers');
        if (layerControlDiv) {
            layerControlDiv.style.background = 'rgba(255, 255, 255, 0.95)';
            layerControlDiv.style.backdropFilter = 'blur(10px)';
            layerControlDiv.style.borderRadius = '12px';
            layerControlDiv.style.padding = '15px';
            layerControlDiv.style.boxShadow = '0 4px 20px rgba(0,0,0,0.2)';
        }
    }, 100);
    
    // Custom marker icon for user's business location
    const userIcon = L.divIcon({
        className: 'custom-marker',
        html: '<div style="background: #dc2626; width: 40px; height: 40px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 4px 12px rgba(0,0,0,0.4);"><i class="bi bi-geo-alt-fill" style="color: white; font-size: 1.5rem; transform: rotate(45deg);"></i></div>',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });
    
    let marker;
    
    // Set old values if exists
    <?php if(old('latitude') && old('longitude')): ?>
        marker = L.marker([<?php echo e(old('latitude')); ?>, <?php echo e(old('longitude')); ?>], { icon: userIcon }).addTo(map);
        marker.bindPopup('<strong>Lokasi Usaha Anda</strong>').openPopup();
        map.setView([<?php echo e(old('latitude')); ?>, <?php echo e(old('longitude')); ?>], 16);
    <?php endif; ?>
    
    // Click on map to set marker
    map.on('click', function(e) {
        setMarkerAtLocation(e.latlng.lat, e.latlng.lng);
    });
    
    // Function to set marker at specific location
    function setMarkerAtLocation(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }
        
        marker = L.marker([lat, lng], { icon: userIcon }).addTo(map);
        marker.bindPopup('<strong>Lokasi Usaha Anda</strong><br>Lat: ' + lat.toFixed(6) + '<br>Lng: ' + lng.toFixed(6)).openPopup();
        
        document.getElementById('latitude').value = lat.toFixed(8);
        document.getElementById('longitude').value = lng.toFixed(8);
        
        // Animate to marker
        map.setView([lat, lng], 16, { animate: true, duration: 0.5 });
    }
    
    // Use My Location feature with better error handling
    function useMyLocation() {
        const btn = document.getElementById('useMyLocation');
        const btnText = document.getElementById('locationBtnText');
        const btnLoader = document.getElementById('locationBtnLoader');
        
        // Check if geolocation is supported
        if (!navigator.geolocation) {
            Swal.fire({
                icon: 'error',
                title: 'Browser Tidak Mendukung',
                html: '<p>Browser Anda tidak mendukung fitur deteksi lokasi otomatis.</p>' +
                      '<p class="mb-0"><strong>Solusi:</strong> Silakan tandai lokasi usaha secara manual dengan mengklik langsung pada peta di atas.</p>',
                confirmButtonColor: '#2D5F3F',
                confirmButtonText: 'Mengerti'
            });
            return;
        }
        
        // Check if page is loaded via HTTPS or localhost
        if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
            Swal.fire({
                icon: 'warning',
                title: 'Koneksi Tidak Aman',
                html: '<p>Fitur deteksi lokasi memerlukan koneksi HTTPS yang aman.</p>' +
                      '<p class="mb-0"><strong>Solusi:</strong> Silakan tandai lokasi usaha secara manual dengan mengklik pada peta.</p>',
                confirmButtonColor: '#2D5F3F',
                confirmButtonText: 'Mengerti'
            });
            return;
        }
        
        // Show loading state
        btn.classList.add('loading');
        btn.disabled = true;
        btnText.textContent = '📍 Mencari lokasi Anda...';
        btnLoader.classList.remove('d-none');
        
        // Show info toast
        const loadingToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true
        });
        
        loadingToast.fire({
            icon: 'info',
            title: 'Mohon izinkan akses lokasi pada browser Anda'
        });
        
        // Get current position with better options
        navigator.geolocation.getCurrentPosition(
            function(position) {
                // Success callback
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const accuracy = position.coords.accuracy;
                
                console.log('Location found:', {lat, lng, accuracy});
                
                // Set marker at current location
                setMarkerAtLocation(lat, lng);
                
                // Reset button state
                btn.classList.remove('loading');
                btn.disabled = false;
                btnText.innerHTML = '✅ Lokasi Berhasil Ditandai!';
                btnLoader.classList.add('d-none');
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Lokasi Ditemukan!',
                    html: `<p>Lokasi Anda berhasil ditandai di peta</p>
                           <p class="mb-0"><small>Akurasi: ±${Math.round(accuracy)} meter</small></p>`,
                    timer: 3000,
                    showConfirmButton: false
                });
                
                // Reset button text after 4 seconds
                setTimeout(function() {
                    btnText.innerHTML = '🎯 Gunakan Lokasi Saya Sekarang';
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-success');
                }, 4000);
            },
            function(error) {
                // Error callback
                btn.classList.remove('loading');
                btn.disabled = false;
                btnText.innerHTML = '🎯 Gunakan Lokasi Saya Sekarang';
                btnLoader.classList.add('d-none');
                
                let errorTitle = 'Gagal Mendapatkan Lokasi';
                let errorMessage = '';
                let solutions = '';
                
                console.error('Geolocation error:', error.code, error.message);
                
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorTitle = 'Akses Lokasi Ditolak';
                        errorMessage = 'Anda menolak izin akses lokasi atau browser memblokir akses lokasi.';
                        solutions = '<strong>Cara Mengaktifkan:</strong><br>' +
                                  '• <strong>Chrome:</strong> Klik ikon 🔒 di address bar → Izinkan Lokasi<br>' +
                                  '• <strong>Firefox:</strong> Klik ikon (i) di address bar → Izinkan Lokasi<br>' +
                                  '• <strong>Edge:</strong> Klik ikon 🔒 di address bar → Izin Situs → Lokasi<br><br>' +
                                  '<strong>Alternatif:</strong> Klik langsung pada peta untuk menandai lokasi secara manual.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorTitle = 'Lokasi Tidak Tersedia';
                        errorMessage = 'Browser tidak dapat menentukan lokasi Anda saat ini.';
                        solutions = '<strong>Kemungkinan Penyebab:</strong><br>' +
                                  '• GPS/lokasi device tidak aktif<br>' +
                                  '• Sinyal GPS lemah (coba di tempat terbuka)<br>' +
                                  '• Browser tidak memiliki akses ke layanan lokasi<br><br>' +
                                  '<strong>Solusi:</strong> Silakan tandai lokasi usaha secara manual dengan mengklik pada peta.';
                        break;
                    case error.TIMEOUT:
                        errorTitle = 'Waktu Permintaan Habis';
                        errorMessage = 'Browser tidak dapat menemukan lokasi Anda dalam waktu yang ditentukan.';
                        solutions = '<strong>Saran:</strong><br>' +
                                  '• Pastikan GPS/lokasi device Anda aktif<br>' +
                                  '• Coba lagi di tempat yang memiliki sinyal GPS baik<br>' +
                                  '• Atau tandai lokasi secara manual dengan klik pada peta';
                        break;
                    default:
                        errorMessage = 'Terjadi kesalahan tidak dikenal saat mengakses lokasi.';
                        solutions = '<strong>Solusi:</strong> Silakan tandai lokasi usaha secara manual dengan mengklik pada peta.';
                }
                
                Swal.fire({
                    icon: 'error',
                    title: errorTitle,
                    html: `<p>${errorMessage}</p><hr><div class="text-start small">${solutions}</div>`,
                    confirmButtonColor: '#2D5F3F',
                    confirmButtonText: 'Mengerti',
                    width: '600px'
                });
            },
            {
                enableHighAccuracy: true, // Use GPS if available
                timeout: 15000, // Increased timeout to 15 seconds
                maximumAge: 0 // Don't use cached position
            }
        );
    }
    
    // Add photo field
    function addPhotoField() {
        const container = document.getElementById('photoContainer');
        const newField = document.createElement('div');
        newField.className = 'row mb-3 photo-item';
        newField.innerHTML = `
            <div class="col-md-5">
                <input type="file" name="photos[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4">
                <select name="photo_types[]" class="form-select">
                    <option value="tempat_usaha">Tempat Usaha</option>
                    <option value="produk" selected>Produk</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="photo_captions[]" class="form-control" placeholder="Keterangan">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger w-100" onclick="removePhotoField(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newField);
    }
    
    function removePhotoField(btn) {
        btn.closest('.photo-item').remove();
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umkm/resources/views/user/business/create.blade.php ENDPATH**/ ?>