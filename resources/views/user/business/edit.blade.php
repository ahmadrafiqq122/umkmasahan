@extends('layouts.app')

@section('title', 'Edit Data Usaha')

@push('styles')
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
    }
    
    .map-instruction i {
        font-size: 1.5rem;
        color: var(--asahan-gold-dark);
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
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-pencil"></i> Edit Data Usaha
        </h1>
        <p class="mb-0">{{ $business->business_name }}</p>
    </div>
</div>

<div class="container my-4">
    <form action="{{ route('user.business.update', $business->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Informasi Dasar -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Dasar Usaha</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror" 
                               value="{{ old('business_name', $business->business_name) }}" required
                               placeholder="Contoh: Warung Makan Bu Siti">
                        <small class="text-muted">Masukkan nama lengkap usaha Anda</small>
                        @error('business_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                        <input type="text" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror" 
                               value="{{ old('owner_name', $business->owner_name) }}" required
                               placeholder="Contoh: Siti Aminah">
                        <small class="text-muted">Nama pemilik/penanggung jawab usaha</small>
                        @error('owner_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Usaha <span class="text-danger">*</span></label>
                        <select name="business_type" class="form-select @error('business_type') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Usaha</option>
                            <option value="kuliner" {{ old('business_type', $business->business_type) == 'kuliner' ? 'selected' : '' }}>Kuliner (Makanan & Minuman)</option>
                            <option value="fashion" {{ old('business_type', $business->business_type) == 'fashion' ? 'selected' : '' }}>Fashion (Pakaian & Aksesoris)</option>
                            <option value="kerajinan" {{ old('business_type', $business->business_type) == 'kerajinan' ? 'selected' : '' }}>Kerajinan (Handmade)</option>
                            <option value="pertanian" {{ old('business_type', $business->business_type) == 'pertanian' ? 'selected' : '' }}>Pertanian (Sayur, Buah, dll)</option>
                            <option value="perikanan" {{ old('business_type', $business->business_type) == 'perikanan' ? 'selected' : '' }}>Perikanan (Ikan & Hasil Laut)</option>
                            <option value="jasa" {{ old('business_type', $business->business_type) == 'jasa' ? 'selected' : '' }}>Jasa (Layanan)</option>
                            <option value="perdagangan" {{ old('business_type', $business->business_type) == 'perdagangan' ? 'selected' : '' }}>Perdagangan (Toko/Retail)</option>
                            <option value="lainnya" {{ old('business_type', $business->business_type) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <small class="text-muted">Pilih kategori usaha yang sesuai</small>
                        @error('business_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Skala Usaha <span class="text-danger">*</span></label>
                        <select name="business_scale" class="form-select @error('business_scale') is-invalid @enderror" required>
                            <option value="mikro" {{ old('business_scale', $business->business_scale) == 'mikro' ? 'selected' : '' }}>Mikro (Aset &lt; 50 Juta)</option>
                            <option value="kecil" {{ old('business_scale', $business->business_scale) == 'kecil' ? 'selected' : '' }}>Kecil (Aset 50 Juta - 500 Juta)</option>
                            <option value="menengah" {{ old('business_scale', $business->business_scale) == 'menengah' ? 'selected' : '' }}>Menengah (Aset &gt; 500 Juta)</option>
                        </select>
                        <small class="text-muted">Berdasarkan nilai aset usaha</small>
                        @error('business_scale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Berdiri</label>
                        <input type="number" name="established_year" class="form-control @error('established_year') is-invalid @enderror" 
                               value="{{ old('established_year', $business->established_year) }}" min="1900" max="{{ date('Y') }}"
                               placeholder="Contoh: 2020">
                        <small class="text-muted">Tahun usaha mulai beroperasi (opsional)</small>
                        @error('established_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi Usaha <span class="text-danger">*</span></label>
                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required
                              placeholder="Ceritakan tentang usaha Anda, produk/layanan yang ditawarkan, keunggulan, dan hal menarik lainnya...">{{ old('description', $business->description) }}</textarea>
                    <small class="text-muted">Jelaskan usaha Anda secara detail untuk menarik perhatian pengunjung (minimal 50 karakter)</small>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Produk Utama</label>
                        <input type="text" name="main_product" class="form-control @error('main_product') is-invalid @enderror" 
                               value="{{ old('main_product', $business->main_product) }}"
                               placeholder="Contoh: Kue Kering, Tas Anyaman, Ikan Segar">
                        <small class="text-muted">Sebutkan produk/layanan unggulan (opsional)</small>
                        @error('main_product')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Jumlah Karyawan</label>
                        <input type="number" name="employee_count" class="form-control @error('employee_count') is-invalid @enderror" 
                               value="{{ old('employee_count', $business->employee_count) }}" min="1"
                               placeholder="1">
                        <small class="text-muted">Total pegawai termasuk pemilik</small>
                        @error('employee_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Omzet/Bulan (Rp)</label>
                        <input type="number" name="monthly_revenue" class="form-control @error('monthly_revenue') is-invalid @enderror" 
                               value="{{ old('monthly_revenue', $business->monthly_revenue) }}" min="0"
                               placeholder="5000000">
                        <small class="text-muted">Perkiraan pendapatan per bulan</small>
                        @error('monthly_revenue')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $business->phone) }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" 
                               value="{{ old('whatsapp', $business->whatsapp) }}">
                        @error('whatsapp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $business->email) }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                    <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $business->address) }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                        <input type="text" name="village" class="form-control @error('village') is-invalid @enderror" 
                               value="{{ old('village', $business->village) }}" required>
                        @error('village')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select name="district" class="form-select @error('district') is-invalid @enderror" required>
                            <option value="">Pilih Kecamatan</option>
                            @foreach(['Aek Kuasan', 'Aek Ledong', 'Air Batu', 'Air Joman', 'Bandar Pasir Mandoge', 'Bandar Pulau', 'Buntu Pane', 'Kisaran Barat', 'Kisaran Timur', 'Meranti', 'Pulau Rakyat', 'Rawang Panca Arga', 'Sei Dadap', 'Sei Kepayang', 'Sei Semayang', 'Setia Janji', 'Simpang Empat', 'Silau Laut', 'Tanjung Balai', 'Teluk Dalam'] as $kec)
                                <option value="{{ $kec }}" {{ old('district', $business->district) == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                            @endforeach
                        </select>
                        @error('district')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" 
                               value="{{ old('postal_code', $business->postal_code) }}" maxlength="5">
                        @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="map-instruction">
                    <i class="bi bi-cursor-fill"></i>
                    <div>
                        <strong>Klik pada peta untuk mengubah lokasi usaha Anda</strong>
                        <br><small>Gunakan layer control di kanan atas untuk mengganti tampilan peta (Satelit/Jalan)</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <button type="button" class="btn btn-success btn-lg w-100" id="useMyLocation" onclick="useMyLocation()">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span id="locationBtnText">Gunakan Lokasi Saya Sekarang</span>
                        <span id="locationBtnLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                    </button>
                    <small class="text-muted d-block mt-2 text-center">
                        <i class="bi bi-info-circle"></i> Browser akan meminta izin akses lokasi Anda
                    </small>
                </div>
                
                <div id="map" class="map-container-form mb-3"></div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Latitude <span class="text-danger">*</span></label>
                        <input type="text" name="latitude" id="latitude" class="form-control coord-display @error('latitude') is-invalid @enderror" 
                               value="{{ old('latitude', $business->latitude) }}" required readonly>
                        @error('latitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Longitude <span class="text-danger">*</span></label>
                        <input type="text" name="longitude" id="longitude" class="form-control coord-display @error('longitude') is-invalid @enderror" 
                               value="{{ old('longitude', $business->longitude) }}" required readonly>
                        @error('longitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        <input type="text" name="nib" class="form-control @error('nib') is-invalid @enderror" 
                               value="{{ old('nib', $business->nib) }}">
                        @error('nib')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">P-IRT</label>
                        <input type="text" name="pirt" class="form-control @error('pirt') is-invalid @enderror" 
                               value="{{ old('pirt', $business->pirt) }}" placeholder="Nomor P-IRT (untuk produk pangan)">
                        @error('pirt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Sertifikat Halal</label>
                        <input type="text" name="halal_certificate" class="form-control @error('halal_certificate') is-invalid @enderror" 
                               value="{{ old('halal_certificate', $business->halal_certificate) }}" placeholder="Nomor Sertifikat Halal">
                        @error('halal_certificate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" 
                               value="{{ old('instagram', $business->instagram) }}" placeholder="@username">
                        @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" 
                               value="{{ old('facebook', $business->facebook) }}">
                        @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" 
                               value="{{ old('website', $business->website) }}">
                        @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto Existing & Upload Baru -->
        <div class="form-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-images"></i> Foto Usaha & Produk</h5>
            </div>
            <div class="card-body">
                @if($business->photos->count() > 0)
                    <h6 class="mb-3">Foto Saat Ini</h6>
                    <div class="row mb-4">
                        @foreach($business->photos as $photo)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ Storage::url($photo->photo_path) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <small class="d-block mb-1"><strong>{{ $photo->getPhotoTypeLabel() }}</strong></small>
                                        @if($photo->caption)
                                            <small class="text-muted d-block mb-2">{{ $photo->caption }}</small>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm w-100" onclick="deletePhoto({{ $photo->id }})">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
                
                <h6 class="mb-3">Tambah Foto Baru</h6>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Format: JPG, PNG. Maksimal 2MB per foto.
                </div>
                
                <div id="photoContainer">
                    <div class="row mb-3 photo-item">
                        <div class="col-md-5">
                            <input type="file" name="new_photos[]" class="form-control" accept="image/*">
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
                    <i class="bi bi-plus-circle"></i> Tambah Foto Lagi
                </button>
            </div>
        </div>

        <!-- Submit -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user.business.show', $business->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-save"></i> Update Data Usaha
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Initialize Map with FULL HYBRID View (Same as Homepage)
    const map = L.map('map', {
        center: [{{ $business->latitude }}, {{ $business->longitude }}],
        zoom: 16,
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
    
    let marker = L.marker([{{ $business->latitude }}, {{ $business->longitude }}], { icon: userIcon }).addTo(map);
    marker.bindPopup('<strong>Lokasi Usaha Saat Ini</strong><br>Klik peta untuk mengubah').openPopup();
    
    // Click on map to update location
    map.on('click', function(e) {
        setMarkerAtLocation(e.latlng.lat, e.latlng.lng);
    });
    
    // Function to set marker at specific location
    function setMarkerAtLocation(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }
        
        marker = L.marker([lat, lng], { icon: userIcon }).addTo(map);
        marker.bindPopup('<strong>Lokasi Usaha Baru</strong><br>Lat: ' + lat.toFixed(6) + '<br>Lng: ' + lng.toFixed(6)).openPopup();
        
        document.getElementById('latitude').value = lat.toFixed(8);
        document.getElementById('longitude').value = lng.toFixed(8);
        
        // Animate to marker
        map.setView([lat, lng], 16, { animate: true, duration: 0.5 });
    }
    
    // Use My Location feature
    function useMyLocation() {
        const btn = document.getElementById('useMyLocation');
        const btnText = document.getElementById('locationBtnText');
        const btnLoader = document.getElementById('locationBtnLoader');
        
        // Check if geolocation is supported
        if (!navigator.geolocation) {
            Swal.fire({
                icon: 'error',
                title: 'Tidak Didukung',
                text: 'Browser Anda tidak mendukung fitur lokasi',
                confirmButtonColor: '#2D5F3F'
            });
            return;
        }
        
        // Show loading state
        btn.classList.add('loading');
        btnText.textContent = 'Mengambil lokasi...';
        btnLoader.classList.remove('d-none');
        
        // Get current position
        navigator.geolocation.getCurrentPosition(
            function(position) {
                // Success callback
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                // Set marker at current location
                setMarkerAtLocation(lat, lng);
                
                // Reset button state
                btn.classList.remove('loading');
                btnText.textContent = 'Lokasi Berhasil Diubah! ✓';
                btnLoader.classList.add('d-none');
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Lokasi Ditemukan!',
                    text: 'Lokasi usaha Anda berhasil diperbarui',
                    timer: 2000,
                    showConfirmButton: false
                });
                
                // Reset button text after 3 seconds
                setTimeout(function() {
                    btnText.textContent = 'Gunakan Lokasi Saya Sekarang';
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-success');
                }, 3000);
            },
            function(error) {
                // Error callback
                btn.classList.remove('loading');
                btnText.textContent = 'Gunakan Lokasi Saya Sekarang';
                btnLoader.classList.add('d-none');
                
                let errorMessage = 'Gagal mendapatkan lokasi Anda';
                
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = 'Anda menolak izin akses lokasi. Silakan aktifkan di pengaturan browser.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = 'Informasi lokasi tidak tersedia.';
                        break;
                    case error.TIMEOUT:
                        errorMessage = 'Permintaan lokasi timeout. Coba lagi.';
                        break;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mendapatkan Lokasi',
                    text: errorMessage,
                    confirmButtonColor: '#2D5F3F'
                });
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }
    
    // Add photo field dynamically
    function addPhotoField() {
        const container = document.getElementById('photoContainer');
        const newField = document.createElement('div');
        newField.className = 'row mb-3 photo-item';
        newField.innerHTML = `
            <div class="col-md-5">
                <input type="file" name="new_photos[]" class="form-control" accept="image/*">
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
    
    // Delete existing photo
    const photosToDelete = [];
    
    function deletePhoto(photoId) {
        Swal.fire({
            title: 'Hapus Foto?',
            text: 'Foto akan dihapus setelah Anda menyimpan perubahan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Add to delete list
                photosToDelete.push(photoId);
                
                // Create hidden input to track deletions
                const form = document.querySelector('form');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_photos[]';
                input.value = photoId;
                form.appendChild(input);
                
                // Hide the photo card visually
                event.target.closest('.col-md-3').style.display = 'none';
                
                Swal.fire({
                    title: 'Ditandai untuk Dihapus',
                    text: 'Foto akan dihapus saat Anda menyimpan perubahan',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endpush
@endsection
