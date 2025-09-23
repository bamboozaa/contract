@extends('layouts.main')

@section('title', 'แดชบอร์ด')

@section('importcss')
    @parent
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        }

        .stats-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.7) 100%);
        }

        .stats-icon {
            font-size: 3.5rem;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .stats-card:hover .stats-icon {
            opacity: 1;
            transform: scale(1.1);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stats-label {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-link:hover {
            color: inherit;
            text-decoration: none;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%);
        }

        .welcome-text {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item {
            font-weight: 500;
        }

        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .action-btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
@stop

@section('content')
    <!-- Breadcrumb -->
    <div class="container-fluid mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span class="text-decoration-none"><i class="bi bi-house-door me-1"></i>{{ __('หน้าหลัก') }}</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span><i class="bi bi-speedometer2 me-1"></i>{{ __('แดชบอร์ด') }}</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Dashboard Header -->
    <div class="dashboard-header text-center">
        {{-- <div class="welcome-text">ยินดีต้อนรับสู่</div> --}}
        <h1 class="dashboard-title">ระบบจัดการสัญญา</h1>
        <p class="dashboard-subtitle mb-0">
            <i class="bi bi-calendar3 me-2"></i>วันที่ {{ \Carbon\Carbon::now()->thaidate() }}
            <span class="mx-3">|</span>
            <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->fullname ?? Auth::user()->name }}
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4">
        <!-- สัญญาทั้งหมด -->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <a href="{{ route('contracts.index') }}" class="card-link">
                <div class="card text-white bg-gradient-info stats-card">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon">
                            <i class="bi bi-files"></i>
                        </div>
                        <div class="stats-number">{{ count($contracts) }}</div>
                        <div class="stats-label">สัญญาทั้งหมด</div>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="bi bi-arrow-right me-1"></i>คลิกเพื่อดูรายละเอียด
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- สัญญาซื้อขาย -->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <a href="{{ route('contracts.index', ['contract_type' => 1]) }}" class="card-link">
                <div class="card text-white bg-gradient-success stats-card">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <div class="stats-number">{{ count($contracts_1) }}</div>
                        <div class="stats-label">สัญญาซื้อขาย</div>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="bi bi-arrow-right me-1"></i>คลิกเพื่อดูรายละเอียด
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- สัญญาเช่า -->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <a href="{{ route('contracts.index', ['contract_type' => 3]) }}" class="card-link">
                <div class="card text-white bg-gradient-warning stats-card">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon">
                            <i class="bi bi-house"></i>
                        </div>
                        <div class="stats-number">{{ count($contracts_3) }}</div>
                        <div class="stats-label">สัญญาเช่า</div>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="bi bi-arrow-right me-1"></i>คลิกเพื่อดูรายละเอียด
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- สัญญาจ้าง -->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <a href="{{ route('contracts.index', ['contract_type' => 2]) }}" class="card-link">
                <div class="card text-white bg-gradient-primary stats-card">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="stats-number">{{ count($contracts_2) }}</div>
                        <div class="stats-label">สัญญาจ้าง</div>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="bi bi-arrow-right me-1"></i>คลิกเพื่อดูรายละเอียด
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- สัญญาอนุมัติให้ใช้สิทธิ์ -->
        {{-- <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <a href="{{ route('contracts.index', ['contract_type' => 4]) }}" class="card-link">
                <div class="card text-white bg-gradient-danger stats-card">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon">
                            <i class="bi bi-key"></i>
                        </div>
                        <div class="stats-number">{{ isset($contracts_4) ? count($contracts_4) : 0 }}</div>
                        <div class="stats-label">สัญญาอนุมัติให้ใช้สิทธิ์</div>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="bi bi-arrow-right me-1"></i>คลิกเพื่อดูรายละเอียด
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}

        <!-- บันทึกข้อตกลง -->
        {{-- <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <a href="{{ route('contracts.index', ['contract_type' => 5]) }}" class="card-link">
                <div class="card text-white" style="background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);">
                    <div class="card-body text-center p-4 stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="stats-number">{{ isset($contracts_5) ? count($contracts_5) : 0 }}</div>
                        <div class="stats-label">บันทึกข้อตกลง</div>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="bi bi-arrow-right me-1"></i>คลิกเพื่อดูรายละเอียด
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>

    <!-- Quick Actions -->
    {{-- <div class="quick-actions">
        <h4 class="mb-4">
            <i class="bi bi-lightning me-2 text-primary"></i>การดำเนินการด่วน
        </h4>
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('contracts.create') }}" class="btn btn-primary action-btn w-100">
                    <i class="bi bi-plus-circle me-2"></i>สร้างสัญญาใหม่
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('contracts.index', ['status' => 1]) }}" class="btn btn-warning action-btn w-100">
                    <i class="bi bi-file-earmark me-2"></i>ร่างสัญญา
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('contracts.index', ['status' => 4]) }}" class="btn btn-info action-btn w-100">
                    <i class="bi bi-pen me-2"></i>รอลงนาม
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('contracts.index', ['status' => 5]) }}" class="btn btn-success action-btn w-100">
                    <i class="bi bi-check-circle me-2"></i>เสร็จสิ้น
                </a>
            </div>
        </div>
    </div> --}}
@endsection
