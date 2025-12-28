@extends('layouts.app')

@section('title', $business->business_name)

@push('styles')
<style>
    .business-header {
        background: white;
        padding: 2rem 0;
        border-bottom: 2px solid #dee2e6;
    }
    
    .business-photo {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .info-table {
        background: white;
        border-radius: 8px;
    }
    
    .info-table th {
        background: #f8f9fa;
        font-weight: 600;
        width: 200px;
    }
    
    #businessMap {
        height: 400px;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
<div class="business-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">{{ $business->business_name }}</li>
            </ol>
        </nav>
        <h1>{{ $business->business_name }}</h1>
        <p class="text-muted mb-0">
            <i class="bi bi-tag"></i> {{ ucfirst($business->business_type) }} | 
            <i class="bi bi-geo-alt"></i> {{ $business->district }}
        </p>
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <!-- Photos -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-images"></i> Foto Usaha
                </div>
                <div class="card-body">
                    @if($business->photos->count() > 0)
                        <div class="row">
                            @foreach($business->photos as $photo)
                                <div class="col-md-6 mb-3">
                                    <img src="{{ Storage::url($photo->photo_path) }}" class="business-photo" alt="Foto {{ $business->business_name }}">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada foto</p>
                    @endif
                </div>
            </div>
            
            <!-- Description -->
            <div class="card mt-3">
                <div class="card-header">
                    <i class="bi bi-file-text"></i> Deskripsi
                </div>
                <div class="card-body">
                    <p>{{ $business->description }}</p>
                </div>
            </div>
        </div>
        
        <!-- Info -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Informasi Usaha
                </div>
                <div class="card-body">
                    <table class="table table-borderless info-table mb-0">
                        <tr>
                            <th>Pemilik</th>
                            <td>{{ $business->owner_name }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Usaha</th>
                            <td>{{ ucfirst($business->business_type) }}</td>
                        </tr>
                        <tr>
                            <th>Skala</th>
                            <td>{{ ucfirst($business->business_scale) }}</td>
                        </tr>
                        @if($business->established_year)
                        <tr>
                            <th>Tahun Berdiri</th>
                            <td>{{ $business->established_year }}</td>
                        </tr>
                        @endif
                        @if($business->main_product)
                        <tr>
                            <th>Produk Utama</th>
                            <td>{{ $business->main_product }}</td>
                        </tr>
                        @endif
                        @if($business->employee_count)
                        <tr>
                            <th>Karyawan</th>
                            <td>{{ $business->employee_count }} orang</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            
            <!-- Contact -->
            <div class="card mt-3">
                <div class="card-header">
                    <i class="bi bi-telephone"></i> Kontak
                </div>
                <div class="card-body">
                    @if($business->phone)
                    <p><i class="bi bi-telephone"></i> <a href="tel:{{ $business->phone }}">{{ $business->phone }}</a></p>
                    @endif
                    
                    @if($business->whatsapp)
                    <p><i class="bi bi-whatsapp"></i> <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $business->whatsapp) }}" target="_blank">{{ $business->whatsapp }}</a></p>
                    @endif
                    
                    @if($business->email)
                    <p><i class="bi bi-envelope"></i> <a href="mailto:{{ $business->email }}">{{ $business->email }}</a></p>
                    @endif
                    
                    @if($business->instagram)
                    <p><i class="bi bi-instagram"></i> <a href="https://instagram.com/{{ ltrim($business->instagram, '@') }}" target="_blank">{{ $business->instagram }}</a></p>
                    @endif
                    
                    @if($business->website)
                    <p><i class="bi bi-globe"></i> <a href="{{ $business->website }}" target="_blank">Website</a></p>
                    @endif
                </div>
            </div>
            
            <!-- Location -->
            <div class="card mt-3">
                <div class="card-header">
                    <i class="bi bi-geo-alt"></i> Lokasi
                </div>
                <div class="card-body">
                    <p><strong>Alamat:</strong><br>{{ $business->address }}</p>
                    <p><strong>Desa/Kelurahan:</strong> {{ $business->village }}</p>
                    <p><strong>Kecamatan:</strong> {{ $business->district }}</p>
                    <div id="businessMap" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Map
    const map = L.map('businessMap').setView([{{ $business->latitude }}, {{ $business->longitude }}], 16);
    
    L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: '© Google'
    }).addTo(map);
    
    L.tileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: ''
    }).addTo(map);
    
    // Marker
    L.marker([{{ $business->latitude }}, {{ $business->longitude }}])
        .addTo(map)
        .bindPopup('<strong>{{ $business->business_name }}</strong>')
        .openPopup();
});
</script>
@endpush
