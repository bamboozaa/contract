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
            margin-bottom: 2rem;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .section-header {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            color: white;
            margin: -1rem -1rem 0rem -1rem;
            padding: 1.5rem;
            border-radius: 0.375rem 0.375rem 0 0;
            position: relative;
            overflow: hidden;
        }

        .section-header::before {
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

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 400;
            margin-bottom: 0;
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
            font-size: 3rem;
            opacity: 0.9;
            transition: all 0.4s ease;
            margin-bottom: 1rem;
        }

        .stats-card:hover .stats-icon {
            opacity: 1;
            transform: scale(1.15) rotate(3deg);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 1rem 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            line-height: 1;
        }

        .stats-label {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.95;
            margin-bottom: 0.5rem;
        }

        .stats-description {
            font-size: 0.8rem;
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

        .bg-gradient-hire {
            background: linear-gradient(135deg, var(--utcc-light-blue) 0%, #3a7bd5 100%);
        }

        .bg-gradient-rental {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        }

        .bg-gradient-permission {
            background: linear-gradient(135deg, #6f42c1 0%, #563d7c 100%);
        }

        .bg-gradient-agreement {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        }

        .bg-gradient-active {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }

        .bg-gradient-expired {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .bg-gradient-expiring {
            background: linear-gradient(135deg, #fd7e14 0%, #e55100 100%);
        }

        .bg-gradient-no-expiry {
            background: linear-gradient(135deg, #6f42c1 0%, #563d7c 100%);
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

        .expiring-detail-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .expiring-detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .expiring-detail-card .card-header {
            border: none;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
            background: linear-gradient(135deg, #fd7e14 0%, #e55100 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .expiring-detail-card .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .expiring-detail-card .card-body {
            padding: 2rem;
            background: white;
            border-radius: 0 0 15px 15px;
        }

        .contract-item {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .contract-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateX(5px);
            border-color: var(--utcc-light-blue);
        }

        .contract-item:last-child {
            margin-bottom: 0;
        }

        .contract-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contract-number {
            background: var(--utcc-blue);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .days-left {
            background: #fd7e14;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .contract-name {
            font-weight: 600;
            color: var(--utcc-dark-blue);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .contract-details {
            color: var(--utcc-gray);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .view-all-btn {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .view-all-btn:hover {
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.3rem;
            }

            .stats-number {
                font-size: 2rem;
            }

            .stats-icon {
                font-size: 2.5rem;
            }

            .contract-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 1.2rem;
            }

            .stats-number {
                font-size: 1.8rem;
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

    <!-- ส่วนที่ 1: ประเภทสัญญาทั้งหมด -->
    <div class="dashboard-card card">
        <div class="section-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="section-title mb-0">
                        <i class="bi bi-pie-chart me-2"></i>ประเภทสัญญาทั้งหมด
                    </h2>
                    <p class="section-subtitle">จำแนกตามประเภทของสัญญาแต่ละชนิด</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- สัญญาทั้งหมด -->
                <div class="col-6 col-lg-2">
                    <a href="{{ route('contracts.index') }}" class="card-link">
                        <div class="card text-white bg-gradient-total stats-card">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon">
                                    <i class="bi bi-files"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts) }}</div>
                                <div class="stats-label">ทั้งหมด</div>
                                <div class="stats-description">รวมทุกประเภท</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาซื้อขาย -->
                <div class="col-6 col-lg-2">
                    <a href="{{ route('contracts.index', ['contract_type' => 1]) }}" class="card-link">
                        <div class="card text-white bg-gradient-purchase stats-card">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon">
                                    <i class="bi bi-cart-check"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_1) }}</div>
                                <div class="stats-label">ซื้อขาย</div>
                                <div class="stats-description">จัดซื้อสินค้า</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาจ้าง -->
                <div class="col-6 col-lg-2">
                    <a href="{{ route('contracts.index', ['contract_type' => 2]) }}" class="card-link">
                        <div class="card text-white bg-gradient-hire stats-card">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon">
                                    <i class="bi bi-briefcase"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_2) }}</div>
                                <div class="stats-label">จ้าง</div>
                                <div class="stats-description">จ้างงานบริการ</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาเช่า -->
                <div class="col-6 col-lg-2">
                    <a href="{{ route('contracts.index', ['contract_type' => 3]) }}" class="card-link">
                        <div class="card text-white bg-gradient-rental stats-card">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon">
                                    <i class="bi bi-house"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_3) }}</div>
                                <div class="stats-label">เช่า</div>
                                <div class="stats-description">เช่าทรัพย์สิน</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาอนุมัติสิทธิ์ -->
                <div class="col-6 col-lg-2">
                    <a href="{{ route('contracts.index', ['contract_type' => 4]) }}" class="card-link">
                        <div class="card text-white bg-gradient-permission stats-card">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_4) }}</div>
                                <div class="stats-label">อนุมัติสิทธิ์</div>
                                <div class="stats-description">ให้ใช้สิทธิ์</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- บันทึกข้อตกลง -->
                <div class="col-6 col-lg-2">
                    <a href="{{ route('contracts.index', ['contract_type' => 5]) }}" class="card-link">
                        <div class="card text-white bg-gradient-agreement stats-card">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>
                                <div class="stats-number">{{ count($contracts_5) }}</div>
                                <div class="stats-label">บันทึกข้อตกลง</div>
                                <div class="stats-description">ข้อตกลงต่างๆ</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ส่วนที่ 2: สถานะสัญญาตามระยะเวลา -->
    <div class="dashboard-card card">
        <div class="section-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="section-title mb-0">
                        <i class="bi bi-hourglass-split me-2"></i>สถานะสัญญาตามระยะเวลา
                    </h2>
                    <p class="section-subtitle">จำแนกตามสถานะการหมดอายุของสัญญา</p>
                </div>
            </div>
        </div>
        <div class="card-body p-3"> <!-- เปลี่ยนจาก p-4 เป็น p-3 -->
            <div class="row g-3"> <!-- เปลี่ยนจาก g-4 เป็น g-3 -->
                @php
                    $today = \Carbon\Carbon::now();

                    // สัญญาที่ยังไม่หมดอายุ (วันสิ้นสุดมากกว่าวันปัจจุบัน)
                    $activeContracts = $contracts->filter(function ($contract) use ($today) {
                        return !empty($contract->end_date) &&
                            \Carbon\Carbon::parse($contract->end_date)->gt($today->copy()->addDays(30));
                    });

                    // สัญญาที่หมดอายุแล้ว (วันสิ้นสุดน้อยกว่าวันปัจจุบัน)
                    $expiredContracts = $contracts->filter(function ($contract) use ($today) {
                        return !empty($contract->end_date) && \Carbon\Carbon::parse($contract->end_date)->lt($today);
                    });

                    // สัญญาที่กำลังจะหมดอายุใน 30 วัน
                    $expiringContracts = $contractsExpiringIn30Days;

                    // สัญญาที่ไม่มีวันหมดอายุ (end_date เป็น null หรือ empty)
                    $noExpiryContracts = $contracts->filter(function ($contract) {
                        return empty($contract->end_date) || is_null($contract->end_date);
                    });
                @endphp

                <!-- สัญญายังไม่หมดอายุ -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['expiry_status' => 'active']) }}" class="card-link">
                        <div class="card text-white bg-gradient-active stats-card stats-card-compact">
                            <div class="card-body text-center p-3"> <!-- เปลี่ยนจาก p-4 เป็น p-3 -->
                                <div class="stats-icon-small"> <!-- ใช้ไอคอนขนาดเล็ก -->
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="stats-number-small">{{ count($activeContracts) }}</div>
                                <div class="stats-label-small">ยังไม่หมดอายุ</div>
                                <div class="stats-description-small">สัญญาที่ใช้งานได้</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาหมดอายุแล้ว -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['expiry_status' => 'expired']) }}" class="card-link">
                        <div class="card text-white bg-gradient-expired stats-card stats-card-compact">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon-small">
                                    <i class="bi bi-x-circle"></i>
                                </div>
                                <div class="stats-number-small">{{ count($expiredContracts) }}</div>
                                <div class="stats-label-small">หมดอายุแล้ว</div>
                                <div class="stats-description-small">สัญญาที่หมดอายุ</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาใกล้หมดอายุ 30 วัน -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['expiry_status' => 'expiring']) }}" class="card-link">
                        <div class="card text-white bg-gradient-expiring stats-card stats-card-compact">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon-small pulse-animation">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div class="stats-number-small">{{ count($expiringContracts) }}</div>
                                <div class="stats-label-small">ใกล้หมดอายุ 30 วัน</div>
                                <div class="stats-description-small">ต้องการความสนใจ</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- สัญญาที่ไม่มีวันหมดอายุ -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('contracts.index', ['expiry_status' => 'no_expiry']) }}" class="card-link">
                        <div class="card text-white bg-gradient-no-expiry stats-card stats-card-compact">
                            <div class="card-body text-center p-3">
                                <div class="stats-icon-small">
                                    <i class="bi bi-infinity"></i>
                                </div>
                                <div class="stats-number-small">{{ count($noExpiryContracts) }}</div>
                                <div class="stats-label-small">ไม่มีวันหมดอายุ</div>
                                <div class="stats-description-small">สัญญาถาวร</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- รายละเอียดสัญญาที่จะหมดอายุใน 30 วัน -->
    @if (!$contractsExpiringIn30Days->isEmpty())
        <div class="expiring-detail-card card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            รายละเอียดสัญญาที่จะหมดอายุใน 30 วัน
                        </h5>
                        <small class="opacity-75">ตรวจสอบและเตรียมความพร้อมสำหรับการต่ออายุสัญญา</small>
                    </div>
                    <div class="badge bg-light text-dark fs-6">
                        {{ count($contractsExpiringIn30Days) }} สัญญา
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach ($contractsExpiringIn30Days as $contract)
                    @php
                        $today = \Carbon\Carbon::now();
                        $endDate = \Carbon\Carbon::parse($contract->end_date);
                        $daysLeft = $today->diffInDays($endDate);
                    @endphp
                    <div class="contract-item">
                        <div class="contract-header">
                            <div class="contract-number">
                                {{ $contract->contract_no }}/{{ $contract->contract_year }}
                            </div>
                            <div class="days-left">
                                <i class="bi bi-clock me-1"></i>
                                เหลืออีก {{ $daysLeft }} วัน
                            </div>
                        </div>
                        <div class="contract-name">
                            {{ $contract->contract_name }}
                        </div>
                        <div class="contract-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="bi bi-building me-1"></i>
                                    <strong>หน่วยงาน:</strong> {{ $contract->department->dep_name ?? 'ไม่ระบุ' }}
                                </div>
                                <div class="col-md-6">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    <strong>วันสิ้นสุด:</strong> {{ $endDate->format('d/m/') . ($endDate->year + 543) }}
                                </div>
                            </div>
                            @if ($contract->partners)
                                <div class="mt-2">
                                    <i class="bi bi-people me-1"></i>
                                    <strong>คู่สัญญา:</strong> {{ $contract->partners }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- ปุ่มดูทั้งหมด -->
                <div class="text-center">
                    <a href="{{ route('contracts.index') }}" class="view-all-btn">
                        <i class="bi bi-eye me-2"></i>ดูรายการสัญญาทั้งหมด
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection
