@extends('layouts.app')

@section('title', 'Detail Laporan Kejadian')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Laporan Kejadian</h4>
            <span class="badge bg-light text-dark">{{ $report->date->format('d/m/Y') }}</span>
        </div>
        <div class="card-body">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded h-100">
                        <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                        <dl class="row">
                            <dt class="col-sm-4">Tanggal</dt>
                            <dd class="col-sm-8">{{ $report->date->format('d/m/Y') }}</dd>

                            <dt class="col-sm-4">Waktu</dt>
                            <dd class="col-sm-8">{{ $report->time }}</dd>

                            <dt class="col-sm-4">Judul</dt>
                            <dd class="col-sm-8">{{ $report->title }}</dd>

                            <dt class="col-sm-4">Pelapor</dt>
                            <dd class="col-sm-8">{{ $report->reporter->name }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded h-100">
                        <h6 class="text-primary mb-3"><i class="fas fa-tools me-2"></i>Status & Waktu</h6>
                        <dl class="row">
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">
                                @if($report->status == 'dilaporkan')
                                    <span class="badge bg-warning"><i class="fas fa-exclamation-circle me-1"></i> Dilaporkan</span>
                                @elseif($report->status == 'diproses')
                                    <span class="badge bg-info"><i class="fas fa-spinner fa-spin me-1"></i> Diproses</span>
                                @else
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Selesai</span>
                                @endif
                            </dd>

                            <dt class="col-sm-4">Dibuat Pada</dt>
                            <dd class="col-sm-8">{{ $report->created_at->format('d/m/Y H:i') }}</dd>

                            <dt class="col-sm-4">Diperbarui Pada</dt>
                            <dd class="col-sm-8">{{ $report->updated_at->format('d/m/Y H:i') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5><i class="fas fa-file-alt me-2"></i>Deskripsi Kejadian</h5>
                <div class="bg-white p-3 rounded border">{{ $report->description }}</div>
            </div>

            @if($report->resolution)
            <div class="mb-4">
                <h5><i class="fas fa-check-circle me-2"></i>Tindakan / Penyelesaian</h5>
                <div class="bg-white p-3 rounded border">{{ $report->resolution }}</div>
            </div>
            @endif

            <div class="mt-3 d-flex gap-2 flex-wrap">
                @can('update', $report)
                <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                @endcan
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection