@extends('layouts.main')

@section('content')
    <div class="container-fluid mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Home</span>
                </li>
                <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
        </nav>
    </div>
    <div class="row g-4">
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาทั้งหมด') }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts_1) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาซื้อขาย') }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts_3) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาซื้อเช่า') }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts_2) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาจ้าง') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
