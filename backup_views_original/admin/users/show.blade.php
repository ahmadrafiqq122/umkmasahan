@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-person"></i> Detail User
        </h1>
        <p class="mb-0">{{ $user->name }}</p>
    </div>
</div>

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 5rem; color: var(--primary-color);"></i>
                    </div>
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted mb-2">{{ $user->email }}</p>
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }} mb-2">
                        {{ ucfirst($user->role) }}
                    </span>
                    @if($user->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Telepon:</strong><br>{{ $user->phone }}</p>
                    @if($user->nik)
                    <p class="mb-2"><strong>NIK:</strong><br>{{ $user->nik }}</p>
                    @endif
                    @if($user->address)
                    <p class="mb-2"><strong>Alamat:</strong><br>{{ $user->address }}</p>
                    @endif
                    <p class="mb-2">
                        <strong>Email Verified:</strong><br>
                        @if($user->email_verified_at)
                            <span class="text-success">
                                <i class="bi bi-check-circle-fill"></i> Ya ({{ $user->email_verified_at->format('d/m/Y') }})
                            </span>
                        @else
                            <span class="text-danger">
                                <i class="bi bi-x-circle-fill"></i> Belum
                            </span>
                        @endif
                    </p>
                    <p class="mb-0">
                        <strong>Terdaftar:</strong><br>
                        {{ $user->created_at->format('d F Y, H:i') }}
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-gear"></i> Aksi</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning w-100 mb-2">
                        <i class="bi bi-pencil"></i> Edit User
                    </a>
                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-{{ $user->is_active ? 'secondary' : 'success' }} w-100">
                            <i class="bi bi-{{ $user->is_active ? 'pause' : 'play' }}"></i> 
                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Statistics -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-shop" style="font-size: 2rem; color: var(--primary-color);"></i>
                            <h3 class="mt-2">{{ $user->businesses_count }}</h3>
                            <p class="text-muted mb-0">Total Usaha</p>
                        </div>
                    </div>
                </div>
                @if($user->role == 'admin')
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle" style="font-size: 2rem; color: var(--success-color);"></i>
                            <h3 class="mt-2">{{ $user->approved_businesses_count }}</h3>
                            <p class="text-muted mb-0">Usaha Disetujui</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- User's Businesses -->
            @if($user->role == 'user' && $user->businesses->count() > 0)
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-shop"></i> Daftar Usaha</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Usaha</th>
                                    <th>Jenis</th>
                                    <th>Kecamatan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->businesses as $business)
                                <tr>
                                    <td><strong>{{ $business->business_name }}</strong></td>
                                    <td>{{ $business->getBusinessTypeLabel() }}</td>
                                    <td>{{ $business->district }}</td>
                                    <td>
                                        <span class="badge bg-{{ $business->getStatusBadgeColor() }}">
                                            {{ $business->getStatusLabel() }}
                                        </span>
                                    </td>
                                    <td>{{ $business->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.businesses.show', $business->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #d1d5db;"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Usaha Terdaftar</h5>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
