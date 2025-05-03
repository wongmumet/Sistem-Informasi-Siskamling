@extends('layouts.app')

@section('title', 'Data Warga')

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
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="page-header">
                <i class="fas fa-users me-2"></i>Data Warga
                <span class="badge bg-primary ms-2">{{ $residents->total() }}</span>
            </h4>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('residents.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Tambah Warga
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-8">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari warga...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dropdown text-end">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">Semua Warga</a></li>
                            <li><a class="dropdown-item" href="#">Warga Baru (30 hari terakhir)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Filter Kustom</a></li>
                        </ul>
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
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th width="180px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="residentsTable">
                        @forelse($residents as $resident)
                        <tr>
                            <td>
                                <span class="badge-id">{{ $loop->iteration }}</span>
                            </td>
                            <td>{{ $resident->nik }}</td>
                            <td>
                                <div class="fw-semibold">{{ $resident->name }}</div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 250px;" title="{{ $resident->address }}">
                                    <i class="fas fa-map-marker-alt me-1 text-muted"></i>{{ $resident->address }}
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="fas fa-phone me-1 text-muted"></i>{{ $resident->phone }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('residents.show', $resident->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                          onclick="return confirm('Apakah Anda yakin ingin menghapus data {{ $resident->name }}?')">
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
                                    <i class="fas fa-folder-open"></i>
                                    <p>Belum ada data warga. Silakan tambahkan data warga baru.</p>
                                    <a href="{{ route('residents.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus-circle"></i> Tambah Warga
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
                    Menampilkan {{ $residents->firstItem() ?? 0 }} - {{ $residents->lastItem() ?? 0 }} dari {{ $residents->total() }} data warga
                </div>
                <div>
                    {{ $residents->links() }}
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
        const table = document.getElementById('residentsTable');
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
    
    // Add animation to newly added rows
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.search.includes('status=created')) {
            const table = document.getElementById('residentsTable');
            if (table && table.rows.length > 0) {
                table.rows[0].classList.add('table-success');
                setTimeout(() => {
                    table.rows[0].classList.remove('table-success');
                }, 3000);
            }
        }
    });
</script>
@endsection