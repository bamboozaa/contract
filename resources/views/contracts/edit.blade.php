@extends('layouts.app')
@section('title', 'Edit Contract')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('importjs')
    @parent
    <script type="module">

    </script>
@stop

@section('content')
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('contracts') }}">{{ __('Contracts') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Contract') }}</li>
            </ol>
        </nav>
    </div>

    {!! Form::open(['route' => array('contracts.update', $contract->id), 'method' => 'POST', 'files' => true]) !!}
    @method('PATCH')

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
                        <div class="col-md-2">
                            <div class="form-floating">
                                {{-- {!! Form::text('contract_no', $contract_no, [
                                    'class' => 'form-control form-control-lg' . ($errors->has('contract_no') ? ' is-invalid' : ''),
                                    'id' => 'contract_no',
                                    'placeholder' => 'เลขที่สัญญา นตก. (ส)',
                                    'readonly',
                                ]) !!} --}}
                                {!! Form::text('contract_no', old('name', $contract->contract_no), [
                                    'class' => 'form-control form-control-lg text-info' . ($errors->has('contract_no') ? ' is-invalid' : ''),
                                    'id' => 'contract_no',
                                    'placeholder' => 'เลขที่สัญญา นตก. (ส)',
                                ]) !!}
                                <label for="contract_no">{{ __('เลขที่สัญญา นตก. (ส)') }}</label>

                                @error('contract_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-floating">
                                {!! Form::text('contract_year', old('name', $contract->contract_year), [
                                    'class' => 'form-control form-control-lg text-info' . ($errors->has('contract_year') ? ' is-invalid' : ''),
                                    'id' => 'contract_year',
                                    'placeholder' => 'ปีการศึกษา',
                                ]) !!}
                                <label for="contract_year">{{ __('ปีการศึกษา') }}</label>

                                @error('contract_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                {!! Form::select('dep_id', $departments, old('name', $contract->dep_id), [
                                    'class' => 'form-select form-select-lg text-info' . ($errors->has('dep_id') ? ' is-invalid' : ''),
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
                        <div class="col-md-6">
                            <div class="form-floating">
                                {!! Form::text('contract_name', old('name', $contract->contract_name), [
                                    'class' => 'form-control form-control-lg text-info' . ($errors->has('contract_name') ? ' is-invalid' : ''),
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
                    </div>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        {!! Form::text('partners', old('name', $contract->partners), [
                            'class' => 'form-control form-control-lg text-info' . ($errors->has('partners') ? ' is-invalid' : ''),
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
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('acquisition_value', old('name', $contract->acquisition_value), [
                                'class' => 'form-control form-control-lg text-info' . ($errors->has('acquisition_value') ? ' is-invalid' : ''),
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
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('fund', old('name', $contract->fund), [
                                'class' => 'form-control form-control-lg text-info' . ($errors->has('fund') ? ' is-invalid' : ''),
                                'id' => 'fund',
                                'placeholder' => 'กองทุน',
                            ]) !!}
                            <label for="fund">{{ __('กองทุน') }}</label>

                            @error('fund')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                </div>
            </div>

            <fieldset class="border rounded-3 p-3 mb-3">
                <legend class="float-none fs-5 w-auto px-3">{{ __('รายละเอียดในสัญญา') }}</legend>

                <div class="row mb-1">
                    <div class="col-md-3">
                        <div class="form-floating">
                            {!! Form::select(
                                'contract_type',
                                [1 => 'สัญญาซื้อขาย', 2 => 'สัญญาจ้าง', 3 => 'สัญาเช่า', 4 => 'สัญญาอนุมัติให้ใช้สิทธิ์'],
                                old('name', $contract->contract_type),
                                [
                                    'class' => 'form-select form-select-lg text-info' . ($errors->has('contract_type') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือก ประเภทสัญญา',
                                    'id' => 'contract_type',
                                    'aria-label' => 'Floating label select contract_type',
                                ],
                            ) !!}

                            @error('contract_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::date('start_date', old('name', $contract->start_date), [
                                    'class' => 'form-control form-control-lg text-info' . ($errors->has('start_date') ? ' is-invalid' : ''),
                                    'id' => 'start_date',
                                    'placeholder' => 'dd/mm/yyyy',
                                ]) !!}
                                <label for="start_date" class="form-label">{{ __('วันเริ่มสัญญา') }}</label>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::date('end_date', old('name', $contract->end_date), [
                                    'class' => 'form-control form-control-lg text-info' . ($errors->has('end_date') ? ' is-invalid' : ''),
                                    'id' => 'end_date',
                                    'placeholder' => 'dd/mm/yyyy',
                                ]) !!}
                                <label for="end_date" class="form-label">{{ __('วันสิ้นสุดสัญญา') }}</label>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="border rounded-3 p-3">
                <legend class="float-none fs-5 w-auto px-3">{{ __('ข้อมูลหลักประกันสัญญา') }}</legend>
                <div class="row mb-1">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            {!! Form::select(
                                'types_of_guarantee',
                                [
                                    '1' => 'หลักประกันที่เป็นเงินสด',
                                    '2' => 'หลักประกันที่เป็นหนังสือค้ำประกัน',
                                    '3' => 'หลักประกันที่เป็นเช็คธนาคาร',
                                    '4' => 'หลักประกันที่เป็นพันธบัตรรัฐบาลไทย',
                                ],
                                old('name', $contract->types_of_guarantee),
                                [
                                    'class' => 'form-select form-select-lg text-info' . ($errors->has('types_of_guarantee') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือก ชนิดหลักประกัน',
                                    'id' => 'types_of_guarantee',
                                    'aria-label' => 'Floating label select types_of_guarantee',
                                ],
                            ) !!}

                            @error('types_of_guarantee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::text('guarantee_amount', old('name', $contract->guarantee_amount), [
                                    'class' => 'form-control form-control-lg text-info' . ($errors->has('guarantee_amount') ? ' is-invalid' : ''),
                                    'id' => 'guarantee_amount',
                                    'placeholder' => 'จำนวนเงินประกันสัญญา',
                                ]) !!}
                                <label for="guarantee_amount">{{ __('จำนวนเงินประกันสัญญา') }}</label>
                                @error('guarantee_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::select(
                                    'duration',
                                    [
                                        '1' => '1 ปี',
                                        '2' => '2 ปี',
                                        '3' => '3 ปี',
                                        '4' => 'อื่น ๆ',
                                    ],
                                    old('name', $contract->duration),
                                    [
                                        'class' => 'form-select form-select-lg text-info' . ($errors->has('duration') ? ' is-invalid' : ''),
                                        'placeholder' => 'กรุณาเลือก ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา',
                                        'id' => 'duration',
                                        'aria-label' => 'Floating label select duration',
                                    ],
                                ) !!}

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">

                            {!! Form::select(
                                'condition',
                                [
                                    '1' => '3 เดือน',
                                    '2' => '6 เดือน',
                                    '3' => '1 ปี',
                                ],
                                old('name', $contract->condition),
                                [
                                    'class' => 'form-select form-select-lg text-info' . ($errors->has('condition') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือก เงือนไขการคืนหลักประกันสัญญา',
                                    'id' => 'condition',
                                    'aria-label' => 'Floating label selectcondition',
                                ],
                            ) !!}

                            @error('condition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                </div>

            </fieldset>

            <div class="row my-3">
                <div class="col md-9">
                    <label for="formFile" class="form-label">{{ __('อัพโหลดไฟล์เอกสารสัญญา') }}</label>
                    <input class="form-control @error('formFile') is-invalid @enderror" type="file" id="formFile" name="formFile">
                    <label for="formFile" class="form-label">{{ old('name', $contract->formFile) }}</label>
                    @error('formFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">{{ __('สถานะสัญญา') }}</label>
                    <div class="form-floating">
                        {!! Form::select(
                            'status',
                            [
                                '1' => 'ร่างสัญญา',
                                '2' => 'เสนอตรวจร่าง',
                                '3' => 'แจ้งลงนามสัญญา',
                                '4' => 'เสนอผู้บริหารลงนาม',
                                '5' => 'เสร็จสิ้น(คืนคู่ฉบับ)',
                            ],
                            old('name', $contract->status),
                            [
                                'class' => 'form-select form-select-lg text-info' . ($errors->has('status') ? ' is-invalid' : ''),
                                'placeholder' => 'กรุณาเลือก สถานะสัญญา',
                                'id' => 'status',
                                'aria-label' => 'Floating label select status',
                            ],
                        ) !!}

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>


            </div>

            <div class="card-footer">
                <div class="d-grid col-1 mx-auto">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-up-square me-1"></i>{{ __('อัพเดทสัญญา') }}</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

    @endsection
