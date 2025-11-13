@extends('layouts.main')

@section('title', 'สัญญา MOU')

@section('importcss')
<style>
    .mou-table th, .mou-table td { vertical-align: middle; }
    .mou-col-no { width: 140px; font-weight: 600; }
    .mou-col-item { min-width: 200px; max-width: 400px; }
    .mou-col-date { width: 180px; text-align: left; }
    .mou-col-dep { width: 200px; }
    .mou-col-type { width: 120px; text-align: center; }
    /* Department text smaller */
    .mou-dep { font-size: 0.9rem; line-height: 1.2; }
    /* Date text: keep in one line and slightly smaller */
    .mou-date { white-space: nowrap !important; font-size: 0.9rem; line-height: 1.1; }
    .text-ellipsis-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }
    .status-dot {
        display: inline-block;
        width: .6rem; height: .6rem;
        border-radius: 50%;
        margin-right: .4rem;
        vertical-align: middle;
    }

    /* Responsive table - wrap text instead of horizontal scroll */
    .table-responsive {
        overflow-x: visible !important;
    }

    @media (max-width: 1400px) {
        .mou-col-item { min-width: 180px; max-width: 300px; }
        .mou-col-dep { width: 180px; }
    }

    @media (max-width: 1200px) {
        .mou-col-no { width: 100px; font-size: 0.9rem; }
        .mou-col-item { min-width: 150px; max-width: 250px; font-size: 0.9rem; }
        .mou-col-type { width: 100px; font-size: 0.9rem; }
        .mou-col-date { width: 140px; font-size: 0.9rem; }
        .mou-col-dep { width: 150px; font-size: 0.9rem; }
        .mou-date { font-size: 0.85rem; }
        .mou-dep { font-size: 0.85rem; }
    }

    @media (max-width: 991.98px) {
        .mou-table { font-size: 0.85rem; }
        .mou-col-no { width: 90px; }
        .mou-col-item { min-width: 120px; max-width: 200px; }
        .mou-col-type { width: 80px; }
        .mou-col-date { width: 120px; }
        .mou-col-dep { width: 130px; }
        .mou-date { font-size: 0.8rem; }
        .mou-dep { font-size: 0.8rem; }
    }

    @media (max-width: 768px) {
        .mou-table { font-size: 0.8rem; }
        .mou-col-no { width: 80px; }
        .mou-col-item { min-width: 100px; max-width: 150px; }
        .mou-col-type { width: 70px; }
        .mou-col-date { width: 110px; white-space: normal !important; }
        .mou-col-dep { width: 100px; white-space: normal !important; }
        .text-ellipsis-2 { -webkit-line-clamp: 3; }
        .mou-date { font-size: 0.78rem; }
        .mou-dep { font-size: 0.78rem; }
    }
</style>
@endsection

