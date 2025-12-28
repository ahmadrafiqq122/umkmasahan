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
        background: #e5e3df; /* OSM tile color saat loading */
    }
    
    .leaflet-tile-container {
        transition: opacity 0.2s;
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
        <div class="row align-items-center mb-3">
            <div class="col-md-4">
                <h2 class="mb-0">Peta Sebaran UMKM</h2>
            </div>
            <div class="col-md-8">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" id="searchBusiness" class="form-control" placeholder="🔍 Cari nama usaha...">
                    </div>
                    <div class="col-md-4">
                        <select id="filterKecamatan" class="form-select">
                            <option value="">📍 Semua Kecamatan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select id="filterJenisUsaha" class="form-select">
                            <option value="">🏪 Semua Jenis Usaha</option>
                            <option value="kuliner">🍽️ Kuliner</option>
                            <option value="fashion">👕 Fashion</option>
                            <option value="kerajinan">🎨 Kerajinan</option>
                            <option value="pertanian">🌾 Pertanian</option>
                            <option value="perikanan">🐟 Perikanan</option>
                            <option value="jasa">⚙️ Jasa</option>
                            <option value="perdagangan">🏬 Perdagangan</option>
                            <option value="lainnya">📦 Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Legend -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-3 align-items-center small">
                    <strong>Legenda:</strong>
                    <span><span style="font-size: 1.5rem;">🍽️</span> Kuliner</span>
                    <span><span style="font-size: 1.5rem;">👕</span> Fashion</span>
                    <span><span style="font-size: 1.5rem;">🎨</span> Kerajinan</span>
                    <span><span style="font-size: 1.5rem;">🌾</span> Pertanian</span>
                    <span><span style="font-size: 1.5rem;">🐟</span> Perikanan</span>
                    <span><span style="font-size: 1.5rem;">⚙️</span> Jasa</span>
                    <span><span style="font-size: 1.5rem;">🏬</span> Perdagangan</span>
                    <span><span style="font-size: 1.5rem;">📦</span> Lainnya</span>
                </div>
            </div>
        </div>
        
        <div id="map"></div>
        
        <div class="mt-2 text-muted small">
            <span id="totalMarkers">0</span> UMKM ditampilkan
        </div>
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
// Test jQuery dan Leaflet
console.log('jQuery loaded:', typeof $ !== 'undefined');
console.log('Leaflet loaded:', typeof L !== 'undefined');

$(document).ready(function() {
    console.log('DOM Ready!');
    
    // Initialize map
    console.log('Initializing map...');
    const map = L.map('map').setView([2.9833, 99.6167], 11);
    console.log('Map initialized:', map);
    
    // OpenStreetMap dengan multiple servers untuk reliability
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap',
        subdomains: ['a', 'b', 'c'],
        errorTileUrl: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==',
        crossOrigin: true
    }).addTo(map);
    
    // Custom icon function - Google Maps style dengan label nama
    function getBusinessIcon(type, businessName) {
        const config = {
            'kuliner': { icon: '🍽️', color: '#EA4335' },      // Merah
            'fashion': { icon: '👕', color: '#9C27B0' },      // Ungu
            'kerajinan': { icon: '🎨', color: '#FF9800' },    // Orange
            'pertanian': { icon: '🌾', color: '#4CAF50' },    // Hijau
            'perikanan': { icon: '🐟', color: '#2196F3' },    // Biru
            'jasa': { icon: '⚙️', color: '#607D8B' },         // Abu
            'perdagangan': { icon: '🏬', color: '#00BCD4' },  // Cyan
            'lainnya': { icon: '📦', color: '#795548' }       // Coklat
        };
        
        const item = config[type] || { icon: '📍', color: '#2D5F3F' };
        
        // Truncate nama jika terlalu panjang
        const displayName = businessName.length > 18 ? businessName.substring(0, 18) + '...' : businessName;
        
        return L.divIcon({
            html: `
                <div style="display: inline-block; text-align: center;">
                    <div style="
                        background: ${item.color};
                        width: 32px;
                        height: 32px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 2px solid white;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
                        cursor: pointer;
                        margin: 0 auto 2px auto;
                    ">
                        <span style="font-size: 1.1rem;">${item.icon}</span>
                    </div>
                    <div style="
                        background: rgba(255,255,255,0.95);
                        color: #333;
                        padding: 1px 4px;
                        border-radius: 2px;
                        font-size: 9px;
                        font-weight: 600;
                        white-space: nowrap;
                        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
                    ">${displayName}</div>
                </div>
            `,
            className: 'marker-with-label',
            iconSize: [32, 32],
            iconAnchor: [16, 16],
            popupAnchor: [0, -20]
        });
    }
    
    let allBusinesses = [];
    let markers = [];
    let kecamatanList = new Set();
    
    // Load businesses
    $.ajax({
        url: '/api/businesses',
        success: function(businesses) {
            console.log('Businesses loaded:', businesses.length, businesses);
            allBusinesses = businesses;
            
            // Populate kecamatan dropdown
            businesses.forEach(b => kecamatanList.add(b.district));
            const sortedKecamatan = Array.from(kecamatanList).sort();
            sortedKecamatan.forEach(kec => {
                $('#filterKecamatan').append(`<option value="${kec}">${kec}</option>`);
            });
            
            // Display all markers initially
            displayMarkers(businesses);
        },
        error: function(xhr, status, error) {
            console.error('Failed to load businesses:', status, error);
        }
    });
    
    // Display markers function
    function displayMarkers(businesses) {
        console.log('displayMarkers called with', businesses.length, 'businesses');
        
        // Clear existing markers
        markers.forEach(m => map.removeLayer(m));
        markers = [];
        
        // Add new markers
        businesses.forEach(function(business) {
            console.log('Processing business:', business.business_name, 'at', business.latitude, business.longitude);
            
            if (business.latitude && business.longitude) {
                const icon = getBusinessIcon(business.business_type, business.business_name);
                const marker = L.marker([business.latitude, business.longitude], { icon: icon });
                
                console.log('Marker created for:', business.business_name);
                
                marker.businessData = business; // Store for filtering
                
                marker.bindPopup(`
                    <div style="min-width: 220px;">
                        <h6 class="mb-2"><strong>${business.business_name}</strong></h6>
                        <p class="mb-1"><small><i class="bi bi-tag"></i> ${business.business_type.toUpperCase()}</small></p>
                        <p class="mb-1"><small><i class="bi bi-geo-alt"></i> ${business.address}</small></p>
                        <a href="/business/${business.id}" class="btn btn-sm btn-primary mt-2 w-100">Lihat Detail</a>
                    </div>
                `);
                
                marker.addTo(map);
                markers.push(marker);
            }
        });
        
        // Update counter
        $('#totalMarkers').text(businesses.length);
    }
    
    // Filter function
    function filterBusinesses() {
        const searchTerm = $('#searchBusiness').val().toLowerCase();
        const kecamatan = $('#filterKecamatan').val();
        const jenisUsaha = $('#filterJenisUsaha').val();
        
        const filtered = allBusinesses.filter(b => {
            const matchSearch = !searchTerm || b.business_name.toLowerCase().includes(searchTerm);
            const matchKecamatan = !kecamatan || b.district === kecamatan;
            const matchJenisUsaha = !jenisUsaha || b.business_type === jenisUsaha;
            
            return matchSearch && matchKecamatan && matchJenisUsaha;
        });
        
        displayMarkers(filtered);
        
        // Fit bounds if there are results
        if (filtered.length > 0 && markers.length > 0) {
            const group = L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }
    
    // Event listeners
    $('#searchBusiness').on('input', filterBusinesses);
    $('#filterKecamatan').on('change', filterBusinesses);
    $('#filterJenisUsaha').on('change', filterBusinesses);
});
</script>
@endpush
