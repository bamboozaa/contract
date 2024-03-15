@extends('layouts.app')

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



        </div>

        <div class="card-footer">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
@endsection
