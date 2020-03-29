@php
    use \Illuminate\Support\Facades\Auth;
    $adminPage = Route::is('admin.*');
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head')
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand d-inline-flex ml-2" href="#">
                <img src="{{ asset('img/icon.png') }}" width="60px" alt="">
                <div class="align-middle ml-1 my-auto" style="color: white; font-size: 30px">{{ config('app.name') }}</div>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 20px">
                <ul class="navbar-nav ml-auto text-center">
                    <li class="nav-item {{ Route::is('welcome') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('welcome') }}">Welcome</a>
                    </li>

                    @guest
                        <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item {{ Route::is('register') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                    @else
                        @if(Auth::check())
                            <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                            </li>
                        @endif

                        @permission('access-admin-page')
                            <li class="nav-item {{ $adminPage ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.default') }}">{{ __('Admin Page') }}</a>
                            </li>
                        @endpermission

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('change_password.edit') }}"
                                   onclick="event.preventDefault(); document.getElementById('change_password-form').submit();">
                                {{ __('Change Password') }}
                                </a>
                                <form id="change_password-form" action="{{ route('change_password.edit') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    @endguest

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Contact</a>
                    </li>
                </ul>
            </div>

        </nav>

        <main style="min-height: 100vh" class="{{ !Route::is('welcome') ? 'mt-4' : '' }}">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <section class="{{ !Route::is('welcome') ? 'mt-4' : '' }}" id="footer">
        <div class="container py-5">
            <div class="row text-center text-md-left">
                <div class="col-sm-12 col-md-4">
                    <h5>Quick links</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="{{ route('welcome') }}"><i class="fa fa-angle-double-right"></i>Welcome</a></li>
                        <li><a href="{{ route('home') }}"><i class="fa fa-angle-double-right"></i>Home</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-angle-double-right"></i>Join</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Contact</a></li>
                    </ul>
                    <hr class="d-md-none w-75" style="background-color: white;">
                </div>

                <div class="col-sm-12 col-md-4">
                    <h5>Info</h5>
                    <ul class="list-unstyled quick-links">
                        <li class="info">
                            <span class="fa fa-location-arrow"></span>
                            Head Office:
                            <p>Tunis,Tunisia</p>
                        </li>

                        <li class="info">
                            <span class="fa fa-phone"></span>
                            Phone Number
                            <p>+216 50 063 206</p>
                        </li>

                        <li class="info">
                            <span class="fa fa-envelope"></span>
                            Email
                            <p>mrigel789@gmail.com</p>
                        </li>
                    </ul>
                    <hr class="d-md-none w-75" style="background-color: white;">
                </div>

                <div class="col-sm-12 col-md-4">
                    <h5>Partners</h5>
                    <div class="container-fluid">
                        <ul class="list-unstyled row" style="height: 280px; overflow-y: auto">
                            <li class="col-12 col-md-6 mt-2">
                                <img src="{{ asset('img/partners/ajst.png') }}" width="180px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2">
                                <img src="{{ asset('img/partners/galaxy.png') }}" width="130px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2">
                                <img class="ml-2" src="{{ asset('img/partners/atg.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2">
                                <img src="{{ asset('img/partners/crt_megrine.png') }}" width="100px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2 pt-3">
                                <img class="ml-2" src="{{ asset('img/partners/jci_medina_s.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2 pt-4 pr-2">
                                <img class="ml-2" src="{{ asset('img/partners/jci_medina_j.png') }}" width="100px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2 pt-3 pr-2">
                                <img class="ml-2" src="{{ asset('img/partners/jci_riadhelmourouj.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2 pt-3 pr-2">
                                <img class="ml-2" src="{{ asset('img/partners/ucba.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2 pt-3 pr-2">
                                <img class="ml-2" src="{{ asset('img/partners/lctm.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2 pt-3 pr-2">
                                <img class="ml-2" src="{{ asset('img/partners/amspt.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2">
                                <img class="ml-2" src="{{ asset('img/partners/jokeresen.png') }}" width="120px" alt="sp1">
                            </li>

                            <li class="col-12 col-md-6 mt-2">
                                <img class="ml-2" src="{{ asset('img/partners/ajccm.png') }}" width="120px" alt="sp1">
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="footer-bottom">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                    <ul class="list-unstyled list-inline social text-center">
                        <li class="list-inline-item"><a href="https://www.facebook.com/Mriguel-192783471190682/"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="mailto: mrigel789@gmail.com" target="_blank"><i class="far fa-envelope"></i></a></li>
                    </ul>
                </div>
                </hr>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p class="h6">
                        Mriguel &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fas fa-heart"></i> by <a href="https://colorlib.com" style="color: #60bc0f;" target="_blank">Colorlib</a>
                    </p>
                </div>
                </hr>
            </div>
        </div>

    </section>
    <!-- ./Footer -->

    @stack('scripts')
</body>
</html>
