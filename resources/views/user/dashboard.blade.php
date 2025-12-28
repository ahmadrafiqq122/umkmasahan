@extends('layouts.app')

@section('title', 'Dashboard Pelaku Usaha')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        color: white;
        padding: 2.5rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 20px 20px;
    }
    
    .welcome-banner {
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 3s ease-in-out infinite;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card-user {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .stat-card-user:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .stat-icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    
    .stat-text {
        color: var(--gray-700);
        font-size: 0.9rem;
    }
    
    .business-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }
    
    .business-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .business-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: start;
    }
    
    .business-body {
        padding: 1.5rem;
    }
    
    .business-footer {
        padding: 1rem 1.5rem;
        background: var(--gray-50);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .status-badge-large {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .info-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        color: var(--gray-700);
    }
    
    .info-row i {
        width: 20px;
        color: var(--asahan-green);
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .empty-state-icon {
        font-size: 5rem;
        color: var(--gray-300);
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="container">
        <div class="welcome-banner">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-2">
                        <i class="bi bi-person-circle me-2"></i>Selamat Datang, {{ auth()->user()->name }}!
                    </h2>
                    <p class="mb-0 opacity-90">Kelola dan kembangkan usaha Anda melalui dashboard ini</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card-user">
            <div class="stat-icon-circle" style="background: rgba(45,95,63,0.1); color: var(--asahan-green);">
                <i class="bi bi-shop"></i>
            </div>
            <div class="stat-number" style="color: var(--asahan-green);">{{ $stats['total'] }}</div>
            <div class="stat-text">Total Usaha</div>
        </div>
        
        <div class="stat-card-user">
            <div class="stat-icon-circle" style="background: rgba(16,185,129,0.1); color: #10b981;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-number" style="color: #10b981;">{{ $stats['approved'] }}</div>
            <div class="stat-text">Disetujui</div>
        </div>
        
        <div class="stat-card-user">
            <div class="stat-icon-circle" style="background: rgba(245,158,11,0.1); color: #f59e0b;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-number" style="color: #f59e0b;">{{ $stats['pending'] }}</div>
            <div class="stat-text">Menunggu</div>
        </div>
        
        <div class="stat-card-user">
            <div class="stat-icon-circle" style="background: rgba(239,68,68,0.1); color: #ef4444;">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="stat-number" style="color: #ef4444;">{{ $stats['rejected'] }}</div>
            <div class="stat-text">Ditolak</div>
        </div>
    </div>
    
    <!-- Business List -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0" style="color: var(--asahan-green);">
                <i class="bi bi-list-ul me-2"></i>Daftar Usaha Anda
            </h5>
            @if($businesses->count() > 0)
                <a href="{{ route('user.business.create') }}" class="btn btn-asahan-primary">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Usaha
                </a>
            @endif
        </div>
        
        @if($businesses->count() > 0)
            <div class="row">
                @foreach($businesses as $business)
                    <div class="col-lg-6">
                        <div class="business-card">
                            <div class="business-header">
                                <div>
                                    <h5 class="mb-1 fw-bold" style="color: var(--asahan-green);">{{ $business->business_name }}</h5>
                                    <p class="text-muted mb-0 small">{{ $business->owner_name }}</p>
                                </div>
                                <span class="status-badge-large bg-{{ $business->status === 'approved' ? 'success' : ($business->status === 'pending' ? 'warning' : 'danger') }}">
                                    @if($business->status === 'approved')
                                        <i class="bi bi-check-circle me-1"></i>Disetujui
                                    @elseif($business->status === 'pending')
                                        <i class="bi bi-clock me-1"></i>Menunggu
                                    @else
                                        <i class="bi bi-x-circle me-1"></i>Ditolak
                                    @endif
                                </span>
                            </div>
                            
                            <div class="business-body">
                                <div class="info-row">
                                    <i class="bi bi-tag-fill"></i>
                                    <span>{{ $business->getBusinessTypeLabel() }}</span>
                                </div>
                                <div class="info-row">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>{{ $business->district }}</span>
                                </div>
                                <div class="info-row">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span>{{ $business->phone ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <i class="bi bi-images"></i>
                                    <span>{{ $business->photos_count }} Foto</span>
                                </div>
                                @if($business->status === 'rejected' && $business->rejection_reason)
                                    <div class="alert alert-danger mt-3 mb-0">
                                        <small><strong>Alasan Penolakan:</strong><br>{{ $business->rejection_reason }}</small>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="business-footer">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>{{ $business->created_at->format('d M Y') }}
                                </small>
                                <div class="btn-group">
                                    <a href="{{ route('user.business.show', $business->id) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('user.business.edit', $business->id) }}" 
                                       class="btn btn-sm btn-outline-warning"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="deleteConfirm({{ $business->id }})"
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <h4 class="fw-bold mb-2" style="color: var(--gray-700);">Belum Ada Data Usaha</h4>
                <p class="text-muted mb-4">Mulai daftarkan usaha Anda sekarang dan dapatkan<br>eksposur lebih luas di peta digital UMKM Kabupaten Asahan</p>
                <a href="{{ route('user.business.create') }}" class="btn btn-asahan-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Daftarkan Usaha Pertama
                </a>
            </div>
        @endif
    </div>
    
    <!-- Tips Section -->
    @if($businesses->count() > 0)
        <div class="card-asahan mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Tips Mengoptimalkan Profil Usaha</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex gap-3">
                            <i class="bi bi-check-circle-fill" style="color: var(--asahan-gold); font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Lengkapi Informasi</h6>
                                <p class="text-muted mb-0 small">Pastikan semua data usaha terisi lengkap dan akurat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex gap-3">
                            <i class="bi bi-check-circle-fill" style="color: var(--asahan-gold); font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Upload Foto Berkualitas</h6>
                                <p class="text-muted mb-0 small">Gunakan foto produk dan tempat usaha yang menarik</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex gap-3">
                            <i class="bi bi-check-circle-fill" style="color: var(--asahan-gold); font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Update Lokasi GPS</h6>
                                <p class="text-muted mb-0 small">Pastikan koordinat lokasi usaha sudah benar di peta</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex gap-3">
                            <i class="bi bi-check-circle-fill" style="color: var(--asahan-gold); font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Deskripsi Menarik</h6>
                                <p class="text-muted mb-0 small">Tulis deskripsi usaha yang jelas dan menarik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function deleteConfirm(id) {
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
            form.action = `/user/business/${id}`;
            
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
