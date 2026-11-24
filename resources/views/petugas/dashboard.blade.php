@extends('layout.petugas')

@section('title', 'Dashboard Petugas')

@section('content')

<style>
    .pd {
        color: #f8f5ff;
    }

    .pd .welcome {
        background: linear-gradient(120deg, #35165f, #7139b5, #4b237b);
        padding: 28px;
        border-radius: 18px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,.2);
    }

    .pd .welcome:after {
        content: '';
        position: absolute;
        width: 190px;
        height: 190px;
        border: 25px solid rgba(255,255,255,.07);
        border-radius: 50%;
        right: -40px;
        top: -80px;
    }

    .pd .stat-card,
    .pd .panel {
        background: #1b142b;
        border: 1px solid #35274d;
        border-radius: 16px;
        padding: 22px;
        height: 100%;
    }

    .pd .stat-card {
        transition: .25s;
    }

    .pd .stat-card:hover {
        transform: translateY(-5px);
        border-color: #9564df;
        box-shadow: 0 8px 20px rgba(124,58,237,.15);
    }

    .pd .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #382452;
        color: #c4a5fd;
        border-radius: 13px;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .pd .number {
        font-size: 30px;
        font-weight: 750;
        color: white;
    }

    .pd .muted {
        color: #b9a9cf;
        font-size: 13px;
    }

    .pd .panel-title {
        color: white;
        font-weight: 700;
        font-size: 17px;
        margin-bottom: 20px;
    }

    .pd .quick-link {
        display: flex;
        align-items: center;
        gap: 13px;
        background: #291d3d;
        border: 1px solid #433258;
        color: white;
        text-decoration: none;
        padding: 16px;
        border-radius: 12px;
        height: 100%;
        transition: .2s;
    }

    .pd .quick-link:hover {
        background: #7139b5;
        color: white;
        transform: translateY(-3px);
    }

    .pd .quick-link i {
        font-size: 25px;
        color: #c4a5fd;
    }

    .pd .quick-link:hover i {
        color: white;
    }

    .pd .progress {
        background: #49365f;
        height: 9px;
        border-radius: 20px;
    }

    .pd .progress-bar {
        background: linear-gradient(90deg,#7c3aed,#c4a5fd);
        border-radius: 20px;
    }

    .pd .table {
        margin-bottom: 0;
        color: white;
    }

    .pd .table th {
        background: #302342;
        color: #d9c7fa;
        border-color: #49365f;
        font-size: 13px;
        white-space: nowrap;
    }

    .pd .table td {
        background: #1b142b;
        color: #eee8f7;
        border-color: #382a4d;
        font-size: 13px;
        vertical-align: middle;
    }

    .pd .badge {
        font-weight: 500;
        padding: 7px 10px;
    }

    @media(max-width:576px) {
        .pd .welcome { padding: 20px; }
        .pd .number { font-size: 25px; }
    }
</style>

<div class="container-fluid py-3 pd">

    {{-- SAMBUTAN --}}
    <div class="welcome">
        <div class="position-relative" style="z-index:1">
            <div class="mb-2" style="color:#e9d5ff;font-size:13px">
                <i class="bi bi-calendar3 me-2"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>

            <h2 class="fw-bold mb-2">
                Selamat Datang, Petugas!
            </h2>

            <p class="mb-0" style="color:#eadcff">
                Selamat bekerja. Kelola aktivitas parkir
                dengan mudah melalui E-PARKIR Kabasa.
            </p>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-box-arrow-in-right"></i>
                </div>
                <div class="number">{{ $kendaraanMasuk ?? 0 }}</div>
                <div class="muted">Kendaraan Masuk Hari Ini</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-box-arrow-right"></i>
                </div>
                <div class="number">{{ $kendaraanKeluar ?? 0 }}</div>
                <div class="muted">Kendaraan Keluar Hari Ini</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <div class="number">{{ $sedangParkir ?? 0 }}</div>
                <div class="muted">Sedang Parkir</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-p-circle"></i>
                </div>
                <div class="number">{{ $sisaKapasitas ?? 0 }}</div>
                <div class="muted">Sisa Kapasitas Parkir</div>
            </div>
        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-7">
            <div class="panel">
                <h5 class="panel-title">
                    <i class="bi bi-lightning-charge-fill me-2"
                       style="color:#c4a5fd"></i>
                    Akses Cepat
                </h5>

                <div class="row g-3">

                    <div class="col-sm-6">
                        <a href="{{ url('/petugas/transaksi/masuk') }}"
                           class="quick-link">
                            <i class="bi bi-car-front"></i>
                            <div>
                                <strong>Kendaraan Masuk</strong>
                                <div class="muted">Catat kendaraan masuk</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ url('/petugas/transaksi/keluar') }}"
                           class="quick-link">
                            <i class="bi bi-box-arrow-right"></i>
                            <div>
                                <strong>Kendaraan Keluar</strong>
                                <div class="muted">Proses kendaraan keluar</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ url('/petugas/transaksi/cetak') }}"
                           class="quick-link">
                            <i class="bi bi-printer"></i>
                            <div>
                                <strong>Struktur Parkir</strong>
                                <div class="muted">Informasi area parkir</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ url('/petugas/dashboard') }}"
                           class="quick-link">
                            <i class="bi bi-speedometer2"></i>
                            <div>
                                <strong>Dashboard</strong>
                                <div class="muted">Ringkasan parkir</div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- KAPASITAS --}}
        <div class="col-lg-5">
            <div class="panel">
                <h5 class="panel-title">
                    <i class="bi bi-pie-chart-fill me-2"
                       style="color:#c4a5fd"></i>
                    Kapasitas Parkir
                </h5>

                <div class="d-flex justify-content-between mb-2">
                    <span class="muted">Area terisi</span>
                    <strong>{{ $persentaseTerisi ?? 0 }}%</strong>
                </div>

                <div class="progress mb-4">
                    <div class="progress-bar"
                         style="width:{{ min(100, $persentaseTerisi ?? 0) }}%">
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="muted">Total kapasitas</span>
                    <strong>{{ $kapasitasTotal ?? 0 }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="muted">Kendaraan terisi</span>
                    <strong style="color:#c4a5fd">
                        {{ $terisiTotal ?? 0 }}
                    </strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span class="muted">Sisa kapasitas</span>
                    <strong style="color:#86efac">
                        {{ $sisaKapasitas ?? 0 }}
                    </strong>
                </div>

                <hr style="border-color:#49365f">

                <div class="muted">
                    <i class="bi bi-geo-alt me-1"></i>
                    Total area:
                    <strong class="text-white">
                        {{ $totalArea ?? 0 }} area parkir
                    </strong>
                </div>
            </div>
        </div>

    </div>

    {{-- INFORMASI AREA --}}
    <div class="panel mb-4">
        <h5 class="panel-title">
            <i class="bi bi-grid-fill me-2"
               style="color:#c4a5fd"></i>
            Informasi Area Parkir
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Area</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Sisa</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($areaParkir ?? []) as $i => $area)
                        @php
                            $sisa = max(0, $area->kapasitas - $area->terisi);
                            $persen = $area->kapasitas > 0
                                ? min(100, round(($area->terisi / $area->kapasitas) * 100))
                                : 0;
                        @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $area->nama_area }}</td>
                            <td>{{ $area->kapasitas }}</td>
                            <td>{{ $area->terisi }}</td>
                            <td>{{ $sisa }}</td>
                            <td>
                                @if($sisa == 0)
                                    <span class="badge bg-danger">Penuh</span>
                                @else
                                    <span class="badge bg-success">Tersedia</span>
                                @endif

                                <div class="progress mt-2">
                                    <div class="progress-bar"
                                         style="width:{{ $persen }}%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Belum ada data area parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- TRANSAKSI TERBARU --}}
    <div class="panel mb-4">
        <h5 class="panel-title">
            <i class="bi bi-clock-history me-2"
               style="color:#c4a5fd"></i>
            Transaksi Parkir Terbaru
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($transaksiTerbaru ?? []) as $i => $transaksi)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-bold">
                                {{ $transaksi->plat_nomor }}
                            </td>
                            <td>{{ ucfirst($transaksi->jenis_kendaraan) }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($transaksi->status == 'masuk')
                                    <span class="badge bg-success">Masih Parkir</span>
                                @else
                                    <span class="badge bg-secondary">Sudah Keluar</span>
                                @endif
                            </td>
                            <td>
                                @if($transaksi->status == 'keluar')
                                    Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
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
