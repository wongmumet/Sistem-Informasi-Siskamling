@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title">Dashboard</h4>
            <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }}</p>
        </div>
        <div>
            <span class="badge bg-primary p-2">
                <i class="fas fa-calendar-day me-1"></i>
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @if(auth()->user()->isAdmin() || auth()->user()->isKetua())
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 class="text-primary">{{ App\Models\Resident::count() }}</h3>
                            <p>Total Warga</p>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="{{ route('residents.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-right me-1"></i> Lihat detail
                    </a>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon bg-success">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <h3 class="text-success">{{ App\Models\Schedule::whereDate('date', today())->count() }}</h3>
                            <p>Jadwal Ronda Hari Ini</p>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="{{ route('schedules.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-right me-1"></i> Lihat detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon bg-danger">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div>
                            <h3 class="text-danger">{{ App\Models\Report::whereMonth('date', now()->month)->count() }}</h3>
                            <p>Laporan Bulan Ini</p>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="{{ route('reports.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-right me-1"></i> Lihat detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin() || auth()->user()->isKetua())
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-bell me-2 text-warning"></i> Laporan Terbaru
                    </h5>
                    <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-list me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Judul</th>
                                    <th class="px-4 py-3">Pelapor</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(App\Models\Report::latest()->take(5)->get() as $report)
                                <tr>
                                    <td class="px-4 py-3">
                                        <span class="d-flex align-items-center">
                                            <i class="fas fa-calendar-day me-2 text-muted"></i>
                                            {{ $report->date->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 fw-medium">{{ $report->title }}</td>
                                    <td class="px-4 py-3">
                                        <span class="d-flex align-items-center">
                                            <i class="fas fa-user me-2 text-muted"></i>
                                            {{ $report->reporter->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($report->status == 'dilaporkan')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="fas fa-exclamation-circle me-1"></i> Dilaporkan
                                        </span>
                                        @elseif($report->status == 'diproses')
                                        <span class="badge bg-info px-3 py-2 rounded-pill">
                                            <i class="fas fa-sync-alt me-1"></i> Diproses
                                        </span>
                                        @else
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Selesai
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-exclamation-circle me-2"></i> Belum ada laporan terbaru
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Jadwal Ronda Terdekat -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2 text-success"></i> Jadwal Ronda Terdekat
                    </h5>
                    <a href="{{ route('schedules.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-list me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Waktu</th>
                                    <th class="px-4 py-3">Petugas</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(App\Models\Schedule::whereDate('date', '>=', today())->orderBy('date')->take(5)->get() as $schedule)
                                <tr>
                                    <td class="px-4 py-3">
                                        {{ $schedule->date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-light text-dark px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 fw-medium">
                                        {{ $schedule->resident->name }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($schedule->date->isToday())
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Hari Ini
                                        </span>
                                        @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                            <i class="fas fa-calendar me-1"></i> Mendatang
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fas fa-exclamation-circle me-2"></i> Belum ada jadwal ronda terdekat
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .stats-card .icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 20px;
        color: white;
    }
    
    .badge.rounded-pill {
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush