@extends('layouts.app')

@section('title', 'Absen Ronda')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Absen Ronda</div>
        <div class="card-body">
            <h5 class="card-title">Jadwal Ronda Tanggal: {{ $schedule->date->format('d/m/Y') }}</h5>
            <p class="card-text">Waktu: {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
            
            <form id="attendanceForm" action="{{ route('schedules.attendances.store', $schedule->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto Lokasi</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" capture="environment" required>
                    <small class="text-muted">Silahkan ambil foto lokasi Anda saat ini</small>
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan (opsional)</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>
                
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                
                <button type="submit" class="btn btn-primary">Submit Absen</button>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script>
    // Mendapatkan lokasi geografis
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            },
            function(error) {
                console.error("Error getting location: ", error);
                alert('Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi.');
            }
        );
    } else {
        alert('Browser tidak mendukung geolocation');
    }

    // Validasi form sebelum submit
    document.getElementById('attendanceForm').addEventListener('submit', function(e) {
        const photo = document.getElementById('photo').files[0];
        if (!photo) {
            e.preventDefault();
            alert('Silahkan ambil foto terlebih dahulu');
            return false;
        }
        return true;
    });
</script>
@endsection