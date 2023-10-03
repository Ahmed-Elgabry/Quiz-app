@extends('layouts.general_layout')
@section('title' , __("Almiqias"))
@section('css')
<style>
    @media (min-width: 0) {
        .kt-header-menu .kt-menu__nav > .kt-menu__item > .kt-menu__link .kt-menu__link-text {
            color: #9096b8;
        }
    }

    @media (min-width: 1025px){
        .kt-header .kt-header-menu .kt-menu__nav > .kt-menu__item > .kt-menu__link .kt-menu__link-text{
            color: white !important;
        }

        .kt-header-menu {
            margin: 0 280px 0 0 !important;
        }
    }

</style>

@endsection
@section('page')
<!-- begin::Body -->
<body @if(App::isLocale('ar')) style="font-family: 'Droid Arabic Kufi', serif;" @endif  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-page--loading">
    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}"> @else <a href="{{route('home' , ['lang'=>'en'] )}}"> @endif
                <h3 style="color:goldenrod;">{{ __('Almiqias') }}</h3>
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " style="background-color: #272a2c;">

                    <!-- begin:: Header Menu -->
                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                        <div class="kt-header-logo">
                            @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}"> @else <a href="{{route('home' , ['lang'=>'en'] )}}"> @endif
                                <h3 style="color:goldenrod;">{{ __('Almiqias') }}</h3>
                            </a>
                        </div>
                        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                            <ul class="kt-menu__nav">
                                <li class="kt-menu__item" >
                                    <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="kt-menu__link">
                                        <span class="kt-menu__link-text">{{ __('Home') }}</span></a>
                                </li>

                                <li class="kt-menu__item" >
                                    <a  @if(App::isLocale('ar')) href="{{route('all_usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_usersquizzes' , ['lang'=>'en'] )}}" @endif class="kt-menu__link ">
                                        <span class="kt-menu__link-text">{{ __('Quizzes ') }}</span></a>
                                </li>

                                <li class="kt-menu__item" >
                                    <a  href="{{route('user_quiz.create')}}" class="kt-menu__link "> <span class="kt-menu__link-text">{{ __('create your own quiz') }}</span></a>
                                </li>

                                <li class="kt-menu__item   kt-menu__item--active" >
                                    @if(App::isLocale('ar'))
                                    <a  href="{{route('quick-quiz.create' , ['name'=>$name,'lang'=>'ar'] )}}" class="kt-menu__link "><span class="kt-menu__link-text">{{ __('Create Quick Quiz') }}</span></a>
                                    @else
                                    <a  href="{{route('quick-quiz.create' , ['name'=>$name,'lang'=>'en'] )}}" class="kt-menu__link "><span class="kt-menu__link-text">{{ __('Create Quick Quiz') }}</span></a>
                                    @endif
                                </li>

                                <li class="kt-menu__item" >
                                    <a  @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif class="kt-menu__link ">
                                        <span class="kt-menu__link-text">{{ __('Articles') }}</span></a>
                                </li>

                                @yield('navbar')

                                @if (!auth()->user())
                                <li class="kt-menu__item" >
                                    <a  href="{{route('register')}}" class="kt-menu__link ">
                                        <span class="kt-menu__link-text">{{ __('Sign Up') }}</span></a>
                                </li>
                                @endif
                                @if (auth()->user())
                                <li class="kt-menu__item" >
                                    <a  href="{{route('dashboard')}}" class="kt-menu__link ">
                                        <span class="kt-menu__link-text">{{ __('My Profile') }}</span></a>
                                </li>
                                @else

                                <li class="kt-menu__item" >
                                    <a  href="{{route('login')}}" class="kt-menu__link ">
                                        <span class="kt-menu__link-text">{{ __('Sign in') }}</span></a>
                                </li>
                                @endif




                            </ul>
                        </div>
                    </div>

                    <!-- end:: Header Menu -->
                </div>

                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <!-- begin:: Subheader -->
                    @yield('subheader')
                    <!-- end:: Subheader -->

                    <!-- begin:: Content -->
                    @yield('content')
                    <!-- end:: Content -->

                    <!-- begin:: Content -->
                    @yield('modals')
                    <!-- end:: Content -->
                </div>


                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            {{ __("Copyright")}} &copy; 2021 {{ __("Almiqias") }} | {{ __("All rights Reserved.") }}
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>

    <!-- end:: Page -->


    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- end::Scrolltop -->
@endsection

