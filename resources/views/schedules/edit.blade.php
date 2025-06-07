@extends('layouts.app')

@section('title', 'Edit Jadwal Ronda')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-calendar-edit me-2"></i>Edit Jadwal Ronda</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="date" class="form-label"><i class="fas fa-calendar-day me-2"></i>Tanggal</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $schedule->date->format('Y-m-d')) }}" required>
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="start_time" class="form-label"><i class="fas fa-clock me-2"></i>Waktu Mulai</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required>
                        @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="end_time" class="form-label"><i class="fas fa-clock me-2"></i>Waktu Selesai</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required>
                        @error('end_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="resident_id" class="form-label"><i class="fas fa-user-friends me-2"></i>Warga</label>
                        <select class="form-select @error('resident_id') is-invalid @enderror" id="resident_id" name="resident_id" required>
                            <option value="">Pilih Warga</option>
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}" {{ old('resident_id', $schedule->resident_id) == $resident->id ? 'selected' : '' }}>{{ $resident->name }}</option>
                            @endforeach
                        </select>
                        @error('resident_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label"><i class="fas fa-info-circle me-2"></i>Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="tidak_terlaksana" {{ old('status', $schedule->status) == 'tidak_terlaksana' ? 'selected' : '' }}>Belum Terlaksana</option>
                            <option value="terlaksana" {{ old('status', $schedule->status) == 'terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label"><i class="fas fa-sticky-note me-2"></i>Catatan</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $schedule->notes) }}</textarea>
                    @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection