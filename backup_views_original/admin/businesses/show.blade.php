@extends('layouts.app')

@section('title', 'Detail Usaha')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-shop"></i> Detail Usaha
        </h1>
        <p class="mb-0">{{ $business->business_name }}</p>
    </div>
</div>

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Status & Actions -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Status: 
                                <span class="badge bg-{{ $business->getStatusBadgeColor() }}">
                                    {{ $business->getStatusLabel() }}
                                </span>
                            </h5>
                            @if($business->status == 'approved' && $business->approved_at)
                                <small class="text-muted">
                                    Disetujui pada {{ $business->approved_at->format('d F Y, H:i') }}
                                    @if($business->approver)
                                        oleh {{ $business->approver->name }}
                                    @endif
                                </small>
                            @endif
                            @if($business->status == 'rejected' && $business->rejection_reason)
                                <div class="alert alert-danger mt-2 mb-0">
                                    <strong>Alasan Penolakan:</strong><br>
                                    {{ $business->rejection_reason }}
                                </div>
                            @endif
                        </div>
                        <div>
                            @if($business->status == 'pending')
                                <form action="{{ route('admin.businesses.approve', $business->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Setujui usaha ini?')">
                                        <i class="bi bi-check-circle"></i> Setujui
                                    </button>
                                </form>
                                <a href="{{ route('admin.businesses.reject.form', $business->id) }}" class="btn btn-danger">
                                    <i class="bi bi-x-circle"></i> Tolak
                                </a>
                            @endif
                            <a href="{{ route('admin.businesses.edit', $business->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Info (Similar to user show page) -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Usaha</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="200"><strong>Nama Usaha</strong></td>
                            <td>{{ $business->business_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pemilik</strong></td>
                            <td>{{ $business->owner_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis</strong></td>
                            <td><span class="badge bg-primary">{{ $business->getBusinessTypeLabel() }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Skala</strong></td>
                            <td>{{ ucfirst($business->business_scale) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi</strong></td>
                            <td>{{ $business->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Telepon</strong></td>
                            <td>{{ $business->phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>{{ $business->address }}, {{ $business->village }}, {{ $business->district }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Map -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Lokasi</h5>
                </div>
                <div class="card-body">
                    <div id="map" style="height: 400px; border-radius: 10px;"></div>
                    <div class="mt-2">
                        <small class="text-muted">
                            Koordinat: {{ $business->latitude }}, {{ $business->longitude }}
                        </small>
                    </div>
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
                                    <form action="{{ route('admin.businesses.photo.delete', [$business->id, $photo->id]) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus foto ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
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
            <!-- User Info -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person"></i> Info Pemilik</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Nama:</strong> {{ $business->user->name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $business->user->email }}</p>
                    <p class="mb-2"><strong>Telepon:</strong> {{ $business->user->phone }}</p>
                    <a href="{{ route('admin.users.show', $business->user->id) }}" class="btn btn-sm btn-primary w-100 mt-2">
                        <i class="bi bi-eye"></i> Lihat Profil
                    </a>
                </div>
            </div>

            <!-- Actions -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-gear"></i> Aksi</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.businesses.index') }}" class="btn btn-secondary w-100 mb-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button onclick="deleteConfirm()" class="btn btn-danger w-100">
                        <i class="bi bi-trash"></i> Hapus Usaha
                    </button>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-clock"></i> Informasi Waktu</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Dibuat:</strong><br>{{ $business->created_at->format('d F Y, H:i') }}</p>
                    <p class="mb-0"><strong>Update Terakhir:</strong><br>{{ $business->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const map = L.map('map').setView([{{ $business->latitude }}, {{ $business->longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([{{ $business->latitude }}, {{ $business->longitude }}])
        .addTo(map)
        .bindPopup('<strong>{{ $business->business_name }}</strong>').openPopup();

    function deleteConfirm() {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Yakin ingin menghapus usaha ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.businesses.destroy', $business->id) }}';
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                
                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endpush
@endsection
