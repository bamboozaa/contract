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
    <div class="container-fluid mb-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Contracts') }}</li>
            </ol>
        </nav>


    </div>

    <div class="card mb-4">
        <div class="card-header d-flex">
            <div>
                <i class="bi bi-view-list"></i>
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
            <div class="ms-auto mb-4">
                <form method="GET" action="{{ route('contracts.index') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">

                        <select class = "form-select rounded shadow w-auto me-3" name="contract_year">
                            <option value="">{{ __('--- กรุณาเลือก ปี ---') }}</option>
                            @for ($year = $minYear->contract_year; $year <= $maxYear->contract_year; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                        <button class="btn btn-primary border-0 mb-1 rounded shadow"
                            type="submit">{{ __('ค้นหา') }}</button>
                    </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('เลขที่สัญญา (นตก.)') }}</th>
                        <th scope="col">{{ __('ชื่อสัญญา') }}</th>
                        <th scope="col">{{ __('หน่วยงานต้นเรื่อง') }}</th>
                        <th scope="col">{{ __('บริษัทคู่สัญญา	') }}</th>
                        {{-- <th scope="col">{{ __('วันเริ่มต้นสัญญา') }}</th>
                        <th scope="col">{{ __('วันสิ้นสุดสัญญา') }}</th> --}}
                        <th scope="col">{{ __('ประเภทสัญญา') }}</th>
                        <th scope="col">{{ __('ผู้ได้รับมอบหมาย') }}</th>
                        <th class="text-center" scope="col">{{ __('สถานะ') }}</th>
                        @if (\Illuminate\Support\Facades\Auth::user()->role === 1)
                            <th class="text-center" scope="col">{{ __('จัดการ') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($contracts) > 0)
                        @foreach ($contracts as $key => $contract)
                            <tr>
                                <td class="align-middle" scope="col">
                                    <a href="{{ route('contracts.show', $contract->id) }}">
                                        {{ $contract->contract_no . '/' . $contract->contract_year }}
                                    </a>
                                </td>
                                <td class="align-middle" scope="col">{{ $contract->contract_name }}</td>
                                <td class="align-middle" scope="col">{{ $contract->department['dep_name'] }}</td>
                                <td class="align-middle" scope="col">{{ $contract->partners }}</td>
                                {{-- <td scope="col">{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</td>
                                <td scope="col">{{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}</td> --}}
                                <td class="align-middle" scope="col">
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
                                <td class="align-middle" scope="col">{{ $contract->user['fullname'] }}</td>
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
                                            <i class="bi bi-pencil-square fs-sm me-1 text-white"></i>
                                            {{-- {{ __('แก้ไข') }} --}}
                                        </a>
                                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this department?')"
                                                data-bs-toggle="tooltip" title="ลบข้อมูล">
                                                <i class="bi bi-trash fs-sm me-1 text-white"></i>
                                                {{-- {{ __('ลบ') }} --}}
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
            {{ $contracts->links() }}
        </div>
    </div>
@endsection
