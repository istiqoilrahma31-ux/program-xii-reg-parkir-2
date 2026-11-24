
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Parkir Kabasa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            background: #260b49;
        }

        /* BACKGROUND GAMBAR */
        body::before {
            content: "";
            position: fixed;
            inset: -12px;
            background-image: url("{{ asset('images/parkir-bg.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(5px);
            transform: scale(1.04);
            z-index: -2;
        }

        /* OVERLAY UNGU */
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(65, 15, 110, 0.55),
                rgba(105, 30, 170, 0.45),
                rgba(35, 10, 75, 0.65)
            );
            z-index: -1;
        }

        /* KARTU LOGIN */
        .glass-card {
            width: 100%;
            max-width: 440px;
            padding: 38px;
            background: rgba(70, 30, 110, 0.48);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            color: white;
            margin: 20px;
            animation: muncul 0.8s ease;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border-radius: 12px;
            background: rgba(30, 10, 55, 0.55);
            border: 1px solid rgba(255,255,255,0.18);
            color: white;
            outline: none;
            transition: 0.3s;
        }

        .glass-input:focus {
            border-color: #c084fc;
            box-shadow: 0 0 12px rgba(192,132,252,0.3);
        }

        .glass-input::placeholder {
            color: #d6b9ef;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: linear-gradient(90deg, #a855f7, #7c3aed);
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
            box-shadow: 0 8px 25px rgba(124,58,237,0.4);
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(168,85,247,0.6);
        }

        @media(max-width: 480px) {
            .glass-card {
                padding: 28px 23px;
            }
        }
    </style>
</head>

<body class="text-white">

    <div class="glass-card">

        <!-- LOGO -->
        <div class="text-center mb-7">

            <div class="text-purple-200 text-3xl mb-3">
                <i class="fa-solid fa-square-parking"></i>
            </div>

            <h1 class="text-2xl font-bold tracking-wide">
                E-PARKIR <span class="text-purple-300">Kabasa</span>
            </h1>

            <p class="text-purple-200 text-sm mt-2">
                Welcome Back!
            </p>

            <p class="text-purple-100/70 text-xs mt-1">
                Login to Your Account
            </p>

        </div>

        <!-- PESAN ERROR -->
        @if (session('error'))
            <div class="mb-4 p-3 bg-red-500/20 border border-red-400/30 rounded-xl text-red-200 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form action="{{ route('login') }}" method="POST">

            @csrf

            <!-- USERNAME -->
            <div class="mb-5">

                <label class="block text-sm mb-2 text-purple-100">
                    <i class="fa-regular fa-user mr-2"></i>
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    class="glass-input"
                    placeholder="Masukkan username..."
                >

            </div>

            <!-- PASSWORD -->
            <div class="mb-3">

                <label class="block text-sm mb-2 text-purple-100">
                    <i class="fa-solid fa-lock mr-2"></i>
                    Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="glass-input"
                        placeholder="Masukkan password..."
                    >

                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-purple-300"
                    >
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>

                </div>

            </div>

            <!-- TOMBOL LOGIN -->
            <button type="submit" class="login-button mt-5">

                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                Login

            </button>

        </form>

        <!-- FOOTER -->
        <div class="mt-7 flex items-center gap-3">

            <div class="flex-1 border-t border-white/30"></div>

            <span class="text-xs text-purple-200">
                E-Parkir Kabasa v1.0
            </span>

            <div class="flex-1 border-t border-white/30"></div>

        </div>

    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
