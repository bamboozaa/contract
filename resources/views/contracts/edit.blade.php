@extends('layouts.main')
@section('title', 'แก้ไขสัญญา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --utcc-blue: #1e3a5f;
            --utcc-gold: #d4af37;
            --utcc-light-blue: #4a90e2;
            --utcc-gray: #6c757d;
            --utcc-light-gray: #f8f9fa;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Sarabun', sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(30, 58, 95, 0.2);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 100px;
            height: 100px;
            background: var(--utcc-gold);
            border-radius: 50%;
            opacity: 0.1;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 80px;
            height: 80px;
            background: var(--utcc-gold);
            border-radius: 50%;
            opacity: 0.1;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .main-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            color: white;
            padding: 1rem 1.5rem;
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 3px solid var(--utcc-gold);
        }

        .section-header i {
            margin-right: 0.5rem;
            color: var(--utcc-gold);
        }

        .form-label {
            font-weight: 600;
            color: var(--utcc-blue);
            margin-bottom: 0.5rem;
        }

        .required:after {
            content: ' *';
            color: #dc3545;
            font-weight: bold;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--utcc-light-blue);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }

        .input-group-text {
            background: var(--utcc-light-blue);
            color: white;
            border: 2px solid var(--utcc-light-blue);
            font-weight: 600;
        }

        .guarantee-fieldset {
            border: 2px solid var(--utcc-light-blue);
            border-radius: 15px;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.8) 0%, rgba(255, 255, 255, 0.9) 100%);
            position: relative;
        }

        .guarantee-legend {
            background: white;
            color: var(--utcc-blue);
            font-weight: 700;
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            border: 2px solid var(--utcc-gold);
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .file-upload-area {
            border: 2px dashed var(--utcc-light-blue);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.05) 0%, rgba(255, 255, 255, 0.1) 100%);
            transition: all 0.3s ease;
            margin: 1.5rem 0;
        }

        .file-upload-area:hover {
            border-color: var(--utcc-blue);
            background: linear-gradient(135deg, rgba(30, 58, 95, 0.05) 0%, rgba(255, 255, 255, 0.1) 100%);
        }

        .file-upload-icon {
            font-size: 3rem;
            color: var(--utcc-light-blue);
            margin-bottom: 1rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--utcc-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            color: var(--utcc-light-blue);
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--utcc-gray);
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 58, 95, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 58, 95, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--utcc-gray) 0%, #5a6268 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #5a6268 0%, var(--utcc-gray) 100%);
        }

        .action-buttons {
            background: var(--utcc-light-gray);
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.1) 0%, rgba(255, 255, 255, 0.8) 100%);
            border: 1px solid var(--utcc-light-blue);
            border-radius: 15px;
            color: var(--utcc-blue);
        }

        .current-file {
            background: var(--utcc-light-gray);
            border: 2px solid var(--utcc-gold);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .current-file i {
            color: var(--utcc-blue);
            font-size: 1.2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .main-card {
                border-radius: 15px;
            }

            .section-card {
                border-radius: 10px;
            }
        }
    </style>
@stop

@section('content')
    <!-- Breadcrumb -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="bi bi-house-door me-1"></i>{{ __('หน้าหลัก') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('contracts.index') }}" class="text-decoration-none">
                                <i class="bi bi-file-earmark-text me-1"></i>{{ __('จัดการสัญญา') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('contracts.show', $contract->id) }}" class="text-decoration-none">
                                <i class="bi bi-eye me-1"></i>{{ __('รายละเอียดสัญญา') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bi bi-pencil-square me-1"></i>{{ __('แก้ไขสัญญา') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    {{-- <div class="page-header text-center">
        <h1 class="page-title">
            <i class="bi bi-pencil-square me-3"></i>แก้ไขสัญญา
        </h1>
        <p class="page-subtitle mb-0">
            เลขที่สัญญา: นตก.(ส) {{ $contract->contract_no }}/{{ $contract->contract_year }}
        </p>
    </div> --}}

    <!-- Main Form -->
    {!! Form::open(['route' => ['contracts.update', $contract->id], 'method' => 'POST', 'files' => true, 'class' => 'needs-validation', 'novalidate' => true]) !!}
    @method('PATCH')

    {{-- Preserve list filters so we can redirect back with the same filters --}}
    @foreach (['contract_year','status','contract_type','department_id','expiry_status','page'] as $f)
        @if (request()->has($f))
            <input type="hidden" name="filter_{{ $f }}" value="{{ request($f) }}">
        @endif
    @endforeach

    <div class="main-card">
        <div class="card-body p-0">

            <!-- ข้อมูลสัญญา -->
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-file-text"></i>ข้อมูลทั่วไปของสัญญา
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label for="contract_no" class="form-label required">เลขที่สัญญา</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-hash me-1"></i>นตก.(ส)
                                </span>
                                {!! Form::text('contract_no', old('contract_no', $contract->contract_no), [
                                    'class' => 'form-control' . ($errors->has('contract_no') ? ' is-invalid' : ''),
                                    'id' => 'contract_no',
                                    'placeholder' => 'เลขที่สัญญา',
                                    'required' => true
                                ]) !!}
                            </div>
                            @error('contract_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="contract_year" class="form-label required">ปีการศึกษา</label>
                            {!! Form::text('contract_year', old('contract_year', $contract->contract_year), [
                                'class' => 'form-control' . ($errors->has('contract_year') ? ' is-invalid' : ''),
                                'id' => 'contract_year',
                                'placeholder' => 'ปี พ.ศ.',
                                'required' => true
                            ]) !!}
                            @error('contract_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dep_id" class="form-label required">หน่วยงานต้นเรื่อง</label>
                            {!! Form::select('dep_id', $departments, old('dep_id', $contract->dep_id), [
                                'class' => 'form-select' . ($errors->has('dep_id') ? ' is-invalid' : ''),
                                'placeholder' => 'กรุณาเลือกหน่วยงานต้นเรื่อง',
                                'id' => 'dep_id',
                                'required' => true
                            ]) !!}
                            @error('dep_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-12">
                            <label for="contract_name" class="form-label required">ชื่อสัญญา</label>
                            {!! Form::text('contract_name', old('contract_name', $contract->contract_name), [
                                'class' => 'form-control' . ($errors->has('contract_name') ? ' is-invalid' : ''),
                                'id' => 'contract_name',
                                'placeholder' => 'ระบุชื่อสัญญาให้ชัดเจน',
                                'required' => true
                            ]) !!}
                            @error('contract_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-4">
                            <label for="partners" class="form-label required">ชื่อคู่สัญญา</label>
                            {!! Form::text('partners', old('partners', $contract->partners), [
                                'class' => 'form-control' . ($errors->has('partners') ? ' is-invalid' : ''),
                                'id' => 'partners',
                                'placeholder' => 'ชื่อบุคคล/นิติบุคคล',
                                'required' => true
                            ]) !!}
                            @error('partners')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="acquisition_value" class="form-label required">มูลค่าสัญญา (บาท)</label>
                            {!! Form::text('acquisition_value', old('acquisition_value', $contract->acquisition_value), [
                                'class' => 'form-control' . ($errors->has('acquisition_value') ? ' is-invalid' : ''),
                                'id' => 'acquisition_value',
                                'placeholder' => '0.00',
                                'required' => true
                            ]) !!}
                            @error('acquisition_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="fund" class="form-label">ชื่อกองทุน</label>
                            {!! Form::text('fund', old('fund', $contract->fund), [
                                'class' => 'form-control' . ($errors->has('fund') ? ' is-invalid' : ''),
                                'id' => 'fund',
                                'placeholder' => 'ระบุชื่อกองทุน'
                            ]) !!}
                            @error('fund')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- รายละเอียดในสัญญา -->
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-file-earmark-text"></i>รายละเอียดการดำเนินงานตามสัญญา
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="contract_type" class="form-label required">ประเภทสัญญา</label>
                            {!! Form::select('contract_type', [
                                1 => 'สัญญาซื้อขาย',
                                2 => 'สัญญาจ้าง',
                                3 => 'สัญญาเช่า',
                                4 => 'สัญญาอนุมัติให้ใช้สิทธิ์',
                                5 => 'บันทึกข้อตกลง'
                            ], old('contract_type', $contract->contract_type), [
                                'class' => 'form-select' . ($errors->has('contract_type') ? ' is-invalid' : ''),
                                'placeholder' => 'กรุณาเลือกประเภทสัญญา',
                                'required' => true
                            ]) !!}
                            @error('contract_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label required">สถานะสัญญา</label>
                            {!! Form::select('status', [
                                '1' => 'ร่างสัญญา',
                                '2' => 'เสนอตรวจร่าง',
                                '3' => 'แจ้งลงนามสัญญา',
                                '4' => 'เสนอผู้บริหารลงนาม',
                                '5' => 'เสร็จสิ้น(คืนคู่ฉบับ)'
                            ], old('status', $contract->status), [
                                'class' => 'form-select' . ($errors->has('status') ? ' is-invalid' : ''),
                                'placeholder' => 'กรุณาเลือกสถานะสัญญา',
                                'required' => true
                            ]) !!}
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="contractid" class="form-label">หมายเลขอ้างอิง</label>
                            {!! Form::text('contractid', old('contractid', $contract->contractid), [
                                'class' => 'form-control' . ($errors->has('contractid') ? ' is-invalid' : ''),
                                'id' => 'contractid',
                                'placeholder' => 'Contract ID (ถ้ามี)'
                            ]) !!}
                            @error('contractid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-4">
                            <label for="contract_date" class="form-label">วันที่ในสัญญา</label>
                            {!! Form::date('contract_date', old('contract_date', $contract->contract_date), [
                                'class' => 'form-control' . ($errors->has('contract_date') ? ' is-invalid' : ''),
                                'id' => 'contract_date'
                            ]) !!}
                            @error('contract_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">วันเริ่มต้นสัญญา</label>
                            {!! Form::date('start_date', old('start_date', $contract->start_date), [
                                'class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''),
                                'id' => 'start_date'
                            ]) !!}
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">วันสิ้นสุดสัญญา</label>
                            {!! Form::date('end_date', old('end_date', $contract->end_date), [
                                'class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''),
                                'id' => 'end_date'
                            ]) !!}
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- ข้อมูลหลักประกันสัญญา -->
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-shield-check"></i>ข้อมูลหลักประกันสัญญา
                </div>
                <div class="card-body p-4">
                    <fieldset class="guarantee-fieldset">
                        <legend class="guarantee-legend">
                            <i class="bi bi-bank me-2"></i>รายละเอียดหลักประกัน
                        </legend>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="types_of_guarantee" class="form-label">ประเภทหลักประกัน</label>
                                {!! Form::select('types_of_guarantee', [
                                    '1' => 'หลักประกันที่เป็นเงินสด',
                                    '2' => 'หลักประกันที่เป็นหนังสือค้ำประกัน',
                                    '3' => 'หลักประกันที่เป็นเช็คธนาคาร',
                                    '4' => 'หลักประกันที่เป็นพันธบัตรรัฐบาลไทย'
                                ], old('types_of_guarantee', $contract->types_of_guarantee), [
                                    'class' => 'form-select' . ($errors->has('types_of_guarantee') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือกประเภทหลักประกัน'
                                ]) !!}
                                @error('types_of_guarantee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="guarantee_amount" class="form-label">จำนวนเงินประกัน (บาท)</label>
                                {!! Form::text('guarantee_amount', old('guarantee_amount', $contract->guarantee_amount), [
                                    'class' => 'form-control' . ($errors->has('guarantee_amount') ? ' is-invalid' : ''),
                                    'id' => 'guarantee_amount',
                                    'placeholder' => '0.00'
                                ]) !!}
                                @error('guarantee_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-4 mt-1">
                            <div class="col-md-6">
                                <label for="duration" class="form-label">ระยะเวลาค้ำประกัน</label>
                                {!! Form::select('duration', [
                                    '1' => '1 ปี',
                                    '2' => '2 ปี',
                                    '3' => '3 ปี',
                                    '4' => 'อื่น ๆ'
                                ], old('duration', $contract->duration), [
                                    'class' => 'form-select' . ($errors->has('duration') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือกระยะเวลา'
                                ]) !!}
                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="condition" class="form-label">เงื่อนไขการคืนหลักประกัน</label>
                                {!! Form::select('condition', [
                                    '0' => '1 เดือน',
                                    '1' => '3 เดือน',
                                    '2' => '6 เดือน',
                                    '3' => '1 ปี'
                                ], old('condition', $contract->condition), [
                                    'class' => 'form-select' . ($errors->has('condition') ? ' is-invalid' : ''),
                                    'placeholder' => 'กรุณาเลือกเงื่อนไข'
                                ]) !!}
                                @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <!-- File Upload -->
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-cloud-upload"></i>เอกสารแนบ
                </div>
                <div class="card-body p-4">
                    @if($contract->formFile)
                        <div class="current-file">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-file-earmark-pdf me-3"></i>
                                <div>
                                    <strong>ไฟล์ปัจจุบัน:</strong> {{ $contract->formFile }}
                                    <br>
                                    <small class="text-muted">อัพโหลดใหม่หากต้องการเปลี่ยนไฟล์</small>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="file-upload-area">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <h5 class="mb-3">อัพโหลดไฟล์เอกสารสัญญาใหม่</h5>
                        <p class="text-muted mb-3">รองรับไฟล์ PDF, DOC, DOCX ขนาดไม่เกิน 10MB</p>
                        <input class="form-control @error('formFile') is-invalid @enderror"
                               type="file" id="formFile" name="formFile"
                               accept=".pdf,.doc,.docx">
                        @error('formFile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mt-3">
                            <label for="formFile_description" class="form-label">คำอธิบายไฟล์หลัก</label>
                            <textarea name="formFile_description" id="formFile_description" class="form-control" placeholder="คำอธิบายสั้น ๆ ของไฟล์หลัก">{{ old('formFile_description', $contract->formFile_description) }}</textarea>
                        </div>
                        <hr>
                        <label class="form-label fw-semibold mt-3">อัพโหลดไฟล์อื่น ๆ (หลายไฟล์) และเพิ่มคำอธิบาย</label>
                        <input class="form-control mt-2" type="file" id="attachments" name="attachments[]" multiple accept=".pdf,.doc,.docx">
                        <div id="attachments-list" class="mt-2"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left me-2"></i>ย้อนกลับ
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-up-square me-2"></i>อัพเดทสัญญา
                </button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@section('importjs')
    @parent
    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        document.addEventListener('DOMContentLoaded', function() {
            // File upload preview
            const formFile = document.getElementById('formFile');
            if (formFile) {
                formFile.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const fileName = file.name;
                        const fileSize = (file.size / 1024 / 1024).toFixed(2);
                        console.log(`Selected file: ${fileName} (${fileSize} MB)`);
                    }
                });
            }

            // Multiple attachments with descriptions (edit)
            const attachmentsInput = document.getElementById('attachments');
            const attachmentsList = document.getElementById('attachments-list');
            if (attachmentsInput && attachmentsList) {
                attachmentsInput.addEventListener('change', function(e) {
                    attachmentsList.innerHTML = '';
                    Array.from(attachmentsInput.files).forEach((file, idx) => {
                        const row = document.createElement('div');
                        row.className = 'mb-2 p-2 border rounded';
                        row.innerHTML = `
                            <div class="fw-semibold">${file.name} <small class="text-muted">(${(file.size/1024/1024).toFixed(2)} MB)</small></div>
                            <div class="mt-2">
                                <textarea name="attachments_desc[]" class="form-control" placeholder="คำอธิบายไฟล์ (เช่น สัญญาฉบับที่ 1)"></textarea>
                            </div>
                        `;
                        attachmentsList.appendChild(row);
                    });
                });
            }

            // Auto format acquisition value with comma
            const acquisitionValue = document.getElementById('acquisition_value');
            if (acquisitionValue) {
                acquisitionValue.addEventListener('input', function(e) {
                    let value = e.target.value;

                    // Remove all non-digit characters except decimal point
                    value = value.replace(/[^\d.]/g, '');

                    // Ensure only one decimal point
                    const parts = value.split('.');
                    if (parts.length > 2) {
                        value = parts[0] + '.' + parts.slice(1).join('');
                    }

                    // Format with comma
                    if (value !== '') {
                        const [integerPart, decimalPart] = value.split('.');
                        const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        e.target.value = decimalPart !== undefined ? formattedInteger + '.' + decimalPart : formattedInteger;
                    }
                });

                // Store original value without comma before submit
                const form = acquisitionValue.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Remove comma before submitting
                        acquisitionValue.value = acquisitionValue.value.replace(/,/g, '');
                    });
                }

                // Format initial value
                if (acquisitionValue.value !== '') {
                    let value = acquisitionValue.value;
                    const [integerPart, decimalPart] = value.split('.');
                    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    acquisitionValue.value = decimalPart !== undefined ? formattedInteger + '.' + decimalPart : formattedInteger;
                }
            }

            // Auto format guarantee amount with comma
            const guaranteeAmount = document.getElementById('guarantee_amount');
            if (guaranteeAmount) {
                guaranteeAmount.addEventListener('input', function(e) {
                    let value = e.target.value;

                    // Remove all non-digit characters except decimal point
                    value = value.replace(/[^\d.]/g, '');

                    // Ensure only one decimal point
                    const parts = value.split('.');
                    if (parts.length > 2) {
                        value = parts[0] + '.' + parts.slice(1).join('');
                    }

                    // Format with comma
                    if (value !== '') {
                        const [integerPart, decimalPart] = value.split('.');
                        const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        e.target.value = decimalPart !== undefined ? formattedInteger + '.' + decimalPart : formattedInteger;
                    }
                });

                // Store original value without comma before submit
                const form = guaranteeAmount.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Remove comma before submitting
                        guaranteeAmount.value = guaranteeAmount.value.replace(/,/g, '');
                    });
                }

                // Format initial value
                if (guaranteeAmount.value !== '') {
                    let value = guaranteeAmount.value;
                    const [integerPart, decimalPart] = value.split('.');
                    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    guaranteeAmount.value = decimalPart !== undefined ? formattedInteger + '.' + decimalPart : formattedInteger;
                }
            }
        });


    </script>
@stop
