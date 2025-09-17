@extends('layouts.app')
@section('title', 'All Contracts')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
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
@stop

@section('content')
    <div class="container-fluid mb-3">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Contracts') }}</li>
            </ol>
        </nav>


    </div>

    <div class="card mb-2">
        <div class="card-header d-flex">
            <div>
                <i class="bi bi-view-list me-2"></i>
                {{ __('รายการสัญญา') }}
            </div>

            @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                <div class="ms-auto">
                    <a href="{{ route('contracts.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-square me-2"></i>
                        {{ __('บันทึกสัญญาใหม่') }}
                    </a>
                </div>
            @endif
        </div>

        {{-- <div class="alert alert-info" role="alert">Sample table page</div> --}}

        <div class="card-body">
            <div class="mb-4">
                <form method="GET" action="{{ route('contracts.index') }}" class="row g-3">
                    @csrf
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">ปีสัญญา</label>
                            <select class="form-select" name="contract_year">
                                <option value="">{{ __('ทั้งหมด') }}</option>
                                @for ($year = $minYear->contract_year; $year <= $maxYear->contract_year; $year++)
                                    <option value="{{ $year }}"
                                        {{ request('contract_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">สถานะ</label>
                            <select class="form-select" name="status">
                                <option value="">ทั้งหมด</option>
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">ค้นหา</label>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="ค้นหาจากเลขที่สัญญา, ชื่อสัญญา, หรือบริษัทคู่สัญญา">
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="bi bi-search me-2"></i>{{ __('ค้นหา') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-nowrap">
                            <i class="bi bi-file-text me-2"></i>{{ __('เลขที่สัญญา') }}
                        </th>
                        <th>
                            <i class="bi bi-card-text me-2"></i>{{ __('ชื่อสัญญา') }}
                        </th>
                        <th class="text-nowrap">
                            <i class="bi bi-building me-2"></i>{{ __('หน่วยงานต้นเรื่อง') }}
                        </th>
                        <th class="text-nowrap">
                            <i class="bi bi-people me-2"></i>{{ __('บริษัทคู่สัญญา') }}
                        </th>
                        <th class="text-nowrap">
                            <i class="bi bi-tags me-2"></i>{{ __('ประเภทสัญญา') }}
                        </th>
                        <th class="text-nowrap">
                            <i class="bi bi-person me-2"></i>{{ __('ผู้ได้รับมอบหมาย') }}
                        </th>
                        <th class="text-center">
                            <i class="bi bi-activity me-2"></i>{{ __('สถานะ') }}
                        </th>
                        @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                            <th class="text-center">
                                <i class="bi bi-gear me-2"></i>{{ __('จัดการ') }}
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($contracts) > 0)
                        @foreach ($contracts as $key => $contract)
                            <tr>
                                <td class="align-top" scope="col">
                                    <a href="{{ route('contracts.show', $contract->id) }}">
                                        {{ $contract->contract_no . '/' . $contract->contract_year }}
                                    </a>
                                </td>
                                <td class="align-top" scope="col">{{ $contract->contract_name }}</td>
                                <td class="text-nowrap align-top" scope="col">{{ $contract->department['dep_name'] }}
                                </td>
                                <td class="align-top" scope="col">{{ $contract->partners }}</td>
                                {{-- <td scope="col">{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</td>
                                <td scope="col">{{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}</td> --}}
                                <td class="align-top" scope="col">
                                    @if ($contract->contract_type === 1)
                                        <span>สัญญาซื้อขาย</span>
                                    @elseif ($contract->contract_type === 2)
                                        <span>สัญญาจ้าง</span>
                                    @elseif ($contract->contract_type === 3)
                                        <span>สัญญาเช่า</span>
                                    @elseif ($contract->contract_type === 4)
                                        <span>สัญญาอนุมัติให้ใช้สิทธิ์</span>
                                    @elseif ($contract->contract_type === 5)
                                        <span>บันทึกข้อตกลง</span>
                                    @endif
                                </td>
                                <td class="align-top" scope="col">{{ $contract->user['fullname'] }}</td>
                                <td class="text-center align-middle" scope="col">
                                    @if ($contract->status === 1)
                                        <span class="badge text-bg-success text-light fw-bold">ร่างสัญญา</span>
                                    @elseif ($contract->status === 2)
                                        <span class="badge text-bg-success text-light fw-bold">เสนอตรวจร่าง</span>
                                    @elseif ($contract->status === 3)
                                        <span class="badge text-bg-success text-light fw-bold">แจ้งลงนามสัญญา</span>
                                    @elseif ($contract->status === 4)
                                        <span class="badge text-bg-success text-light fw-bold">เสนอผู้บริหารลงนาม</span>
                                    @elseif ($contract->status === 5)
                                        <span class="badge text-bg-success text-light fw-bold">เสร็จสิ้น(คืนคู่ฉบับ)</span>
                                    @endif
                                </td>
                                @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('contracts.edit', $contract->id) }}"
                                            class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="แก้ไขข้อมูล">
                                            <i class="bi bi-pencil-square me-1" style="font-size: 0.75rem;"></i>
                                            {{ __('แก้ไข') }}
                                        </a>
                                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this department?')"
                                                data-bs-toggle="tooltip" title="ลบข้อมูล">
                                                <i class="bi bi-trash me-1" style="font-size: 0.75rem;"></i>
                                                {{ __('ลบ') }}
                                            </button>
                                        </form>
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

        <div class="card-footer">
            {{-- {{ $contracts->links() }} --}}
        </div>
    </div>
@endsection
