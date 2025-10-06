<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script type="module">
        @if (session('error'))
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: '{{ session('error') }}',
                icon: 'error'
            });
        @endif
    </script>

    <!-- Custom Style -->
    {{ Html::style('css/main.css') }}
    @yield('importcss')
    @yield('importjs')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // แสดง/ซ่อน Sidebar
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });

            // คลิกที่ Overlay เพื่อปิด Sidebar
            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        });
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Sidebar Toggle Button -->
            <button class="btn btn-primary d-lg-none me-2" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img alt="" style="border-radius: 50%"
                    src="{{ URL::asset('images/logo/logo-UTCC_SubMain-3.png') }}" alt="UTCC Logo" class="me-2">
                <span>ระบบจัดการสัญญากองนิติการ</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">
                                @php
                                    $name = Auth::user()->name;
                                    $initials = collect(explode(' ', $name))
                                        ->map(fn($word) => mb_substr($word, 0, 1))
                                        ->take(2)
                                        ->implode('');
                                @endphp
                                <span>{{ $initials }}</span>
                            </div>
                            <span>{{ __('ข้อมูลผู้ใช้งาน') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('users.profile', Auth::user()->id) }}"><i class="bi bi-person me-2"></i>โปรไฟล์</a>
                            </li>
                            {{-- <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>ตั้งค่า</a></li> --}}
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        {{ __('ออกจากระบบ') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Layout Container -->
    <div class="container-fluid flex-fill">
        <div class="row h-100">
            <!-- Sidebar -->
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
            <div class="col-lg-2 col-md-3 p-0">
                <div class="sidebar h-100" id="sidebar">
                    <ul class="nav flex-column py-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">
                                <i class="i bi-grid"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contracts.*') ? 'active' : '' }}"
                                href="{{ route('contracts.index') }}">
                                <i class="bi bi-file-earmark-text"></i>
                                จัดการสัญญา
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-plus-circle"></i>
                                สร้างสัญญาใหม่
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-exclamation-triangle"></i>
                                แจ้งเตือน
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-bar-chart"></i>
                                รายงาน
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear"></i>
                                ตั้งค่าระบบ
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-9">
                <div class="main-content h-100">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
