
@extends('layout.owner')

@section('title', 'Dashboard Owner')

@section('content')

<style>
    .owner-dashboard {
        color: #f3f0ff;
    }

    .owner-welcome {
        background: linear-gradient(120deg, #281449, #54258b, #35205f);
        border: 1px solid rgba(196, 165, 253, .2);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .owner-welcome h2 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .owner-welcome p {
        color: #d8c8ef;
        margin: 0;
    }

    .owner-card {
        background: #1b1530;
        border: 1px solid rgba(196, 165, 253, .13);
        border-radius: 17px;
        padding: 22px;
        height: 100%;
        transition: .25s;
    }

    .owner-card:hover {
        transform: translateY(-5px);
        border-color: #9b6bdb;
    }

    .owner-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(167, 139, 250, .15);
        color: #c4a5fd;
        font-size: 21px;
        margin-bottom: 17px;
    }

    .owner-card h6 {
        color: #b9abcF;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .owner-card h3 {
        font-size: 26px;
        font-weight: 800;
        margin: 0;
        color: #fff;
    }

    .owner-panel {
        background: #1b1530;
        border: 1px solid rgba(196, 165, 253, .13);
        border-radius: 17px;
        padding: 22px;
        height: 100%;
    }

    .owner-panel h5 {
        font-weight: 700;
        margin-bottom: 20px;
    }

    .owner-table {
        color: #eee8fa;
        vertical-align: middle;
    }

    .owner-table th {
        color: #b9a7d5;
        font-size: 12px;
        border-color: #382b50;
        white-space: nowrap;
    }

    .owner-table td {
        border-color: #382b50;
        font-size: 13px;
    }

    .owner-table tbody tr:hover {
        background: rgba(167, 139, 250, .06);
    }

    .owner-status {
        background: rgba(167, 139, 250, .15);
        color: #c4a5fd;
        border-radius: 20px;
        padding: 5px 11px;
        font-size: 11px;
    }

    .owner-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        background: #7540b5;
        color: white;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .owner-link:hover {
        background: #905bd0;
        color: white;
        transform: translateY(-2px);
    }

    .owner-muted {
        color: #a99bbd;
    }

    .owner-action {
        background: #251b3c;
        border: 1px solid #493364;
        border-radius: 13px;
        padding: 17px;
        color: white;
        text-decoration: none;
        display: block;
        transition: .2s;
        height: 100%;
    }

    .owner-action:hover {
        background: #352052;
        color: white;
        transform: translateY(-3px);
    }

    .owner-action i {
        color: #c4a5fd;
        font-size: 23px;
        display: block;
        margin-bottom: 10px;
    }
</style>

<div class="owner-dashboard">

    {{-- HEADER --}}
    <div class="owner-welcome">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="owner-muted small">OWNER PANEL / E-PARKIR KABASA</span>
                <h2 class="mt-2">Dashboard Owner</h2>
                <p>Pantau aktivitas parkir, transaksi, dan pendapatan secara menyeluruh.</p>
                <p class="mt-3 small">
                    <i class="bi bi-calendar3 me-2"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="text-end">
                <i class="bi bi-speedometer2" style="font-size:65px;color:#d8baff;opacity:.8"></i>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="owner-card">
                <div class="owner-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <h6>Total Transaksi</h6>
                <h3>{{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}</h3>
                <small class="owner-muted">Seluruh transaksi parkir</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="owner-card">
                <div class="owner-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h6>Total Pendapatan</h6>
                <h3 style="font-size:21px">
                    Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                </h3>
                <small class="owner-muted">Dari transaksi selesai</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="owner-card">
                <div class="owner-icon">
                    <i class="bi bi-car-front"></i>
                </div>
                <h6>Kendaraan Masuk Hari Ini</h6>
                <h3>{{ number_format($kendaraanMasuk ?? 0, 0, ',', '.') }}</h3>
                <small class="owner-muted">Kendaraan tercatat masuk</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="owner-card">
                <div class="owner-icon">
                    <i class="bi bi-p-square"></i>
                </div>
                <h6>Sedang Parkir</h6>
                <h3>{{ number_format($sedangParkir ?? 0, 0, ',', '.') }}</h3>
                <small class="owner-muted">Belum menyelesaikan transaksi</small>
            </div>
        </div>

    </div>

    {{-- RINGKASAN DAN AKSI --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-5">
            <div class="owner-panel">
                <h5><i class="bi bi-graph-up-arrow me-2" style="color:#c4a5fd"></i>Ringkasan Aktivitas</h5>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="owner-muted">Kendaraan keluar hari ini</span>
                    <strong>{{ number_format($kendaraanKeluar ?? 0, 0, ',', '.') }}</strong>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="owner-muted">Kendaraan masih parkir</span>
                    <strong>{{ number_format($sedangParkir ?? 0, 0, ',', '.') }}</strong>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="owner-muted">Total pendapatan</span>
                    <strong style="color:#c4a5fd">
                        Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                    </strong>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="owner-panel">
                <h5><i class="bi bi-lightning-charge me-2" style="color:#c4a5fd"></i>Akses Cepat</h5>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <a href="{{ url('/owner/laporan') }}" class="owner-action">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                            <strong>Laporan Transaksi</strong>
                            <div class="owner-muted small mt-1">Lihat seluruh riwayat transaksi</div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ url('/owner/laporan/cetak') }}" class="owner-action">
                            <i class="bi bi-printer"></i>
                            <strong>Cetak Laporan</strong>
                            <div class="owner-muted small mt-1">Cetak laporan parkir</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TRANSAKSI TERBARU --}}
    <div class="owner-panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-clock-history me-2" style="color:#c4a5fd"></i>
                    Transaksi Terbaru
                </h5>
                <small class="owner-muted">Lima transaksi parkir terakhir</small>
            </div>

            <a href="{{ url('/owner/laporan') }}" class="owner-link">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table owner-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Pemilik</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                        <th>Biaya</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksiTerbaru ?? [] as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $transaksi->plat_nomor }}</strong></td>
                            <td>{{ ucfirst($transaksi->jenis_kendaraan) }}</td>
                            <td>{{ $transaksi->pemilik }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($transaksi->status == 'masuk')
                                    <span class="owner-status">Masih Parkir</span>
                                @else
                                    <span class="owner-status">Selesai</span>
                                @endif
                            </td>
                            <td>
                                Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center owner-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada transaksi parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
