<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="bi bi-speedometer fs-4 me-4"></i>
            <h4>{{ __('Dashboard') }}</h4>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Users') }}
        </a>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('About us') }}
        </a>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('contracts.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">
            <i class="bi bi-pass-fill fs-4 me-4"></i>
            <h4>{{ __('รายการสัญญา') }}</h4>
        </a>
    </li>

    {{-- <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Two-level menu
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Child menu
                </a>
            </li>
        </ul>
    </li> --}}
</ul>
