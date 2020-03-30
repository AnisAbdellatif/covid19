@extends('layouts.app')

@php
    use App\User;
@endphp

@section('head')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<!--================ Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner">
        <div class="container">
            <div class="banner_content">
                <p class="upper_text">@lang('welcomePage.bannerTop')</p>
                <h2>@lang('welcomePage.bannerMid')</h2>
                <p>
                    @lang('welcomePage.bannerBot')
                </p>
            </div>
        </div>
    </div>
</section>
<!--================ End Home Banner Area =================-->

<!--================ Start Causes Area =================-->
<section id="causes" class="causes_area">
    <div class="container">
        <div class="main_title">
            <h2>@lang('welcomePage.causesTitle')</h2>
{{--            <p>Creepeth called face upon face yielding midst is after moveth </p>--}}
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_causes">
                    <h4>@lang('welcomePage.cause1Title')</h4>
                    <img src="{{ asset('img/causes/c4.png') }}" width="95" height="95" alt="">
                    <p>
                        @lang('welcomePage.cause1Body')
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_causes">
                    <h4>@lang('welcomePage.cause2Title')</h4>
                    <img src="{{ asset('img/causes/c2.png') }}" alt="">
                    <p>
                        @lang('welcomePage.cause2Body')
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_causes">
                    <h4>@lang('welcomePage.cause3Title')</h4>
                    <img src="{{ asset('img/causes/c1.png') }}" alt="">
                    <p>
                        @lang('welcomePage.cause3Body')
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Causes Area =================-->

<!--================ Start About Us Area =================-->
<section class="about_area section_gap_bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 text-center about_left">
                <div class="about_thumb h-100" style="display: flex; align-items: center; flex-wrap: wrap;">
                    <img src="{{ asset('img/nonprofit.png') }}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 about_right">
                <div class="about_content">
                    <h2>
                        @lang('welcomePage.noProfit')
                    </h2>
                    <p style="font-size: 30px">
                        @lang('welcomePage.noProfitSub')
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End About Us Area =================-->

<!--================ Start Features Cause section =================-->
<section class="features_causes"  style="padding: unset">
    <div class="container">
        <div class="main_title">
            <h2>{{ __('Available registration forms') }}:</h2>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <figure>
                            <img class="card-img-top img-fluid" src="{{ asset('img/features/normal_user.jpg') }}" alt="Card image cap">
                        </figure>
                        <div class="card_inner_body">
                            <h4 class="card-title">{{ __('Normal User') }}</h4>
                            <p class="card-text">
                                <ul class="list-group" style="font-size: 22px">
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> You get to ask for resources that will be delivered to your location.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> You can ask the doctors for information.</li>
                                </ul>
                            </p>

                            <div class="d-flex justify-content-between donation align-items-center mt-4">
                                <a href="{{ route('register', ['type' => 'default']) }}" class="primary_btn">{{ __("Join US") }}</a>
                                <p><span class="lnr lnr-heart"></span> {{ User::group('default')->get()->count() }} {{ __('Users') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <figure>
                            <img class="card-img-top img-fluid" src="{{ asset('img/features/volunteer.jpg') }}" alt="Card image cap">
                        </figure>
                        <div class="card_inner_body">
                            <h4 class="card-title">{{ __('Volunteer') }}</h4>
                            <p class="card-text">
                                <ul class="list-group" style="font-size: 22px">
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Help people get their needs.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Go out and buy whatever is missing for people.</li>
                                </ul>
                            </p>

                            <div class="d-flex justify-content-between donation align-items-center mt-5">
                                <a href="{{ route('register', ['type' => 'volunteer']) }}" class="primary_btn">{{ __("Join US") }}</a>
                                <p><span class="lnr lnr-heart"></span> {{ User::group('volunteer')->get()->count() }} {{ __('Users') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <figure>
                            <img class="card-img-top img-fluid" style="height: 350px" src="{{ asset('img/features/doctor.jpg') }}" alt="Card image cap">
                        </figure>
                        <div class="card_inner_body">
                            <h4 class="card-title">{{ __('Doctor') }} ({{ __('Volunteer') }})</h4>
                            <p class="card-text">
                                <ul class="list-group" style="font-size: 22px">
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Aware People and answer their questions.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Help possible victims that might catch the virus.</li>
                                </ul>
                            </p>

                            <div class="d-flex justify-content-between donation align-items-center mt-5">
                                <a href="{{ route('register', ['type' => 'doctor']) }}" class="primary_btn">{{ __("Join US") }}</a>
                                <p><span class="lnr lnr-heart"></span> {{ User::group('doctor')->get()->count() }} {{ __('Users') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Features Cause section =================-->

<!--================Team Area =================-->
<section class="team_area section_gap" style="padding-top: 50px">
    <div class="container">
        <div class="main_title">
            <h2>{{ __('Meet our Team') }}</h2>
        </div>
        <div class="row team_inner mb-2">
            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" style="height: 255px" src="{{ asset('img/team/Amin_Zribi.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Amin Zribi</h4>
                        <p>Community Manager</p>

                        <div class="social">
                            <a href="https://www.facebook.com/amine.zribi.9" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" src="{{ asset('img/team/Anis_Abdellatif.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Anis Abdellatif</h4>
                        <p>Web Developer</p>

                        <div class="social">
                            <a href="https://www.facebook.com/anis.abdellatif.57"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="https://twitter.com/anis_abdellatif" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="https://www.instagram.com/anis_abdellatif200/"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="mailto: anisabdellatif57@gmail.com"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" src="{{ asset('img/team/Anis_Ouerhani.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Anis Ouerhani</h4>
                        <p>Designer</p>

                        <div class="social">
                            <a href="https://www.facebook.com/anis.ouerhani.39" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" src="{{ asset('img/team/Med_Rayen.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Med Rayen Hosni</h4>
                        <p>Social Media Manager</p>

                        <div class="social">
                            <a href="https://www.facebook.com/sami.hosni.75" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="https://www.instagram.com/rayen4391/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" src="{{ asset('img/team/Rayen_Sboui.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Rayen Sboui</h4>
                        <p>Relationships Manager</p>

                        <div class="social">
                            <a href="https://www.facebook.com/sboui.rayen" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="https://www.instagram.com/rayen1sboui/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" src="{{ asset('img/team/Reema_Diab.jpg') }}" width="255px" style="max-height: 255px" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Reema Diab</h4>
                        <p>CEO of Galaxy organisation</p>

                        <div class="social">
                            <a href="https://www.facebook.com/reema.diab.3" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" style="height: 255px" src="{{ asset('img/team/Yassine_Metoui.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Yassine Metoui</h4>
                        <p>Project Manager</p>

                        <div class="social">
                            <a href="https://www.facebook.com/yassine.metoui" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="https://twitter.com/Ym2454003663" target="_blank" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="https://www.instagram.com/metoui24/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="javascript:void();" target="_blank"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================End Team Area =================-->

<!--================ Start CTA Area =================-->
<div class="cta-area section_gap overlay">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h1>{{ __('Want to jump right in and help us defend our case?') }}</h1>
{{--                <p>--}}
{{--                    So seed seed green that winged cattle in. Gathering thing made fly you're--}}
{{--                    divided deep leave on the medicene moved us land years living.--}}
{{--                </p>--}}
                <a href="{{ route('register') }}" class="primary_btn yellow_btn rounded">{{ __("Join US") }}</a>
            </div>
        </div>
    </div>
</div>
<!--================ End CTA Area =================-->

@endsection
