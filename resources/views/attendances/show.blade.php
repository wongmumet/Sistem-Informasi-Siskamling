@extends('layouts.app')

@section('title', 'Detail Absensi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Detail Absensi</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th>Tanggal Ronda</th>
                            <td>{{ $attendance->schedule->date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Ronda</th>
                            <td>{{ $attendance->schedule->start_time }} - {{ $attendance->schedule->end_time }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Absen</th>
                            <td>{{ $attendance->attendance_time->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        @if($attendance->latitude && $attendance->longitude)
                        <tr>
                            <th>Lokasi</th>
                            <td>
                                <a href="https://www.google.com/maps?q={{ $attendance->latitude }},{{ $attendance->longitude }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Lihat di Peta
                                </a>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $attendance->notes ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="text-center my-4">
                <h5>Foto Absensi</h5>
                <img src="{{ $attendance->photo_path }}" alt="Foto Absensi" class="img-fluid rounded" style="max-height: 500px;">
            </div>
            
            <div class="mt-3">
                @if(Auth::user()->isAdmin() || Auth::user()->isKetua())
                <form action="{{ route('attendances.verify', $attendance->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Verifikasi Absensi</button>
                </form>
                @endif
                <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection