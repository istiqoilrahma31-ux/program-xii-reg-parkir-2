
@extends('layout.layout')

@section('title', 'Log Aktivitas')

@section('content')

<div class="container-fluid py-3">

    <div class="mb-4">
        <h3 class="fw-bold">Log Aktivitas</h3>
        <p class="text-secondary">
            Riwayat aktivitas pengguna E-Parkir
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Aktivitas</th>
                            <th>Waktu Aktivitas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->nama_lengkap }}</td>
                                <td>{{ $log->aktivitas }}</td>
                                <td>{{ $log->waktu_aktivitas }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="text-center text-secondary py-4">
                                    Belum ada aktivitas tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
