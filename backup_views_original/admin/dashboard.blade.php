@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        color: white;
        padding: 2.5rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 20px 20px;
    }
    
    .welcome-card {
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card-modern {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .stat-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--stat-color);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1rem;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        color: var(--gray-700);
        font-size: 0.9rem;
    }
    
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .quick-action-btn {
        background: white;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        text-decoration: none;
        color: var(--gray-900);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
    }
    
    .quick-action-btn:hover {
        border-color: var(--asahan-green);
        background: var(--asahan-green);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(45,95,63,0.2);
    }
    
    .quick-action-btn i {
        font-size: 2rem;
    }
    
    .recent-activity {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .activity-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-bottom: 1px solid var(--gray-200);
        transition: background 0.2s ease;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-item:hover {
        background: var(--gray-50);
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
</style>
@endpush

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="welcome-card">
                    <h2 class="fw-bold mb-2">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                    </h2>
                    <p class="mb-0 opacity-90">Selamat datang, {{ auth()->user()->name }}! Kelola seluruh data UMKM Kabupaten Asahan</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="text-white">
                    <p class="mb-1 opacity-75">Tanggal Hari Ini</p>
                    <h5 class="mb-0">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card-modern" style="--stat-color: #2D5F3F;">
            <div class="stat-icon" style="background: rgba(45,95,63,0.1); color: var(--asahan-green);">
                <i class="bi bi-shop"></i>
            </div>
            <div class="stat-value" style="color: var(--asahan-green);">{{ $stats['total_businesses'] }}</div>
            <div class="stat-label">Total UMKM</div>
        </div>
        
        <div class="stat-card-modern" style="--stat-color: #10b981;">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10b981;">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-value" style="color: #10b981;">{{ $stats['approved'] }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        
        <div class="stat-card-modern" style="--stat-color: #f59e0b;">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: #f59e0b;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-value" style="color: #f59e0b;">{{ $stats['pending'] }}</div>
            <div class="stat-label">Menunggu Verifikasi</div>
        </div>
        
        <div class="stat-card-modern" style="--stat-color: #ef4444;">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-value" style="color: #ef4444;">{{ $stats['rejected'] }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
        
        <div class="stat-card-modern" style="--stat-color: #F4C430;">
            <div class="stat-icon" style="background: rgba(244,196,48,0.1); color: var(--asahan-gold);">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value" style="color: var(--asahan-gold);">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Pelaku Usaha</div>
        </div>
        
        <div class="stat-card-modern" style="--stat-color: #06b6d4;">
            <div class="stat-icon" style="background: rgba(6,182,212,0.1); color: #06b6d4;">
                <i class="bi bi-pin-map"></i>
            </div>
            <div class="stat-value" style="color: #06b6d4;">{{ $stats['districts'] }}</div>
            <div class="stat-label">Kecamatan Terlayani</div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="mb-4">
        <h5 class="fw-bold mb-3" style="color: var(--asahan-green);">
            <i class="bi bi-lightning-charge me-2"></i>Aksi Cepat
        </h5>
        <div class="quick-actions">
            <a href="{{ route('admin.businesses.index') }}?status=pending" class="quick-action-btn">
                <i class="bi bi-clock-history"></i>
                <span class="fw-600">Verifikasi UMKM</span>
                @if($stats['pending'] > 0)
                    <span class="badge bg-warning">{{ $stats['pending'] }} menunggu</span>
                @endif
            </a>
            
            <a href="{{ route('admin.businesses.index') }}" class="quick-action-btn">
                <i class="bi bi-list-ul"></i>
                <span class="fw-600">Kelola UMKM</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="quick-action-btn">
                <i class="bi bi-people"></i>
                <span class="fw-600">Kelola Pengguna</span>
            </a>
            
            <a href="{{ route('home') }}" class="quick-action-btn">
                <i class="bi bi-map"></i>
                <span class="fw-600">Lihat Peta</span>
            </a>
        </div>
    </div>
    
    <!-- Recent Activity and Charts -->
    <div class="row">
        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="recent-activity">
                <h5 class="fw-bold mb-3" style="color: var(--asahan-green);">
                    <i class="bi bi-activity me-2"></i>Aktivitas Terbaru
                </h5>
                
                @if($recent_businesses && $recent_businesses->count() > 0)
                    @foreach($recent_businesses->take(5) as $business)
                        <div class="activity-item">
                            <div class="activity-icon" style="background: 
                                @if($business->status === 'approved') rgba(16,185,129,0.1); color: #10b981;
                                @elseif($business->status === 'pending') rgba(245,158,11,0.1); color: #f59e0b;
                                @else rgba(239,68,68,0.1); color: #ef4444;
                                @endif
                            ">
                                <i class="bi bi-shop"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">{{ $business->business_name }}</h6>
                                <p class="mb-1 small text-muted">{{ $business->owner_name }} - {{ $business->district }}</p>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-{{ $business->status === 'approved' ? 'success' : ($business->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ $business->status === 'approved' ? 'Disetujui' : ($business->status === 'pending' ? 'Menunggu' : 'Ditolak') }}
                                    </span>
                                    <small class="text-muted">{{ $business->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.businesses.show', $business->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2">Belum ada aktivitas</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Business Type Distribution -->
        <div class="col-lg-6 mb-4">
            <div class="chart-card">
                <h5 class="fw-bold mb-3" style="color: var(--asahan-green);">
                    <i class="bi bi-pie-chart me-2"></i>Distribusi Jenis Usaha
                </h5>
                <canvas id="businessTypeChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- District Distribution -->
    <div class="chart-card">
        <h5 class="fw-bold mb-3" style="color: var(--asahan-green);">
            <i class="bi bi-bar-chart me-2"></i>Distribusi Per Kecamatan
        </h5>
        <canvas id="districtChart" height="100"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Business Type Chart
    const businessTypeData = @json($business_by_type ?? []);
    const typeLabels = Object.keys(businessTypeData);
    const typeValues = Object.values(businessTypeData);
    
    const typeColors = [
        'rgba(45,95,63,0.8)',
        'rgba(244,196,48,0.8)',
        'rgba(16,185,129,0.8)',
        'rgba(245,158,11,0.8)',
        'rgba(239,68,68,0.8)',
        'rgba(6,182,212,0.8)',
        'rgba(139,92,246,0.8)',
        'rgba(236,72,153,0.8)'
    ];
    
    new Chart(document.getElementById('businessTypeChart'), {
        type: 'doughnut',
        data: {
            labels: typeLabels.map(label => label.charAt(0).toUpperCase() + label.slice(1)),
            datasets: [{
                data: typeValues,
                backgroundColor: typeColors,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    
    // District Chart
    const districtData = @json($business_by_district ?? []);
    const districtLabels = Object.keys(districtData);
    const districtValues = Object.values(districtData);
    
    new Chart(document.getElementById('districtChart'), {
        type: 'bar',
        data: {
            labels: districtLabels,
            datasets: [{
                label: 'Jumlah UMKM',
                data: districtValues,
                backgroundColor: 'rgba(45,95,63,0.8)',
                borderColor: 'rgba(45,95,63,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush
