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
                <p class="upper_text">Give a hand</p>
                <h2>to make the better world</h2>
                <p>
                    Peaple need your help, so why don't you be
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
            <h2>Our major causes</h2>
            <p>Creepeth called face upon face yielding midst is after moveth </p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_causes">
                    <h4>Help People</h4>
                    <img src="{{ asset('img/causes/c4.png') }}" width="95" height="95" alt="">
                    <p>
                        We want to mange to help people through these hard times.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_causes">
                    <h4>Give Inspiration</h4>
                    <img src="{{ asset('img/causes/c2.png') }}" alt="">
                    <p>
                        We want to be an example for other associations and communities.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_causes">
                    <h4>Help the needy people</h4>
                    <img src="{{ asset('img/causes/c1.png') }}" alt="">
                    <p>
                        There are some people who can't afford even the basic necessities, and we decide to help those by collecting money for them.
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
            <div class="single_about row">
                <div class="col-lg-6 col-md-12 text-center about_left">
                    <div class="about_thumb">
                        <img src="{{ asset('img/nonprofit.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 about_right">
                    <div class="about_content">
                        <h2>
                            We are nonprofit team <br>
                            and work currently only in <span style="color: red">Tunisia</span> with plans to expand more.
                        </h2>
                        <p style="font-size: 30px">
                            Our goal won't and will never be profit.
                        </p>
                        <a href="#" class="primary_btn">Learn more</a>
                    </div>
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
            <h2>Featured causes</h2>
            <p>Creepeth called face upon face yielding midst is after moveth </p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <figure>
                            <img class="card-img-top img-fluid" src="{{ asset('img/features/normal_user.jpg') }}" alt="Card image cap">
                        </figure>
                        <div class="card_inner_body">
                            <h4 class="card-title">Normal User</h4>
                            <p class="card-text">
                                <ul class="list-group" style="font-size: 22px">
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> You get to ask for resources that will be delivered to your location.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> You can ask the doctors for information.</li>
                                </ul>
                            </p>
                            <div class="d-flex justify-content-between raised_goal">
                                <p>Number: {{ User::all()->filter(function ($user) {
                                                return $user->hasRole('default');
                                            })->count() }}</p>
{{--                                <p><span>Goal: $2500</span></p>--}}
                            </div>
                            <div class="d-flex justify-content-between donation align-items-center">
                                <a href="{{ route('register', ['type' => 'default']) }}" class="primary_btn">Join</a>
{{--                                <p><span class="lnr lnr-heart"></span> 90 Donors</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <figure>
                            <img class="card-img-top img-fluid" src="{{ asset('img/features/volunteer.png') }}" alt="Card image cap">
                        </figure>
                        <div class="card_inner_body">
                            <h4 class="card-title">Volunteer</h4>
                            <p class="card-text">
                                <ul class="list-group" style="font-size: 22px">
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Help people get their needs.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Go out and buy whatever is missing for people.</li>
                                </ul>
                            </p>
                            <div class="d-flex justify-content-between raised_goal">
                                <p>Number: {{ User::all()->filter(function ($user) {
                                                return $user->hasRole('volunteer');
                                            })->count() }}</p>
                            </div>
                            <div class="d-flex justify-content-between donation align-items-center">
                                <a href="{{ route('register', ['type' => 'volunteer']) }}" class="primary_btn">Join</a>
{{--                                <p><span class="lnr lnr-heart"></span> 90 Donors</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <figure>
                            <img class="card-img-top img-fluid" style="height: 350px" src="{{ asset('img/features/doctor.png') }}" alt="Card image cap">
                        </figure>
                        <div class="card_inner_body">
                            <h4 class="card-title">Doctor(Volunteer)</h4>
                            <p class="card-text">
                                <ul class="list-group" style="font-size: 22px">
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Aware People and answer their questions.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle"></i> Help possible victims that might catch the virus.</li>
                                </ul>
                            </p>
                            <div class="d-flex justify-content-between raised_goal">
                                <p>Number: {{ User::all()->filter(function ($user) {
                                                return $user->hasRole('doctor');
                                            })->count() }}</p>
{{--                                <p><span>Goal: $2500</span></p>--}}
                            </div>
                            <div class="d-flex justify-content-between donation align-items-center">
                                <a href="{{ route('register', ['type' => 'doctor']) }}" class="primary_btn">Join</a>
{{--                                <p><span class="lnr lnr-heart"></span> 90 Donors</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Features Cause section =================-->

<!--================ Start Recent Event Area =================-->

{{--<section class="event_area section_gap_custom">--}}
{{--    <div class="container">--}}
{{--        <div class="main_title">--}}
{{--            <h2>Upcoming events</h2>--}}
{{--            <p>Creepeth called face upon face yielding midst is after moveth </p>--}}
{{--        </div>--}}

{{--        <div class="row">--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="single_event">--}}
{{--                    <div class="row align-items-center">--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <figure>--}}
{{--                                <img class="img-fluid w-100" src="img/event/e1.jpg" alt="">--}}
{{--                                <div class="img-overlay"></div>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <div class="content_wrapper">--}}
{{--                                <h3 class="title">--}}
{{--                                    <a href="event-details.html">Working syrian childreen</a>--}}
{{--                                </h3>--}}
{{--                                <p>--}}
{{--                                    Be tree their face won't appear day to waters moved fourth in they're divide don't a you're were man.--}}
{{--                                </p>--}}
{{--                                <div class="d-flex count_time" id="clockdiv1">--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="days">552</h4>--}}
{{--                                        <p>Days</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="hours">08</h4>--}}
{{--                                        <p>Hours</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="minutes">45</h4>--}}
{{--                                        <p>Minutes</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="seconds">30</h4>--}}
{{--                                        <p>Seconds</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="primary_btn">Learn More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-6">--}}
{{--                <div class="single_event">--}}
{{--                    <div class="row align-items-center">--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <figure>--}}
{{--                                <img class="img-fluid w-100" src="img/event/e2.jpg" alt="">--}}
{{--                                <div class="img-overlay"></div>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <div class="content_wrapper">--}}
{{--                                <h3 class="title">--}}
{{--                                    <a href="event-details.html">Help and homelesness</a>--}}
{{--                                </h3>--}}
{{--                                <p>--}}
{{--                                    Be tree their face won't appear day to waters moved fourth in they're divide don't a you're were man.--}}
{{--                                </p>--}}
{{--                                <div class="d-flex count_time" id="clockdiv2">--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="days">552</h4>--}}
{{--                                        <p>Days</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="hours">08</h4>--}}
{{--                                        <p>Hours</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="minutes">45</h4>--}}
{{--                                        <p>Minutes</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="seconds">30</h4>--}}
{{--                                        <p>Seconds</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="primary_btn">Learn More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-6">--}}
{{--                <div class="single_event">--}}
{{--                    <div class="row align-items-center">--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <figure>--}}
{{--                                <img class="img-fluid w-100" src="img/event/e3.jpg" alt="">--}}
{{--                                <div class="img-overlay"></div>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <div class="content_wrapper">--}}
{{--                                <h3 class="title">--}}
{{--                                    <a href="event-details.html">Save the clean water</a>--}}
{{--                                </h3>--}}
{{--                                <p>--}}
{{--                                    Be tree their face won't appear day to waters moved fourth in they're divide don't a you're were man.--}}
{{--                                </p>--}}
{{--                                <div class="d-flex count_time" id="clockdiv3">--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="days">552</h4>--}}
{{--                                        <p>Days</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="hours">08</h4>--}}
{{--                                        <p>Hours</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="minutes">45</h4>--}}
{{--                                        <p>Minutes</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="seconds">30</h4>--}}
{{--                                        <p>Seconds</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="primary_btn">Learn More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-6">--}}
{{--                <div class="single_event">--}}
{{--                    <div class="row align-items-center">--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <figure>--}}
{{--                                <img class="img-fluid w-100" src="img/event/e4.jpg" alt="">--}}
{{--                                <div class="img-overlay"></div>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <div class="content_wrapper">--}}
{{--                                <h3 class="title">--}}
{{--                                    <a href="event-details.html">Foods for poor childreen</a>--}}
{{--                                </h3>--}}
{{--                                <p>--}}
{{--                                    Be tree their face won't appear day to waters moved fourth in they're divide don't a you're were man.--}}
{{--                                </p>--}}
{{--                                <div class="d-flex count_time" id="clockdiv4">--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="days">552</h4>--}}
{{--                                        <p>Days</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="hours">08</h4>--}}
{{--                                        <p>Hours</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="mr-25">--}}
{{--                                        <h4 class="minutes">45</h4>--}}
{{--                                        <p>Minutes</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="seconds">30</h4>--}}
{{--                                        <p>Seconds</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="primary_btn">Learn More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

{{--<!--================ End Recent Event Area =================-->--}}



<!--================Team Area =================-->
<section class="team_area section_gap" style="padding-top: 50px">
    <div class="container">
        <div class="main_title">
            <h2>Meet our Team</h2>
{{--            <p>Creepeth called face upon face yielding midst is after moveth </p>--}}
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
{{--                        <p class="mt-20">--}}
{{--                            So seed seed green that winged cattle in kath  moved us land years living.--}}
{{--                        </p>--}}
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fas fa-envelope-square fa-2x"></i></a>
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
{{--                        <p class="mt-20">--}}
{{--                            So seed seed green that winged cattle in kath  moved us land years living.--}}
{{--                        </p>--}}
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fas fa-envelope-square fa-2x"></i></a>
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
{{--                        <p class="mt-20">--}}
{{--                            So seed seed green that winged cattle in kath  moved us land years living.--}}
{{--                        </p>--}}
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fas fa-envelope-square fa-2x"></i></a>
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
{{--                        <p class="mt-20">--}}
{{--                            So seed seed green that winged cattle in kath  moved us land years living.--}}
{{--                        </p>--}}
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fas fa-envelope-square fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row team_inner">

            <div class="col-lg-3 col-md-6">
                <div class="team_item">
                    <div class="team_img">
                        <img class="img-fluid" src="{{ asset('img/team/Rayen_Sboui.jpg') }}" alt="">
                    </div>
                    <div class="team_name">
                        <h4>Rayen Sboui</h4>
                        <p>Relationships Manager</p>
{{--                        <p class="mt-20">--}}
{{--                            So seed seed green that winged cattle in kath  moved us land years living.--}}
{{--                        </p>--}}
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fas fa-envelope-square fa-2x"></i></a>
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
{{--                        <p class="mt-20">--}}
{{--                            So seed seed green that winged cattle in kath  moved us land years living.--}}
{{--                        </p>--}}
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a href="#" class=""><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fas fa-envelope-square fa-2x"></i></a>
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
                <h1>Become a volunteer</h1>
                <p>
                    So seed seed green that winged cattle in. Gathering thing made fly you're
                    divided deep leave on the medicene moved us land years living.
                </p>
                <a href="{{ route('register') }}" class="primary_btn yellow_btn rounded">join us</a>
            </div>
        </div>
    </div>
</div>
<!--================ End CTA Area =================-->

@endsection
