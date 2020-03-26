@extends('layouts.app')

@php
    $authTab = in_array(explode(".",Route::currentRouteName())[1], array('users', 'roles', 'permissions'));
@endphp

@section('head')
    <!-- Styles -->
    <link href="{{ asset('css/admin.css', App::environment('production')) }}" rel="stylesheet">
@endsection

@section('content')
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
            </div>

            <ul class="list-unstyled components">
                <p><i class="fas fa-tachometer-alt"></i> Dashboard</p>
                <li class="{{ Route::is('admin.dashboard.index') ? 'active' : '' }}">
                    <a href="{{ Route::is('admin.dashboard.index') ? '#' : route('admin.dashboard.index') }}"><i class="fas fa-chart-line"></i> General</a>
                </li>

                <li class="{{ $authTab ? 'active' : '' }}">
                    <a href="#authSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-shield-alt"></i> Auth</a>
                    <ul class="collapse list-unstyled" id="authSubmenu">
                        <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                            <a href="{{ Route::is('admin.users.index') ? '#' : route('admin.users.index') }}"><i class="fas fa-users"></i> Users</a>
                        </li>
                        <li class="{{ Route::is('admin.roles.index') ? 'active' : '' }}">
                            <a href="{{ Route::is('admin.roles.index') ? '#' : route('admin.roles.index') }}"><i class="fas fa-user-tag"></i> Roles</a>
                        </li>
                        <li class="{{ Route::is('admin.permissions.index') ? 'active' : '' }}">
                            <a href="{{ Route::is('admin.permissions.index') ? '#' : route('admin.permissions.index') }}"><i class="fas fa-wrench"></i> Permissions</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Route::is('admin.about') ? 'active' : '' }}">
                    <a href="#">About</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://github.com/AnisAbdellatif/covid19" class="download" target="_blank">View source</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
{{--                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                        <i class="fas fa-align-justify"></i>--}}
{{--                    </button>--}}

                    @yield('header-links')
{{--                    <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                        <ul class="nav navbar-nav ml-auto">--}}
{{--                            <li class="nav-item active">--}}
{{--                                <a class="nav-link" href="#">New</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Page</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Page</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Page</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </nav>
            @yield('panel')
        </div>
        @push('scripts')
            <script type="text/javascript">
                if ( "{{ $authTab }}" ) {
                    $('#authSubmenu').collapse();
                }
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });
            </script>
        @endpush
    </div>

@endsection
