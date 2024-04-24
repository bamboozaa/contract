@extends('layouts.app')
@section('title', 'Create Contract')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('content')
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('contracts') }}">{{ __('Contracts') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Create Contract') }}</li>
            </ol>
        </nav>
    </div>

    {!! Form::open(['route' => 'contracts.store', 'method' => 'POST', 'files' => true]) !!}

    <div class="card mb-4">
        <div class="card-header" style="display: flex;">
            <div>
                {{ __('Create New') }}
            </div>
            {{-- <div class="ms-auto">
                <a href="{{ route('contracts.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-square me-2"></i>
                    {{ __('Create New') }}
                </a>
            </div> --}}
        </div>

        {{-- <div class="alert alert-info" role="alert">Sample table page</div> --}}

        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                {!! Form::text('contract_no', $contract_no, [
                                    'class' => 'form-control form-control-lg' . ($errors->has('contract_no') ? ' is-invalid' : ''),
                                    'id' => 'contract_no',
                                    'placeholder' => 'เลขที่สัญญา นตก. (ส)',
                                    'readonly',
                                ]) !!}
                                <label for="contract_no">{{ __('เลขที่สัญญา นตก. (ส)') }}</label>

                                @error('contract_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                {!! Form::text('contract_year', $currentYearTH, [
                                    'class' => 'form-control form-control-lg' . ($errors->has('contract_year') ? ' is-invalid' : ''),
                                    'id' => 'contract_year',
                                    'placeholder' => 'ปีการศึกษา',
                                    'readonly',
                                ]) !!}
                                <label for="contract_year">{{ __('ปีการศึกษา') }}</label>

                                @error('contract_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating">
                        {!! Form::select('dep_id', $departments, null, [
                            'class' => 'form-select form-select-lg w-auto' . ($errors->has('dep_id') ? ' is-invalid' : ''),
                            'placeholder' => 'กรุณาเลือก หน่วยงานต้นเรื่อง',
                            'id' => 'dep_id',
                            'aria-label' => 'Floating label select departments',
                        ]) !!}

                        @error('dep_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::text('contract_name', null, [
                            'class' => 'form-control form-control-lg' . ($errors->has('contract_name') ? ' is-invalid' : ''),
                            'id' => 'contract_name',
                            'placeholder' => 'ชื่อสัญญา',
                        ]) !!}
                        <label for="contract_name">{{ __('ชื่อสัญญา') }}</label>

                        @error('contract_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::text('partners', null, [
                            'class' => 'form-control form-control-lg' . ($errors->has('partners') ? ' is-invalid' : ''),
                            'id' => 'partners',
                            'placeholder' => 'ชื่อคู่สัญญา',
                        ]) !!}
                        <label for="partners">{{ __('ชื่อคู่สัญญา') }}</label>

                        @error('partners')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('acquisition_value', null, [
                                'class' => 'form-control form-control-lg' . ($errors->has('acquisition_value') ? ' is-invalid' : ''),
                                'id' => 'acquisition_value',
                                'placeholder' => 'มูลค่างานตามสัญญา (จำนวนเงิน)',
                            ]) !!}
                            <label for="acquisition_value">{{ __('มูลค่างานตามสัญญา (จำนวนเงิน)') }}</label>

                            @error('acquisition_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('fund', null, ['class' => 'form-control form-control-lg', 'id' => 'fund', 'placeholder' => 'กองทุน']) !!}
                            <label for="fund" class="form-label">{{ __('กองทุน') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <fieldset class="border rounded-3 p-3 mb-3">
                <legend class="float-none fs-5 w-auto px-3">{{ __('รายละเอียดในสัญญา') }}</legend>

                <div class="row mb-1">
                    <div class="col-md-4">
                        <div class="form-floating">
                            {!! Form::select(
                                'contract_type',
                                [1 => 'สัญญาซื้อขาย', 2 => 'สัญญาจ้าง', 3 => 'สัญาเช่า', 4 => 'สัญญาอนุมัติให้ใช้สิทธิ์'],
                                null,
                                [
                                    'class' => 'form-select form-select-lg w-auto',
                                    'placeholder' => 'กรุณาเลือก ชนิดหลักประกัน',
                                    'id' => 'contract_type',
                                    'aria-label' => 'Floating label select contract_type',
                                ],
                            ) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::date('start_date', null, [
                                    'class' => 'form-control form-control-lg w-auto',
                                    'id' => 'start_date',
                                    'placeholder' => 'dd/mm/yyyy',
                                ]) !!}
                                <label for="start_date" class="form-label">{{ __('วันเริ่มสัญญา') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::date('end_date', null, [
                                    'class' => 'form-control form-control-lg w-auto',
                                    'id' => 'end_date',
                                    'placeholder' => 'dd/mm/yyyy',
                                ]) !!}
                                <label for="end_date" class="form-label">{{ __('วันสิ้นสุดสัญญา') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="border rounded-3 p-3">
                <legend class="float-none fs-5 w-auto px-3">{{ __('ข้อมูลหลักประกันสัญญา') }}</legend>
                <div class="form-floating mb-3">
                    {!! Form::select(
                        'types_of_contract',
                        [
                            '1' => 'หลักประกันที่เป็นเงินสด',
                            '2' => 'หลักประกันที่เป็นหนังสือค้ำประกัน',
                            '3' => 'หลักประกันที่เป็นเช็คธนาคาร',
                            '4' => 'หลักประกันที่เป็นพันธบัตรรัฐบาลไทย',
                        ],
                        null,
                        [
                            'class' => 'form-select form-select-lg w-auto',
                            'placeholder' => 'กรุณาเลือก ชนิดหลักประกัน',
                            'id' => 'types_of_contract',
                            'aria-label' => 'Floating label select types_of_contract',
                        ],
                    ) !!}
                </div>

                <div class="row mb-1">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::text('guarantee_amount', null, [
                                    'class' => 'form-control form-control-lg',
                                    'id' => 'guarantee_amount',
                                    'placeholder' => 'จำนวนเงินประกันสัญญา',
                                ]) !!}
                                <label for="guarantee_amount">{{ __('จำนวนเงินประกันสัญญา') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::text('duration', null, [
                                    'class' => 'form-control form-control-lg',
                                    'id' => 'duration',
                                    'placeholder' => 'ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา',
                                ]) !!}
                                <label for="duration">{{ __('ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select form-select-lg w-auto" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>กรุณาเลือก เงือนไขการคืนหลักประกันสัญญา</option>
                                <option value="1">3 เดือน</option>
                                <option value="2">6 เดือน</option>
                                <option value="3">1 ปี</option>
                            </select>
                            {{-- <label for="floatingSelect">Works with selects</label> --}}
                        </div>
                    </div>
                </div>

            </fieldset>

        </div>

        <div class="card-footer">
            {{-- {{ $users->links() }} --}}
            {!! Form::submit('บันทึกสัญญา', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection
