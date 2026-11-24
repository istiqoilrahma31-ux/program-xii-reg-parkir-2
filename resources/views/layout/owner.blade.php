
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-PARKIR Owner')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #0f0b1e;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #161129;
            padding: 16px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 0 28px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            background: #7c3aed;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
        }

        .brand-name {
            font-size: 16px;
            font-weight: bold;
        }

        .brand-subtitle {
            color: #a78bfa;
            font-size: 9px;
            letter-spacing: 2px;
            margin-top: 3px;
        }

        .menu {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 15px 18px;
            margin: 5px 4px;
            border-radius: 13px;
            font-size: 14px;
        }

        .menu i {
            font-size: 19px;
            margin-right: 15px;
        }

        .menu:hover,
        .menu.active {
            background: #7c3aed;
            color: white;
        }

       
.profile {
    margin-top: auto;
    background: #211a38;
    border: 1px solid #302747;
    border-radius: 12px;
    padding: 15px;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 15px;
}

.profile-info {
    min-width: 0;
    width: 100%;
}

.profile-info strong {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: white;
}

.profile-info small {
    display: block;
    color: #22d3ee;
    font-size: 12px;
    margin-top: 4px;
}

.logout {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #e3344b;
    color: white;
    border: none;
    padding: 8px;
    border-radius: 5px;
    font-size: 13px;
    text-decoration: none;
}

.logout:hover {
    background: #c9233a;
    color: white;
}


        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .content-card {
            background: #161129;
            border: 1px solid #302747;
            border-radius: 15px;
            padding: 25px;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-logo">P</div>
            <div>
                <div class="brand-name">E-PARKIR</div>
                <div class="brand-subtitle">HALAMAN OWNER</div>
            </div>
        </div>

        <a href="{{ route('owner.dashboard') }}"
           class="menu {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i>
            Dashboard
        </a>

        <a href="{{ route('owner.laporan') }}"
           class="menu {{ request()->routeIs('owner.laporan*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-bar-graph-fill"></i>
            Laporan Transaksi
        </a>

        
<div class="profile">

    <div class="profile-info">
        <strong>{{ session('nama_lengkap', 'Owner') }}</strong>
        <small>Owner Parkir</small>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="m-0 w-100">
        @csrf

        <button type="submit" class="logout">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </button>
    </form>

</div>


        <form id="logout-form-owner" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>
