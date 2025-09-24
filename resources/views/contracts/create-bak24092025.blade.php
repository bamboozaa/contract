@extends('layouts.main')
@section('title', 'Create Contract')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style>
        .required:after {
            content: ' *';
            color: red;
            font-weight: bold;
        }
    </style>
@stop

@section('importjs')
    @parent
    <script>

    </script>
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

    {!! Form::hidden('assignee', \Illuminate\Support\Facades\Auth::user()->username) !!}

    <div class="card mb-4">
        <div class="card-header" style="display: flex;">
            <div>
                {{ __('บันทึกสัญญาใหม่') }}
            </div>
        </div>

        <div class="card-body">
            <!-- ข้อมูลสัญญา -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-file-text me-2"></i>{{ __('ข้อมูลสัญญา') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-2">
                            <label for="contract_no" class="form-label required">{{ __('เลขที่สัญญา') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ __('นตก.(ส)') }}</span>
                                <input type="text" class="form-control" id="contract_no" name="contract_no" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="contract_year" class="form-label required">ปีการศึกษา</label>
                            <input type="text" class="form-control" id="contract_year" name="contract_year" required>
                            <div class="invalid-feedback">
                                Please provide your contract year.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="dep_id" class="form-label required">{{ __('หน่วยงานต้นเรื่อง') }}</label>
                            {!! Form::select('dep_id', $departments, null, [
                                'class' => 'form-select' . ($errors->has('dep_id') ? ' is-invalid' : ''),
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
                        <div class="col-md-4">
                            <label for="contract_name" class="form-label required">{{ __('ชื่อสัญญา') }}</label>
                            <input type="text" class="form-control" id="contract_name" name="contract_name" required>
                            <div class="invalid-feedback">
                                Please provide your contract name.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fund" class="form-label">{{ __('กองทุน') }}</label>
                            <input type="text" class="form-control" id="fund" name="fund">
                            <div class="invalid-feedback">
                                Please provide fund.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="acquisition_value"
                                class="form-label required">{{ __('มูลค่างานตามสัญญา (จำนวนเงิน)') }}</label>
                            <input type="text" class="form-control" id="acquisition_value" name="acquisition_value"
                                required>
                            <div class="invalid-feedback">
                                Please provide acquisition_value.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="partners" class="form-label required">{{ __('ชื่อคู่สัญญา') }}</label>
                            <input type="text" class="form-control" id="partners" name="partners" required>
                            <div class="invalid-feedback">
                                Please provide partners.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- รายละเอียดในสัญญา -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi-file-earmark-text me-2"></i>{{ __('รายละเอียดในสัญญา') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="contract_type" class="form-label required">{{ __('ประเภทสัญญา') }}</label>
                            {!! Form::select(
                                'contract_type',
                                [1 => 'สัญญาซื้อขาย', 2 => 'สัญญาจ้าง', 3 => 'สัญญาเช่า', 4 => 'สัญญาอนุมัติให้ใช้สิทธิ์', 5 => 'บันทึกข้อตกลง'],
                                null,
                                [
                                    'class' => 'form-select form-select' . ($errors->has('contract_type') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือก ประเภทสัญญา',
                                    'id' => 'contract_type',
                                    'aria-label' => 'Floating label select contract_type',
                                ],
                            ) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label required">{{ __('สถานะสัญญา') }}</label>
                            {!! Form::select(
                                'status',
                                [
                                    '1' => 'ร่างสัญญา',
                                    '2' => 'เสนอตรวจร่าง',
                                    '3' => 'แจ้งลงนามสัญญา',
                                    '4' => 'เสนอผู้บริหารลงนาม',
                                    '5' => 'เสร็จสิ้น(คืนคู่ฉบับ)',
                                ],
                                null,
                                [
                                    'class' => 'form-select' . ($errors->has('status') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือก สถานะสัญญา',
                                    'id' => 'status',
                                    'aria-label' => 'Floating label select status',
                                    'required' => true,
                                ],
                            ) !!}

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="contractid" class="form-label">{{ __('Contract ID') }}</label>
                            {!! Form::text('contractid', null, [
                                'class' => 'form-control' . ($errors->has('contractid') ? ' is-invalid' : ''),
                                'id' => 'contractid',
                                'placeholder' => 'Contract ID',
                            ]) !!}

                            @error('contractid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-floating">
                                    {!! Form::date('contract_date', null, [
                                        'class' => 'form-control form-control' . ($errors->has('contract_date') ? ' is-invalid' : ''),
                                        'id' => 'contract_date',
                                        'placeholder' => 'dd/mm/yyyy',
                                    ]) !!}
                                    <label for="contract_date" class="form-label">{{ __('วันที่ในสัญญา') }}</label>

                                    @error('contract_date')
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
                                    {!! Form::date('start_date', null, [
                                        'class' => 'form-control form-control' . ($errors->has('start_date') ? ' is-invalid' : ''),
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-floating">
                                    {!! Form::date('end_date', null, [
                                        'class' => 'form-control form-control' . ($errors->has('end_date') ? ' is-invalid' : ''),
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
                </div>
            </div>

            <!-- ข้อมูลหลักประกันสัญญา -->
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
                                null,
                                [
                                    'class' => 'form-select form-select' . ($errors->has('types_of_guarantee') ? ' is-invalid' : ''),
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
                                {!! Form::text('guarantee_amount', null, [
                                    'class' => 'form-control' . ($errors->has('guarantee_amount') ? ' is-invalid' : ''),
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
                                    null,
                                    [
                                        'class' => 'form-select form-select' . ($errors->has('duration') ? ' is-invalid' : ''),
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
                                    '0' => '1 เดือน',
                                    '1' => '3 เดือน',
                                    '2' => '6 เดือน',
                                    '3' => '1 ปี',
                                ],
                                null,
                                [
                                    'class' => 'form-select form-select' . ($errors->has('condition') ? ' is-invalid' : ''),
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

            <div class="my-3">
                <label for="formFile" class="form-label">อัพโหลดไฟล์เอกสารสัญญา</label>
                <input class="form-control @error('formFile') is-invalid @enderror" type="file" id="formFile"
                    name="formFile">

                @error('formFile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary me-md-2">Reset</button>
                    <button type="submit" class="btn btn-labeled btn-primary">
                        <span class="btn-label">
                            <i class="bi bi-floppy me-1" style="font-size: 1rem;"></i>
                        </span>
                        {{ __('บันทึกสัญญา') }}
                    </button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

    @endsection
