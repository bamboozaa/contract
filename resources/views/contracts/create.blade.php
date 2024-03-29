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
            @php
                $currentYear = \Carbon\Carbon::now()->year;
            @endphp

            <div class="row mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        {!! Form::text('contract_no', null, [
                            'class' => 'form-control w-auto',
                            'id' => 'contract_no',
                            'placeholder' => 'ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา',
                        ]) !!}
                        <label for="contract_no">{{ __('เลขที่สัญญา นตก. (ส)') }}</label>
                    </div>
                </div>
                <div class="col-md mr-auto">
                    <label for="contract_no">{{ __(' / ' . $currentYear) }}</label>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        {!! Form::select('dep_id', $departments, null, [
                            'class' => 'form-select w-auto',
                            'placeholder' => 'กรุณาเลือก หน่วยงานต้นเรื่อง',
                            'id' => 'dep_id',
                            'aria-label' => 'Floating label select departments',
                        ]) !!}
                    </div>
                </div>
            </div>


            {{-- <div class="row mb-3">

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-floating">
                            {!! Form::text('contract_no', null, [
                                'class' => 'form-control w-auto',
                                'id' => 'contract_no',
                                'placeholder' => 'ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา',
                            ]) !!}
                            <label for="contract_no">{{ __('เลขที่สัญญา นตก. (ส)') }}</label>
                        </div>
                    </div>
                </div>

                @php
                    $currentYear = \Carbon\Carbon::now()->year;
                @endphp
                {!! Form::text('contract_no_year', $currentYear, ['class' => 'form-control', 'readonly']) !!}
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::select('dep_id', $departments, null, [
                            'class' => 'form-select w-auto',
                            'placeholder' => 'กรุณาเลือก หน่วยงานต้นเรื่อง',
                            'id' => 'dep_id',
                            'aria-label' => 'Floating label select departments',
                        ]) !!}
                    </div>
                </div>
            </div> --}}

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="contract_name" placeholder={{ __('ชื่อสัญญา') }}>
                        <label for="contract_name">{{ __('ชื่อสัญญา') }}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="vendor" placeholder={{ __('ชื่อคู่สัญญา') }}>
                        <label for="vendor">{{ __('ชื่อคู่สัญญา') }}</label>
                    </div>
                </div>
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

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            {!! Form::select(
                                'contract_type',
                                [1 => 'สัญญาซื้อขาย', 2 => 'สัญญาจ้าง', 3 => 'สัญาเช่า', 4 => 'สัญญาอนุมัติให้ใช้สิทธิ์'],
                                null,
                                [
                                    'class' => 'form-select w-auto',
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
                                    'class' => 'form-control w-auto',
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
                                    'class' => 'form-control w-auto',
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
                            'class' => 'form-select w-auto',
                            'placeholder' => 'กรุณาเลือก ชนิดหลักประกัน',
                            'id' => 'types_of_contract',
                            'aria-label' => 'Floating label select types_of_contract',
                        ],
                    ) !!}
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

        </div>

        <div class="card-footer">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection
