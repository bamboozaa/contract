@extends('layouts.main')
@section('title', 'รายละเอียดสัญญา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style>
        .contract-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .contract-status {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        .info-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .tab-content {
            background: white;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs {
            border-bottom: none;
        }
        .nav-tabs .nav-link {
            border: none;
            background: #f8f9fa;
            margin-right: 5px;
            border-radius: 10px 10px 0 0;
            color: #6c757d;
        }
        .nav-tabs .nav-link.active {
            background: white;
            color: #495057;
            border-bottom: 3px solid #667eea;
        }
        .contract-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #28a745;
        }
        .file-attachment {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        .contract-id-highlight {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
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
        <div class="row mb-4">
            <div class="col-12">
                <div class="card info-card">
                    <div class="card-header contract-header text-center py-4">
                        {{-- <h2 class="mb-2"><i class="bi bi-file-earmark-text me-2"></i>รายละเอียดสัญญา</h2> --}}
                        <h4 class="mb-0 mb-2">เลขที่สัญญา: {{ $contract->contract_no . '/' . $contract->contract_year }}</h4>
                        <p class="mb-0">{{ $contract->contract_name }}</p>

                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general"
                    type="button" role="tab" aria-controls="nav-general" aria-selected="true">
                    <i class="bi bi-info-circle me-2"></i>{{ __('ข้อมูลทั่วไป') }}
                </button>
                <button class="nav-link" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details"
                    type="button" role="tab" aria-controls="nav-details" aria-selected="false">
                    <i class="bi bi-file-earmark-text me-2"></i>{{ __('รายละเอียดสัญญา') }}
                </button>
                <button class="nav-link" id="nav-guarantee-tab" data-bs-toggle="tab" data-bs-target="#nav-guarantee"
                    type="button" role="tab" aria-controls="nav-guarantee" aria-selected="false">
                    <i class="bi bi-shield-check me-2"></i>{{ __('หลักประกันสัญญา') }}
                </button>
                @if($contract->formFile)
                <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#nav-files"
                    type="button" role="tab" aria-controls="nav-files" aria-selected="false">
                    <i class="bi bi-paperclip me-2"></i>{{ __('ไฟล์แนบ') }}
                </button>
                @endif
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <!-- ข้อมูลทั่วไป -->
            <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th width="250" class="text-muted"><i class="bi bi-hash me-2"></i>เลขที่สัญญา (นตก.)</th>
                                            <td class="fw-bold">{{ $contract->contract_no . '/' . $contract->contract_year }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted"><i class="bi bi-building me-2"></i>หน่วยงานต้นเรื่อง</th>
                                            <td>{{ $contract->department['dep_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted"><i class="bi bi-file-text me-2"></i>ชื่อสัญญา</th>
                                            <td class="fw-bold">{{ $contract->contract_name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted"><i class="bi bi-people me-2"></i>บริษัทคู่สัญญา</th>
                                            <td>{{ $contract->partners }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted"><i class="bi bi-wallet2 me-2"></i>กองทุน</th>
                                            <td>{{ $contract->fund ?: 'ไม่ระบุ' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted"><i class="bi bi-person-check me-2"></i>ผู้ที่ได้รับมอบหมาย</th>
                                            <td>{{ $contract->user['fullname'] ?? 'ไม่ระบุ' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-center">
                                    <h5 class="text-muted mb-2">มูลค่างานตามสัญญา</h5>
                                    <div class="contract-value">
                                        {{ number_format($contract->acquisition_value) }} บาท
                                    </div>
                                    <hr>
                                    <h6 class="text-muted mb-2">สถานะสัญญา</h6>
                                    @php
                                        $statusConfig = [
                                            1 => ['class' => 'bg-secondary', 'text' => 'ร่างสัญญา'],
                                            2 => ['class' => 'bg-info', 'text' => 'เสนอตรวจร่าง'],
                                            3 => ['class' => 'bg-warning', 'text' => 'แจ้งลงนามสัญญา'],
                                            4 => ['class' => 'bg-primary', 'text' => 'เสนอผู้บริหารลงนาม'],
                                            5 => ['class' => 'bg-success', 'text' => 'เสร็จสิ้น(คืนคู่ฉบับ)'],
                                        ];
                                        $status = $statusConfig[$contract->status] ?? ['class' => 'bg-dark', 'text' => 'ไม่ระบุ'];
                                    @endphp
                                    <span class="badge {{ $status['class'] }} contract-status">
                                        {{ $status['text'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- รายละเอียดสัญญา -->
            <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                <div class="card">
                    <div class="card-body p-4">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th width="250" class="text-muted"><i class="bi bi-diagram-3 me-2"></i>ประเภทสัญญา</th>
                                    <td>
                                        @php
                                            $contractTypes = [
                                                1 => 'สัญญาซื้อขาย',
                                                2 => 'สัญญาจ้าง',
                                                3 => 'สัญญาเช่า',
                                                4 => 'สัญญาอนุมัติให้ใช้สิทธิ์',
                                                5 => 'บันทึกข้อตกลง'
                                            ];
                                        @endphp
                                        <span class="badge bg-primary">{{ $contractTypes[$contract->contract_type] ?? 'ไม่ระบุ' }}</span>
                                    </td>
                                </tr>
                                @if ($contract->contract_type === 3 && $contract->contractid)
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-key me-2"></i>Contract ID</th>
                                        <td>
                                            <span class="contract-id-highlight">{{ $contract->contractid }}</span>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th class="text-muted"><i class="bi bi-calendar-event me-2"></i>วันที่ในสัญญา</th>
                                    <td>{{ \Carbon\Carbon::parse($contract->contract_date)->thaidate() }}</td>
                                </tr>
                                @if ($contract->contract_type === 3)
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-calendar-plus me-2"></i>วันเริ่มสัญญา</th>
                                        <td>{{ \Carbon\Carbon::parse($contract->start_date)->thaidate() }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-calendar-x me-2"></i>วันสิ้นสุดสัญญา</th>
                                        <td>{{ \Carbon\Carbon::parse($contract->end_date)->thaidate() }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-clock me-2"></i>ระยะเวลาสัญญา</th>
                                        <td>
                                            @php
                                                $start = \Carbon\Carbon::parse($contract->start_date);
                                                $end = \Carbon\Carbon::parse($contract->end_date);
                                                $diffInDays = $start->diffInDays($end);
                                                $diffInMonths = $start->diffInMonths($end);
                                                $diffInYears = $start->diffInYears($end);
                                            @endphp
                                            <span class="badge bg-info">
                                                @if($diffInYears > 0)
                                                    {{ $diffInYears }} ปี {{ $diffInMonths % 12 }} เดือน
                                                @elseif($diffInMonths > 0)
                                                    {{ $diffInMonths }} เดือน
                                                @else
                                                    {{ $diffInDays }} วัน
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ข้อมูลหลักประกันสัญญา -->
            <div class="tab-pane fade" id="nav-guarantee" role="tabpanel" aria-labelledby="nav-guarantee-tab">
                <div class="card">
                    <div class="card-body p-4">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th width="250" class="text-muted"><i class="bi bi-shield-check me-2"></i>ชนิดหลักประกันสัญญา</th>
                                    <td>
                                        @php
                                            $guaranteeTypes = [
                                                1 => 'หลักประกันที่เป็นเงินสด',
                                                2 => 'หลักประกันที่เป็นหนังสือค้ำประกัน',
                                                3 => 'หลักประกันที่เป็นเช็คธนาคาร',
                                                4 => 'หลักประกันที่เป็นพันธบัตรรัฐบาลไทย'
                                            ];
                                        @endphp
                                        {{ $guaranteeTypes[$contract->types_of_guarantee] ?? 'ไม่ระบุ' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-currency-exchange me-2"></i>มูลค่าหลักประกัน</th>
                                    <td>
                                        <span class="contract-value">{{ number_format($contract->guarantee_amount) }} บาท</span>
                                        @if($contract->acquisition_value > 0)
                                            <br><small class="text-muted">
                                                คิดเป็น {{ number_format(($contract->guarantee_amount / $contract->acquisition_value) * 100, 2) }}%
                                                ของมูลค่างานตามสัญญา
                                            </small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-clock-history me-2"></i>ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา</th>
                                    <td>
                                        @php
                                            $durations = [1 => '1 ปี', 2 => '2 ปี', 3 => '3 ปี', 4 => 'อื่น ๆ'];
                                        @endphp
                                        {{ $durations[$contract->duration] ?? 'ไม่ระบุ' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-arrow-return-left me-2"></i>เงื่อนไขการคืนหลักประกัน</th>
                                    <td>
                                        @php
                                            $conditions = [1 => '3 เดือน', 2 => '6 เดือน', 3 => '1 ปี'];
                                        @endphp
                                        {{ $conditions[$contract->condition] ?? 'ไม่ระบุ' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ไฟล์แนบ -->
            @if($contract->formFile)
            <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="nav-files-tab">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="file-attachment text-center">
                            <i class="bi bi-file-earmark-pdf" style="font-size: 3rem; color: #dc3545;"></i>
                            <h5 class="mt-3">ไฟล์เอกสารสัญญา</h5>
                            <p class="text-muted">{{ $contract->formFile }}</p>
                            <div class="mt-3">
                                <a href="{{ asset('uploads/' . $contract->formFile) }}"
                                   class="btn btn-primary me-2" target="_blank">
                                    <i class="bi bi-eye me-2"></i>ดูไฟล์
                                </a>
                                <a href="{{ asset('uploads/' . $contract->formFile) }}"
                                   class="btn btn-success" download>
                                    <i class="bi bi-download me-2"></i>ดาวน์โหลด
                                </a>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                ไฟล์ PDF • อัปโหลดเมื่อ {{ \Carbon\Carbon::parse($contract->created_at)->thaidate() }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('contracts.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left me-2"></i>กลับหน้ารายการ
                </a>
                @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                    <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-warning me-2">
                        <i class="bi bi-pencil me-2"></i>แก้ไขสัญญา
                    </a>
                    <button class="btn btn-info" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i>พิมพ์รายละเอียด
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection
