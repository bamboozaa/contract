@extends('layouts.main')

@section('title', 'Dashboard')

@section('importcss')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .dashboard-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .stat-card {
        border: none;
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .stat-card .icon {
        font-size: 3rem;
        opacity: 0.3;
        position: absolute;
        right: 1.5rem;
        bottom: 1.5rem;
    }

    .stat-card .number {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-card .label {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .stat-card .sublabel {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* สีการ์ด */
    .stat-card-navy {
        background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 100%);
        color: white;
    }

    .stat-card-green {
        background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);
        color: white;
    }

    .stat-card-blue {
        background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%);
        color: white;
    }

    .stat-card-yellow {
        background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
        color: white;
    }

    .stat-card-purple {
        background: linear-gradient(135deg, #7c3aed 0%, #9333ea 100%);
        color: white;
    }

    .stat-card-cyan {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: white;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .info-section h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #3b82f6;
    }

    @media (max-width: 1200px) {
        .stat-card .number {
            font-size: 2.5rem;
        }

        .stat-card .icon {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 1.5rem;
        }

        .stat-card {
            margin-bottom: 1rem;
        }

        .stat-card .number {
            font-size: 2rem;
        }

        .stat-card .icon {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-speedometer2 me-3" style="font-size: 2.5rem;"></i>
            <div>
                <h1>ประเภทสัญญาทั้งหมด</h1>
                <p>จำแนกตามประเภทของสัญญาแต่ละชนิด</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- ทั้งหมด -->
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a href="{{ route('contracts.index') }}" class="text-decoration-none">
                <div class="stat-card stat-card-navy">
                    <i class="bi bi-file-earmark-text icon"></i>
                    <div class="number">{{ $totalContracts ?? $contracts->count() }}</div>
                    <div class="label">ทั้งหมด</div>
                    <div class="sublabel">รวมทุกประเภท</div>
                </div>
            </a>
        </div>

        <!-- ซื้อขาย -->
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a href="{{ route('contracts.index', ['contract_type' => 1]) }}" class="text-decoration-none">
                <div class="stat-card stat-card-green">
                    <i class="bi bi-cart icon"></i>
                    <div class="number">{{ $contracts_1->count() }}</div>
                    <div class="label">ซื้อขาย</div>
                    <div class="sublabel">จัดซื้อสินค้า</div>
                </div>
            </a>
        </div>

        <!-- สัญญาจ้าง -->
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a href="{{ route('contracts.index', ['contract_type' => 2]) }}" class="text-decoration-none">
                <div class="stat-card stat-card-blue">
                    <i class="bi bi-briefcase icon"></i>
                    <div class="number">{{ $contracts_2->count() }}</div>
                    <div class="label">จ้าง</div>
                    <div class="sublabel">สัญญาจ้าง</div>
                </div>
            </a>
        </div>

        <!-- เช่า -->
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a href="{{ route('contracts.index', ['contract_type' => 3]) }}" class="text-decoration-none">
                <div class="stat-card stat-card-yellow">
                    <i class="bi bi-house icon"></i>
                    <div class="number">{{ $contracts_3->count() }}</div>
                    <div class="label">เช่า</div>
                    <div class="sublabel">เช่าทรัพย์สิน</div>
                </div>
            </a>
        </div>

        <!-- อนุมัติสิทธิ์ -->
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a href="{{ route('contracts.index', ['contract_type' => 4]) }}" class="text-decoration-none">
                <div class="stat-card stat-card-purple">
                    <i class="bi bi-shield-check icon"></i>
                    <div class="number">{{ $contracts_4->count() }}</div>
                    <div class="label">อนุมัติสิทธิ์</div>
                    <div class="sublabel">ให้สิทธิ์</div>
                </div>
            </a>
        </div>

        <!-- บันทึกข้อตกลง -->
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a href="{{ route('contracts.index', ['contract_type' => 5]) }}" class="text-decoration-none">
                <div class="stat-card stat-card-cyan">
                    <i class="bi bi-clipboard-check icon"></i>
                    <div class="number">{{ $contracts_5->count() }}</div>
                    <div class="label">บันทึกข้อตกลง</div>
                    <div class="sublabel">ข้อตกลงร่วม</div>
                </div>
            </a>
        </div>
    </div>

    <!-- เงินหลักประกันสัญญา -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <a href="{{ route('guarantee.index') }}" class="text-decoration-none">
                <div class="info-section" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 0.5rem;">มูลค่าหลักประกันทั้งหมด</div>
                            <div style="font-size: 2rem; font-weight: 700;">{{ number_format($totalGuaranteeAmount ?? 0, 2) }} บาท</div>
                        </div>
                        <i class="bi bi-cash-stack" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-lg-6">
            <a href="{{ route('guarantee.index') }}" class="text-decoration-none">
                <div class="info-section" style="background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 0.5rem;">จำนวนสัญญาที่มีหลักประกัน</div>
                            <div style="font-size: 2rem; font-weight: 700;">{{ number_format($contractsWithGuarantee ?? 0) }} สัญญา</div>
                        </div>
                        <i class="bi bi-file-earmark-text" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- สัญญาใกล้หมดอายุ -->
    @if($contractsExpiringIn30Days->count() > 0)
    <div class="info-section">
        <h3>
            <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
            สัญญาใกล้หมดอายุ 30 วัน
            <span class="badge bg-danger ms-2">{{ $contractsExpiringIn30Days->count() }}</span>
        </h3>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 120px;">เลขที่สัญญา</th>
                        <th>ชื่อสัญญา</th>
                        <th>คู่สัญญา</th>
                        <th style="width: 150px;">วันที่สิ้นสุด</th>
                        <th style="width: 120px;">เหลือเวลา</th>
                        <th style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contractsExpiringIn30Days as $contract)
                    <tr>
                        <td>
                            <span class="badge bg-primary">{{ $contract->contract_no }}/{{ $contract->contract_year }}</span>
                        </td>
                        <td>
                            <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $contract->contract_name }}">
                                {{ $contract->contract_name }}
                            </div>
                        </td>
                        <td>
                            <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $contract->partners }}">
                                {{ $contract->partners }}
                            </div>
                        </td>
                        <td>
                            @if($contract->end_date)
                                @php
                                    $d = \Carbon\Carbon::parse($contract->end_date)->locale('th');
                                    $thaiDate = $d->translatedFormat('j M') . ' ' . ($d->year + 543);
                                @endphp
                                {{ $thaiDate }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($contract->end_date)
                                @php
                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($contract->end_date), false);
                                @endphp
                                @if($daysLeft < 0)
                                    <span class="badge bg-danger">หมดอายุแล้ว</span>
                                @elseif($daysLeft <= 7)
                                    <span class="badge bg-danger">{{ $daysLeft }} วัน</span>
                                @elseif($daysLeft <= 15)
                                    <span class="badge bg-warning text-dark">{{ $daysLeft }} วัน</span>
                                @else
                                    <span class="badge bg-info">{{ $daysLeft }} วัน</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> ดู
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
