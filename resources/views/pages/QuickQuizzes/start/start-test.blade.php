@extends('layouts.layout')
@section('title', $quiz->quiz_name)
@section('meta')
<meta property="og:title" content="{{$quiz->quiz_name}}">
<meta property="og:image" content="http://phplaravel-991000-3481149.cloudwaysapps.com{{$quiz->quiz_img}}">
@endsection
@section('navbar')
@if(App::isLocale('ar'))
            <li class="navigation-item"> <a  href="{{route('quick-quiz.start_test' , ['slug'=>$quiz->slug , 'lang'=>'en'] )}}" class="navigation-link">English</a> </li>
            @else
            <li class="navigation-item"> <a href="{{route('quick-quiz.start_test' , ['slug'=>$quiz->slug, 'lang'=>'ar'] )}}" class="navigation-link">عربي</a> </li>
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
@endsection

{{--  @section('banner')
      <section class="crumina-stunning-header stunning-header-bg3 pb60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
						<a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div>
					<h1 class="page-title text-white"> {{ $quiz->quiz_name }}</h1>
				</div>
			</div>
		</div>
	</section>
@endsection  --}}

@section('content')
{{--  <div class="crumina-breadcrumbs breadcrumbs--dark-themes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                        <span class="crumina-icon">»</span>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span> {{ $quiz->quiz_name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  --}}

<section class="large-section-padding">

        {{-- DIV for Ads --}}
        @if (\App\Models\Ads::first()->do_quiz1)
        @section('margin-top') style="margin-top: 130px;"@endsection
        <div class="sorting-section-js">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                {!! \App\Models\Ads::first()->do_quiz1 !!}
                </div>
                </div>
            </div>
        </div>
        @endif
        {{--End DIV for Ads --}}
        <br>
    <div id ="tag_container" class="container">
        @include('pages.QuickQuizzes.start.start-test-ajax')
        <input id="plocale" style="display: none" @if(App::isLocale('ar')) value="ar"  @else value="en" @endif >
         </div>
    {{-- DIV for Ads --}}
    @if (\App\Models\Ads::first()->do_quiz2)
    <div class="sorting-section-js">
        <div class="container">
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            {!! \App\Models\Ads::first()->do_quiz2 !!}
            </div>
            </div>
        </div>
    </div>
    @endif
    <input id="counter_" type="hidden" value="{{ $counter }}">
    <input id="quiz_slug" type="hidden" value="{{ $quiz->slug }}">

    {{--End DIV for Ads --}}
</section>
@endsection
@section('js')
<!-- include BlockUI -->
<script src="{{ asset('assets/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ asset('templete/pages/QuickQuizzes/start-test/scripts.js') }}" type="text/javascript"></script>
@endsection
