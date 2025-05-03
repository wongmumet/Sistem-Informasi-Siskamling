@extends('layouts.app')

@section('title', 'Detail Warga')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Warga</h4>
            <span class="badge bg-light text-dark">{{ $resident->nik }}</span>
        </div>
        <div class="card-body">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded h-100">
                        <h6 class="text-primary mb-3"><i class="fas fa-id-card me-2"></i>Data Pribadi</h6>
                        <dl class="row">
                            <dt class="col-sm-4"><i class="fas fa-address-card me-2"></i>NIK</dt>
                            <dd class="col-sm-8">{{ $resident->nik }}</dd>

                            <dt class="col-sm-4"><i class="fas fa-user me-2"></i>Nama</dt>
                            <dd class="col-sm-8">{{ $resident->name }}</dd>

                            <dt class="col-sm-4"><i class="fas fa-home me-2"></i>Alamat</dt>
                            <dd class="col-sm-8">{{ $resident->address }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded h-100">
                        <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Informasi Tambahan</h6>
                        <dl class="row">
                            <dt class="col-sm-4"><i class="fas fa-phone me-2"></i>Telepon</dt>
                            <dd class="col-sm-8">{{ $resident->phone }}</dd>

                            <dt class="col-sm-4"><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</dt>
                            <dd class="col-sm-8">{{ $resident->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>

                            <dt class="col-sm-4"><i class="fas fa-birthday-cake me-2"></i>Tanggal Lahir</dt>
                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($resident->birth_date)->format('d/m/Y') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2 flex-wrap">
                <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('residents.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection