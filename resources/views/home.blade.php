@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>Home</span>
                </li>
                <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
        </nav>
    </div>

    {{-- <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ count($contracts) . __(' รายการ') }}
                        </div>
                        {{ __('สัญญาทั้งหมด') }}
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('contracts.index') }}">Action</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70" width="224"
                        style="display: block; box-sizing: border-box; height: 70px; width: 224px;"></canvas>
                    <div class="chartjs-tooltip" style="opacity: 0; left: 56.6667px; top: 121.938px;">
                        <table style="margin: 0px;">
                            <thead class="chartjs-tooltip-header">
                                <tr class="chartjs-tooltip-header-item" style="border-width: 0px;">
                                    <th style="border-width: 0px;">February</th>
                                </tr>
                            </thead>
                            <tbody class="chartjs-tooltip-body">
                                <tr class="chartjs-tooltip-body-item">
                                    <td style="border-width: 0px;"><span
                                            style="background: rgb(51, 153, 255); border-color: rgba(255, 255, 255, 0.55); border-width: 2px; margin-right: 10px; height: 10px; width: 10px; display: inline-block;"></span>My
                                        First dataset: 18</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ count($contracts_1) . __(' รายการ') }}</div>
                        <div>{{ __('สัญญาซื้อขาย') }}</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="cil-options icon icon-xxl"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a
                                class="dropdown-item" href="#">Another action</a><a class="dropdown-item"
                                href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70" width="256"
                        style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
                    <div class="chartjs-tooltip" style="opacity: 0; left: 212.667px; top: 152.84px;">
                        <table style="margin: 0px;">
                            <thead class="chartjs-tooltip-header">
                                <tr class="chartjs-tooltip-header-item" style="border-width: 0px;">
                                    <th style="border-width: 0px;">June</th>
                                </tr>
                            </thead>
                            <tbody class="chartjs-tooltip-body">
                                <tr class="chartjs-tooltip-body-item">
                                    <td style="border-width: 0px;"><span
                                            style="background: rgba(255, 255, 255, 0.2); border-color: rgba(255, 255, 255, 0.55); border-width: 2px; margin-right: 10px; height: 10px; width: 10px; display: inline-block;"></span>My
                                        First dataset: 12</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ count($contracts_3) . __(' รายการ') }}</div>
                        <div>{{ __('สัญญาซื้อเช่า') }}</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="cil-options icon icon-xxl"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a
                                class="dropdown-item" href="#">Another action</a><a class="dropdown-item"
                                href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70" width="224"
                        style="display: block; box-sizing: border-box; height: 70px; width: 224px;"></canvas>
                    <div class="chartjs-tooltip" style="opacity: 0; left: 233px; top: 104.6px;">
                        <table style="margin: 0px;">
                            <thead class="chartjs-tooltip-header">
                                <tr class="chartjs-tooltip-header-item" style="border-width: 0px;">
                                    <th style="border-width: 0px;">April</th>
                                </tr>
                            </thead>
                            <tbody class="chartjs-tooltip-body">
                                <tr class="chartjs-tooltip-body-item">
                                    <td style="border-width: 0px;"><span
                                            style="background: rgba(255, 255, 255, 0.2); border-color: rgba(255, 255, 255, 0.55); border-width: 2px; margin-right: 10px; height: 10px; width: 10px; display: inline-block;"></span>My
                                        First dataset: 82</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ count($contracts_2) . __(' รายการ') }}
                        </div>
                        <div>{{ __('สัญญาจ้าง') }}</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="cil-options icon icon-xxl"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70" width="224"
                        style="display: block; box-sizing: border-box; height: 70px; width: 224px;"></canvas>
                </div>
            </div>
        </div>
    </div> --}}
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
                    {{-- <div class="progress progress-white progress-thin mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div> --}}
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts_1) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาซื้อขาย') }}</div>
                    {{-- <div class="progress progress-white progress-thin mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div> --}}
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts_3) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาซื้อเช่า') }}</div>
                    {{-- <div class="progress progress-white progress-thin mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div> --}}
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="text-white text-opacity-75 text-end">
                        <i class="bi bi-tag fs-1"></i>
                    </div>
                    <div class="fs-4 fw-semibold">{{ count($contracts_2) . __(' รายการ') }}</div>
                    <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">
                        {{ __('สัญญาจ้าง') }}</div>
                    {{-- <div class="progress progress-white progress-thin mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div> --}}
                </div>
            </div>
        </div>
        {{-- <div class="col-6 col-lg-4 col-xl-3 col-xxl-3">
          <div class="card text-white bg-danger">
            <div class="card-body">
              <div class="text-white text-opacity-75 text-end">
                <i class="bi bi-tag fs-1"></i>
              </div>
              <div class="fs-4 fw-semibold">5:34:11</div>
              <div class="small text-white text-opacity-75 text-uppercase fw-semibold text-truncate">Avg. Time</div>

            </div>
          </div>
        </div> --}}
    </div>


    {{-- <div class="table-responsive">
        <table class="table border mb-0">
            <thead class="table-light fw-semibold">
                <tr class="align-middle">
                    <th class="text-center">
                        <i class="bi bi-people"></i>
                    </th>
                    <th>User</th>

                    <th>Usage</th>

                    <th>Activity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td class="text-center">
                        <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/1.jpg"
                            alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td>
                        <div>Yiorgos Avraamu</div>
                        <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>

                    <td>
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="fw-semibold">50%</div>
                            </div>
                            <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small>
                            </div>
                        </div>
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>

                    <td>
                        <div class="small text-medium-emphasis">Last login</div>
                        <div class="fw-semibold">10 sec ago</div>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">

                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a
                                    class="dropdown-item text-danger" href="#">Delete</a></div>
                        </div>
                    </td>
                </tr>
                <tr class="align-middle">
                    <td class="text-center">
                        <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/2.jpg"
                            alt="user@email.com"><span class="avatar-status bg-danger"></span></div>
                    </td>
                    <td>
                        <div>Avram Tarasios</div>
                        <div class="small text-medium-emphasis"><span>Recurring</span> | Registered: Jan 1, 2020</div>
                    </td>

                    <td>
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="fw-semibold">10%</div>
                            </div>
                            <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small>
                            </div>
                        </div>
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>

                    <td>
                        <div class="small text-medium-emphasis">Last login</div>
                        <div class="fw-semibold">5 minutes ago</div>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">

                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a
                                    class="dropdown-item text-danger" href="#">Delete</a></div>
                        </div>
                    </td>
                </tr>
                <tr class="align-middle">
                    <td class="text-center">
                        <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/3.jpg"
                                alt="user@email.com"><span class="avatar-status bg-warning"></span></div>
                    </td>
                    <td>
                        <div>Quintin Ed</div>
                        <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>

                    <td>
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="fw-semibold">74%</div>
                            </div>
                            <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small>
                            </div>
                        </div>
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 74%"
                                aria-valuenow="74" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>

                    <td>
                        <div class="small text-medium-emphasis">Last login</div>
                        <div class="fw-semibold">1 hour ago</div>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">

                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a
                                    class="dropdown-item text-danger" href="#">Delete</a></div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div> --}}
@endsection
