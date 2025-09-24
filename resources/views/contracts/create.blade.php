@extends('layouts.main')
@section('title', 'สร้างสัญญาใหม่')

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
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
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

        /* Floating label improvements */
        .form-floating label {
            color: var(--utcc-gray);
            font-weight: 500;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: var(--utcc-blue);
            font-weight: 600;
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

@section('importjs')
    @parent
    
@stop

@section('content')
    <!-- Breadcrumb -->
    <div class="container-fluid mb-3">
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bi bi-plus-circle me-1"></i>{{ __('สร้างสัญญาใหม่') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    {{-- <div class="page-header text-center">
        <h1 class="page-title">
            <i class="bi bi-file-earmark-plus me-3"></i>สร้างสัญญาใหม่
        </h1>
        <p class="page-subtitle mb-0">
            ระบบจัดการสัญญา มหาวิทยาลัยหอการค้าไทย
        </p>
    </div> --}}

    <!-- Main Form -->
    {!! Form::open([
        'route' => 'contracts.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'needs-validation',
        'novalidate' => true,
    ]) !!}
    {!! Form::hidden('assignee', Auth::user()->username) !!}

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
                                <input type="text" class="form-control" id="contract_no" name="contract_no"
                                    placeholder="เลขที่สัญญา" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="contract_year" class="form-label required">ปีการศึกษา</label>
                            <input type="text" class="form-control" id="contract_year" name="contract_year"
                                placeholder="ปี พ.ศ." required>
                        </div>
                        <div class="col-md-6">
                            <label for="dep_id" class="form-label required">หน่วยงานต้นเรื่อง</label>
                            {!! Form::select('dep_id', $departments, null, [
                                'class' => 'form-select' . ($errors->has('dep_id') ? ' is-invalid' : ''),
                                'placeholder' => 'กรุณาเลือกหน่วยงานต้นเรื่อง',
                                'id' => 'dep_id',
                                'required' => true,
                            ]) !!}
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-12">
                            <label for="contract_name" class="form-label required">ชื่อสัญญา</label>
                            <input type="text" class="form-control" id="contract_name" name="contract_name"
                                placeholder="ระบุชื่อสัญญาให้ชัดเจน" required>
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-4">
                            <label for="partners" class="form-label required">ชื่อคู่สัญญา</label>
                            <input type="text" class="form-control" id="partners" name="partners"
                                placeholder="ชื่อบุคคล/นิติบุคคล" required>
                        </div>
                        <div class="col-md-4">
                            <label for="acquisition_value" class="form-label required">มูลค่าสัญญา (บาท)</label>
                            <input type="text" class="form-control" id="acquisition_value" name="acquisition_value"
                                placeholder="0.00" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fund" class="form-label">ชื่อกองทุน</label>
                            <input type="text" class="form-control" id="fund" name="fund"
                                placeholder="ระบุชื่อกองทุน">
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
                            {!! Form::select(
                                'contract_type',
                                [
                                    1 => 'สัญญาซื้อขาย',
                                    2 => 'สัญญาจ้าง',
                                    3 => 'สัญญาเช่า',
                                    4 => 'สัญญาอนุมัติให้ใช้สิทธิ์',
                                    5 => 'บันทึกข้อตกลง',
                                ],
                                null,
                                [
                                    'class' => 'form-select',
                                    'placeholder' => 'กรุณาเลือกประเภทสัญญา',
                                    'required' => true,
                                ],
                            ) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label required">สถานะสัญญา</label>
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
                                    'class' => 'form-select',
                                    'placeholder' => 'กรุณาเลือกสถานะสัญญา',
                                    'required' => true,
                                ],
                            ) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="contractid" class="form-label">หมายเลขอ้างอิง</label>
                            <input type="text" class="form-control" id="contractid" name="contractid"
                                placeholder="Contract ID (ถ้ามี)">
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-4">
                            <div class="form-floating">
                                {!! Form::date('contract_date', null, [
                                    'class' => 'form-control',
                                    'id' => 'contract_date',
                                    'placeholder' => 'วันที่ในสัญญา',
                                ]) !!}
                                <label for="contract_date">วันที่ในสัญญา</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                {!! Form::date('start_date', null, [
                                    'class' => 'form-control',
                                    'id' => 'start_date',
                                    'placeholder' => 'วันเริ่มสัญญา',
                                ]) !!}
                                <label for="start_date">วันเริ่มต้นสัญญา</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                {!! Form::date('end_date', null, [
                                    'class' => 'form-control',
                                    'id' => 'end_date',
                                    'placeholder' => 'วันสิ้นสุดสัญญา',
                                ]) !!}
                                <label for="end_date">วันสิ้นสุดสัญญา</label>
                            </div>
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
                                        'class' => 'form-select',
                                        'placeholder' => 'กรุณาเลือกประเภทหลักประกัน',
                                    ],
                                ) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="guarantee_amount" class="form-label">จำนวนเงินประกัน (บาท)</label>
                                <input type="text" class="form-control" id="guarantee_amount" name="guarantee_amount"
                                    placeholder="0.00">
                            </div>
                        </div>
                        <div class="row g-4 mt-1">
                            <div class="col-md-6">
                                <label for="duration" class="form-label">ระยะเวลาค้ำประกัน</label>
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
                                        'class' => 'form-select',
                                        'placeholder' => 'กรุณาเลือกระยะเวลา',
                                    ],
                                ) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="condition" class="form-label">เงื่อนไขการคืนหลักประกัน</label>
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
                                        'class' => 'form-select',
                                        'placeholder' => 'กรุณาเลือกเงื่อนไข',
                                    ],
                                ) !!}
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
                    <div class="file-upload-area">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <h5 class="mb-3">อัพโหลดไฟล์เอกสารสัญญา</h5>
                        <p class="text-muted mb-3">รองรับไฟล์ PDF, DOC, DOCX ขนาดไม่เกิน 10MB</p>
                        <input class="form-control @error('formFile') is-invalid @enderror" type="file" id="formFile"
                            name="formFile" accept=".pdf,.doc,.docx">
                        @error('formFile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <div class="d-flex justify-content-end gap-3">
                <button type="reset" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-clockwise me-2"></i>รีเซ็ต
                </button>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-floppy me-2"></i>บันทึกสัญญา
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

            // Auto format number inputs
            // const acquisitionValue = document.getElementById('acquisition_value');
            // if (acquisitionValue) {
            //     acquisitionValue.addEventListener('input', function(e) {
            //         let value = e.target.value.replace(/,/g, '');
            //         if (!isNaN(value) && value !== '') {
            //             e.target.value = parseFloat(value).toLocaleString('en-US', {
            //                 minimumFractionDigits: 2,
            //                 maximumFractionDigits: 2
            //             });
            //         }
            //     });
            // }

            // const guaranteeAmount = document.getElementById('guarantee_amount');
            // if (guaranteeAmount) {
            //     guaranteeAmount.addEventListener('input', function(e) {
            //         let value = e.target.value.replace(/,/g, '');
            //         if (!isNaN(value) && value !== '') {
            //             e.target.value = parseFloat(value).toLocaleString('en-US', {
            //                 minimumFractionDigits: 2,
            //                 maximumFractionDigits: 2
            //             });
            //         }
            //     });
            // }
        });
    </script>
@stop
