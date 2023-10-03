@extends('layouts.layout')
@section('title',__("Result"))
@section('meta')
<meta property="og:title" content="{{ __('My Result in') }} {{ $quiz->quiz_name}}">
<meta property="og:image" content="http://phplaravel-991000-3481149.cloudwaysapps.com{{$quiz->quiz_img}}">
@endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link"  href="{{route('quick-quiz.get_result' , ['answer_slug'=>$answer->slug,'lang'=>'en'] )}}" >English</a></li>
@else
<li class="navigation-item"><a class="navigation-link"  href="{{route('quick-quiz.get_result' , ['answer_slug'=>$answer->slug,'lang'=>'ar'] )}}" >عربي</a></li>
@endif
@endsection
@section('background') style="background-color:rgba(39, 42, 44, 0.95);" @endsection
@section('css')
<style>
    .crumina-faqs-block--without-border {
        padding: 10px !important;
    }

</style>
@endsection

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
<section class="crumina-stunning-header stunning-header-bg5 pb60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
                <div class="page-category">
                    <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
                </div>
                <h1 class="page-title text-white">{{ __("Your result on") }} {{ $quiz->quiz_name }}</h1>
            </div>
        </div>
    </div>
</section>
@endsection  --}}

@section('margin-top') style="margin-top: 130px;"@endsection
@section('content')
{{--  <div class="crumina-breadcrumbs breadcrumbs--orange-themes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ __('Your Result') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  --}}

{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->guest_result1)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->guest_result1 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}



<section class="large-section-padding section-bg2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                <h2>{{ __("Your result on") }} {{ $quiz->quiz_name }}</h2>
                <p class="fs-18 fw-medium">" {{ $answer->name }} "</p>

                @if($multiple_questions_counter > 0)
                    <p class="fs-18 fw-medium">{{ __('Your Result is : ') }} <b> <br>{{ $answer->results }} </b> {{ __('from') }} <b> {{ $quiz->grade }}.</p>

                        @if (!$quiz->hide_result_counter)
                            @php
                            if($answer->results !=0 && $quiz->grade != 0){
                                $resula_as_percentage_ = ($answer->results * 100 )/($quiz->grade);
                                $resula_as_percentage = number_format((float)$resula_as_percentage_, 2, '.', '');
                            }else{
                                $resula_as_percentage = 0;
                            }
                            @endphp
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="crumina-module crumina-skills-item skills-item--style-circle mb-4">
                                    <div class="skills-item-info">
                                        <span class="skills-item-title">{{ __('Your Result is : ') }}</span>
                                        <span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="{{ $resula_as_percentage }}" data-from="0"></span><span class="units">%</span></span>
                                    </div>
                                    <div class="skills-item-meter">
                                        <span class="skills-item-meter-active bg-orange-themes" style="width: {{ $resula_as_percentage }}%"></span>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if ($quiz->result_text)
                        <br>

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                               {{ $quiz->result_text }}
                                </div>
                            </div>
                        </div>
                        <br>
                        @endif
                @endif

                    @if($survey_questions_counter > 0)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 mb-md-0">
                        <div class="crumina-module crumina-faqs-block crumina-faqs-block--without-border section-bg1">
                            <div class="accordion crumina-module crumina-accordion accordion--style1 mt-5" id="accordion1">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button  class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                {{ __('Survey questions results') }}
                                                    <span class="icons">
                                                        <svg class="crumina-icon icon-plus"><use xlink:href="#icon-plus"></use></svg>
                                                        <svg class="crumina-icon active icon-minus"><use xlink:href="#icon-minus"></use></svg>
                                                    </span>
                                                </button>
                                            </h2>
                                        </div>

                                        <div  id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                                            <div class="card-body">
                                                @foreach ($survey_questions as $item )
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 justify-content-center">
                                                        <canvas id="chart-line{{ $item->id }}" style="height: 385px !important;" class="chartjs-render-monitor" ></canvas>
                                                    </div>
                                                </div>

                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                    <input type="hidden" id= "survey_questions_counter" value="{{ $survey_questions_counter }}">

                <a class="crumina-button button--yellow button--l mt-4" @if (App::isLocale('ar')) href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif >{{ __('Results') }} </a>


<br>
<br>
                @if (App::isLocale('ar'))

                <a class="crumina-button button--dark button--xxl button--uppercase button--bordered mt-4" href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}">{{ __('Back to Quiz') }}</a>
                @else
                <a class="crumina-button button--dark button--xxl button--uppercase button--bordered mt-4" href="{{route('quick-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}">{{ __('Back to Quiz') }}</a>
                @endif

                <br><br>
                <h2>{{ __('Share the quiz') }}</h2>
                <footer class="entry-footer">
                    <div class="entry-meta">
                        <ul class="socials socials--rounded">
                            <li><a id="facebook" @if (App::isLocale('ar')) href="{{ route('QQuiz_facebook_share', ['slug'=>$quiz->slug,'lang'=>'ar' ]) }}" @else href="{{ route('QQuiz_facebook_share', ['slug'=>$quiz->slug,'lang'=>'en' ]) }}"  @endif title="{{ __('Share it on Facebook') }}" target="_blank"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/facebook3.svg')}}" alt="facebook"></a></li>
                            <li><a id="twitter" @if (App::isLocale('ar'))  href="{{ route('QQuiz_twitter_share', ['slug'=>$quiz->slug,'lang'=>'ar' ]) }}" @else href="{{ route('QQuiz_twitter_share', ['slug'=>$quiz->slug,'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Twitter') }}"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/twitter2.svg')}}" alt="twitter"></a></li>
                            <li><a id="whatsapp" @if (App::isLocale('ar'))  href="{{ route('QQuiz_whatsapp_share', ['slug'=>$quiz->slug,'lang'=>'ar' ]) }}"  @else href="{{ route('QQuiz_whatsapp_share', ['slug'=>$quiz->slug,'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Whatsapp') }}" data-action="share/whatsapp/share" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/whatsapp2.svg')}}" alt="whatsapp"></a></li>

                            <li><a id="link_copy" href="#" data-toggle="modal" data-target="#modal_copy2" target="_blank" title="{{ __('Copy link') }}" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/copy.svg')}}" alt="copy"></a></li>
                        </ul>
                    </div>
                </footer>

            </div>
        </div>
    </div>
