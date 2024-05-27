@extends('layouts.app')
@section('title', 'Create Contract')

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
                <li class="breadcrumb-item active" aria-current="page">{{ __('Display Contract') }}</li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h3 class="box-title mt-5">General Info</h3>
        <div class="table-responsive">
            <table class="table table-striped table-product">
                <tbody>
                    <tr>
                        <td width="390">Brand</td>
                        <td>Stellar</td>
                    </tr>
                    <tr>
                        <td>Delivery Condition</td>
                        <td>Knock Down</td>
                    </tr>
                    <tr>
                        <td>Seat Lock Included</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>Office Chair</td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>Contemporary&amp;Modern</td>
                    </tr>
                    <tr>
                        <td>Wheels Included</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Upholstery Included</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Upholstery Type</td>
                        <td>Cushion</td>
                    </tr>
                    <tr>
                        <td>Head Support</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Suitable For</td>
                        <td>Study&amp;Home Office</td>
                    </tr>
                    <tr>
                        <td>Adjustable Height</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Model Number</td>
                        <td>F01020701-00HT744A06</td>
                    </tr>
                    <tr>
                        <td>Armrest Included</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Care Instructions</td>
                        <td>Handle With Care,Keep In Dry Place,Do Not Apply Any Chemical For Cleaning.</td>
                    </tr>
                    <tr>
                        <td>Finish Type</td>
                        <td>Matte</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    @endsection
