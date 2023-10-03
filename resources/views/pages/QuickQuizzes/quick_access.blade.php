@extends('layouts.layout')
@section('title',__("Quick Access"))
@section('meta')
<meta property="og:title" content="{{ __('Quick Access') }}" />
<meta name="og:image" content="http://phplaravel-991000-3481149.cloudwaysapps.com{{$quiz->quiz_img}}">
@endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link"  href="{{route('quick-quiz.quick_access' , ['slug'=>$quiz->slug,'lang'=>'en'] )}}" >English</a></li>
@else
<li class="navigation-item"><a class="navigation-link"  href="{{route('quick-quiz.quick_access' , ['slug'=>$quiz->slug,'lang'=>'ar'] )}}" >عربي</a></li>
@endif
@endsection
@section('background') style="background-color:rgba(39, 42, 44, 0.95);" @endsection
@section('search')
<div class="link-modal-popup" data-toggle="modal" data-target="#popupSearch"></div>
        <svg class="crumina-icon">
            <use xlink:href="#icon-search"></use>
        </svg>
@endsection
@section('search_modal')
<!-- Popup Search -->

<div class="modal fade window-popup popup-search" id="popupSearch" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="modal-close-btn-wrapper">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
								<svg class="crumina-icon">
									<use xlink:href="#icon-close"></use>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="navigation-search-popup">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 m-auto">
								<h2 class="fw-medium text-white">{{ __('WHAT ARE YOU LOOKING FOR?') }}</h2>
								<form method="get" @if(App::isLocale('ar')) action="{{route('search' , ['lang'=>'ar'] )}}" @else  action="{{route('search' , ['lang'=>'en'] )}}"  @endif class="search-popup-form">
                                    @csrf
                                    <div class="input-btn--inline">
										<input  class="input--dark" name="search" type="text" placeholder="{{ __('Search') }}">
										<button type="submit" class="crumina-button button--primary button--l">{{ __("SEARCH") }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ... end Popup Search -->
@endsection
{{--
@section('banner')
      <section class="crumina-stunning-header stunning-header-bg7 pb60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
						<a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div>
					<h1 class="page-title text-white">{{ __("Quick Access Page") }}</h1>
				</div>
			</div>
		</div>
	</section>
@endsection
  --}}

@section('content')
{{--  <div class="crumina-breadcrumbs breadcrumbs--lime-themes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ __('Quick Access') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  --}}

{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->quick_access1)
@section('margin-top') style="margin-top: 130px;"@endsection
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->quick_access1 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}
<section class="large-section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 mb-4 mb-lg-0">
                <h2>{{ __("Quick Access Page") }}</h2>
            </div>
            @if($multiple_questions_counter > 0)
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <div class="crumina-module crumina-info-box info-box--align-left">

                    <div class="info-box-thumb">
                        <img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon30.png') }}" alt="Almiqias">
                    </div>
                    <div class="info-box-content">
                        <a class="h5 info-box-title" @if(App::isLocale('ar')) href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif>{{ __("Share the quiz") }} </a>
                        <p class="info-box-text">{{ __("share the quiz with whoever you want.") }}</p>
                        <br>
                        <a @if(App::isLocale('ar')) href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--lime button--xl w-100">{{ __("Share the quiz") }}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <div class="crumina-module crumina-info-box info-box--align-left">

                    <div class="info-box-thumb">
                        <img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon11.png')}}" alt="almiqias">
                    </div>

                    <div class="info-box-content">
                        <a @if (App::isLocale('ar')) href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="h5 info-box-title">{{ __('Results') }}</a>
                        <p class="info-box-text">{{ __("You can see the quiz results, and you can also rank them.") }}</p>
                        <a @if (App::isLocale('ar')) href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--yellow button--xl w-100">{{ __('Results') }}</a>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="crumina-module crumina-info-box info-box--align-left">

                    <div class="info-box-thumb">
                        <img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon1.png') }}" alt="almiqias">
                    </div>

                    <div class="info-box-content">
                        <a @if(App::isLocale('ar')) href="{{route('quick-quiz.settings_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.settings_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="h5 info-box-title">{{ __("Settings") }}</a>
                        <p class="info-box-text">{{ __("You can control the quiz settings.") }}</p>
                        <br>
                        <a @if(App::isLocale('ar')) href="{{route('quick-quiz.settings_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.settings_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--dark button--xl w-100">{{ __("Settings") }}</a>
                    </div>

                </div>
            </div>
            @else

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <div class="crumina-module crumina-info-box info-box--align-left">

                    <div class="info-box-thumb">
                        <img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon30.png') }}" alt="Almiqias">
                    </div>
                    <div class="info-box-content">
                        <a class="h5 info-box-title" @if(App::isLocale('ar')) href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif>{{ __("Share the quiz") }} </a>
                        <p class="info-box-text">{{ __("share the quiz with whoever you want.") }}</p>
                        <br>
                        <a @if(App::isLocale('ar')) href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--lime button--xl w-100">{{ __("Share the quiz") }}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <div class="crumina-module crumina-info-box info-box--align-left">

                    <div class="info-box-thumb">
                        <img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon11.png')}}" alt="almiqias">
                    </div>

                    <div class="info-box-content">
                        <a @if (App::isLocale('ar')) href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="h5 info-box-title">{{ __('Results') }}</a>
                        <p class="info-box-text">{{ __("You can see the quiz results, and you can also rank them.") }}</p>
                        <a @if (App::isLocale('ar')) href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--yellow button--xl w-100">{{ __('Results') }}</a>
                    </div>

                </div>
            </div>
            @endif


        </div>
    </div>
</section>

{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->quick_access2)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->quick_access2 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}
@endsection