</section>
{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->guest_result2)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->guest_result2 !!}
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
                <h2>{{ __('Share your result') }}</h2>
                <footer class="entry-footer">
                        <ul class="socials socials--rounded">
                            <li><a id="facebook" @if (App::isLocale('ar')) href="{{ route('Qquizresult_facebook_share', ['answer_slug'=>$answer->slug ,'lang'=>'ar' ]) }}" @else  href="{{ route('Qquizresult_facebook_share', ['answer_slug'=>$answer->slug, 'lang'=>'en' ]) }}" @endif title="{{ __('Share it on Facebook') }}" target="_blank"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/facebook3.svg')}}" alt="facebook"></a></li>
                             <li><a id="twitter" @if (App::isLocale('ar'))  href="{{ route('Qquizresult_twitter_share', ['answer_slug'=>$answer->slug ,'lang'=>'ar' ]) }}" @else href="{{ route('Qquizresult_twitter_share', ['answer_slug'=>$answer->slug , 'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Twitter') }}"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/twitter2.svg')}}" alt="twitter"></a></li>
                             <li><a id="whatsapp" @if (App::isLocale('ar')) href="{{ route('Qquizresult_whatsapp_share', ['answer_slug'=>$answer->slug , 'lang'=>'ar' ]) }}" @else href="{{ route('Qquizresult_whatsapp_share', ['answer_slug'=>$answer->slug , 'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Whatsapp') }}" data-action="share/whatsapp/share" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/whatsapp2.svg')}}" alt="whatsapp"></a></li>
                            <li><a id="link_copy" href="#" data-toggle="modal" data-target="#modal_copy" target="_blank" title="{{ __('Copy link') }}" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/copy.svg')}}" alt="copy"></a></li>
                        </ul>
                    </div>
                </footer>

            </div>
        </div>
    </div>
</section>

