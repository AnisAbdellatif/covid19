@php
    use \Illuminate\Support\Facades\Auth;
    $adminPage = Route::is('admin.*');
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scrollbar">
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
                        <a class="nav-link" href="{{ route('welcome') }}">{{ __('Welcome') }}</a>
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
                        <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>

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
                <div class="col-sm-12 col-md-4 mx-auto">
                    <h5>{{ __('Quick links') }}</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="{{ route('welcome') }}"><i class="fa fa-angle-double-right"></i>{{ __('Welcome') }}</a></li>
                        <li><a href="{{ route('home') }}"><i class="fa fa-angle-double-right"></i>{{ __('Home') }}</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-angle-double-right"></i>{{ __("Join US") }}</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Contact</a></li>
                    </ul>
                    <hr class="d-md-none w-75" style="background-color: white;">
                </div>

                <div class="col-sm-12 col-md-4 mx-auto">
                    <h5>{{ __('Info') }}</h5>
                    <ul class="list-unstyled quick-links">
                        <li class="info">
                            <span class="fa fa-location-arrow"></span>
                            {{ __('Head Office') }}:
                            <p>Tunis,Tunisia</p>
                        </li>

                        <li class="info">
                            <span class="fa fa-phone"></span>
                            {{ __('Phone Number') }}:
                            <p>+216 50 063 206</p>
                        </li>

                        <li class="info">
                            <span class="fa fa-envelope"></span>
                            {{ __('Email Address') }}
                            <p>mrigel789@gmail.com</p>
                        </li>
                    </ul>
                    <hr class="d-md-none w-75" style="background-color: white;">
                </div>

                <div class="col-sm-12">
                    <h5>{{ __('Partners') }}</h5>
                    <div class="container">
                        @push('scripts')
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
                            <script !src="">
                                $('.partners-logos').slick({
                                    slidesToShow: 6,
                                    slidesToScroll: 1,
                                    autoplay: true,
                                    autoplaySpeed: 1500,
                                    arrows: false,
                                    dots: false,
                                    pauseOnHover: false,
                                    responsive: [{
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: 4
                                        }
                                    }, {
                                        breakpoint: 520,
                                        settings: {
                                            slidesToShow: 3
                                        }
                                    }]
                                });
                            </script>
                        @endpush

                        <section class="partners-logos slider">
                            <div class="slide"><img src="{{ asset('img/partners/ajst.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/galaxy.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/atg.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/crt_megrine.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/jci_medina_s.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/jci_medina_j.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/jci_riadhelmourouj.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/ucba.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/lctm.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/amspt.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/jokeresen.png') }}"></div>
                            <div class="slide"><img src="{{ asset('img/partners/ajccm.png') }}"></div>
                        </section>
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
