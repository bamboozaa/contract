@extends('layouts.main')

@section('title', 'แดชบอร์ด')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style>
        :root {
            --utcc-blue: #1e3a5f;
            --utcc-gold: #d4af37;
            --utcc-light-blue: #4a90e2;
            --utcc-gray: #6c757d;
            --utcc-light-gray: #f8f9fa;
            --utcc-dark-blue: #142b42;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Sarabun', sans-serif;
            min-height: 100vh;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--utcc-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            color: var(--utcc-light-blue);
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--utcc-gray);
            font-weight: 600;
        }

        .dashboard-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .page-header {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            color: white;
            margin: -1rem -1rem 0rem -1rem;
            padding: 2rem 1.5rem;
            border-radius: 0.375rem 0.375rem 0 0;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 120px;
            height: 120px;
            background: var(--utcc-gold);
            border-radius: 50%;
            opacity: 0.1;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 100px;
            height: 100px;
            background: var(--utcc-gold);
            border-radius: 50%;
            opacity: 0.1;
        }

        .dashboard-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 400;
        }

        .university-name {
            font-size: 1rem;
            opacity: 0.8;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .utcc-logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .utcc-logo i {
            font-size: 1.8rem;
            color: var(--utcc-gold);
        }

        .stats-card {
            border: none;
            border-radius: 20px;
            transition: all 0.4s ease;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--utcc-gold);
        }

        .stats-icon {
            font-size: 3.5rem;
            opacity: 0.9;
            transition: all 0.4s ease;
            margin-bottom: 1rem;
        }

        .stats-card:hover .stats-icon {
            opacity: 1;
            transform: scale(1.15) rotate(3deg);
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 800;
            margin: 1rem 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            line-height: 1;
        }

        .stats-label {
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.95;
            margin-bottom: 0.5rem;
        }

        .stats-description {
            font-size: 0.85rem;
            opacity: 0.8;
            font-weight: 400;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        .card-link:hover {
            color: inherit;
            text-decoration: none;
        }

        .bg-gradient-total {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-dark-blue) 100%);
        }

        .bg-gradient-purchase {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }

        .bg-gradient-rental {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        }

        .bg-gradient-service {
            background: linear-gradient(135deg, var(--utcc-light-blue) 0%, #3a7bd5 100%);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 1.8rem;
            }

            .stats-number {
                font-size: 2.5rem;
            }

            .stats-icon {
                font-size: 3rem;
            }

            .page-header {
                padding: 1.5rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .dashboard-title {
                font-size: 1.5rem;
            }

            .stats-number {
                font-size: 2rem;
            }
        }
    </style>
@stop

@section('content')
    <!-- Breadcrumb -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="bi bi-house-door me-1"></i>{{ __('หน้าหลัก') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bi bi-speedometer2 me-1"></i>{{ __('แดชบอร์ด') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="dashboard-card card">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <h1 class="dashboard-title mb-1">ระบบจัดการสัญญา</h1>
                    <div class="dashboard-subtitle">
                        <i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::now()->thaidate() }}
                        <span class="mx-3">|</span>
                        <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->fullname ?? Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <!-- สัญญาทั้งหมด -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('contracts.index') }}" class="card-link">
                        <div class="card text-white bg-gradient-total stats-card">
                            <div class="card-body text-center p-4">
                                <div class="stats-icon pulse-animation">
                                    <i class="bi bi-files"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts) }}</div>
                                <div class="stats-label">สัญญาทั้งหมด</div>
                                <div class="stats-description">
                                    จำนวนสัญญารวมทุกประเภท
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาซื้อขาย -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['contract_type' => 1]) }}" class="card-link">
                        <div class="card text-white bg-gradient-purchase stats-card">
                            <div class="card-body text-center p-4">
                                <div class="stats-icon">
                                    <i class="bi bi-cart-check"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_1) }}</div>
                                <div class="stats-label">สัญญาซื้อขาย</div>
                                <div class="stats-description">
                                    การจัดซื้อสินค้าและบริการ
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาจ้าง -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['contract_type' => 2]) }}" class="card-link">
                        <div class="card text-white bg-gradient-service stats-card">
                            <div class="card-body text-center p-4">
                                <div class="stats-icon">
                                    <i class="bi bi-briefcase"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_2) }}</div>
                                <div class="stats-label">สัญญาจ้าง</div>
                                <div class="stats-description">
                                    การจ้างงานและบริการ
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาเช่า -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['contract_type' => 3]) }}" class="card-link">
                        <div class="card text-white bg-gradient-rental stats-card">
                            <div class="card-body text-center p-4">
                                <div class="stats-icon">
                                    <i class="bi bi-house-door"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_3) }}</div>
                                <div class="stats-label">สัญญาเช่า</div>
                                <div class="stats-description">
                                    การเช่าอสังหาริมทรัพย์
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
