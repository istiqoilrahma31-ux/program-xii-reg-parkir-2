```blade
@extends('layout.owner')

@section('title', 'Cetak Laporan Transaksi')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Laporan Transaksi Parkir</h3>

        <button onclick="window.print()" class="btn btn-primary">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="text-center fw-bold">
                LAPORAN TRANSAKSI E-PARKIR KABASA
            </h4>

            <p class="text-center">
                Riwayat Transaksi Parkir
            </p>

            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Jenis Kendaraan</th>
                            <th>Pemilik</th>
                            <th>Area Parkir</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->plat_nomor }}</td>
                            <td>{{ ucfirst($data->jenis_kendaraan) }}</td>
                            <td>{{ $data->pemilik }}</td>
                            <td>{{ $data->nama_area ?? '-' }}</td>
                            <td>{{ $data->waktu_masuk }}</td>
                            <td>{{ $data->waktu_keluar ?? '-' }}</td>
                            <td>Rp {{ number_format($data->biaya_total ?? 0, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($data->status) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">Belum ada transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <h5>Total Transaksi: {{ $totalTransaksi }}</h5>
                <h5>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5>
            </div>

        </div>
    </div>

</div>

<style>
@media print {
    .sidebar, nav, button, .btn {
        display: none !important;
    }

    body {
        background: white !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>

@endsection
```