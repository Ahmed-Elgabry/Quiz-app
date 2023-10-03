<!DOCTYPE html>

<html lang="{{ config('app.locale') }}" @if(App::isLocale('ar')) dir="rtl" @endif >

	<!-- begin::Head -->
	<head>

		<!--begin::Base Path (base relative path for assets of this page) -->
		<base href="../../../../">

		<!--end::Base Path -->
		<meta charset="utf-8" />
		<title> @yield('title' , __("Sign In")) </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

       {{-- @if(App::isLocale('ar'))
            {{-- <meta name="og:site_name" content="{{ App\Models\Settings::first()->sitename_ar }}" /> --}}
             {{-- <meta name="og:title" content="{{ App\Models\Settings::first()->sitename_ar }}" /> --}}
             {{-- <meta name="og:description" content="{{ App\Models\Settings::first()->description_ar }}" /> --}}
        {{-- @else --}}
        {{-- <meta name="og:site_name" content="{{ App\Models\Settings::first()->sitename_en }}" /> --}}
        {{-- <meta name="og:title" content="{{ App\Models\Settings::first()->sitename_en }}" /> --}}
        {{-- <meta name="og:description" content="{{ App\Models\Settings::first()->description_en }}" /> --}}
        {{-- @endif --}}

        <meta name="og:type" content="website" />
        @if(App::isLocale('ar'))
        <meta name="og:url" content="{{route('home' , ['lang'=>'ar'] )}}" />
        @else
        <meta name="og:url" content="{{route('home' , ['lang'=>'en'] )}}" />
        @endif


        {{-- <meta name="og:image" content="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" /> --}}
        @yield('meta')
		<!--begin::Fonts -->
		{{--  <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">  --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/fonts/droidarabickufi.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset1/fonts/tajawal.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		<!--end::Fonts -->

        @yield('css')

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="{{ asset('assets/css/demo1/pages/login/login-4.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="./assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<link href="./assets/vendors/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

        <!--end:: Global Optional Vendors -->

        <!--begin::Global Theme Styles(used by all pages) -->
        <link @if(App::isLocale('ar')) href="{{ asset('assets/css/demo1/style_.bundle.rtl.css') }}" @else href="{{ asset('assets/css/demo1/style_.bundle.css') }}" @endif  rel="stylesheet" type="text/css" />
        {{-- <link href="{{ asset('assets/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/demo1/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" /> --}}

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{ asset('assets/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body @if(App::isLocale('ar')) style="font-family: 'Droid Arabic Kufi', serif;" @endif class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(./assets/media/bg/bg-3.jpg);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
							<div class="kt-login__container">
									<div class="kt-login__logo">
                                        {{-- @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif>
                                            <img alt="almiqias" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" class="m-img-logo-style">
										</a> --}}
									</div>

							@yield('content')
                            <div class="kt-login__account">
                                    @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif class="kt-login__account-link">{{ __("Back to Home") }}</a>
                            </div>
							<div class="kt-login__account">
									<a href="{{ route('language' , ['ar']) }}" class="kt-login__account-link"> عربي</a> | <a href="{{ route('language' , ['en']) }}" class="kt-login__account-link">English</a>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

        <!--begin:: Global Mandatory Vendors -->
		<script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Gbal Optional Vendors -->
		<script src="{{ asset('assets/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/bootstrap-switch.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/typeahead.js/dist/typeahead.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/bootstrap-markdown.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/bootstrap-notify.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{ asset('assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="{{ asset('assets/js/demo1/pages/login/login-general.js') }}" type="text/javascript"></script>
        @yield('js')
        @stack('javaS')
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>
