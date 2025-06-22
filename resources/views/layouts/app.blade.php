<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Manajemen GYM')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        #app {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 1rem;
            flex-shrink: 0;
        }
        .sidebar .nav-link {
            color: white;
            padding: 0.75rem 1rem; 
            transition: all 0.2s;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }
        .main-content {
            flex: 1;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .content-wrapper {
            width: 100%;
            max-width: 1200px;
            padding-bottom: 2rem;
            text-align: left;
        }
        /* Style untuk footer */
        .footer {
            background-color: #343a40;
            text-align: center;
            color: white; /* Pastikan warna teks putih */
            margin-top: auto;
            width: 100%; /* Pastikan footer membentang penuh */
        }
        .footer .container {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="d-flex flex-column p-3 h-100">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <i class="bi bi-person-fill-gear me-2 fs-4"></i>
                    <span class="fs-4">Manajemen GYM</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('members.index') }}" class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge me-2"></i>
                            Data Member
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('visitors.index') }}" class="nav-link {{ request()->routeIs('visitors.*') ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            Data Pengunjung
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payments.index') }}" class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                            <i class="bi bi-credit-card me-2"></i>
                            Data Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporans.index') }}" class="nav-link {{ request()->routeIs('laporans.*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-bar-graph me-2"></i>
                            Data Laporan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('info.index') }}" class="nav-link {{ request()->routeIs('info.*') ? 'active' : '' }}">
                            <i class="bi bi-gear-fill me-2"></i>
                            Info Gym
                        </a>
                    </li>
                </ul>
                <hr>
                <!-- User Dropdown in Sidebar -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/admin.png') }}" alt="Admin Avatar" width="32" height="32" class="rounded-circle me-2">
                        <strong>{{ session('user_name') ?? session('user_email') ?? 'Admin GYM' }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="main-content">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer py-3 text-white">
        <div class="container text-center">
            <span class="text-white">© {{ date('Y') }} Manajemen GYM.</span>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>