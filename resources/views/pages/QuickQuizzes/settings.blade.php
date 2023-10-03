@extends('layouts.layout')
@section('title',__("Quick Quiz Settings"))
@section('meta')
<meta property="og:title" content="{{ __('Settings of') }} {{$quiz->quiz_name}}">
<meta property="og:image" content="http://phplaravel-991000-3481149.cloudwaysapps.com{{$quiz->quiz_img}}">
@endsection

@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link"  href="{{route('quick-quiz.settings_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" >English</a></li>
@else
<li class="navigation-item"><a class="navigation-link"  href="{{route('quick-quiz.settings_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" >عربي</a></li>
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

{{--  @section('banner')
<section class="crumina-stunning-header stunning-header-bg1 pb60">
    <div class="container">
        <div class="row justify-content-center align-center">
            <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
                <div class="page-category">
                    <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
                </div>
                <h1 class="page-title text-white">{{ __("Quick Quiz Settings") }}</h1>
            </div>
        </div>
    </div>
</section>
@endsection  --}}

@section('content')
{{--  <div class="crumina-breadcrumbs breadcrumbs--red">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ __('Quick Quiz Settings') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  --}}
{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->share_quiz1)
@section('margin-top') style="margin-top: 130px;"@endsection
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->share_quiz1 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}
<section class="large-section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 m-auto">
                <h2 class="align-center mb-5">{{ __('Quick Quiz Settings') }}</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                        {{session('success')}}
                        </div>
                    @endif

                    <form class="form--bordered" method="post" novalidate action="{{route('quick-quiz.do_settings_quiz' , ['slug'=>$quiz->slug] )}}">
                        @csrf
                    <h6 class="form-title-with-border">{{ __('Settings') }}</h6>
                    <div class="input--with-icon input--icon-right">
                        <div class="checkbox mb30 text-center">
                            <label><input type="checkbox" name="hide_score_counter" @if ($quiz->hide_result_counter) checked @endif >{{ __('Hide score counter') }}</label>
                            @error('hide_score_counter')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="input--with-icon input--icon-right">
                        <label>{{ __('Result page text') }}:</label>
                        <textarea class="input--grey input--squared" name="result_text" type="text" placeholder="{{ __('write a text that appears on the result page ...') }}">{{ $quiz->result_text }}</textarea>
                        @error('result_text')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>

                    <div class="input--with-icon input--icon-right text-center">
                        <button type="submit" class="crumina-button button--primary button--l">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="large-section-padding section-bg1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">

                    {{--  <img class="mb-4 " loading="lazy" src="{{ asset('asset1/img/demo-content/images/image12.png')}}" alt="almiqias">  --}}
                <h2>{{ __('Quick Quiz Settings') }} {{ __('for quiz owner') }} "{{ $quiz->owner_name }}"</h2>
                @if (App::isLocale('ar'))
                <a class="crumina-button button--lime button--xl mt-4" href="{{route('quick-quiz.quick_access' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}">{{ __("Quick Access Page") }} </a>
                @else
                <a class="crumina-button button--lime button--xl mt-4" href="{{route('quick-quiz.quick_access' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}">{{ __("Quick Access Page") }}</a>
                @endif

                @if (App::isLocale('ar'))
                <a class="crumina-button button--primary button--xl button--bordered mt-4" href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}">{{ __("Back to the quiz") }} </a>
                @else
                <a class="crumina-button button--primary button--xl button--bordered mt-4" href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}">{{ __("Back to the quiz") }}</a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->share_quiz2)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->share_quiz2 !!}
        </div>
        </div>
    </div>
</div>
@endif
{{--End DIV for Ads --}}
@endsection
