@extends('layouts.layout')
@section('title', $quiz->quiz_name )
@section('meta')
<meta property="og:title" content="{{$quiz->quiz_name}}">
<meta property="og:image" content="http://phplaravel-991000-3481149.cloudwaysapps.com{{$quiz->quiz_img}}">
@endsection

@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link"  href="{{route('user-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" >English</a></li>
@else
<li class="navigation-item"><a class="navigation-link"  href="{{route('user-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" >عربي</a></li>
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
      <section class="crumina-stunning-header stunning-header-bg9 pb60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
						<a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div>
                    <h1 class="page-title text-white">  {{ $quiz->quiz_name}}</h1>
                    <div class="author-block">
						<div class="author-content text-center">
							<div class="description text-white">{{ __('Posted by') }}</div>
							<a  class="author-name text-white">{{ $name}}</a>
						</div>
					</div>
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
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ $quiz->quiz_name}}</span>
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
@if (($quiz->is_private == "عام" || $quiz->is_private == "Public"))
<section class="large-section-padding section-bg2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                <h2>{{$quiz->quiz_name}}</h2>
                <p class="fs-18 fw-medium">{{ __('this quiz created by') }} "{{ $name}}"  .</p><a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--dark button--l mt-4">{{ __("Start") }}</a>
                <a class="crumina-button button--primary button--l mt-4" @if (App::isLocale('ar')) href="{{route('user-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif >{{ __('Results') }} </a>
            </div>
        </div>
    </div>
</section>

<section class="large-section-padding section-bg1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                <img class="mb-4 " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon30.png')}}" alt="almiqias">
                <h2>{{ __('Share the quiz') }}</h2>
                <footer class="entry-footer">
                    <div class="entry-meta">

                        <ul class="socials socials--rounded">
                            <li><a id="facebook" @if (App::isLocale('ar')) href="{{ route('UQuiz_facebook_share', ['slug'=>$quiz->slug,'lang'=>'ar' ]) }}" @else href="{{ route('UQuiz_facebook_share', ['slug'=>$quiz->slug,'lang'=>'en' ]) }}"  @endif title="{{ __('Share it on Facebook') }}" target="_blank"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/facebook3.svg')}}" alt="facebook"></a></li>
                             <li><a id="twitter" @if (App::isLocale('ar'))  href="{{ route('UQuiz_twitter_share', ['slug'=>$quiz->slug,'lang'=>'ar' ]) }}" @else href="{{ route('UQuiz_twitter_share', ['slug'=>$quiz->slug,'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Twitter') }}"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/twitter2.svg')}}" alt="twitter"></a></li>
                             <li><a id="whatsapp" @if (App::isLocale('ar'))  href="{{ route('UQuiz_whatsapp_share', ['slug'=>$quiz->slug,'lang'=>'ar' ]) }}"  @else href="{{ route('UQuiz_whatsapp_share', ['slug'=>$quiz->slug,'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Whatsapp') }}" data-action="share/whatsapp/share" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/whatsapp2.svg')}}" alt="whatsapp"></a></li>
                            <li><a id="link_copy" href="#" data-toggle="modal" data-target="#modal_copy" target="_blank" title="{{ __('Copy link') }}" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/copy.svg')}}" alt="copy"></a></li>
                        </ul>
                    </div>
                </footer>

            </div>
        </div>
    </div>
</section>
@else
<section class="large-section-padding section-bg2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                {{--  <h2>{{ __('It is a private Quiz for the user, you can not able to see it !') }}</h2>  --}}
                <p class="fs-18 fw-medium">{{ __('It is a private Quiz for the user, you can not able to see it !') }}</p>

                @auth
                <a class="crumina-button button--lime button--l mt-4" href="{{ URL::to('/') }}/u/dashboard">{{ __('Join us and Create your own Quiz') }}</a>
                @else
                <a class="crumina-button button--lime button--l mt-4" href="{{ route('register') }}">{{ __('Join us and Create your own Quiz') }}</a>
                @endauth

            </div>
        </div>
    </div>
</section>
@endif
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

@section('modal')
<div class="modal fade window-popup popup-subscribe" id="modal_copy" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                    <div class="form-group has-error">
                        <div class="form-item">
                            <h5 class="fw-medium">{{ __('Copy link') }}</h5>
                        </div>
                        <div class="form-item">
                            {{-- <label class="control-label" for="firstname">{{ __('Copy link') }} :</label> --}}
                            <input class="input--grey input--squared required" type="text" id="copy_input" value="url;" dir="ltr" readonly>
                            <p class="fs-14 fw-medium" id="pcopy" style="color:green"> </p>
                        </div>

                        <div class="form-item">
                            <button type="button" class="crumina-button button--green button--l w-100" onclick="copyToClipboard()">{{ __("Copy link") }}</button>
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
var url=window.location.href;
url=url.toString();
document.getElementById("copy_input").value = decodeURI(url);
</script>

<script type="text/javascript">
function copyToClipboard() {
    var copyText = document.getElementById("copy_input");
    var pcopy = document.getElementById("pcopy");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    {{-- toastr.success('Link Copied !'); --}}
    pcopy.innerHTML = "{{ __('Link Copied.') }}";
}
</script>
@endsection
