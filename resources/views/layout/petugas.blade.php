
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PARKIR - Petugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #0f0b1e;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #161129;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .menu {
            color: #a0aec0;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 18px;
            margin: 4px 12px;
            border-radius: 12px;
        }

        .menu:hover, 
        .menu.active {
            background: #7c3aed;
            color: white;
        }

        .topbar {
            background: #161129;
            padding: 18px 30px;
            border-bottom: 1px solid #302747;
        }

        .content {
            padding: 30px;
        }

        .card {
            background: #161129 !important;
            color: white !important;
            border: 1px solid #302747 !important;
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <div>
        <div class="p-3 d-flex align-items-center">
            <div class="bg-info rounded-3 p-2 me-3 fw-bold">P</div>
            <div>
                <div class="fw-bold">E-PARKIR</div>
                <small class="text-info">HALAMAN PETUGAS</small>
            </div>
        </div>

        <div class="px-2 mt-3">

            <a href="{{ route('petugas.dashboard') }}"
               class="menu {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill me-3"></i>
                Dashboard
            </a>


            <a href="{{ route('petugas.transaksi.masuk') }}"
               class="menu {{ request()->is('petugas/transaksi/masuk') ? 'active' : '' }}">
                <i class="bi bi-box-arrow-in-right me-3"></i>
                Kendaraan Masuk
            </a>

            <a href="{{ route('petugas.transaksi.keluar') }}"
               class="menu {{ request()->is('petugas/transaksi/keluar') ? 'active' : '' }}">
                <i class="bi bi-box-arrow-right me-3"></i>
                Kendaraan Keluar
            </a>

            <a href="{{ route('petugas.transaksi.cetak') }}"
               class="menu {{ request()->is('petugas/transaksi/cetak') ? 'active' : '' }}">
                <i class="bi bi-printer-fill me-3"></i>
                Cetak Struktur Parkir
            </a>

        </div>
    </div>

    <div class="p-3 m-3" style="background:#1f1838;border-radius:12px;">
        <div class="fw-bold">{{ session('nama_lengkap') }}</div>
        <small class="text-info">Petugas Parkir</small>

        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm w-100">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>
    </div>

</div>

<div class="main-content">

    <div class="topbar d-flex justify-content-between align-items-center">
        <h5 class="mb-0">@yield('title', 'Dashboard Petugas')</h5>
        <span>
            <i class="bi bi-person-circle me-2"></i>
            {{ session('nama_lengkap') }}
        </span>
    </div>

    <div class="content">
        @yield('content')
    </div>

</div>

</body>
</html>
