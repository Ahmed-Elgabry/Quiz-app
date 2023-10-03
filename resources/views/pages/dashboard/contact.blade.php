@extends('layouts.layout')
@section('title',__("Contact"))
@section('meta')
<meta property="og:title" content="{{ __('Contact') }}" />
@endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"> <a href="{{route('contact' , ['lang'=>'en'] )}}" class="navigation-link">English</a> </li>
@else
<li class="navigation-item">  <a href="{{route('contact' , ['lang'=>'ar'] )}}" class="navigation-link">عربي</a> </li>
@endif
@endsection

@section('banner')
      <section class="crumina-stunning-header stunning-header-bg9 pb60">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div><br>
					<h1 class="page-title text-white">{{ __('Contact us') }}</h1>
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
                        <span>{{ __('Contact us') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->contact1)
<div class="sorting-section-js section-bg1">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->contact1 !!}
        </div>
        </div>
    </div>
</div>
@endif
{{--End DIV for Ads --}}
<section class="large-section-padding section-bg1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                <img class="mb-4 " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon30.png')}}" alt="almiqias">
                <h2>{{ __('Follow us on') }}</h2>
                <footer class="entry-footer">
                    <div class="entry-meta">
                        <ul class="socials socials--rounded">
                             <li><a id="facebook" href="{{ \App\Models\Settings::first()->facebook }}" title="facebook" target="_blank"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/facebook3.svg')}}" alt="facebook"></a></li>
                             <li><a id="twitter" href="{{ \App\Models\Settings::first()->twitter }}" title="twitter" target="_blank" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/twitter2.svg')}}" alt="twitter"></a></li>
                             <li><a id="instagram" href="{{ \App\Models\Settings::first()->instagram }}" title="instagram" target="_blank" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/instagram2.svg')}}" alt="instagram"></a></li>
                             <li><a id="snapshat" href="{{ \App\Models\Settings::first()->snapshat }}" title="snapshat" target="_blank" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/snapchat.svg')}}" alt="snapshat"></a></li>

                           </ul>
                    </div>
                </footer>

            </div>
        </div>
    </div>
</section>
<section class="large-section-padding bg-yellow-themes">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 align-center mb-4 mb-lg-0">
                <h2>{{ __('CONTACT TO OUR AWESOME SUPPORT TEAM') }}</h2>
                {{-- <p class="fs-18 fw-medium">Join Our Newsletter & Marketing Communication. We'll send you news and offers.</p> --}}

                    <div class="input-btn--inline">
                        <input class="input--white text-center" type="email" value="{{ \App\Models\Settings::first()->email }}" readonly>
                    </div>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


                <img loading="lazy" src="{{ asset('../asset1/img/demo-content/images/image13.png')}}" alt="almiqias">

            </div>
        </div>
    </div>
</section>

</div>
@endsection

