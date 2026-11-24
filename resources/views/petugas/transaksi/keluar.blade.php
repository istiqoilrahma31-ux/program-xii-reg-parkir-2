
@extends('layout.petugas')

@section('title', 'Kendaraan Keluar')

@section('content')

<div class="container-fluid">
    <h3 class="mb-4">Kendaraan Keluar</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            Daftar Kendaraan yang Masih Parkir
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Jenis Kendaraan</th>
                            <th>Waktu Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->plat_nomor }}</td>
                                <td>{{ ucfirst($t->jenis_kendaraan) }}</td>
                                <td>{{ $t->waktu_masuk }}</td>
                                <td>
                                    <form action="{{ route('petugas.transaksi.prosesKeluar', $t->id_transaksi) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Proses kendaraan keluar?')">
                                            <i class="bi bi-box-arrow-right"></i>
                                            Proses Keluar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada kendaraan yang sedang parkir.
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