<section class="large-section-padding">
    <div class="container">
        <br>
            <br>
        @if(App::isLocale('ar'))
        @if ($Usequizzes_ar->count() >0)

    <div class="row mb-5 align-center justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h2>{{ __('Almiqias Quizzes') }}</h2>
             {{-- <p class="fs-18 fw-medium">{{ __("Test yourself and Answer the Quiz") }}</p> --}}
        </div>
    </div>
    <div class="row sorting-container medium-section-padding " data-layout="fitRows" id="blogs-items">
        @foreach ($Usequizzes_ar as $quiz)
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb30 sorting-item creative" data-mh="blog-item">
            <article class="entry post post-standard has-post-thumbnail video ">
                <div class="post-thumb">
                    <img src="{{ asset($quiz->quiz_img) }}" alt="Almiqias" >
                </div>

                <div class="post-content">
                    <a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="post-title h6 text-center">{{ $quiz->quiz_name }}</a>

                    <div class="post-additional-info text-center">
                            <a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--lime button--l">{{ __("Start") }}</a>
                    </div>

                </div>

            </article>
        </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-center">
            <a @if(App::isLocale('ar')) href="{{route('all_usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_usersquizzes' , ['lang'=>'en'] )}}" @endif class="crumina-button button--primary button--l button--bordered">{{ __('LOAD MORE') }}</a>
        </div>
    @endif
    </div>
    @elseif(App::isLocale('en'))

    @if ($Usequizzes_en->count() >0)

    <br>
    <br>
    <br>
    <div class="row mb-5 align-center justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h2>{{ __('Almiqias Quizzes') }}</h2>
             {{-- <p class="fs-18 fw-medium">{{ __("Test yourself and Answer the Quiz") }}</p> --}}
        </div>
    </div>
    <div class="row sorting-container medium-section-padding " data-layout="fitRows" id="blogs-items">
        @foreach ($Usequizzes_en as $quiz)
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb30 sorting-item creative" data-mh="blog-item">
            <article class="entry post post-standard has-post-thumbnail video ">
                <div class="post-thumb">
                    <img src="{{ asset($quiz->quiz_img) }}" alt="Almiqias" >
                </div>

                <div class="post-content">
                    <a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="post-title h6 text-center">{{ $quiz->quiz_name }}</a>

                    <div class="post-additional-info text-center">
                            <a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--lime button--l">{{ __("Start") }}</a>
                    </div>

                </div>

            </article>
        </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-center">
            <a @if(App::isLocale('ar')) href="{{route('all_usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_usersquizzes' , ['lang'=>'en'] )}}" @endif class="crumina-button button--primary button--l button--bordered">{{ __('LOAD MORE') }}</a>
        </div>
    @endif
    </div>
    @endif


    </div>
</section>

@endsection
@section('modal')
<div class="modal fade window-popup popup-subscribe" id="modal_owner_name_multiple" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-modal="true">
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
                                <input class="input--grey input--squared required" type="text" id="input_for_name_multiple" placeholder="{{ __('Enter your name Please') }}" >
                                <p class="fs-14 fw-medium" id="p_for_msg_error_multiple" style="color:red"> </p>
                                <input id="input_for_lang_multiple" style="display: none" @if(App::isLocale('ar')) value="ar"  @else value="en" @endif >
                            </div>

                            <div class="form-item">
                                <button type="button" class="crumina-button button--green button--l w-100" onclick="open_create_multiple_quiz_page()" >{{ __("Create a multiple choices quiz") }}</button>
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
    function open_create_multiple_quiz_page(){
        var guests, cat, message, plocale;
            message = document.getElementById("p_for_msg_error_multiple");
            message.innerHTML = "";
            guests= document.getElementById("input_for_name_multiple").value;
            plocale= document.getElementById("input_for_lang_multiple").value;

        var url_open_create_multiple_quiz_page = BASE_URL + '/quick-quiz/create-multiple/'+guests+"/"+plocale;
            if (guests == null || guests == "") {
                message.innerHTML = "{{ __('you must enter your name') }}";
            }else{
                window.open(url_open_create_multiple_quiz_page, "_self");
            }
    }