@section('importjs')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('mou-search-form');
    const input = document.getElementById('mou-search-input');
    if (!form || !input) return;

    // โฟกัสกลับไปที่ช่องค้นหาและวางเคอร์เซอร์ไว้ท้ายข้อความเสมอ
    const focusEnd = (el) => {
        const len = el.value.length;
        if (el.focus) el.focus({ preventScroll: true });
        try { el.setSelectionRange(len, len); } catch (e) { /* ignore */ }
    };
    focusEnd(input);

    let t;
    let isComposing = false; // รองรับการพิมพ์ภาษาไทย/IME ไม่ให้ส่งฟอร์มระหว่างประกอบตัวอักษร
    const debounceMs = 800; // เวลาหน่วงก่อนค้นหาอัตโนมัติ
    const submitNow = () => {
        // ล้างพารามิเตอร์ page เพื่อเริ่มที่หน้าแรกใหม่
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
        if (isComposing) return; // ยังพิมพ์ภาษาไทยอยู่
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

    // Year filter change -> search immediately
    const yearSel = document.getElementById('mou-filter-year');
    if (yearSel) {
        yearSel.addEventListener('change', function () {
            const pageInput = form.querySelector('input[name="page"]');
            if (pageInput) pageInput.remove();
            if (form.requestSubmit) form.requestSubmit(); else form.submit();
        });
    }

    // Status filter change -> search immediately
    const statusSel = document.getElementById('mou-filter-status');
    if (statusSel) {
        statusSel.addEventListener('change', function () {
            const pageInput = form.querySelector('input[name="page"]');
            if (pageInput) pageInput.remove();
            if (form.requestSubmit) form.requestSubmit(); else form.submit();
        });
    }

    // Type filter change -> search immediately
    const typeSel = document.getElementById('mou-filter-type');
    if (typeSel) {
        typeSel.addEventListener('change', function () {
            const pageInput = form.querySelector('input[name="page"]');
            if (pageInput) pageInput.remove();
            if (form.requestSubmit) form.requestSubmit(); else form.submit();
        });
    }

    // Department filter change -> search immediately
    const deptSel = document.getElementById('mou-filter-department');
    if (deptSel) {
        deptSel.addEventListener('change', function () {
            const pageInput = form.querySelector('input[name="page"]');
            if (pageInput) pageInput.remove();
            if (form.requestSubmit) form.requestSubmit(); else form.submit();
        });
    }
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
                    <li class="breadcrumb-item active" aria-current="page">สัญญา MOU <span class="badge bg-danger align-middle ms-2" title="จำนวนรายการทั้งหมด">{{ number_format($mous->total()) }}</span></li>
                </ol>
            </nav>
            <h2 class="mb-0">รายการสัญญา MOU</h2>
        </div>

        <form id="mou-search-form" action="{{ route('mou.index') }}" method="get" class="d-flex flex-column gap-2" role="search" style="min-width: 300px;">
            <input id="mou-search-input" type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="ค้นหาเรื่อง/คำสำคัญ">
            <div class="d-flex gap-2 flex-wrap">
                <select name="year" id="mou-filter-year" class="form-select" style="flex: 1; min-width: 120px;">
                    <option value="">ทุกปี</option>
                    @foreach(($years ?? []) as $y)
                        <option value="{{ $y }}" {{ (string)$y === (string)request('year') ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
                <select name="type" id="mou-filter-type" class="form-select" style="flex: 1; min-width: 120px;">
                    <option value="">ทุกประเภท</option>
                    @foreach(($types ?? []) as $t)
                        <option value="{{ $t->type_id }}" {{ (string)$t->type_id === (string)request('type') ? 'selected' : '' }}>{{ $t->type_name }}</option>
                    @endforeach
                </select>
                <select name="department" id="mou-filter-department" class="form-select" style="flex: 1; min-width: 150px;">
                    <option value="">ทุกหน่วยงาน</option>
                    @foreach(($departments ?? []) as $d)
                        <option value="{{ $d->dep_id }}" {{ (string)$d->dep_id === (string)request('department') ? 'selected' : '' }}>{{ $d->dep_name }}</option>
                    @endforeach
                </select>
                <select name="status" id="mou-filter-status" class="form-select" style="flex: 1; min-width: 160px;">
                    <option value="">ทุกสถานะ</option>
                    <option value="active" {{ request('status')==='active' ? 'selected' : '' }}>ยังไม่หมดอายุ</option>
                    <option value="soon" {{ request('status')==='soon' ? 'selected' : '' }}>กำลังหมดอายุ 60 วัน</option>
                    <option value="expired" {{ request('status')==='expired' ? 'selected' : '' }}>หมดอายุแล้ว</option>
                    <option value="no_limit" {{ request('status')==='no_limit' ? 'selected' : '' }}>ไม่มีกำหนด</option>
                </select>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 mou-table">
                    <thead class="table-light">
                        <tr>
                            <th class="mou-col-no">เลขที่</th>
                            <th class="mou-col-item">เรื่อง</th>
                            <th class="mou-col-type">ประเภท</th>
                            <th class="mou-col-date">วันที่ประกาศ</th>
                            <th class="mou-col-date">วันหมดอายุ</th>
                            <th class="mou-col-dep">หน่วยงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mous as $row)
                            <tr>
                                <td class="mou-col-no">{{ sprintf('%02d', (int)$row->ann_no) }}/{{ $row->ann_year }}</td>
                                <td class="mou-col-item"><span class="text-ellipsis-2" title="{{ $row->ann_item }}">{{ $row->ann_item }}</span></td>
                                <td class="mou-col-type">{{ $row->type_name ?? '-' }}</td>
                                    <td class="mou-col-date">
                                        @if ($row->ann_date && $row->ann_date !== '0000-00-00')
                                            @php
                                                $d = \Carbon\Carbon::parse($row->ann_date)->setTimezone('Asia/Bangkok')->locale('th');
                                                $thaiDate = $d->translatedFormat('j F') . ' ' . ($d->year + 543);
                                            @endphp
                                            <span class="mou-date">{{ $thaiDate }}</span>
                                        @else
                                            <span class="mou-date">-</span>
                                        @endif
                                    </td>
                                    <td class="mou-col-date">
                                        @if ($row->ann_exp && $row->ann_exp !== '0000-00-00')
                                            @php
                                                $d = \Carbon\Carbon::parse($row->ann_exp)->setTimezone('Asia/Bangkok')->locale('th');
                                                $thaiDate = $d->translatedFormat('j F') . ' ' . ($d->year + 543);
                                                $today = \Carbon\Carbon::now('Asia/Bangkok')->startOfDay();
                                                $diffDays = $today->diffInDays($d->copy()->startOfDay(), false); // < 0 = expired
                                                $soonDays = (int) env('MOU_EXP_SOON_DAYS', 60);
                                            @endphp
                                            <span class="mou-date">
                                                @if ($diffDays < 0)
                                                    <span class="status-dot bg-danger"></span>
                                                @elseif ($diffDays <= $soonDays)
                                                    <span class="status-dot bg-warning"></span>
                                                @else
                                                    <span class="status-dot bg-success"></span>
                                                @endif
                                                {{ $thaiDate }}
                                            </span>
                                        @else
                                            <span class="mou-date text-muted">ไม่มีกำหนด</span>
                                        @endif
                                    </td>
                                <td class="mou-col-dep"><span class="mou-dep">{{ $row->dep_name ?? '-' }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">ไม่พบข้อมูล</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($mous->hasPages())
            <div class="card-footer">
                {{ $mous->links() }}
            </div>
        @endif
    </div>

    {{-- <div class="form-text mt-2">
        แหล่งข้อมูล: ฐานข้อมูล db_oadoc (เชื่อมต่อผ่าน mysql2)
    </div> --}}
</div>
@endsection
