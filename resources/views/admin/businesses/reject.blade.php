@extends('layouts.app')

@section('title', 'Tolak Usaha')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="display-6 fw-bold">
            <i class="bi bi-x-circle"></i> Tolak Usaha
        </h1>
        <p class="mb-0">{{ $business->business_name }}</p>
    </div>
</div>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        Anda akan menolak usaha ini. Harap berikan alasan yang jelas agar pemilik usaha dapat memperbaiki data mereka.
                    </div>

                    <form action="{{ route('admin.businesses.reject', $business->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <h5>Informasi Usaha</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Nama Usaha</strong></td>
                                    <td>{{ $business->business_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pemilik</strong></td>
                                    <td>{{ $business->owner_name }} ({{ $business->user->email }})</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis</strong></td>
                                    <td>{{ $business->getBusinessTypeLabel() }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="rejection_reason" 
                                      class="form-control @error('rejection_reason') is-invalid @enderror" 
                                      rows="5" 
                                      required
                                      placeholder="Jelaskan alasan penolakan dengan detail...">{{ old('rejection_reason') }}</textarea>
                            @error('rejection_reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Contoh: "Data koordinat tidak sesuai dengan alamat yang tertera" atau "Foto usaha tidak jelas, mohon upload foto yang lebih baik"
                            </small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.businesses.show', $business->id) }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Tolak Usaha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
