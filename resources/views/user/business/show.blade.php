@extends('layouts.app')

@section('title', 'Detail Usaha')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-shop"></i> Detail Usaha
        </h1>
        <p class="mb-0">{{ $business->business_name }}</p>
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Status Alert -->
            @if($business->status == 'pending')
                <div class="alert alert-warning">
                    <i class="bi bi-clock-history"></i> 
                    <strong>Menunggu Persetujuan Admin</strong><br>
                    Data usaha Anda sedang dalam proses verifikasi oleh admin.
                </div>
            @elseif($business->status == 'approved')
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> 
                    <strong>Usaha Telah Disetujui</strong><br>
                    Data usaha Anda sudah ditampilkan di peta digital.
                    @if($business->approved_at)
                        <br><small>Disetujui pada: {{ $business->approved_at->format('d F Y, H:i') }}</small>
                    @endif
                </div>
            @elseif($business->status == 'rejected')
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i> 
                    <strong>Usaha Ditolak</strong><br>
                    Alasan: {{ $business->rejection_reason }}
                    <br><small>Silakan edit dan ajukan kembali data usaha Anda.</small>
                </div>
            @endif

            <!-- Basic Info -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Dasar</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="200"><strong>Nama Usaha</strong></td>
                            <td>{{ $business->business_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Pemilik</strong></td>
                            <td>{{ $business->owner_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Usaha</strong></td>
                            <td><span class="badge bg-primary">{{ $business->getBusinessTypeLabel() }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Skala Usaha</strong></td>
                            <td>{{ ucfirst($business->business_scale) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi</strong></td>
                            <td>{{ $business->description }}</td>
                        </tr>
                        @if($business->main_product)
                        <tr>
                            <td><strong>Produk Utama</strong></td>
                            <td>{{ $business->main_product }}</td>
                        </tr>
                        @endif
                        @if($business->established_year)
                        <tr>
                            <td><strong>Tahun Berdiri</strong></td>
                            <td>{{ $business->established_year }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>Jumlah Karyawan</strong></td>
                            <td>{{ $business->employee_count }} orang</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-telephone"></i> Informasi Kontak</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="200"><strong>Telepon</strong></td>
                            <td>{{ $business->phone }}</td>
                        </tr>
                        @if($business->whatsapp)
                        <tr>
                            <td><strong>WhatsApp</strong></td>
                            <td>
                                <a href="https://wa.me/{{ $business->whatsapp }}" target="_blank">
                                    {{ $business->whatsapp }} <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($business->email)
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $business->email }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            <!-- Address -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Alamat & Lokasi</h5>
                </div>
                <div class="card-body">
                    <p><strong>{{ $business->address }}</strong></p>
                    <p class="mb-3">{{ $business->village }}, {{ $business->district }}
                    @if($business->postal_code), {{ $business->postal_code }}@endif</p>
                    
                    <div id="map" style="height: 300px; border-radius: 10px;"></div>
                </div>
            </div>

            <!-- Photos -->
            @if($business->photos->count() > 0)
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-images"></i> Foto</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($business->photos as $photo)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ Storage::url($photo->photo_path) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body p-2">
                                    <small class="text-muted">{{ $photo->getPhotoTypeLabel() }}</small>
                                    @if($photo->caption)
                                    <br><small>{{ $photo->caption }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <!-- Actions -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-gear"></i> Aksi</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.business.edit', $business->id) }}" class="btn btn-warning w-100 mb-2">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                    <button onclick="deleteConfirm()" class="btn btn-danger w-100 mb-2">
                        <i class="bi bi-trash"></i> Hapus Data
                    </button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Social Media -->
            @if($business->instagram || $business->facebook || $business->website)
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-share"></i> Media Sosial</h5>
                </div>
                <div class="card-body">
                    @if($business->instagram)
                    <a href="https://instagram.com/{{ ltrim($business->instagram, '@') }}" target="_blank" class="btn btn-outline-danger w-100 mb-2">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                    @endif
                    @if($business->facebook)
                    <a href="{{ $business->facebook }}" target="_blank" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    @endif
                    @if($business->website)
                    <a href="{{ $business->website }}" target="_blank" class="btn btn-outline-info w-100">
                        <i class="bi bi-globe"></i> Website
                    </a>
                    @endif
                </div>
            </div>
            @endif

            <!-- Legal Info -->
            @if($business->nib || $business->pirt || $business->halal_certificate)
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-file-text"></i> Legalitas</h5>
                </div>
                <div class="card-body">
                    @if($business->nib)
                    <p class="mb-2"><strong>NIB:</strong> {{ $business->nib }}</p>
                    @endif
                    @if($business->pirt)
                    <p class="mb-2"><strong>P-IRT:</strong> {{ $business->pirt }}</p>
                    @endif
                    @if($business->halal_certificate)
                    <p class="mb-0"><strong>Sertifikat Halal:</strong> {{ $business->halal_certificate }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize map
    const map = L.map('map').setView([{{ $business->latitude }}, {{ $business->longitude }}], 15);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    
    L.marker([{{ $business->latitude }}, {{ $business->longitude }}])
        .addTo(map)
        .bindPopup('<strong>{{ $business->business_name }}</strong>').openPopup();

    function deleteConfirm() {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data usaha ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('user.business.destroy', $business->id) }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endpush
@endsection
