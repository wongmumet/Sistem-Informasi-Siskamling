@extends('layouts.app')

@section('title', 'Detail Jadwal Ronda')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Jadwal Ronda</h5>
            <div class="badge bg-light text-dark">
                {{ $schedule->date->format('d/m/Y') }}
            </div>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded">
                        <h6 class="text-primary mb-3">Informasi Jadwal</h6>
                        <dl class="row">
                            <dt class="col-sm-4">Waktu Ronda</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-clock me-2"></i>
                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            </dd>

                            <dt class="col-sm-4">Petugas Ronda</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-user me-2"></i>
                                {{ $schedule->resident->name }}
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded">
                        <h6 class="text-primary mb-3">Status Pelaksanaan</h6>
                        <dl class="row">
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">
                                @if($schedule->status == 'terlaksana')
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>Terlaksana
                                </span>
                                @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Belum Terlaksana
                                </span>
                                @endif
                            </dd>

                            <dt class="col-sm-4">Catatan</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-sticky-note me-2"></i>
                                {{ $schedule->notes ?? '-' }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection