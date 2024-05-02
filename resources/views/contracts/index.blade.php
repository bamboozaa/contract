@extends('layouts.app')
@section('title', 'All Contracts')

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
        <div class="card-header" style="display: flex;">
            <div>
                {{ __('Contract') }}
            </div>
            <div class="ms-auto">
                <a href="{{ route('contracts.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-square me-2"></i>
                    {{ __('Create New') }}
                </a>
            </div>
        </div>

        {{-- <div class="alert alert-info" role="alert">Sample table page</div> --}}

        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('เลขที่สัญญา (นตก.)') }}</th>
                        <th scope="col">{{ __('ชื่อสัญญา') }}</th>
                        <th scope="col">{{ __('หน่วยงานต้นเรื่อง') }}</th>
                        <th scope="col">{{ __('วันเริ่มต้นสัญญา') }}</th>
                        <th scope="col">{{ __('วันสิ้นสุดสัญญา') }}</th>
                        {{-- <th scope="col">ประเภท</th>--}}
                        <th class="text-center" scope="col">{{ __('สถานะ') }}</th>
                        <th class="text-center" scope="col">{{ __('จัดการ') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($contracts) > 0)
                        @foreach ($contracts as $key => $contract)
                            <tr>
                                <td scope="col">{{ $contract->contract_no . "/" . $contract->contract_year }}</td>
                                <td scope="col">{{ $contract->contract_name }}</td>
                                <td scope="col">{{ $contract->department['dep_name'] }}</td>
                                <td scope="col">{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</td>
                                <td scope="col">{{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}</td>
                                <td class="text-center" scope="col">
                                    @if ($contract->status === 1)
                                        <span class="text-white bg-primary bg-gradient rounded px-3 py-2">ร่างสัญญา</span>
                                    @elseif ($contract->status === 2)
                                        <span class="text-dark bg-secondary bg-gradient rounded px-3 py-2">เสนอตรวจร่าง</span>
                                    @elseif ($contract->status === 3)
                                        <span class="text-white bg-success bg-gradient rounded px-3 py-2">แจ้งลงนามสัญญา</span>
                                    @elseif ($contract->status === 4)
                                        <span class="text-white bg-success bg-gradient rounded px-3 py-2">เสนอผู้บริหารลงนาม</span>
                                    @elseif ($contract->status === 5)
                                        <span class="text-white bg-success bg-gradient rounded px-3 py-2">เสร็จสิ้น(คืนคู่ฉบับ)</span>
                                    @endif
                                </td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square fs-sm me-1"></i>
                                        {{ __('แก้ไข') }}
                                    </a>
                                    <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this department?')">
                                            <i class="bi bi-trash fs-sm me-1"></i>
                                            {{ __('ลบ') }}
                                        </button>
                                    </form>
                                </td>
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
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection
