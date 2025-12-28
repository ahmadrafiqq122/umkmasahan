@extends('layouts.app')

@section('title', 'Kelola Usaha')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-shop"></i> Kelola Data Usaha
        </h1>
        <p class="mb-0">Manajemen data usaha mikro Kabupaten Asahan</p>
    </div>
</div>

<div class="container-fluid my-4">
    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.businesses.index') }}">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari usaha..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="type" class="form-select">
                            <option value="">Semua Jenis</option>
                            <option value="kuliner" {{ request('type') == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="fashion" {{ request('type') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                            <option value="kerajinan" {{ request('type') == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                            <option value="pertanian" {{ request('type') == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                            <option value="perikanan" {{ request('type') == 'perikanan' ? 'selected' : '' }}>Perikanan</option>
                            <option value="jasa" {{ request('type') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                            <option value="perdagangan" {{ request('type') == 'perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                            <option value="lainnya" {{ request('type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="district" class="form-select">
                            <option value="">Semua Kecamatan</option>
                            <option value="Kisaran Barat" {{ request('district') == 'Kisaran Barat' ? 'selected' : '' }}>Kisaran Barat</option>
                            <option value="Kisaran Timur" {{ request('district') == 'Kisaran Timur' ? 'selected' : '' }}>Kisaran Timur</option>
                            <option value="Sei Semayang" {{ request('district') == 'Sei Semayang' ? 'selected' : '' }}>Sei Semayang</option>
                            <option value="Buntu Pane" {{ request('district') == 'Buntu Pane' ? 'selected' : '' }}>Buntu Pane</option>
                            <!-- Add more districts -->
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

    <!-- Business List -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Usaha ({{ $businesses->total() }})</h5>
            <div>
                <button class="btn btn-success btn-sm" onclick="bulkApprove()">
                    <i class="bi bi-check-all"></i> Setujui Terpilih
                </button>
                <button class="btn btn-danger btn-sm" onclick="bulkDelete()">
                    <i class="bi bi-trash"></i> Hapus Terpilih
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            @if($businesses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="30">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>Nama Usaha</th>
                                <th>Pemilik</th>
                                <th>Jenis</th>
                                <th>Kecamatan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($businesses as $business)
                            <tr>
                                <td>
                                    <input type="checkbox" class="business-checkbox" value="{{ $business->id }}">
                                </td>
                                <td>
                                    <strong>{{ $business->business_name }}</strong><br>
                                    <small class="text-muted">{{ $business->owner_name }}</small>
                                </td>
                                <td>
                                    {{ $business->user->name }}<br>
                                    <small class="text-muted">{{ $business->user->email }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $business->getBusinessTypeLabel() }}</span>
                                </td>
                                <td>{{ $business->district }}</td>
                                <td>
                                    <span class="badge bg-{{ $business->getStatusBadgeColor() }}">
                                        {{ $business->getStatusLabel() }}
                                    </span>
                                </td>
                                <td>{{ $business->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.businesses.show', $business->id) }}" 
                                           class="btn btn-info" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($business->status == 'pending')
                                            <form action="{{ route('admin.businesses.approve', $business->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success" title="Setujui" onclick="return confirm('Setujui usaha ini?')">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.businesses.edit', $business->id) }}" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-danger" title="Hapus" onclick="deleteConfirm({{ $business->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer bg-white">
                    {{ $businesses->links() }}
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

@push('scripts')
<script>
    // Select all checkboxes
    $('#selectAll').on('change', function() {
        $('.business-checkbox').prop('checked', this.checked);
    });

    // Bulk approve
    function bulkApprove() {
        const selected = $('.business-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (selected.length === 0) {
            Swal.fire('Peringatan', 'Pilih minimal satu usaha', 'warning');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi',
            text: `Setujui ${selected.length} usaha terpilih?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.businesses.bulk-approve') }}';
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                selected.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'business_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Bulk delete
    function bulkDelete() {
        const selected = $('.business-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (selected.length === 0) {
            Swal.fire('Peringatan', 'Pilih minimal satu usaha', 'warning');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Hapus ${selected.length} usaha terpilih?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.businesses.bulk-delete') }}';
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                selected.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'business_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Delete single
    function deleteConfirm(id) {
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
                form.action = `/admin/businesses/${id}`;
                
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
