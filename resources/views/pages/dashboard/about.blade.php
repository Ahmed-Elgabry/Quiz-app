@extends('layouts.layout')
@section('title',__("About"))
@section('meta') <meta property="og:title" content="{{ __('About') }}" /> @endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"> <a href="{{route('about' , ['lang'=>'en'] )}}" class="navigation-link">English</a> </li>
@else
<li class="navigation-item"> <a href="{{route('about' , ['lang'=>'ar'] )}}" class="navigation-link">عربي</a> </li>
@endif
@endsection
@section('banner')
<section class="crumina-stunning-header stunning-header-bg3 pb60">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
                <div class="page-category">
                    <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white">{{ __('Home') }}</a>
                </div><br>
                <h1 class="page-title text-white">{{ __('WHO ARE WE?') }}</h1>
                <br>
                <br>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<div class="crumina-breadcrumbs breadcrumbs--red-themes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ __('About us') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="large-section-padding">
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4 mb-md-0">
            <img loading="lazy" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" alt="almiqias">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="row mt-5">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4 mb-lg-0">
                    <div class="crumina-module crumina-info-box info-box--standard">
                        <div class="info-box-thumb">
                            <img loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon14.png') }}" alt="almiqias" width="100px" height="101px">
                        </div>
                        <?php  $setting = \App\Models\Settings::first(); ?>
                        <div class="info-box-content">
                            <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif class="h5 info-box-title">{{ __('Articles') }}</a>
                            <p class="info-box-text">
                            @if(App::isLocale('ar'))
                                {{ $setting->aboutUs_Articles_text_ar}}
                            @else
                                {{ $setting->aboutUs_Articles_text_en }}
                            @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="crumina-module crumina-info-box info-box--standard">
                        <div class="info-box-thumb">
                            <img loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon3.png') }}" alt="almiqias" >
                        </div>
                        <div class="info-box-content">
                            <a @if(App::isLocale('ar')) href="{{route('usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('usersquizzes' , ['lang'=>'en'] )}}" @endif class="h5 info-box-title">{{ __('Quizzes') }}</a>
                            <p class="info-box-text">
                                @if(App::isLocale('ar'))
                                {{ $setting->aboutUs_text_ar}}
                            @else
                                {{ $setting->aboutUs_text_en }}
                            @endif</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->about1)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->about1 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 crumina-promo-block bg-accent-primary align-center">
                <img class="mb-4 " loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon27.png') }}" alt="almiqias">

                <h2 class="text-white">{{ __('CONTACT TO OUR AWESOME SUPPORT TEAM') }}</h2>
                <p class="text-white fs-18 fw-medium">{{ __('Let’s keep in touch') }}</p>
                <a  @if(App::isLocale('ar')) <a href="{{route('contact' , ['lang'=>'ar'] )}}" @else <a href="{{route('contact' , ['lang'=>'en'] )}}" @endif class="crumina-button button--lime button--l mt-4">{{ __('LET’S CONTACT') }}</a>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 crumina-promo-block bg-yellow-themes align-center">


                <img class="mb-4 " loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon28.png') }}" alt="almiqias">

                <h2>{{ __('JOIN US') }}</h2>
                <p class="fs-18 fw-medium">{{ __('Join us. you’ll create your own Quizzes and share it on your social media.') }}</p>
               <a  href="{{ route('register') }}" class="crumina-button button--dark button--l mt-4">{{ __('SIGN UP') }}</a>


            </div>
        </div>
    </div>
</section>
@endsection

