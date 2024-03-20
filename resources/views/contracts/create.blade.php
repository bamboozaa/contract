@extends('layouts.app')
@section('title', 'Create Contract')

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

            {{-- {!! Form::label('contract_date', __('วันเดือนปี ที่บันทึก'), ['class' => 'col col-form-label']) !!}
            <div class="col-1">
                {!! Form::date('contract_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            </div> --}}
            {{-- <div class="form-floating mb-3">
                <input type="text" name="department" class="form-control" id="department"
                    placeholder={{ __('หน่วยงานต้นเรื่อง') }}>
                <label for="department">{{ __('หน่วยงานต้นเรื่อง') }}</label>
            </div> --}}

            <div class="form-group row my-3">
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

            {{-- <div class="form-row mb-3">
                <div class="form-group col-auto">
                    <label for="dep_id">หน่วยงานต้นเรื่อง</label>
                    {!! Form::select('dep_id', $departments, null, [
                        'class' => 'form-select w-auto',
                        'placeholder' => 'Please Select ...',
                        'id' => 'dep_id',
                    ]) !!}
                </div>
            </div> --}}

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="contract_name" placeholder={{ __('ชื่อสัญญา') }}>
                <label for="contract_name">{{ __('ชื่อสัญญา') }}</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="vendor" placeholder={{ __('ชื่อคู่สัญญา') }}>
                <label for="vendor">{{ __('ชื่อคู่สัญญา') }}</label>
            </div>

            {{-- <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="contract_detail" style="height: 100px"></textarea>
                <label for="contract_detail">{{ __('รายละเอียดสัญญา') }}</label>
            </div> --}}

            <div class="form-group row mb-3">
                <label for="start_date" class="col-md-1 col-form-label">{{ __('วันที่ลงนามสัญญา') }}</label>
                <div class="col-auto">
                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="end_date" class="col-md-1 col-form-label">{{ __('วันสิ้นสุดสัญญา') }}</label>
                <div class="col-auto">
                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            {{-- <div class="row my-3">
                <div class="col-auto">
                    <label for="start_date" class="form-label">{{ __('วันที่ลงนามสัญญา') }}</label>

                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}

                </div>
                <div class="col-auto">
                    <label for="end_date" class="form-label">{{ __('วันสิ้นสุดสัญญา') }}</label>

                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}

                </div>
                <div class="col">
                    <label for="value_contract" class="form-label">{{ __('มูลค่าวงเงินตามสัญญา') }}</label>
                    <input type="text" name="value_contract" class="form-control" placeholder="$B">
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col">
                    <label for="value_contract" class="form-label">{{ __('ผู้จัดทำโครงการ') }}</label>
                    <input type="text" name="value_contract" class="form-control">
                </div>
                <div class="col">
                    <label for="value_contract" class="form-label">{{ __('หน่วยงาน') }}</label>
                    <input type="text" name="value_contract" class="form-control">
                </div>
            </div> --}}



        </div>

        <div class="card-footer">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection
