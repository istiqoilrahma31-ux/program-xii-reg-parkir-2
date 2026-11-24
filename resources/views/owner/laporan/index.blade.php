
@extends('layout.owner')

@section('title', 'Laporan Transaksi')

@section('content')

<style>
    .report-title {
        font-weight: 700;
        color: white;
    }

    .report-subtitle {
        color: #a78bfa;
        font-size: 13px;
    }

    .report-card {
        background: #211936;
        border: 1px solid #35264f;
        border-radius: 15px;
        padding: 22px;
        height: 100%;
    }

    .report-card h6 {
        color: #c4b5fd;
        font-size: 13px;
    }

    .report-card h3 {
        color: white;
        font-weight: 700;
    }

    .report-table {
        background: #211936;
        border-radius: 15px;
        padding: 20px;
        border: 1px solid #35264f;
    }

    .table {
        color: white !important;
        font-size: 12px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table thead th {
        background: #302344;
        color: #c4b5fd;
        border: none;
        padding: 13px;
    }

    .table tbody td {
        background: #211936;
        color: white;
        border-color: #382b50;
        padding: 13px;
    }

    .form-control {
        background: #211936;
        border: 1px solid #49365f;
        color: white;
    }

    .form-control:focus {
        background: #211936;
        color: white;
        border-color: #a855f7;
        box-shadow: none;
    }

    .form-control::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    .btn-purple {
        background: #7c3aed;
        color: white;
        border: none;
    }

    .btn-purple:hover {
        background: #6d28d9;
        color: white;
    }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="report-title">Laporan Transaksi</h3>
            <p class="report-subtitle">
                Rekapitulasi transaksi parkir E-Parkir Kabasa
            </p>
        </div>

        <a href="{{ route('owner.laporan.cetak', request()->query()) }}"
           class="btn btn-purple">
            <i class="bi bi-printer me-2"></i>
            Cetak Laporan
        </a>
    </div>

    <!-- RINGKASAN -->
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="report-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Transaksi</h6>
                        <h3>{{ $totalTransaksi }}</h3>
                    </div>
                    <i class="bi bi-car-front-fill fs-1 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="report-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Pendapatan</h6>
                        <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                    <i class="bi bi-wallet-fill fs-1 text-success"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- FILTER TANGGAL -->
    <div class="report-card mb-4">

        <h6 class="mb-3 text-white">
            <i class="bi bi-funnel me-2"></i>
            Filter Periode Transaksi
        </h6>

        <form action="{{ route('owner.laporan') }}" method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label text-white small">
                        Tanggal Mulai
                    </label>
                    <input type="date"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ request('tanggal_mulai') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-white small">
                        Tanggal Selesai
                    </label>
                    <input type="date"
                           name="tanggal_selesai"
                           class="form-control"
                           value="{{ request('tanggal_selesai') }}">
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-purple">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('owner.laporan') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>

        </form>
    </div>

    <!-- TABEL TRANSAKSI -->
    <div class="report-table">

        <h5 class="text-white fw-bold mb-3">
            <i class="bi bi-receipt me-2"></i>
            Riwayat Transaksi Parkir
        </h5>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Warna</th>
                        <th>Pemilik</th>
                        <th>Area</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Durasi</th>
                        <th>Biaya</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transaksi as $index => $item)

                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td class="fw-bold text-info">
                            {{ $item->plat_nomor }}
                        </td>

                        <td>{{ ucfirst($item->jenis_kendaraan) }}</td>

                        <td>{{ $item->warna }}</td>

                        <td>{{ $item->pemilik }}</td>

                        <td>{{ $item->nama_area ?? '-' }}</td>

                        <td>
                            {{ $item->waktu_masuk
                                ? \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i')
                                : '-' }}
                        </td>

                        <td>
                            {{ $item->waktu_keluar
                                ? \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i')
                                : '-' }}
                        </td>

                        <td>{{ $item->durasi_jam ?? 0 }} jam</td>

                        <td>
                            Rp {{ number_format($item->biaya_total ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($item->status == 'keluar')
                                <span class="badge bg-success">Keluar</span>
                            @else
                                <span class="badge bg-warning text-dark">Masuk</span>
                            @endif
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="11" class="text-center py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada data transaksi.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
