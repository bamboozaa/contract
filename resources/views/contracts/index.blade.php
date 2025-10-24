@extends('layouts.main')
@section('title', 'รายการสัญญา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style>
        .contract-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contract-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .page-header {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            color: white;
            margin: -1rem -1rem 0rem -1rem;
            padding: 1.5rem;
            border-radius: 0.375rem 0.375rem 0 0;
        }

        .filter-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contract-link {
            color: var(--utcc-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .contract-link:hover {
            color: var(--utcc-dark-gold);
            text-decoration: underline;
        }

        .status-badge {
            font-size: 0.65rem;
            padding: 0.25rem 0.5rem;
        }

        .text-truncate {
            white-space: normal;
            /* อนุญาตให้ข้อความขึ้นบรรทัดใหม่ */
            word-wrap: break-word;
            /* ตัดข้อความเมื่อเกินความกว้าง */
            overflow: visible;
            /* ซ่อนข้อความที่เกิน */
            text-overflow: ellipsis;
            /* เพิ่ม ... เมื่อข้อความถูกตัด */
            font-size: 0.8rem;
            /* ปรับขนาดฟอนต์ */
        }

        /* ปรับขนาดตัวอักษรใน thead */
        .table thead th {
            font-size: 0.8rem;
            font-weight: 600;
            color: #495057;
            padding: 0.6rem 0.4rem;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .table thead th i {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        /* ปรับขนาดตัวอักษรใน tbody */
        .table tbody td {
            font-size: 0.8rem;
            padding: 0.6rem 0.4rem;
            vertical-align: top;
        }

        /* ปรับขนาดตัวอักษรใน small elements */
        .table tbody td small {
            font-size: 0.75rem; /* เล็กลงอีก */
        }

        /* ปรับขนาดตัวอักษรสำหรับลิงก์สัญญา */
        .contract-link {
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table thead th {
                font-size: 0.75rem;
                padding: 0.5rem 0.3rem;
            }

            .table thead th i {
                font-size: 0.7rem;
            }

            .table tbody td {
                font-size: 0.75rem;
                padding: 0.5rem 0.3rem;
            }

            .status-badge {
                font-size: 0.6rem;
                padding: 0.2rem 0.4rem;
            }
        }

        @media (max-width: 576px) {
            .table thead th {
                font-size: 0.7rem;
                padding: 0.4rem 0.2rem;
            }

            .table thead th i {
                font-size: 0.65rem;
            }

            .table tbody td {
                font-size: 0.7rem;
                padding: 0.4rem 0.2rem;
            }

            .status-badge {
                font-size: 0.55rem;
                padding: 0.15rem 0.3rem;
            }
        }
    </style>
@stop

@section('importjs')
    @parent
    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.delete-form');
                    const contractId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: `คุณต้องการลบสัญญานี้หรือไม่?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ใช่, ลบเลย!',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // ส่งฟอร์มเมื่อผู้ใช้ยืนยัน
                        }
                    });
                });
            });
        });
    </script>
@stop

@section('content')
    <!-- แจ้งเตือน -->
    {{-- @if (session('warning'))
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
        </div>
    @endif --}}

    <!-- Page Header -->
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
                            <i class="bi bi-file-earmark-text me-1"></i>{{ __('จัดการสัญญา') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="contract-card card">
        <!-- Card Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">
                        <i class="bi bi-file-earmark-text me-2"></i>{{ __('รายการสัญญาทั้งหมด') }}
                    </h4>
                    <p class="mb-0 opacity-75">จัดการและติดตามสถานะสัญญาต่าง ๆ</p>
                </div>
                @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                    <a href="{{ route('contracts.create') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>
                        {{ __('สร้างสัญญาใหม่') }}
                    </a>
                @endif
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card-body">
            <div class="filter-card card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('contracts.index') }}" class="row g-3 align-items-end">
                        @csrf
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-calendar-event me-2"></i>ปีสัญญา
                            </label>
                            <select class="form-select" name="contract_year" onchange="this.form.submit()">
                                <option value="">{{ __('ทั้งหมด') }}</option>
                                @for ($year = $minYear->contract_year; $year <= $maxYear->contract_year; $year++)
                                    <option value="{{ $year }}"
                                        {{ request('contract_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-activity me-2"></i>สถานะสัญญา
                            </label>
                            <select class="form-select" name="status" onchange="this.form.submit()">
                                <option value="">{{ __('ทั้งหมด') }}</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>ร่างสัญญา</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>เสนอตรวจร่าง
                                </option>
                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>แจ้งลงนามสัญญา
                                </option>
                                <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>เสนอผู้บริหารลงนาม
                                </option>
                                <option value="5" {{ request('status') == '5' ? 'selected' : '' }}>
                                    เสร็จสิ้น(คืนคู่ฉบับ)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-tags me-2"></i>ประเภทสัญญา
                            </label>
                            <select class="form-select" name="contract_type" onchange="this.form.submit()">
                                <option value="">{{ __('ทั้งหมด') }}</option>
                                <option value="1" {{ request('contract_type') == '1' ? 'selected' : '' }}>สัญญาซื้อขาย
                                </option>
                                <option value="2" {{ request('contract_type') == '2' ? 'selected' : '' }}>สัญญาจ้าง
                                </option>
                                <option value="3" {{ request('contract_type') == '3' ? 'selected' : '' }}>สัญญาเช่า
                                </option>
                                <option value="4" {{ request('contract_type') == '4' ? 'selected' : '' }}>
                                    สัญญาอนุมัติให้ใช้สิทธิ์</option>
                                <option value="5" {{ request('contract_type') == '5' ? 'selected' : '' }}>
                                    บันทึกข้อตกลง</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-building me-2"></i>หน่วยงาน
                            </label>
                            <select class="form-select" name="department_id" onchange="this.form.submit()">
                                <option value="">{{ __('ทั้งหมด') }}</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->dep_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ปุ่มค้นหาถูกลบออกเพื่อให้ filter ทำงานอัตโนมัติ --}}
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="bi bi-search me-2"></i>{{ __('ค้นหา') }}
                                </button>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-5 text-end">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                พบสัญญาทั้งหมด {{ count($contracts) }} รายการ
                            </small>
                        </div> --}}
                    </form>
                </div>
            </div>

            <!-- Table Responsive -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10%;">
                                <i class="bi bi-hash me-2"></i>{{ __('เลขที่สัญญา') }}
                            </th>
                            <th style="width: 22%;">
                                <i class="bi bi-file-text me-2"></i>{{ __('ชื่อสัญญา') }}
                            </th>
                            <th style="width: 12%;">
                                <i class="bi bi-building me-2"></i>{{ __('หน่วยงาน') }}
                            </th>
                            <th style="width: 12%;">
                                <i class="bi bi-people me-2"></i>{{ __('คู่สัญญา') }}
                            </th>
                            <th style="width: 10%;">
                                <i class="bi bi-tags me-2"></i>{{ __('ประเภท') }}
                            </th>
                            <th style="width: 10%;">
                                <i class="bi bi-calendar-x me-2"></i>{{ __('วันหมดสัญญา') }}
                            </th>
                            <th style="width: 10%;">
                                <i class="bi bi-activity me-2"></i>{{ __('สถานะ') }}
                            </th>
                            <th style="width: 5%;" class="text-center">
                                <i class="bi bi-paperclip" title="ไฟล์แนบ"></i>
                            </th>
                            @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                                <th style="width: 12%;" class="text-center">
                                    <i class="bi bi-gear me-2"></i>{{ __('จัดการ') }}
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($contracts) > 0)
                            @foreach ($contracts as $key => $contract)
                                @php
                                    $today = \Carbon\Carbon::now();
                                    $endDate = null;
                                    $daysLeft = 0;
                                    $isExpired = false;
                                    $isExpiring = false;

                                    // ตรวจสอบว่า end_date มีค่าและไม่เป็น null
                                    if (!empty($contract->end_date)) {
                                        try {
                                            $endDate = \Carbon\Carbon::parse($contract->end_date);
                                            $daysLeft = $today->diffInDays($endDate);
                                            $isExpired = $endDate->lt($today);
                                            $isExpiring = $endDate->between($today, $today->copy()->addDays(30));
                                        } catch (\Exception $e) {
                                            // หาก parse ไม่ได้ ให้ตั้งค่าเป็น null
                                            $endDate = null;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('contracts.show', $contract->id) }}"
                                            class="contract-link fw-semibold">
                                            {{ $contract->contract_no }}/{{ $contract->contract_year }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="" title="{{ $contract->contract_name }}">
                                            {{ $contract->contract_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-mute">{{ $contract->department['dep_name'] }}</small>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;"
                                            title="{{ $contract->partners }}">
                                            <small class="text-mute">{{ $contract->partners }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            @if ($contract->contract_type === 1)
                                                <span class="badge bg-primary status-badge">สัญญาซื้อขาย</span>
                                            @elseif ($contract->contract_type === 2)
                                                <span class="badge bg-info status-badge">สัญญาจ้าง</span>
                                            @elseif ($contract->contract_type === 3)
                                                <span class="badge bg-warning status-badge">สัญญาเช่า</span>
                                                @if($contract->contractid)
                                                    <small class="text-muted mt-1" style="font-size: 0.7rem;">ID: {{ $contract->contractid }}</small>
                                                @endif
                                            @elseif ($contract->contract_type === 4)
                                                <span class="badge bg-secondary status-badge">สัญญาอนุมัติให้ใช้สิทธิ์</span>
                                            @elseif ($contract->contract_type === 5)
                                                <span class="badge bg-dark status-badge">บันทึกข้อตกลง</span>
                                                @if($contract->contractid)
                                                    <small class="text-muted mt-1" style="font-size: 0.7rem;">ID: {{ $contract->contractid }}</small>
                                                @endif
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        @if ($endDate)
                                            <div class="d-flex flex-column">
                                                <small
                                                    class="fw-semibold
                                                @if ($isExpired) text-danger
                                                @elseif ($isExpiring) text-warning
                                                @else text-success @endif" style="font-size: 0.75rem;">
                                                    {{ $endDate->format('d/m/') . ($endDate->year + 543) }}
                                                </small>
                                                {{-- @if ($isExpired)
                                                    <span class="badge bg-danger status-badge mt-1" style="font-size: 0.6rem;">
                                                        <i class="bi bi-x-circle me-1" style="font-size: 0.55rem;"></i>หมดอายุแล้ว
                                                    </span>
                                                @elseif ($isExpiring)
                                                    <span class="badge bg-warning status-badge mt-1" style="font-size: 0.6rem;">
                                                        <i class="bi bi-exclamation-triangle me-1" style="font-size: 0.55rem;"></i>เหลือ
                                                        {{ $daysLeft }} วัน
                                                    </span>
                                                @else
                                                    <span class="badge bg-success status-badge mt-1" style="font-size: 0.6rem;">
                                                        <i class="bi bi-check-circle me-1" style="font-size: 0.55rem;"></i>ยังใช้งานได้
                                                    </span>
                                                @endif --}}
                                            </div>
                                        @else
                                            <div class="d-flex flex-column">
                                                <small class="text-muted" style="font-size: 0.75rem;">ไม่ระบุ</small>
                                                {{-- <span class="badge bg-secondary status-badge mt-1" style="font-size: 0.6rem;">
                                                    <i class="bi bi-question-circle me-1" style="font-size: 0.55rem;"></i>ไม่ทราบ
                                                </span> --}}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($contract->status === 1)
                                            <span class="badge bg-light text-dark status-badge">ร่างสัญญา</span>
                                        @elseif ($contract->status === 2)
                                            <span class="badge bg-info status-badge">เสนอตรวจร่าง</span>
                                        @elseif ($contract->status === 3)
                                            <span class="badge bg-warning status-badge">แจ้งลงนามสัญญา</span>
                                        @elseif ($contract->status === 4)
                                            <span class="badge bg-primary status-badge">เสนอผู้บริหารลงนาม</span>
                                        @elseif ($contract->status === 5)
                                            <span class="badge bg-success status-badge">เสร็จสิ้น(คืนคู่ฉบับ)</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($contract->formFile)
                                            <i class="bi bi-paperclip text-muted" title="มีไฟล์แนบ"></i>
                                        @endif
                                    </td>
                                    @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('contracts.edit', $contract->id) }}{{ request()->except('page') ? '?' . http_build_query(request()->except('page')) : '' }}"
                                                    class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip"
                                                    title="แก้ไขข้อมูล">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('contracts.destroy', $contract->id) }}"
                                                    method="POST" class="d-inline delete-form ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm delete-btn"
                                                        data-id="{{ $contract->id }}" data-bs-toggle="tooltip"
                                                        title="ลบข้อมูล">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">{{ __('ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้') }}</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-light">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        หน้า {{ $contracts->currentPage() }} จาก {{ $contracts->lastPage() }}
                        ({{ $contracts->total() }} รายการทั้งหมด)
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    @if ($contracts->hasPages())
                        <div class="d-flex justify-content-end">
                            {{ $contracts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
