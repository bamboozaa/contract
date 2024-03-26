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

            <div class="form-group row mb-3">
                <label for="contract_no" class="col-auto col-form-label">เลขที่สัญญา นตก. (ส) :</label>
                <div class="col-auto">
                    {!! Form::text('contract_no', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-auto">
                    <span class="form-label">
                        /
                    </span>
                </div>
                <div class="col-auto">
                    @php
                        $currentYear = \Carbon\Carbon::now()->year;
                    @endphp
                    {!! Form::text('contract_no_year', $currentYear, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="dep_id" class="col-auto col-form-label">หน่วยงานต้นเรื่อง : </label>
                <div class="col-auto">
                    {!! Form::select('dep_id', $departments, null, [
                        'class' => 'form-select',
                        'placeholder' => 'Please Select ...',
                        'id' => 'dep_id',
                        'aria-label' => 'Floating label select departments',
                    ]) !!}
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="contract_name" placeholder={{ __('ชื่อสัญญา') }}>
                <label for="contract_name">{{ __('ชื่อสัญญา') }}</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="vendor" placeholder={{ __('ชื่อคู่สัญญา') }}>
                <label for="vendor">{{ __('ชื่อคู่สัญญา') }}</label>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('value', null, [
                                'class' => 'form-control',
                                'id' => 'value',
                                'placeholder' => 'มูลค่างานตามสัญญา (จำนวนเงิน)',
                            ]) !!}
                            <label for="value">{{ __('มูลค่างานตามสัญญา (จำนวนเงิน)') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('fund', null, ['class' => 'form-control', 'id' => 'fund', 'placeholder' => 'กองทุน']) !!}
                            <label for="fund" class="form-label">{{ __('กองทุน') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <fieldset class="border rounded-3 p-3 mb-3">
                <legend class="float-none fs-5 w-auto px-3">{{ __('รายละเอียดในสัญญา') }}</legend>
                <div class="form-group row mb-3">
                    <label for="start_date" class="col-md-1 col-form-label text-nowrap">{{ __('วันเริ่มสัญญา') }}</label>
                    <div class="col-auto">
                        {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="end_date" class="col-md-1 col-form-label text-nowrap">{{ __('วันสิ้นสุดสัญญา') }}</label>
                    <div class="col-auto">
                        {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="category" class="col-auto col-form-label">{{ __('ประเภทสัญญา : ') }}</label>
                    <div class="col-auto">
                        {!! Form::select(
                            'category',
                            [1 => 'สัญญาซื้อขาย', 2 => 'สัญญาจ้าง', 3 => 'สัญาเช่า', 4 => 'สัญญาอนุมัติให้ใช้สิทธิ์'],
                            null,
                            [
                                'class' => 'form-select',
                                'placeholder' => 'Please Select ...',
                                'id' => 'category',
                                'aria-label' => 'Floating label select categories',
                            ],
                        ) !!}
                    </div>
                </div>
            </fieldset>

            <fieldset class="border rounded-3 p-3">
                <legend class="float-none fs-5 w-auto px-3">{{ __('ข้อมูลหลักประกันสัญญา') }}</legend>
                <label class="form-label me-5">{{ __('ชนิดหลักประกัน : ') }}</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                        value="option1">
                    <label class="form-check-label" for="inlineRadio1">{{ __('หลักประกันที่เป็นเงินสด') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                        value="option2">
                    <label class="form-check-label"
                        for="inlineRadio2">{{ __('หลักประกันที่เป็นหนังสือค้ำประกัน') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                        value="option3">
                    <label class="form-check-label" for="inlineRadio3">{{ __('หลักประกันที่เป็นเช็คธนาคาร') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4"
                        value="option4">
                    <label class="form-check-label"
                        for="inlineRadio4">{{ __('หลักประกันที่เป็นพันธบัตรรัฐบาลไทย') }}</label>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating">
                                {!! Form::text('guarantee_amount', null, [
                                    'class' => 'form-control',
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
                                    'class' => 'form-control',
                                    'id' => 'duration',
                                    'placeholder' => 'ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา',
                                ]) !!}
                                <label for="duration">{{ __('ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
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

            {{-- <fieldset class="border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Your Legend</legend>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </fieldset> --}}



        </div>

        <div class="card-footer">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection
