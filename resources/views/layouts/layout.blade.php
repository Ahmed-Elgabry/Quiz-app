@include('js-localization::head')
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" @if(App::isLocale('ar')) dir="rtl" @endif>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

	<title>@yield('title','Home')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />

       @if(App::isLocale('ar'))
            {{-- <meta name="og:site_name" content="{{ App\Models\Settings::first()->sitename_ar }}" /> --}}
             {{-- <meta name="og:title" content="{{ App\Models\Settings::first()->sitename_ar }}" /> --}}
             {{-- <meta name="og:description" content="{{ App\Models\Settings::first()->description_ar }}" /> --}}
        @else
        <meta name="og:site_name" content="{{ App\Models\Settings::first()->sitename_en }}" />
        <meta name="og:title" content="{{ App\Models\Settings::first()->sitename_en }}" />
        <meta name="og:description" content="{{ App\Models\Settings::first()->description_en }}" />
        @endif

        <meta name="og:type" content="website" />
        @if(App::isLocale('ar'))
        <meta name="og:url" content="{{route('home' , ['lang'=>'ar'] )}}" />
        @else
        <meta name="og:url" content="{{route('home' , ['lang'=>'en'] )}}" />
        @endif
        {{-- <meta name="og:image" content="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" /> --}}

        @yield('meta')
        @yield('css')

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    {{--  <link @yield('title','Home')css/plugins/navigation.min.css') }}" rel="stylesheet">  --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/plugins/navigation.min.css') }}">

        @if(App::isLocale('ar'))
        {{--  <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">  --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/fonts/droidarabickufi.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/fonts/tajawal.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/vendors/Bootstrap/bootstrap.rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/main.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/rtl.min.css') }}">
        @else

        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/theme-font.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/vendors/Bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/main.min.css') }}">
        @endif

        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

        <script data-ad-client="ca-pub-8083085385088514" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<body @if(App::isLocale('ar'))  style="font-family: 'Droid Arabic Kufi', serif;" @endif>
<!-- Main Header -->

<nav id="navigation" class="site-header navigation navigation-justified header--sticky" @yield('background')>
	<div class="container">
		<div class="navigation-header">
			<div class="navigation-logo">
                {{-- <a @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif>
					<img loading="lazy" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" alt="almiqias">
				</a> --}}
			</div>
			<div class="navigation-button-toggler">
				<i class="hamburger-icon"></i>
			</div>
		</div>
		<div class="navigation-body">
			<div class="navigation-body-header">
				<div class="navigation-logo">
                    {{-- <a @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif>
                        <img loading="lazy" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" alt="almiqias">
                    </a> --}}
                </div>
				<span class="navigation-body-close-button">&#10005;</span>
            </div>

			<ul class="navigation-menu">
                <li class="navigation-item"><a class="navigation-link"  @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a> </li>
                <li class="navigation-item"><a class="navigation-link"  @if(App::isLocale('ar')) href="{{route('all_usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_usersquizzes' , ['lang'=>'en'] )}}" @endif >{{ __('Quizzes ') }}</a></li>
                <li class="navigation-item"><a class="navigation-link"  href="{{route('dashboard')}}">{{ __('create your own quiz') }}</a> </li>
                <li class="navigation-item"><a class="navigation-link"  href="#" data-toggle="modal" data-target="#modal_owner_name">{{ __('Create a quick quiz') }}</a> </li>
                <li class="navigation-item"><a class="navigation-link"  @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif >{{ __('Articles') }}</a> </li>
				@yield('navbar')
                @if (!auth()->user())
				<li class="navigation-item"><a class="navigation-link" href="{{ route('register') }}"  >{{ __('Sign Up') }}</a> </li>
                @endif
                @if (auth()->user())
				<li class="navigation-item"><a class="navigation-link" href="{{ route('dashboard') }}"  >{{ __('My Profile') }}</a> </li>
                @else
                <li class="navigation-item"><a class="navigation-link" href="{{ route('login') }}"  >{{ __('Sign in') }}</a> </li>
                @endif
            </ul>
            <div class="navigation-body-section navigation-additional-menu">
                <div class="navigation-search">
                    @yield('search')
                </div>
            </div>

		</div>
	</div>
</nav>

<!-- ... end Main Header -->

@yield('search_modal')

<div class="main-content-wrapper">

	    @yield('banner')
        <div @yield('margin-top')>
            @yield('content')
        </div>
</div>

@yield('modal')
<div class="modal fade window-popup popup-subscribe" id="modal_owner_name" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                        <div class="form-group has-error">
                            {{--  <div class="form-item">
                                <h5 class="fw-medium">{{ $quiz->quiz_name}}</h5>
                            </div>  --}}
                            <div class="form-item">
                                <label class="control-label" for="firstname">{{ __('Enter your name Please') }} :</label>
                                <input class="input--grey input--squared required" type="text" id="input_for_name" placeholder="{{ __('Enter your name Please') }}" >
                                <p class="fs-14 fw-medium" id="p_for_msg_error" style="color:red"> </p>
                                <input id="input_for_lang" style="display: none" @if(App::isLocale('ar')) value="ar"  @else value="en" @endif >
                            </div>

                            <div class="form-item">
                                <button type="button" class="crumina-button button--green button--l w-100" onclick="open_create_quick_quiz_page()" >{{ __("Create Quick Quiz") }}</button>
                            </div>
                        </div>

                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    {{ __("Close") }}
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function open_create_quick_quiz_page(){
        var guests, cat, message, plocale;
            message = document.getElementById("p_for_msg_error");
            message.innerHTML = "";
            guests= document.getElementById("input_for_name").value;
            plocale= document.getElementById("input_for_lang").value;

        var url_open_create_quick_quiz_page = BASE_URL + '/quick-quiz/create/'+guests+"/"+plocale;
            if (guests == null || guests == "") {
                message.innerHTML = "{{ __('you must enter your name') }}";
            }else{
                window.open(url_open_create_quick_quiz_page, "_self");
            }
    }
</script>


<!-- Footer -->

<footer id="site-footer" class="footer footer--dark footer--with-decoration">
    @yield('footer-content')
	<div class="sub-footer bg-black">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mb-0 mb-lg-0">
					<div class="copyright">
                        {{ __("Copyright")}} &copy; {{ now()->year }} {{ __("Almiqias") }} | {{ __("All rights Reserved.") }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<a class="back-to-top" href="#">
		<svg class="crumina-icon">
			<use xlink:href="#icon-to-top"></use>
		</svg>
	</a>
</footer>

<!-- ... end Footer -->
@yield('js-localization.head')

<script>var BASE_URL = @json(url('/'));</script>
<script src="{{ asset('asset1/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset1/js/responsive-paginate.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset1/js/Bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/navigation.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/material.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/swiper.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/jquery.matchHeight.min.js') }}"></script>
<script src="{{ asset('asset1/js/main.js') }}"></script>
<!-- SVG icons loader -->
<script src="{{ asset('asset1/js/svg-loader.js') }}""></script>

@yield('js')

</body>
</html>
