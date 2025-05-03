@extends('layouts.app')

@section('title', 'Laporan Kejadian')

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
        border-radius: 30px;
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
    .priority-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
    .priority-high {
        background-color: #e74a3b;
    }
    .priority-medium {
        background-color: #f6c23e;
    }
    .priority-low {
        background-color: #1cc88a;
    }
    .report-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-width: 250px;
    }
    .report-desc {
        font-size: 0.85rem;
        color: #6c757d;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-width: 250px;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 0.5rem 0.75rem;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.85rem;
    }
    .status-reported {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-processing {
        background-color: #cff4fc;
        color: #055160;
    }
    .status-completed {
        background-color: #d1e7dd;
        color: #0f5132;
    }
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
    .report-card-hover {
        transition: all 0.2s;
    }
    .report-card-hover:hover {
        background-color: #f8f9fa;
    }
    .export-btn {
        background-color: #1cc88a;
        border-color: #1cc88a;
        color: white;
    }
    .export-btn:hover {
        background-color: #15a87a;
        border-color: #15a87a;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="page-header">
                <i class="fas fa-clipboard-list me-2"></i>Laporan Kejadian
                <span class="badge bg-primary ms-2">{{ $reports->total() }}</span>
            </h4>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="d-flex justify-content-md-end gap-2">
                <a href="{{ route('reports.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Buat Laporan
                </a>
                <button class="btn export-btn" title="Export Laporan">
                    <i class="fas fa-file-export me-1"></i> Export
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari laporan...">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="d-flex justify-content-md-end">
                        <div class="filter-group">
                            <button class="btn filter-btn active" data-filter="all">Semua</button>
                            <button class="btn filter-btn" data-filter="dilaporkan">Dilaporkan</button>
                            <button class="btn filter-btn" data-filter="diproses">Diproses</button>
                            <button class="btn filter-btn" data-filter="selesai">Selesai</button>
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
                            <th>Laporan</th>
                            <th>Pelapor</th>
                            <th class="text-center">Status</th>
                            <th width="150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="reportsTable">
                        @forelse($reports as $report)
                        <tr class="report-card-hover" data-status="{{ $report->status }}">
                            <td>
                                <span class="badge-id">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="date-badge">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ $report->date->format('d/m/Y') }}
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="report-title">
                                        <span class="priority-indicator priority-{{ $report->priority ?? 'medium' }}"></span>
                                        {{ $report->title }}
                                    </div>
                                    <div class="report-desc">
                                        {{ Str::limit($report->description ?? 'Tidak ada deskripsi', 50) }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">
                                        {{ substr($report->reporter->name, 0, 1) }}
                                    </div>
                                    <span class="fw-semibold">{{ $report->reporter->name }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($report->status == 'dilaporkan')
                                <span class="status-badge status-reported">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>Dilaporkan</span>
                                </span>
                                @elseif($report->status == 'diproses')
                                <span class="status-badge status-processing">
                                    <i class="fas fa-sync-alt"></i>
                                    <span>Diproses</span>
                                </span>
                                @else
                                <span class="status-badge status-completed">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Selesai</span>
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('update', $report)
                                    <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('delete', $report)
                                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                          onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="far fa-clipboard"></i>
                                    <p>Belum ada laporan kejadian. Silakan buat laporan baru.</p>
                                    <a href="{{ route('reports.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus-circle"></i> Buat Laporan
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
                    Menampilkan {{ $reports->firstItem() ?? 0 }} - {{ $reports->lastItem() ?? 0 }} dari {{ $reports->total() }} laporan
                </div>
                <div>
                    {{ $reports->links() }}
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
        const table = document.getElementById('reportsTable');
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
            const rows = document.getElementById('reportsTable').getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                if (rows[i].hasAttribute('data-status')) {
                    const status = rows[i].getAttribute('data-status');
                    
                    if (filter === 'all') {
                        rows[i].style.display = '';
                    } else if (filter === status) {
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
            const table = document.getElementById('reportsTable');
            if (table && table.rows.length > 0) {
                table.rows[0].classList.add('table-success');
                setTimeout(() => {
                    table.rows[0].classList.remove('table-success');
                }, 3000);
            }
        }
    });
    
    // Handle export button click
    document.querySelector('.export-btn').addEventListener('click', function() {
        alert('Fitur export akan segera tersedia.');
    });
</script>
@endsection