@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    .hero-dinas {
        background: linear-gradient(135deg, #1a4d2e 0%, #2d6a4f 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
    }
    
    .hero-dinas h1 {
        font-size: 2rem;
        font-weight: 700;
        color: white;
    }
    
    .stats-box {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .stats-box i {
        font-size: 3rem;
        color: #2D5F3F;
        margin-bottom: 1rem;
    }
    
    .stats-box h3 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2D5F3F;
        margin: 0;
    }
    
    .stats-box p {
        color: #6c757d;
        margin: 0;
    }
    
    .map-section {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    #map {
        height: 500px;
        border-radius: 8px;
    }
    
    @media (max-width: 768px) {
        .hero-dinas h1 {
            font-size: 1.5rem;
        }
        
        .stats-box {
            margin-bottom: 1rem;
        }
        
        #map {
            height: 400px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<section class="hero-dinas">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="mb-3">Peta Digital UMKM Kabupaten Asahan</h1>
                <p class="lead mb-4">Sistem Informasi Pendataan dan Pemetaan Usaha Mikro, Kecil, dan Menengah</p>
                
                @guest
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg me-2">
                    <i class="bi bi-person-plus"></i> Daftar UMKM
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                @endguest
                
                @auth
                @if(!auth()->user()->isAdmin())
                <a href="{{ route('user.business.create') }}" class="btn btn-warning btn-lg">
                    <i class="bi bi-plus-circle"></i> Daftarkan Usaha Anda
                </a>
                @endif
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="container my-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="stats-box">
                <i class="bi bi-building"></i>
                <h3>{{ \App\Models\Business::where('status', 'approved')->count() }}</h3>
                <p>UMKM Terdaftar</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-box">
                <i class="bi bi-people"></i>
                <h3>{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                <p>Pengguna</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-box">
                <i class="bi bi-geo-alt"></i>
                <h3>25</h3>
                <p>Kecamatan</p>
            </div>
        </div>
    </div>
</section>

<!-- Map -->
<section class="container my-4">
    <div class="map-section">
        <h2 class="mb-3">Peta Sebaran UMKM</h2>
        <div id="map"></div>
    </div>
</section>

<!-- Info -->
<section class="container my-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Tentang Aplikasi
                </div>
                <div class="card-body">
                    <p>Aplikasi Peta Digital UMKM Kabupaten Asahan merupakan sistem informasi untuk pendataan dan pemetaan usaha mikro, kecil, dan menengah di wilayah Kabupaten Asahan.</p>
                    <p class="mb-0">Aplikasi ini dikelola oleh Dinas Koperasi, Perdagangan dan Perindustrian Kabupaten Asahan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-question-circle"></i> Cara Mendaftar
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li>Klik tombol "Daftar" pada menu</li>
                        <li>Isi form registrasi dan verifikasi email</li>
                        <li>Login dan daftarkan usaha Anda</li>
                        <li>Tunggu approval dari admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize map
    const map = L.map('map').setView([2.9833, 99.6167], 11);
    
    // Google Satellite
    L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: '© Google'
    }).addTo(map);
    
    // Google Labels
    L.tileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: ''
    }).addTo(map);
    
    // Load businesses
    $.ajax({
        url: '/api/businesses',
        success: function(businesses) {
            businesses.forEach(function(business) {
                if (business.latitude && business.longitude) {
                    const marker = L.marker([business.latitude, business.longitude]);
                    
                    marker.bindPopup(`
                        <div style="min-width: 200px;">
                            <h6 class="mb-2"><strong>${business.business_name}</strong></h6>
                            <p class="mb-1"><small><i class="bi bi-geo-alt"></i> ${business.address}</small></p>
                            <p class="mb-1"><small><i class="bi bi-tag"></i> ${business.business_type}</small></p>
                            <a href="/business/${business.id}" class="btn btn-sm btn-primary mt-2">Detail</a>
                        </div>
                    `);
                    
                    marker.addTo(map);
                }
            });
        }
    });
});
</script>
@endpush
