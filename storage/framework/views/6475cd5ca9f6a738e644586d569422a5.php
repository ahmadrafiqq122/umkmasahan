<?php $__env->startSection('title', 'Beranda - Peta Digital UMKM Kabupaten Asahan'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/modern-animations.css')); ?>">
<style>
    .hero-asahan {
        background: linear-gradient(135deg, #0d2818 0%, #1a4d2e 50%, #2d6a4f 100%);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
        color: white;
        padding: 6rem 0 5rem;
        position: relative;
        overflow: hidden;
        min-height: 90vh;
        display: flex;
        align-items: center;
    }
    
    .hero-asahan::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255,215,0,0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(255,215,0,0.15) 0%, transparent 50%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    .hero-asahan::after {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,215,0,0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: -250px;
        right: -250px;
        animation: float 6s ease-in-out infinite;
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
        animation: slideInLeft 1s ease-out;
    }
    
    .hero-badge {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: var(--gray-900);
        padding: 0.75rem 2rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        animation: slideInLeft 0.8s ease-out;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    
    .hero-badge i {
        font-size: 1.2rem;
        animation: pulse 2s ease-in-out infinite;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        animation: slideInLeft 1s ease-out;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        letter-spacing: -1px;
    }
    
    .hero-title .highlight {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 4rem;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2.5rem;
        opacity: 0.95;
        line-height: 1.8;
        animation: slideInLeft 1.2s ease-out;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }
    
    .hero-illustration {
        position: relative;
        animation: float 4s ease-in-out infinite;
        filter: drop-shadow(0 10px 30px rgba(255, 215, 0, 0.3));
    }
    
    .hero-3d-icon {
        font-size: 20rem;
        background: linear-gradient(135deg, rgba(255,215,0,0.4) 0%, rgba(255,165,0,0.2) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: float 4s ease-in-out infinite;
    }
    
    .btn-hero {
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        animation: slideInUp 1.4s ease-out;
    }
    
    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 215, 0, 0.4);
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .stats-card {
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        border-radius: 12px;
        padding: 2rem 1.5rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-card.gold {
        background: linear-gradient(135deg, var(--asahan-gold) 0%, var(--asahan-gold-dark) 100%);
        color: var(--gray-900);
    }
    
    .stats-card.blue {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    }
    
    .stats-icon {
        font-size: 3rem;
        opacity: 0.2;
        position: absolute;
        bottom: 10px;
        right: 15px;
    }
    
    .stats-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .stats-label {
        font-size: 1rem;
        opacity: 0.95;
        position: relative;
        z-index: 1;
    }
    
    .feature-card {
        text-align: center;
        padding: 2rem;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transform: translateY(-5px);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
    }
    
    .map-container {
        height: 600px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    /* ============================================ */
    /* RESPONSIVE DESIGN UNTUK HP - DIPERBAIKI */
    /* ============================================ */
    
    /* HP Kecil dan Sedang (max 768px) */
    @media (max-width: 768px) {
        .hero-asahan {
            padding: 4rem 0 3rem !important;
            min-height: auto !important;
        }
        
        .hero-badge {
            font-size: 0.8rem !important;
            padding: 0.5rem 1rem !important;
            margin-bottom: 1rem !important;
        }
        
        .hero-title {
            font-size: 2rem !important;
            margin-bottom: 1rem !important;
        }
        
        .hero-title .highlight {
            font-size: 2.5rem !important;
        }
        
        .hero-subtitle {
            font-size: 1rem !important;
            margin-bottom: 1.5rem !important;
            line-height: 1.6 !important;
        }
        
        .hero-3d-icon {
            font-size: 8rem !important;
        }
        
        .btn-hero {
            padding: 0.75rem 1.5rem !important;
            font-size: 1rem !important;
            width: 100% !important;
            margin-bottom: 0.75rem !important;
        }
        
        .stats-card {
            margin-bottom: 1rem !important;
            padding: 1.5rem 1rem !important;
        }
        
        .stats-value {
            font-size: 2rem !important;
        }
        
        .stats-label {
            font-size: 0.9rem !important;
        }
        
        .stats-icon {
            font-size: 2rem !important;
        }
        
        .feature-card {
            padding: 1.5rem !important;
            margin-bottom: 1rem !important;
        }
        
        .feature-icon {
            width: 60px !important;
            height: 60px !important;
            font-size: 1.5rem !important;
        }
        
        .map-container {
            height: 400px !important;
        }
        
        /* Section spacing lebih kecil */
        .container {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        section {
            padding: 3rem 0 !important;
        }
        
        h2 {
            font-size: 1.75rem !important;
        }
        
        .search-card {
            padding: 1.5rem !important;
        }
        
        .form-control, .form-select {
            font-size: 16px !important; /* Prevent zoom on iOS */
        }
    }
    
    /* HP Sangat Kecil (max 576px) */
    @media (max-width: 576px) {
        .hero-asahan {
            padding: 3rem 0 2rem !important;
        }
        
        .hero-title {
            font-size: 1.75rem !important;
        }
        
        .hero-title .highlight {
            font-size: 2rem !important;
        }
        
        .hero-subtitle {
            font-size: 0.95rem !important;
        }
        
        .hero-badge {
            font-size: 0.75rem !important;
        }
        
        .stats-value {
            font-size: 1.75rem !important;
        }
        
        .stats-label {
            font-size: 0.85rem !important;
        }
        
        h2 {
            font-size: 1.5rem !important;
        }
        
        .map-container {
            height: 350px !important;
        }
    }
    
    /* Landscape mode untuk HP */
    @media (max-width: 768px) and (orientation: landscape) {
        .hero-asahan {
            min-height: auto !important;
            padding: 2rem 0 !important;
        }
        
        .hero-3d-icon {
            font-size: 6rem !important;
        }
        
        .map-container {
            height: 300px !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section - Ultra Modern -->
<section class="hero-asahan">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <div class="hero-badge">
                    <i class="bi bi-shield-check-fill"></i>
                    <span>Resmi Pemerintah Kabupaten Asahan</span>
                </div>
                <h1 class="hero-title">
                    Peta Digital<br>
                    <span class="highlight">UMKM</span> Asahan
                </h1>
                <p class="hero-subtitle">
                    🚀 Revolusi digital untuk UMKM Kabupaten Asahan! Temukan, jelajahi, dan kembangkan usaha 
                    Anda dengan teknologi peta satelit <strong>beresolusi tinggi</strong> yang menampilkan detail hingga tingkat rumah.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-asahan-gold btn-hero ripple">
                            <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang - Gratis!
                        </a>
                        <a href="#peta-umkm" class="btn btn-hero glass-card ripple" style="color: white; border: 2px solid rgba(255,255,255,0.3);">
                            <i class="bi bi-globe-americas me-2"></i>Jelajahi Peta Satelit
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard')); ?>" class="btn btn-asahan-gold btn-hero ripple">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Saya
                        </a>
                        <a href="#peta-umkm" class="btn btn-hero glass-card ripple" style="color: white; border: 2px solid rgba(255,255,255,0.3);">
                            <i class="bi bi-globe-americas me-2"></i>Jelajahi Peta Satelit
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Trust Badges -->
                <div class="mt-4 d-flex flex-wrap gap-4 align-items-center" style="opacity: 0.9;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill" style="color: #FFD700; font-size: 1.5rem;"></i>
                        <span style="font-size: 0.9rem;">Data Terverifikasi</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-globe2" style="color: #FFD700; font-size: 1.5rem;"></i>
                        <span style="font-size: 0.9rem;">Peta Satelit HD</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-lightning-charge-fill" style="color: #FFD700; font-size: 1.5rem;"></i>
                        <span style="font-size: 0.9rem;">Real-time Update</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <div class="hero-illustration">
                    <div class="position-relative">
                        <i class="bi bi-geo-alt-fill hero-3d-icon"></i>
                        <!-- Floating Elements -->
                        <div style="position: absolute; top: 20%; left: 10%; animation: float 3s ease-in-out infinite;">
                            <div class="glass-card p-3" style="box-shadow: 0 8px 32px rgba(255,215,0,0.3);">
                                <i class="bi bi-shop" style="font-size: 2rem; color: #FFD700;"></i>
                            </div>
                        </div>
                        <div style="position: absolute; bottom: 30%; right: 15%; animation: float 4s ease-in-out infinite 1s;">
                            <div class="glass-card p-3" style="box-shadow: 0 8px 32px rgba(255,215,0,0.3);">
                                <i class="bi bi-cart" style="font-size: 2rem; color: #FFD700;"></i>
                            </div>
                        </div>
                        <div style="position: absolute; top: 50%; right: 5%; animation: float 5s ease-in-out infinite 2s;">
                            <div class="glass-card p-3" style="box-shadow: 0 8px 32px rgba(255,215,0,0.3);">
                                <i class="bi bi-people" style="font-size: 2rem; color: #FFD700;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5" style="background: var(--gray-50);">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="bi bi-shop stats-icon"></i>
                    <div class="stats-value counter" data-target="<?php echo e($stats['total_businesses'] ?? 0); ?>"><?php echo e($stats['total_businesses'] ?? 0); ?></div>
                    <div class="stats-label">Total UMKM Terdaftar</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card gold">
                    <i class="bi bi-pin-map-fill stats-icon"></i>
                    <div class="stats-value counter" data-target="<?php echo e($stats['districts'] ?? 0); ?>"><?php echo e($stats['districts'] ?? 0); ?></div>
                    <div class="stats-label">Kecamatan Terlayani</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card blue">
                    <i class="bi bi-grid-3x3-gap-fill stats-icon"></i>
                    <div class="stats-value counter" data-target="<?php echo e($stats['business_types'] ?? 0); ?>"><?php echo e($stats['business_types'] ?? 0); ?></div>
                    <div class="stats-label">Kategori Usaha</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: var(--asahan-green);">Fitur Unggulan</h2>
            <p class="text-muted">Solusi digital untuk mendukung UMKM Kabupaten Asahan</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-map-fill"></i>
                    </div>
                    <h5 class="mb-3" style="color: var(--asahan-green);">Peta Interaktif</h5>
                    <p class="text-muted mb-0">
                        Visualisasi lokasi UMKM dengan peta digital interaktif berbasis Leaflet.js
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5 class="mb-3" style="color: var(--asahan-green);">Pencarian Mudah</h5>
                    <p class="text-muted mb-0">
                        Temukan UMKM dengan cepat berdasarkan nama, kategori, atau lokasi
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="mb-3" style="color: var(--asahan-green);">Data Terverifikasi</h5>
                    <p class="text-muted mb-0">
                        Semua data UMKM telah diverifikasi oleh Disperindagkop Kab. Asahan
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h5 class="mb-3" style="color: var(--asahan-green);">Registrasi Online</h5>
                    <p class="text-muted mb-0">
                        Daftarkan usaha Anda secara online dengan mudah dan cepat
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h5 class="mb-3" style="color: var(--asahan-green);">Dashboard Lengkap</h5>
                    <p class="text-muted mb-0">
                        Kelola data usaha Anda dengan dashboard yang mudah digunakan
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                    <h5 class="mb-3" style="color: var(--asahan-green);">Galeri Foto</h5>
                    <p class="text-muted mb-0">
                        Tampilkan produk dan tempat usaha Anda dengan galeri foto
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5" style="background: var(--gray-50);" id="peta-umkm">
    <div class="container">
        <div class="card-asahan">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-map me-2"></i>Peta Digital UMKM Kabupaten Asahan</h5>
            </div>
            <div class="card-body p-0">
                <!-- Search and Filter -->
                <div class="p-4 border-bottom">
                    <form id="searchForm" class="form-asahan">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Cari UMKM</label>
                                <input type="text" class="form-control" id="keyword" placeholder="Nama usaha...">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jenis Usaha</label>
                                <select class="form-select" id="businessType">
                                    <option value="">Semua Jenis</option>
                                    <option value="kuliner">Kuliner</option>
                                    <option value="fashion">Fashion</option>
                                    <option value="kerajinan">Kerajinan</option>
                                    <option value="pertanian">Pertanian</option>
                                    <option value="perikanan">Perikanan</option>
                                    <option value="jasa">Jasa</option>
                                    <option value="perdagangan">Perdagangan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kecamatan</label>
                                <select class="form-select" id="district">
                                    <option value="">Semua Kecamatan</option>
                                    <?php $__currentLoopData = $businesses->unique('district')->pluck('district')->filter(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($district); ?>"><?php echo e($district); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-asahan-primary w-100">
                                    <i class="bi bi-search me-1"></i>Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Map -->
                <div id="map" class="map-container"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="card-asahan text-white text-center" style="background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);">
            <div class="card-body p-5">
                <h2 class="mb-3">Bergabunglah dengan Ekosistem UMKM Digital</h2>
                <p class="mb-4 fs-5">
                    Daftarkan usaha Anda sekarang dan jadilah bagian dari transformasi digital UMKM Kabupaten Asahan
                </p>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-asahan-gold btn-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang - Gratis!
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard')); ?>" class="btn btn-asahan-gold btn-lg">
                        <i class="bi bi-speedometer2 me-2"></i>Ke Dashboard
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    // Counter Animation
    $('.counter').each(function() {
        const target = parseInt($(this).data('target'));
        const element = $(this);
        let current = 0;
        const increment = target / 50;
        
        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                element.text(target);
                clearInterval(timer);
            } else {
                element.text(Math.floor(current));
            }
        }, 30);
    });
    
    // Initialize Map with FULL HYBRID View (Satellite + Complete Labels)
    const map = L.map('map', {
        center: [2.9811, 99.6167],
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
    // GOOGLE SATELLITE ONLY - Simple & Clean
    // ============================================
    
    // Google Satellite dengan Labels
    L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        maxNativeZoom: 20,
        attribution: '© Google Satellite'
    }).addTo(map);
    
    // Google Labels (Jalan + Tempat)
    L.tileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        maxNativeZoom: 20,
        attribution: ''
    }).addTo(map);
    
    // Custom marker icon
    const greenIcon = L.divIcon({
        className: 'custom-marker',
        html: '<div style="background: #2D5F3F; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="bi bi-shop" style="color: #F4C430; font-size: 1rem;"></i></div>',
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -15]
    });
    
    // Add markers
    let markers = [];
    const businesses = <?php echo json_encode($businesses, 15, 512) ?>;
    
    businesses.forEach(function(business) {
        if (business.latitude && business.longitude) {
            const marker = L.marker([business.latitude, business.longitude], {
                icon: greenIcon
            }).bindPopup(`
                <div style="min-width: 250px;">
                    <h6 class="fw-bold mb-2" style="color: var(--asahan-green);">${business.business_name}</h6>
                    <p class="mb-1 small"><i class="bi bi-person me-1"></i><strong>Pemilik:</strong> ${business.owner_name}</p>
                    <p class="mb-1 small"><i class="bi bi-tag me-1"></i><strong>Jenis:</strong> ${business.business_type}</p>
                    <p class="mb-1 small"><i class="bi bi-geo-alt me-1"></i><strong>Alamat:</strong> ${business.address}</p>
                    ${business.phone ? `<p class="mb-1 small"><i class="bi bi-telephone me-1"></i><strong>Telepon:</strong> ${business.phone}</p>` : ''}
                    ${business.description ? `<p class="mb-2 small"><i class="bi bi-info-circle me-1"></i>${business.description}</p>` : ''}
                    <div class="badge bg-success">${business.status === 'approved' ? 'Terverifikasi' : 'Pending'}</div>
                </div>
            `);
            
            marker.businessData = business;
            marker.addTo(map);
            markers.push(marker);
        }
    });
    
    // Search and Filter
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        filterBusinesses();
    });
    
    $('#keyword, #businessType, #district').on('change', function() {
        filterBusinesses();
    });
    
    function filterBusinesses() {
        const keyword = $('#keyword').val().toLowerCase();
        const businessType = $('#businessType').val().toLowerCase();
        const district = $('#district').val().toLowerCase();
        
        let visibleMarkers = [];
        
        markers.forEach(function(marker) {
            const business = marker.businessData;
            let show = true;
            
            if (keyword && !business.business_name.toLowerCase().includes(keyword) && 
                !business.owner_name.toLowerCase().includes(keyword)) {
                show = false;
            }
            
            if (businessType && business.business_type.toLowerCase() !== businessType) {
                show = false;
            }
            
            if (district && business.district.toLowerCase() !== district) {
                show = false;
            }
            
            if (show) {
                marker.addTo(map);
                visibleMarkers.push(marker);
            } else {
                map.removeLayer(marker);
            }
        });
        
        // Fit bounds to visible markers
        if (visibleMarkers.length > 0) {
            const group = L.featureGroup(visibleMarkers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }
    
    // Smooth scroll
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umkm/resources/views/home.blade.php ENDPATH**/ ?>