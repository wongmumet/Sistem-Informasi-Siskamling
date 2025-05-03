@extends('layouts.app')

@section('title', 'Jadwal Ronda')

@section('styles')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
        padding: 1rem 1.5rem;
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background-color: #3a5fc8;
        border-color: #3a5fc8;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(78, 115, 223, 0.2);
    }
    .table th {
        font-weight: 600;
        color: #555;
        background-color: #f8f9fa;
        white-space: nowrap;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-sm {
        border-radius: 6px;
        font-size: 0.8rem;
        padding: 0.375rem 0.5rem;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-info {
        background-color: #36b9cc;
        border-color: #36b9cc;
        color: white;
    }
    .btn-warning {
        background-color: #f6c23e;
        border-color: #f6c23e;
        color: white;
    }
    .btn-danger {
        background-color: #e74a3b;
        border-color: #e74a3b;
    }
    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        color: white;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }
    .search-box {
        position: relative;
        margin-bottom: 1.5rem;
    }
    .search-box input {
        padding-left: 40px;
        border-radius: 50px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    .search-icon {
        position: absolute;
        left: 15px;
        top: 10px;
        color: #aaa;
    }
    .page-header {
        font-weight: 600;
        color: #333;
    }
    .pagination {
        justify-content: center;
    }
    .badge-id {
        background-color: #e8eaf6;
        color: #3949ab;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 6px;
    }
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #ddd;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        padding: 0.35em 0.65em;
    }
    .badge-success {
        background-color: #1cc88a;
    }
    .badge-warning {
        background-color: #f6c23e;
        color: #212529;
    }
    .date-badge {
        background-color: #f0f2f5;
        color: #4e73df;
        font-weight: 500;
        padding: 0.5rem;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
    }
    .time-badge {
        display: inline-flex;
        align-items: center;
        background-color: #edf2ff;
        color: #3949ab;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        font-weight: 500;
    }
    .filter-group {
        display: flex;
        gap: 10px;
    }
    .filter-btn {
        border-radius: 50px;
        padding: 0.375rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .filter-btn.active {
        background-color: #4e73df;
        color: white;
    }
    .calendar-view-btn {
        background-color: #f8f9fa;
        border-color: #ddd;
        color: #555;
    }
    .calendar-view-btn:hover {
        background-color: #e9ecef;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="page-header">
                <i class="fas fa-calendar-alt me-2"></i>Jadwal Ronda
                <span class="badge bg-primary ms-2">{{ $schedules->total() }}</span>
            </h4>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="d-flex justify-content-md-end gap-2">
                <a href="{{ route('schedules.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Jadwal
                </a>
                <a href="#" class="btn calendar-view-btn" title="Tampilkan Kalender">
                    <i class="fas fa-th-large"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari jadwal...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="filter-group">
                            <button class="btn filter-btn active" data-filter="all">Semua</button>
                            <button class="btn filter-btn" data-filter="terlaksana">Terlaksana</button>
                            <button class="btn filter-btn" data-filter="belum">Belum Terlaksana</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="70px">#</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Warga</th>
                            <th class="text-center">Status</th>
                            <th width="150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="schedulesTable">
                        @forelse($schedules as $schedule)
                        <tr data-status="{{ $schedule->status }}">
                            <td>
                                <span class="badge-id">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="date-badge">
                                    <i class="far fa-calendar me-2"></i>
                                    {{ $schedule->date->format('d/m/Y') }}
                                </div>
                            </td>
                            <td>
                                <div class="time-badge">
                                    <i class="far fa-clock me-2"></i>
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-light text-primary me-2">
                                        {{ substr($schedule->resident->name, 0, 1) }}
                                    </div>
                                    <div class="fw-semibold">{{ $schedule->resident->name }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($schedule->status == 'terlaksana')
                                <span class="badge bg-success rounded-pill">
                                    <i class="fas fa-check me-1"></i>Terlaksana
                                </span>
                                @else
                                <span class="badge bg-warning rounded-pill">
                                    <i class="fas fa-clock me-1"></i>Belum Terlaksana
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                          onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="far fa-calendar-times"></i>
                                    <p>Belum ada jadwal ronda. Silakan tambahkan jadwal baru.</p>
                                    <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus-circle"></i> Tambah Jadwal
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan {{ $schedules->firstItem() ?? 0 }} - {{ $schedules->lastItem() ?? 0 }} dari {{ $schedules->total() }} jadwal
                </div>
                <div>
                    {{ $schedules->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const table = document.getElementById('schedulesTable');
        const rows = table.getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const rowText = rows[i].textContent.toLowerCase();
            if (rowText.includes(searchValue)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
    
    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            const rows = document.getElementById('schedulesTable').getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                if (rows[i].hasAttribute('data-status')) {
                    const status = rows[i].getAttribute('data-status');
                    
                    if (filter === 'all') {
                        rows[i].style.display = '';
                    } else if (filter === 'terlaksana' && status === 'terlaksana') {
                        rows[i].style.display = '';
                    } else if (filter === 'belum' && status !== 'terlaksana') {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        });
    });
    
    // Add animation to newly added rows
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.search.includes('status=created')) {
            const table = document.getElementById('schedulesTable');
            if (table && table.rows.length > 0) {
                table.rows[0].classList.add('table-success');
                setTimeout(() => {
                    table.rows[0].classList.remove('table-success');
                }, 3000);
            }
        }
    });
    
    // Add custom style for avatar circles
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            .avatar-circle {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                font-size: 14px;
                background-color: #e8eaf6;
                color: #3949ab;
            }
        </style>
    `);
</script>
@endsection