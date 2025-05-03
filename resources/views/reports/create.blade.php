@extends('layouts.app')

@section('title', 'Buat Laporan Kejadian')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Buat Laporan Kejadian</div>
        <div class="card-body">
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label">Waktu</label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time', now()->format('H:i')) }}" required>
                        @error('time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Laporan</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Kejadian</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if(auth()->user()->isAdmin() || auth()->user()->isKetua())
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="dilaporkan" {{ old('status') == 'dilaporkan' ? 'selected' : '' }}>Dilaporkan</option>
                            <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="resolution" class="form-label">Tindakan/Penyelesaian</label>
                        <textarea class="form-control @error('resolution') is-invalid @enderror" id="resolution" name="resolution" rows="3">{{ old('resolution') }}</textarea>
                        @error('resolution')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection