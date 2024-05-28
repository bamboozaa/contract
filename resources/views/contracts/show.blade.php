@extends('layouts.app')
@section('title', 'Create Contract')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('importjs')
    @parent
    <script type="module"></script>
@stop

@section('content')
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('contracts') }}">{{ __('Contracts') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Display Contract') }}</li>
            </ol>
        </nav>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                role="tab" aria-controls="nav-home" aria-selected="true">{{ __('ข้อมูลสัญญา') }}</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                role="tab" aria-controls="nav-profile" aria-selected="false">{{ __('รายละเอียดในสัญญา') }}</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button"
                role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('ข้อมูลหลักประกันสัญญา') }}</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="390">{{ __('เลขที่สัญญา (นตก.)') }}</th>
                                    <td>{{ $contract->contract_no . '/' . $contract->contract_year }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('หน่วยงานต้นเรื่อง') }}</th>
                                    <td>{{ $contract->department['dep_name'] }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('ชื่อสัญญา') }}</th>
                                    <td>{{ $contract->contract_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('บริษัทคู่สัญญา') }}</th>
                                    <td>{{ $contract->partners }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('มูลค่างานตามสัญญา') }}</th>
                                    <td>{{ number_format($contract->acquisition_value) . ' บาท' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('กองทุน') }}</th>
                                    <td>{{ $contract->fund }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="390">{{ __('ประเภทสัญญา') }}</th>
                                    <td>
                                        @if ($contract->contract_type === 1)
                                            สัญญาซื้อขาย
                                        @elseif ($contract->contract_type === 2)
                                            สัญญาจ้าง
                                        @elseif ($contract->contract_type === 3)
                                            สัญาเช่า
                                        @elseif ($contract->contract_type === 4)
                                            สัญญาอนุมัติให้ใช้สิทธิ์
                                        @elseif ($contract->contract_type === 5)
                                            บันทึกข้อตกลง
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('วันที่ในสัญญา') }}</th>
                                    <td>{!! \Carbon\Carbon::parse($contract->contract_date)->thaidate() !!}</td>
                                </tr>
                                @if ($contract->contract_type === 3)
                                    <tr>
                                        <th>{{ __('วันเริ่มสัญญา') }}</th>
                                        <td>{!! \Carbon\Carbon::parse($contract->start_date)->thaidate() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('วันสิ้นสุดสัญญา') }}</th>
                                        <td>{!! \Carbon\Carbon::parse($contract->end_date)->thaidate() !!}</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="390">{{ __('ชนิดหลักประกันสัญญา') }}</th>
                                    <td>
                                        @if ($contract->types_of_guarantee === 1)
                                            หลักประกันที่เป็นเงินสด
                                        @elseif ($contract->types_of_guarantee === 2)
                                            หลักประกันที่เป็นหนังสือค้ำประกัน
                                        @elseif ($contract->types_of_guarantee === 3)
                                            หลักประกันที่เป็นเช็คธนาคาร
                                        @elseif ($contract->types_of_guarantee === 4)
                                            หลักประกันที่เป็นพันธบัตรรัฐบาลไทย
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('มูลค่าหลักประกัน') }}</th>
                                    <td>{{ number_format($contract->guarantee_amount) . ' บาท คิดเป็นเปอร์เซ็นต์ ' . ($contract->guarantee_amount / $contract->acquisition_value) * 100 . '% ของมูลค่างานตามสัญญา' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>{{ __('ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา') }}</th>
                                    <td>
                                        @if ($contract->duration === 1)
                                            1 ปี
                                        @elseif ($contract->duration === 2)
                                            2 ปี
                                        @elseif ($contract->duration === 3)
                                            3 ปี
                                        @elseif ($contract->duration === 4)
                                            อื่น ๆ
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('เงื่อนไขการคืนหลักประกัน') }}</th>
                                    <td>
                                        @if ($contract->condition === 1)
                                            3 เดือน
                                        @elseif ($contract->condition === 2)
                                            6 เดือน
                                        @elseif ($contract->condition === 3)
                                            1 ปี
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="box-title">{{ __('ข้อมูลสัญญา') }}</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th width="390">{{ __('เลขที่สัญญา (นตก.)') }}</th>
                                <td>{{ $contract->contract_no . '/' . $contract->contract_year }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('หน่วยงานต้นเรื่อง') }}</th>
                                <td>{{ $contract->department['dep_name'] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('ชื่อสัญญา') }}</th>
                                <td>{{ $contract->contract_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('บริษัทคู่สัญญา') }}</th>
                                <td>{{ $contract->partners }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('มูลค่างานตามสัญญา') }}</th>
                                <td>{{ number_format($contract->acquisition_value) . ' บาท' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('กองทุน') }}</th>
                                <td>{{ $contract->fund }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h3 class="box-title">{{ __('รายละเอียดในสัญญา') }}</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th width="390">{{ __('ประเภทสัญญา') }}</th>
                                <td>
                                    @if ($contract->contract_type === 1)
                                        สัญญาซื้อขาย
                                    @elseif ($contract->contract_type === 2)
                                        สัญญาจ้าง
                                    @elseif ($contract->contract_type === 3)
                                        สัญาเช่า
                                    @elseif ($contract->contract_type === 4)
                                        สัญญาอนุมัติให้ใช้สิทธิ์
                                    @elseif ($contract->contract_type === 5)
                                        บันทึกข้อตกลง
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('วันที่ในสัญญา') }}</th>
                                <td>{!! \Carbon\Carbon::parse($contract->contract_date)->thaidate() !!}</td>
                            </tr>
                            @if ($contract->contract_type === 3)
                                <tr>
                                    <th>{{ __('วันเริ่มสัญญา') }}</th>
                                    <td>{!! \Carbon\Carbon::parse($contract->start_date)->thaidate() !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('วันสิ้นสุดสัญญา') }}</th>
                                    <td>{!! \Carbon\Carbon::parse($contract->end_date)->thaidate() !!}</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <h3 class="box-title">{{ __('ข้อมูลหลักประกันสัญญา') }}</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th width="390">{{ __('ชนิดหลักประกันสัญญา') }}</th>
                                <td>
                                    @if ($contract->types_of_guarantee === 1)
                                        หลักประกันที่เป็นเงินสด
                                    @elseif ($contract->types_of_guarantee === 2)
                                        หลักประกันที่เป็นหนังสือค้ำประกัน
                                    @elseif ($contract->types_of_guarantee === 3)
                                        หลักประกันที่เป็นเช็คธนาคาร
                                    @elseif ($contract->types_of_guarantee === 4)
                                        หลักประกันที่เป็นพันธบัตรรัฐบาลไทย
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('มูลค่าหลักประกัน') }}</th>
                                <td>{{ number_format($contract->guarantee_amount) . ' บาท คิดเป็นเปอร์เซ็นต์ ' . ($contract->guarantee_amount / $contract->acquisition_value) * 100 . '% ของมูลค่างานตามสัญญา' }}
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('ระยะเวลาค้ำประกันการปฏิบัติตามสัญญา') }}</th>
                                <td>
                                    @if ($contract->duration === 1)
                                        1 ปี
                                    @elseif ($contract->duration === 2)
                                        2 ปี
                                    @elseif ($contract->duration === 3)
                                        3 ปี
                                    @elseif ($contract->duration === 4)
                                        อื่น ๆ
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('เงื่อนไขการคืนหลักประกัน') }}</th>
                                <td>
                                    @if ($contract->condition === 1)
                                        3 เดือน
                                    @elseif ($contract->condition === 2)
                                        6 เดือน
                                    @elseif ($contract->condition === 3)
                                        1 ปี
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
