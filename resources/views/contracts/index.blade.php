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
                        {{-- <th scope="col">ประเภท</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">จัดการ</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($contracts) > 0)
                        @foreach ($contracts as $key => $contract)
                            <tr>
                                <td scope="col">{{ $contract->contract_no . "/" . $contract->contract_year }}</td>
                                <td scope="col">{{ $contract->contract_name }}</td>
                                <td scope="col">{{ $contract->department['dep_name'] }}</td>
                                {{-- <td class="text-center text-nowrap">
                                    <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square fs-sm"></i>
                                        <span class="ms-1">{{ __('Edit') }}</span>
                                    </a>
                                    <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this department?')">
                                            <i class="bi bi-trash fs-sm"></i>
                                            <span class="ms-1">{{ __('Delete') }}</span>
                                        </button>
                                    </form>
                                </td> --}}
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
