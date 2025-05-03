@extends('layouts.app')

@section('title', 'Daftar Absensi Saya')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Absensi Saya</h5>
        </div>
        <div class="card-body">
            @if($attendances->isEmpty())
            <div class="alert alert-info">
                Anda belum memiliki catatan absensi.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Ronda</th>
                            <th>Waktu Absen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance->schedule->date->format('d/m/Y') }} ({{ $attendance->schedule->start_time }} - {{ $attendance->schedule->end_time }})</td>
                            <td>{{ $attendance->attendance_time->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-success">Tercatat</span>
                            </td>
                            <td>
                                <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $attendances->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection