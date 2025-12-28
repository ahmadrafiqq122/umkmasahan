@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-people"></i> Kelola User
        </h1>
        <p class="mb-0">Manajemen pengguna sistem</p>
    </div>
</div>

<div class="container-fluid my-4">
    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari user..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="role" class="form-select">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User List -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar User ({{ $users->total() }})</h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah User
            </a>
        </div>
        <div class="card-body p-0">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Role</th>
                                <th>Jumlah Usaha</th>
                                <th>Status</th>
                                <th>Terdaftar</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->email_verified_at)
                                        <i class="bi bi-check-circle-fill text-success" title="Email Terverifikasi"></i>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $user->businesses_count }} usaha</span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $user->is_active ? 'secondary' : 'success' }}" 
                                                    title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="bi bi-{{ $user->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer bg-white">
                    {{ $users->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
                    <h5 class="mt-3 text-muted">Tidak Ada Data</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
