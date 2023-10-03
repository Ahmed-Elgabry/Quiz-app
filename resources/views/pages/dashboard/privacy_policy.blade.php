@extends('layouts.layout')
@section('title',__("Privacy Policy"))
@section('meta')
<meta property="og:title" content="{{ __('Privacy Policy') }}" />
@endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"> <a href="{{route('privacy_policy' , ['lang'=>'en'] )}}" class="navigation-link">English</a> </li>
@else
<li class="navigation-item">  <a href="{{route('privacy_policy' , ['lang'=>'ar'] )}}" class="navigation-link">عربي</a> </li>
@endif
@endsection

@section('banner')
      <section class="crumina-stunning-header stunning-header-bg1 pb60">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div><br>
					<h1 class="page-title text-white">{{ __('Privacy Policy') }}</h1>
					<br><br>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('content')
<div class="crumina-breadcrumbs breadcrumbs--dark-themes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ __('Privacy Policy') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="large-section-padding bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 align-center ml-auto mr-auto mb-5">
                <h2>{{ __('Privacy Policy') }}</h2>
               </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="crumina-module crumina-faqs-block crumina-faqs-block--without-border tabs tabs--style7">
                        <div class="block-border-linear-gradient">
                            <div class="block-border-linear-gradient-top"></div>
                            <div class="block-border-linear-gradient-right"></div>
                            <div class="block-border-linear-gradient-bottom"></div>
                            <div class="block-border-linear-gradient-left"></div>
                        </div>
                    @if(App::isLocale('ar'))
                    <p> {!!$policy_ar!!}</p>
                    @else
                    <p> {!!$policy_en!!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

