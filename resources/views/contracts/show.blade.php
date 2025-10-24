@extends('layouts.main')
@section('title', 'รายละเอียดสัญญา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style>
        .contract-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            text-align: center;
            margin-bottom: 0;
        }

        .contract-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .contract-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .info-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 15px 15px;
            margin-bottom: 1.5rem;
        }

        .contract-value {
            font-size: 1.4rem;
            font-weight: bold;
            color: #28a745;
            text-align: center;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            display: inline-block;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px solid #667eea;
            border-left: 4px solid #667eea;
            position: relative;
        }

        .info-section.guarantee {
            border-color: #ffc107;
            border-left-color: #ffc107;
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.05) 0%, rgba(255, 255, 255, 0.8) 100%);
        }

        .info-section.files {
            border-color: #17a2b8;
            border-left-color: #17a2b8;
            background: linear-gradient(135deg, rgba(23, 162, 184, 0.05) 0%, rgba(255, 255, 255, 0.8) 100%);
            grid-column: 1 / -1;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.5rem;
            color: #667eea;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .data-label {
            font-weight: 500;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .data-value {
            font-weight: 600;
            color: #495057;
            text-align: right;
        }

        .contract-id-highlight {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.85rem;
        }

        .file-attachment {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 12px;
            border: 2px dashed #dee2e6;
            text-align: center;
        }

        .file-attachment i {
            font-size: 2.5rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .action-buttons {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .btn-custom {
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            margin: 0 0.25rem;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .contract-header {
                padding: 1.5rem;
            }

            .contract-title {
                font-size: 1.5rem;
            }
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('หน้าหลัก') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('contracts') }}">{{ __('จัดการสัญญา') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('รายละเอียดสัญญา') }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Contract Header -->
        <div class="card info-card">
            <div class="contract-header">
                <h1 class="contract-title">
                    <i class="bi bi-file-earmark-text me-3"></i>
                    {{ __('นตก.(ส) ') . $contract->contract_no . '/' . $contract->contract_year }}
                </h1>
                <p class="contract-subtitle">{{ $contract->contract_name }}</p>
            </div>

            <!-- Main Content -->
            <div class="card-body p-4">
                <!-- Contract Value & Status -->
                <div class="row mb-4">
                    <div class="col-md-6 text-center">
                        <h5 class="text-muted mb-2">มูลค่างานตามสัญญา</h5>
                        <div class="contract-value">
                            {{ number_format($contract->acquisition_value) }} บาท
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="text-muted mb-2">สถานะสัญญา</h5>
                        @php
                            $statusConfig = [
                                1 => ['class' => 'bg-secondary', 'text' => 'ร่างสัญญา'],
                                2 => ['class' => 'bg-info', 'text' => 'เสนอตรวจร่าง'],
                                3 => ['class' => 'bg-warning', 'text' => 'แจ้งลงนามสัญญา'],
                                4 => ['class' => 'bg-primary', 'text' => 'เสนอผู้บริหารลงนาม'],
                                5 => ['class' => 'bg-success', 'text' => 'เสร็จสิ้น(คืนคู่ฉบับ)'],
                            ];
                            $status = $statusConfig[$contract->status] ?? [
                                'class' => 'bg-dark',
                                'text' => 'ไม่ระบุ',
                            ];
                        @endphp
                        <span class="badge {{ $status['class'] }} status-badge">
                            {{ $status['text'] }}
                        </span>
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="info-grid">
                    <!-- ข้อมูลทั่วไป -->
                    <div class="info-section">
                        <h6 class="section-title">
                            <i class="bi bi-info-circle"></i>ข้อมูลทั่วไป
                        </h6>
                        <div class="data-row">
                            <span class="data-label">หน่วยงานต้นเรื่อง</span>
                            <span class="data-value">{{ $contract->department['dep_name'] }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">บริษัทคู่สัญญา</span>
                            <span class="data-value">{{ $contract->partners }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">กองทุน</span>
                            <span class="data-value">{{ $contract->fund ?: 'ไม่ระบุ' }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">ผู้ที่ได้รับมอบหมาย</span>
                            <span class="data-value">{{ $contract->user['fullname'] ?? 'ไม่ระบุ' }}</span>
                        </div>
                    </div>

                    <!-- รายละเอียดสัญญา -->
                    <div class="info-section">
                        <h6 class="section-title">
                            <i class="bi bi-file-earmark-text"></i>รายละเอียดสัญญา
                        </h6>
                        <div class="data-row">
                            <span class="data-label">ประเภทสัญญา</span>
                            <span class="data-value">
                                @php
                                    $contractTypes = [
                                        1 => 'สัญญาซื้อขาย',
                                        2 => 'สัญญาจ้าง',
                                        3 => 'สัญญาเช่า',
                                        4 => 'สัญญาอนุมัติให้ใช้สิทธิ์',
                                        5 => 'บันทึกข้อตกลง',
                                    ];
                                @endphp
                                <span class="badge bg-primary">{{ $contractTypes[$contract->contract_type] ?? 'ไม่ระบุ' }}</span>
                            </span>
                        </div>
                        @if (($contract->contract_type === 3 || $contract->contract_type === 5) && $contract->contractid)
                            <div class="data-row">
                                <span class="data-label">Contract ID</span>
                                <span class="data-value">
                                    <span class="contract-id-highlight">{{ $contract->contractid }}</span>
                                </span>
                            </div>
                        @endif
                        <div class="data-row">
                            <span class="data-label">วันที่ในสัญญา</span>
                            <span class="data-value">{{ \Carbon\Carbon::parse($contract->contract_date)->thaidate() }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">วันเริ่มสัญญา</span>
                            <span class="data-value">{{ \Carbon\Carbon::parse($contract->start_date)->thaidate() }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">วันสิ้นสุดสัญญา</span>
                            <span class="data-value">{{ \Carbon\Carbon::parse($contract->end_date)->thaidate() }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">ระยะเวลาสัญญา</span>
                            <span class="data-value">
                                @php
                                    $start = \Carbon\Carbon::parse($contract->start_date);
                                    $end = \Carbon\Carbon::parse($contract->end_date);
                                    $diffInDays = $start->diffInDays($end);
                                    $diffInMonths = $start->diffInMonths($end);
                                    $diffInYears = $start->diffInYears($end);
                                @endphp
                                <span class="badge bg-info">
                                    @if ($diffInYears > 0)
                                        {{ $diffInYears }} ปี {{ $diffInMonths % 12 }} เดือน
                                    @elseif($diffInMonths > 0)
                                        {{ $diffInMonths }} เดือน
                                    @else
                                        {{ $diffInDays }} วัน
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>

                    <!-- ข้อมูลหลักประกันสัญญา -->
                    <div class="info-section guarantee">
                        <h6 class="section-title">
                            <i class="bi bi-shield-check"></i>หลักประกันสัญญา
                        </h6>
                        <div class="data-row">
                            <span class="data-label">ชนิดหลักประกัน</span>
                            <span class="data-value">
                                @php
                                    $guaranteeTypes = [
                                        1 => 'เงินสด',
                                        2 => 'หนังสือค้ำประกัน',
                                        3 => 'เช็คธนาคาร',
                                        4 => 'พันธบัตรรัฐบาลไทย',
                                    ];
                                @endphp
                                {{ $guaranteeTypes[$contract->types_of_guarantee] ?? 'ไม่ระบุ' }}
                            </span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">มูลค่าหลักประกัน</span>
                            <span class="data-value contract-value" style="font-size: 1rem;">
                                {{ number_format($contract->guarantee_amount) }} บาท
                                @if ($contract->acquisition_value > 0)
                                    <br><small class="text-muted">
                                        ({{ number_format(($contract->guarantee_amount / $contract->acquisition_value) * 100, 2) }}%)
                                    </small>
                                @endif
                            </span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">ระยะเวลาค้ำประกัน</span>
                            <span class="data-value">
                                @php
                                    $durations = [1 => '1 ปี', 2 => '2 ปี', 3 => '3 ปี', 4 => 'อื่น ๆ'];
                                @endphp
                                {{ $durations[$contract->duration] ?? 'ไม่ระบุ' }}
                            </span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">เงื่อนไขการคืน</span>
                            <span class="data-value">
                                @php
                                    $conditions = [1 => '3 เดือน', 2 => '6 เดือน', 3 => '1 ปี'];
                                @endphp
                                {{ $conditions[$contract->condition] ?? 'ไม่ระบุ' }}
                            </span>
                        </div>
                    </div>

                    <!-- ไฟล์แนบ -->
                    @if ($contract->formFile)
                        <div class="info-section files">
                            <h6 class="section-title">
                                <i class="bi bi-paperclip"></i>ไฟล์แนบ
                            </h6>
                            <div class="file-attachment">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <h6 class="mt-2">{{ $contract->formFile }}</h6>
                                <div class="mt-3">
                                    <a href="{{ route('contracts.file', $contract->id) }}" class="btn btn-sm btn-primary me-2" target="_blank">
                                        <i class="bi bi-eye me-1"></i>ดูไฟล์
                                    </a>
                                    <a href="{{ route('contracts.file', $contract->id) }}?download=1" class="btn btn-sm btn-success">
                                        <i class="bi bi-download me-1"></i>ดาวน์โหลด
                                    </a>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    อัปโหลดเมื่อ {{ \Carbon\Carbon::parse($contract->created_at)->thaidate() }}
                                </small>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="javascript:history.back()" class="btn btn-secondary btn-custom">
                        <i class="bi bi-arrow-left me-2"></i>กลับหน้ารายการ
                    </a>
                    @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                        <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-warning btn-custom">
                            <i class="bi bi-pencil me-2"></i>แก้ไขสัญญา
                        </a>
                        <button class="btn btn-info btn-custom" onclick="window.print()">
                            <i class="bi bi-printer me-2"></i>พิมพ์รายละเอียด
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
