@extends('layouts.main')

@section('title', 'เงินหลักประกันสัญญา')

@section('importcss')
<style>
    .guarantee-table th, .guarantee-table td { vertical-align: middle; }
    .guarantee-col-no { width: 140px; font-weight: 600; }
    .guarantee-col-name { min-width: 200px; max-width: 400px; }
    .guarantee-col-partner { min-width: 150px; max-width: 300px; }
    .guarantee-col-type { width: 150px; text-align: center; }
    .guarantee-col-amount { width: 150px; text-align: right; }
    .guarantee-col-duration { width: 120px; text-align: center; }
    .guarantee-col-condition { width: 150px; }
    .guarantee-col-dep { width: 180px; }

    .text-ellipsis-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }

    .guarantee-amount {
        font-weight: 600;
        color: #0d6efd;
    }

    /* Responsive table */
    .table-responsive {
        overflow-x: visible !important;
    }

    @media (max-width: 1400px) {
        .guarantee-col-name { min-width: 180px; max-width: 300px; }
        .guarantee-col-partner { min-width: 120px; max-width: 250px; }
    }

    @media (max-width: 1200px) {
        .guarantee-table { font-size: 0.9rem; }
        .guarantee-col-no { width: 100px; }
        .guarantee-col-name { min-width: 150px; max-width: 250px; }
        .guarantee-col-partner { min-width: 100px; max-width: 200px; }
        .guarantee-col-amount { width: 130px; }
    }

    @media (max-width: 991.98px) {
        .guarantee-table { font-size: 0.85rem; }
        .guarantee-col-no { width: 90px; }
        .guarantee-col-amount { width: 120px; }
    }

    @media (max-width: 768px) {
        .guarantee-table { font-size: 0.8rem; }
        .guarantee-col-no { width: 80px; }
        .guarantee-col-name, .guarantee-col-partner, .guarantee-col-dep {
            white-space: normal !important;
        }
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .stats-value {
        font-size: 1.5rem;
        font-weight: 700;
    }
</style>
@endsection

@section('importjs')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('guarantee-search-form');
    const input = document.getElementById('guarantee-search-input');
    if (!form || !input) return;

    const focusEnd = (el) => {
        const len = el.value.length;
        if (el.focus) el.focus({ preventScroll: true });
        try { el.setSelectionRange(len, len); } catch (e) { /* ignore */ }
    };
    focusEnd(input);

    let t;
    let isComposing = false;
    const debounceMs = 800;
    const submitNow = () => {
        const pageInput = form.querySelector('input[name="page"]');
        if (pageInput) pageInput.remove();
        if (form.requestSubmit) form.requestSubmit(); else form.submit();
    };

    input.addEventListener('compositionstart', function () { isComposing = true; });
    input.addEventListener('compositionend', function () {
        isComposing = false;
        clearTimeout(t);
        t = setTimeout(submitNow, debounceMs);
    });

    input.addEventListener('input', function () {
        if (isComposing) return;
        clearTimeout(t);
        t = setTimeout(submitNow, debounceMs);
    });

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(t);
            submitNow();
        }
    });

    // Auto-submit on filter change
    ['year', 'type', 'department', 'condition', 'return-status'].forEach(filterId => {
        const filterEl = document.getElementById('guarantee-filter-' + filterId);
        if (filterEl) {
            filterEl.addEventListener('change', function () {
                const pageInput = form.querySelector('input[name="page"]');
                if (pageInput) pageInput.remove();
                if (form.requestSubmit) form.requestSubmit(); else form.submit();
            });
        }
    });
});
</script>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap gap-3 align-items-start justify-content-between mb-3">
        <div>
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">เงินหลักประกันสัญญา <span class="badge bg-danger align-middle ms-2" title="จำนวนรายการทั้งหมด">{{ number_format($guarantees->total()) }}</span></li>
                </ol>
            </nav>
            <h2 class="mb-0">เงินหลักประกันสัญญา</h2>
        </div>

        <form id="guarantee-search-form" action="{{ route('guarantee.index') }}" method="get" class="d-flex flex-column gap-2" role="search" style="min-width: 300px;">
            <input id="guarantee-search-input" type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="ค้นหาเลขที่/ชื่อสัญญา/คู่สัญญา">
            <div class="d-flex gap-2 flex-wrap">
                <select name="year" id="guarantee-filter-year" class="form-select" style="flex: 1; min-width: 100px;">
                    <option value="">ทุกปี</option>
                    @foreach(($years ?? []) as $y)
                        <option value="{{ $y }}" {{ (string)$y === (string)request('year') ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
                <select name="type" id="guarantee-filter-type" class="form-select" style="flex: 1; min-width: 120px;">
                    <option value="">ทุกชนิด</option>
                    <option value="1" {{ request('type')==='1' ? 'selected' : '' }}>เช็คธนาคาร</option>
                    <option value="2" {{ request('type')==='2' ? 'selected' : '' }}>หนังสือค้ำประกัน</option>
                    <option value="3" {{ request('type')==='3' ? 'selected' : '' }}>เงินสด</option>
                </select>
                <select name="department" id="guarantee-filter-department" class="form-select" style="flex: 1; min-width: 150px;">
                    <option value="">ทุกหน่วยงาน</option>
                    @foreach(($departments ?? []) as $d)
                        <option value="{{ $d->id }}" {{ (string)$d->id === (string)request('department') ? 'selected' : '' }}>{{ $d->dep_name }}</option>
                    @endforeach
                </select>
                <select name="condition" id="guarantee-filter-condition" class="form-select" style="flex: 1; min-width: 140px;">
                    <option value="">ทุกเงื่อนไข</option>
                    <option value="1" {{ request('condition')==='1' ? 'selected' : '' }}>คืนเมื่อสิ้นสุด</option>
                    <option value="2" {{ request('condition')==='2' ? 'selected' : '' }}>ไม่คืน</option>
                </select>
            </div>
            <div class="d-flex gap-2 flex-wrap mt-2">
                <select name="return_status" id="guarantee-filter-return-status" class="form-select" style="flex: 1; min-width: 180px;">
                    <option value="">สถานะการคืน: ทั้งหมด</option>
                    <option value="overdue" {{ request('return_status')==='overdue' ? 'selected' : '' }}>🔴 เกินกำหนดคืนแล้ว</option>
                    <option value="due_soon" {{ request('return_status')==='due_soon' ? 'selected' : '' }}>🟡 ใกล้ถึงกำหนดคืน 90 วัน</option>
                    <option value="active" {{ request('return_status')==='active' ? 'selected' : '' }}>🟢 ยังไม่ถึงกำหนดคืน</option>
                </select>
            </div>
        </form>
    </div>

    <!-- สถิติ -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">มูลค่าหลักประกันทั้งหมด</div>
                        <div class="stats-value">{{ number_format($totalAmount ?? 0, 2) }} บาท</div>
                    </div>
                    <i class="bi bi-cash-stack" style="font-size: 3rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">จำนวนสัญญาที่มีหลักประกัน</div>
                        <div class="stats-value">{{ number_format($totalCount ?? 0) }} สัญญา</div>
                    </div>
                    <i class="bi bi-file-earmark-text" style="font-size: 3rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">เกินกำหนดคืน / ใกล้กำหนด</div>
                        <div class="stats-value">{{ number_format($overdueCount ?? 0) }} / {{ number_format($dueSoonCount ?? 0) }}</div>
                    </div>
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 guarantee-table">
                    <thead class="table-light">
                        <tr>
                            <th class="guarantee-col-no">เลขที่สัญญา</th>
                            <th class="guarantee-col-name">ชื่อสัญญา</th>
                            <th class="guarantee-col-partner">คู่สัญญา</th>
                            <th class="guarantee-col-type">ชนิดหลักประกัน</th>
                            <th class="guarantee-col-amount">มูลค่าหลักประกัน</th>
                            <th class="guarantee-col-duration">ระยะเวลา</th>
                            <th class="guarantee-col-condition">วันที่ต้องคืน</th>
                            <th class="guarantee-col-condition">สถานะการคืน</th>
                            <th class="guarantee-col-dep">หน่วยงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guarantees as $row)
                            <tr>
                                <td class="guarantee-col-no">
                                    <a href="{{ route('contracts.show', $row->id) }}" class="text-decoration-none fw-bold" title="ดูรายละเอียดสัญญา">
                                        {{ $row->contract_no }}/{{ $row->contract_year }}
                                    </a>
                                </td>
                                <td class="guarantee-col-name">
                                    <span class="text-ellipsis-2" title="{{ $row->contract_name }}">{{ $row->contract_name }}</span>
                                </td>
                                <td class="guarantee-col-partner">
                                    <span class="text-ellipsis-2" title="{{ $row->partners }}">{{ $row->partners }}</span>
                                </td>
                                <td class="guarantee-col-type">
                                    @if($row->types_of_guarantee == 1)
                                        <span class="badge bg-info">เช็คธนาคาร</span>
                                    @elseif($row->types_of_guarantee == 2)
                                        <span class="badge bg-warning text-dark">หนังสือค้ำประกัน</span>
                                    @elseif($row->types_of_guarantee == 3)
                                        <span class="badge bg-success">เงินสด</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="guarantee-col-amount">
                                    <span class="guarantee-amount">{{ number_format($row->guarantee_amount ?? 0, 2) }}</span> บาท
                                </td>
                                <td class="guarantee-col-duration text-center">
                                    @if($row->duration)
                                        {{ $row->duration }} ปี
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="guarantee-col-condition">
                                    @if($row->duration && $row->condition != 2)
                                        @php
                                            // ใช้ contract_date (ทุกสัญญามี contract_date)
                                            $baseDate = $row->contract_date ? \Carbon\Carbon::parse($row->contract_date) : null;
                                            if ($baseDate) {
                                                try {
                                                    $returnDate = \App\Helpers\BusinessDayCalculator::addBusinessYears($baseDate, $row->duration);
                                                    $thaiReturnDate = $returnDate->locale('th')->translatedFormat('j M') . ' ' . ($returnDate->year + 543);
                                                } catch (\Exception $e) {
                                                    $thaiReturnDate = null;
                                                }
                                            }
                                        @endphp
                                        @if(isset($thaiReturnDate))
                                            <small>{{ $thaiReturnDate }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    @elseif($row->condition == 2)
                                        <span class="text-muted small">ไม่ต้องคืน</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="guarantee-col-condition">
                                    @if($row->duration && $row->condition != 2)
                                        @php
                                            $today = \Carbon\Carbon::now();
                                            $baseDate = $row->contract_date ? \Carbon\Carbon::parse($row->contract_date) : null;
                                            if ($baseDate) {
                                                try {
                                                    $returnDate = \App\Helpers\BusinessDayCalculator::addBusinessYears($baseDate, $row->duration);
                                                    $daysUntilReturn = $today->diffInDays($returnDate, false);
                                                } catch (\Exception $e) {
                                                    $daysUntilReturn = null;
                                                }
                                            }
                                        @endphp
                                        @if(isset($daysUntilReturn))
                                            @if($daysUntilReturn < 0)
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-exclamation-circle-fill"></i> เกินกำหนด {{ abs($daysUntilReturn) }} วัน
                                                </span>
                                            @elseif($daysUntilReturn <= 90)
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-clock-fill"></i> อีก {{ $daysUntilReturn }} วัน
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle-fill"></i> ปกติ
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    @elseif($row->condition == 2)
                                        <span class="badge bg-secondary">ไม่ต้องคืน</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="guarantee-col-dep">{{ $row->department->dep_name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">ไม่พบข้อมูล</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($guarantees->hasPages())
            <div class="card-footer">
                {{ $guarantees->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