</script>
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
<div class="modal fade window-popup popup-subscribe" id="modal_copy2" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-modal="true">
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
                            <input class="input--grey input--squared required" type="text" id="copy_input2" value="url;" dir="ltr" readonly>
                            <p class="fs-14 fw-medium" id="pcopy2" style="color:green"> </p>
                        </div>

                        <div class="form-item">
                            <button type="button" class="crumina-button button--green button--l w-100" onclick="copyToClipboard2()">{{ __("Copy link") }}</button>
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

<div class="modal fade window-popup popup-subscribe" id="modal_owner_name_survey" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-modal="true">
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
                                <input class="input--grey input--squared required" type="text" id="input_for_name_survey" placeholder="{{ __('Enter your name Please') }}" >
                                <p class="fs-14 fw-medium" id="p_for_msg_error_survey" style="color:red"> </p>
                                <input id="input_for_lang_survey" style="display: none" @if(App::isLocale('ar')) value="ar"  @else value="en" @endif >
                            </div>

                            <div class="form-item">
                                <button type="button" class="crumina-button button--green button--l w-100" onclick="open_create_survey_quiz_page()" >{{ __("Create a survey quiz") }}</button>
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
    function open_create_survey_quiz_page(){
        var guests, cat, message, plocale;
            message = document.getElementById("p_for_msg_error_survey");
            message.innerHTML = "";
            guests= document.getElementById("input_for_name_survey").value;
            plocale= document.getElementById("input_for_lang_survey").value;

        var url_open_create_survey_quiz_page = BASE_URL + '/quick-quiz/create-survey/'+guests+"/"+plocale;
            if (guests == null || guests == "") {
                message.innerHTML = "{{ __('you must enter your name') }}";
            }else{
                window.open(url_open_create_survey_quiz_page, "_self");
            }
    }
</script>



<script type="text/javascript">
var url=window.location.href;
// console.log(url);
url=url.toString();
var quiz_slug ='{{ $slug }}';
var plocale='{{$lang}}';

document.getElementById("copy_input").value = decodeURI(url);
document.getElementById("copy_input2").value = decodeURI("{{ URL::to('/') }}/quick-quiz/share/"+quiz_slug+"/"+plocale ,"_self") ;
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

function copyToClipboard2() {
    var copyText2 = document.getElementById("copy_input2");
    var pcopy2 = document.getElementById("pcopy2");
    copyText2.select();
    copyText2.setSelectionRange(0, 99999)
    document.execCommand("copy");
    pcopy2.innerHTML = "{{ __('Link Copied.') }}";
}
</script>
@endsection
@section('js')
<script src="{{ asset('asset1/js/js-plugins/jquery-countTo.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/waypoints.min.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
{{--  <script src="{{ asset('templete/pages/QuickQuizzes/user-result/scripts.blade.php') }}" type="text/javascript"></script>  --}}

@if($survey_questions_counter > 0)


@foreach ($survey_questions as $item )
@php
$options_texts = [];
$op = $item->options;
for ($i = 0; $i < $item->options->count(); $i++) {
    $options_texts[$i] = $op[$i]->option_text;
}
 @endphp

<script type="text/javascript">

 var question_id ='{{ $item->id }}';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = question_id;
    var type = "get";
    var ajaxurl = BASE_URL + "/quick-quiz/get/option/"+question_id;
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
            //console.log(data);
        var colors = ['#FFCD00','#E6E300','#9FF400','#00FF00','#00FF70','#00FFB9','#00FFFF']
        var ctx = $("#chart-line{{ $item->id }}");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.options_texts,
                datasets: [{
                    data: data.options_survey_counter,//[0,1,100],
                    label: "{{$item->question_text}}",
                    borderColor: colors[Math.floor(Math.random() * 5)],
                    backgroundColor: colors[Math.floor(Math.random() * 5)],
                    fill: false
                }]
            },
            options: {
                title: {
                    display: false,
                    text: '{{$item->question_text}}'
                }
            }
        });
        },
        error: function (data) {
            console.log(data);
        },
    });



</script>
@endforeach
@endif


@endsection
