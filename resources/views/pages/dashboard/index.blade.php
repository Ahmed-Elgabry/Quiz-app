@extends('layouts.layout')
@section('title',__("Almiqias"))
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link" href="{{route('home' , ['lang'=>'en'] )}}" >English</a> </li>
@else
<li class="navigation-item"><a class="navigation-link" href="{{route('home' , ['lang'=>'ar'] )}}" >عربي</a></li>
@endif
@endsection
@section('background') style="background-color:rgba(39, 42, 44, 0.95);" @endsection
{{--  @section('banner')
    <section class="crumina-module crumina-module-slider crumina-main-slider">
        <!--Prev next buttons-->

        <div class="swiper-btn-prev">
            <svg class="crumina-icon">
                <use xlink:href="#icon-prev"></use>
            </svg>
        </div>

        <div class="swiper-btn-next">
            <svg class="crumina-icon">
                <use xlink:href="#icon-next"></use>
            </svg>
        </div>

        <div class="swiper-container" data-effect="fade" data-show-items="1" data-change-handler="thumbsParent" data-prev-next="1" data-autoplay="4000">

            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide stunning-header-bg9">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="slider-content">

                                    <h2 class="slider-content-title" data-swiper-parallax="-100" >{{ __("Almiqias allows you to create your own Quizzes and share them with whoever you want, in addition to many features and services") }}</h2>

                                    <p class="slider-content-text" data-swiper-parallax="-200">{{ __("Create your quiz now") }}</p>

                                    <div class="universal-btn-wrapper align-items-center justify-content-center">
                                        <a href="#" data-toggle="modal" data-target="#modal_owner_name" class="crumina-button button--yellow button--l">{{ __('Create a quick quiz') }}</a>
                                        <a href="{{route('dashboard')}}" class="crumina-button button--red button--l">{{ __('create your own quiz') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide stunning-header-bg3">

                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4 mb-lg-0 align-left">
                                <div class="slider-content">

                                    <h2 class="slider-content-title" data-swiper-parallax="-100">{{ __("Create your Quiz now,  share it with whoever you want") }}</h2>

                                    <p class="slider-content-text" data-swiper-parallax="-200">{{ __("Create your quiz now") }}</p>

                                    <div class="universal-btn-wrapper align-items-center justify-content-center">
                                        <a href="#" data-toggle="modal" data-target="#modal_owner_name_survey" class="crumina-button button--yellow button--l">{{ __('Create a survey quiz') }}</a>
                                        <a href="#" data-toggle="modal" data-target="#modal_owner_name_multiple" class="crumina-button button--red button--l">{{ __('Create a multiple choices quiz') }}</a>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="slider-thumb" data-swiper-parallax="-400" data-swiper-parallax-duration="600">
                                    <img class="swiper-lazy" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" alt="almiqias">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="swiper-slide stunning-header-bg5">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 mb-lg-0">

                                <div class="slider-content">

                                    <h2 class="slider-content-title" data-swiper-parallax="-100">{{ __('Follow the latest articles on our blog') }}</h2>

                                    <p class="slider-content-text" data-swiper-parallax="-200">{{ __('Almiqias provides you topics and statistical information from various fields') }}</p>

                                    <div class="universal-btn-wrapper align-items-center justify-content-center">
                                        <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif class="crumina-button button--yellow button--l">{{ __("Our Blog") }}</a>
                                    </div>

                                </div>

                                <div class="slider-thumb" data-swiper-parallax="-400" data-swiper-parallax-duration="600">
                                    <img class="swiper-lazy" src="{{ asset('asset1/img/demo-content/images/our-video.png') }}" alt="almiqias">
                                    <div class="swiper-lazy-preloader"></div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!--Pagination tabs-->

            <div class="slider-slides">
                <div class="container">
                    <div class="row">
                        <div class="slider-slides-wrap">
                            <div class="slides-item slides-item-red">
                                <span class="slides-item-text"></span>
                            </div>
                            <div class="slides-item slides-item-orange">
                                <span class="slides-item-text"></span>
                            </div>
                            <div class="slides-item slides-item-yellow">
                                <span class="slides-item-text"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection  --}}

@section('content')
{{--  <section class="large-section-padding">
    <div class="container">
        <div class="row mb-5 align-center justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>{{ __('Articles') }}</h2>
                 <p class="fs-18 fw-medium">{{ __('Almiqias provides you topics and statistical information from various fields') }}</p>
            </div>
        </div>
        @if(App::isLocale('ar'))
          <div class="row sorting-container medium-section-padding" data-layout="fitRows" id="blogs-items">
            @foreach ($Article_ar as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb30 sorting-item creative" data-mh="blog-item">
                <article class="entry post post-standard has-post-thumbnail video">

                    <div class="post-thumb">
                        <img src="{{ asset($item->image) }}" alt="Almiqias" >
                    </div>

                    <div class="post-content">
                        <a href="{{ route('view_article', ['slug'=>$item->slug, 'lang'=>'ar' ]) }}" class="post-title h6">{{ $item->title}}</a>

                        <div class="post-text">
                            @php
                            $stritem = $item->content;
                            $str = strip_tags($stritem);
                            if (strlen($str) > 120) {
                                $stringCut = substr($str,0,120);
                                $str = substr($stringCut,0,strrpos($stringCut, ' ')).'...';
                            }
                         @endphp
                         <p>{{$str}}</p>
                        </div>
                    </div>

                </article>
            </div>
            @endforeach
        </div>
          @else
          <div class="row sorting-container medium-section-padding" data-layout="fitRows" id="blogs-items">
            @foreach ($Article_en as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb30 sorting-item creative" data-mh="blog-item">
                <article class="entry post post-standard has-post-thumbnail video">

                    <div class="post-thumb">
                        <img src="{{ asset($item->image) }}" alt="Almiqias" >
                    </div>

                    <div class="post-content">
                        <a href="{{ route('view_article', ['slug'=>$item->slug, 'lang'=>'en' ]) }}" class="post-title h6">{{ $item->title}}</a>

                        <div class="post-text">
                            @php
                            $stritem = $item->content;
                            $str = strip_tags($stritem);
                            if (strlen($str) > 120) {
                                $stringCut = substr($str,0,120);
                                $str = substr($stringCut,0,strrpos($stringCut, ' ')).'...';
                            }
                         @endphp
                         <p>{{$str}}</p>
                        </div>

                    </div>

                </article>
            </div>
            @endforeach
        </div>
          @endif

        <div class="row mt-5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-center">
                <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif class="crumina-button button--dark button--l">{{ __('READ MORE') }}</a>
            </div>
        </div>
    </div>
</section>  --}}
            {{-- DIV for Ads --}}
            {{-- @if (\App\Models\Ads::first()->Home1)
            @section('margin-top') style="margin-top: 130px;"@endsection
            <div class="sorting-section-js">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    {!! \App\Models\Ads::first()->Home1 !!}
                    </div>
                    </div>
                </div>
            </div> --}}
            {{-- @endif --}}
            {{--End DIV for Ads --}}
{{--  <section class="small-section-padding bg-accent-primary">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <h5 class="mb-0 text-white">{{ __('Join us, to be able to create your own quizzes and share them with whoever you want.') }}</h5>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                @if (auth()->user())
                <a href="{{ route('dashboard') }}" class="crumina-button button--blue button--m">{{ __('SIGN UP') }}</a>
                @else
                <a href="{{ route('register') }}" class="crumina-button button--blue button--m">{{ __('SIGN UP') }}</a>
                @endif
            </div>
        </div>
    </div>
</section>  --}}

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


{{-- DIV for Ads --}}
{{-- @if (\App\Models\Ads::first()->Home2)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->Home2 !!}
        </div>
        </div>
    </div>
</div>
@endif --}}
<br>
{{--End DIV for Ads --}}
<section class="large-section-padding bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto mb-5 align-center">
                <h2>{{ __("Create your Quiz now,  share it with whoever you want") }}</h2>
                {{--  <p class="fs-18 fw-medium">{{ __("Create your Quiz now,  share it with whoever you want") }}.</p>  --}}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto mb-5 align-center">
                <div class="crumina-module crumina-info-box info-box--with-bg">
                    <div class="info-box-thumb">
                        <img loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon3.png')}}" alt="talk">
                    </div>
                    <div class="info-box-content">
                        <a href="#" data-toggle="modal" data-target="#modal_owner_name" class="h6 info-box-title" style="font-size: 1.09rem !important;">{{ __('Create a quick quiz') }}</a>
                        <a class="read-more--with-arrow" href="#" data-toggle="modal" data-target="#modal_owner_name" >
                            {{ __('Start') }}
                            <svg class="crumina-icon" width="15px" height="9px">
                                <path fill-rule="evenodd" d="M9.427,0.139 C9.236,-0.041 8.919,-0.041 8.722,0.139 C8.531,0.313 8.531,0.602 8.722,0.775 L12.299,4.035 L0.494,4.035 C0.218,4.035 -0.000,4.234 -0.000,4.484 C-0.000,4.737 0.218,4.941 0.494,4.941 L12.299,4.941 L8.722,8.196 C8.531,8.376 8.531,8.665 8.722,8.839 C8.919,9.018 9.237,9.018 9.427,8.839 L13.852,4.807 C14.049,4.633 14.049,4.344 13.852,4.171 L9.427,0.139 Z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        {{--  <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <div class="crumina-module crumina-info-box info-box--with-bg">
                    <div class="info-box-thumb">
                        <img loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon3.png')}}" alt="talk">
                    </div>
                    <div class="info-box-content">
                        <a href="#" data-toggle="modal" data-target="#modal_owner_name" class="h6 info-box-title" style="font-size: 1.09rem !important;">{{ __('Create a quick quiz') }}</a>
                        <a class="read-more--with-arrow" href="#" data-toggle="modal" data-target="#modal_owner_name" >
                            {{ __('Start') }}
                            <svg class="crumina-icon" width="15px" height="9px">
                                <path fill-rule="evenodd" d="M9.427,0.139 C9.236,-0.041 8.919,-0.041 8.722,0.139 C8.531,0.313 8.531,0.602 8.722,0.775 L12.299,4.035 L0.494,4.035 C0.218,4.035 -0.000,4.234 -0.000,4.484 C-0.000,4.737 0.218,4.941 0.494,4.941 L12.299,4.941 L8.722,8.196 C8.531,8.376 8.531,8.665 8.722,8.839 C8.919,9.018 9.237,9.018 9.427,8.839 L13.852,4.807 C14.049,4.633 14.049,4.344 13.852,4.171 L9.427,0.139 Z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <div class="crumina-module crumina-info-box info-box--with-bg">
                    <div class="info-box-thumb">
                        <img loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon24.png')}}" alt="talk">
                    </div>
                    <div class="info-box-content">
                        <a href="#" data-toggle="modal" data-target="#modal_owner_name_survey" class="h6 info-box-title" style="font-size: 1.09rem !important;">{{ __('Create a survey quiz') }}</a>
                        <a class="read-more--with-arrow" href="#" data-toggle="modal" data-target="#modal_owner_name_survey" >
                            {{ __('Start') }}
                            <svg class="crumina-icon" width="15px" height="9px">
                                <path fill-rule="evenodd" d="M9.427,0.139 C9.236,-0.041 8.919,-0.041 8.722,0.139 C8.531,0.313 8.531,0.602 8.722,0.775 L12.299,4.035 L0.494,4.035 C0.218,4.035 -0.000,4.234 -0.000,4.484 C-0.000,4.737 0.218,4.941 0.494,4.941 L12.299,4.941 L8.722,8.196 C8.531,8.376 8.531,8.665 8.722,8.839 C8.919,9.018 9.237,9.018 9.427,8.839 L13.852,4.807 C14.049,4.633 14.049,4.344 13.852,4.171 L9.427,0.139 Z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="crumina-module crumina-info-box info-box--with-bg">
                    <div class="info-box-thumb">
                        <img loading="lazy" src="{{ asset('../asset1/img/demo-content/icons/info-icon31.png') }}" alt="talk">
                    </div>
                    <div class="info-box-content">
                        <a href="#" data-toggle="modal" data-target="#modal_owner_name_multiple" class="h6 info-box-title" style="font-size: 1.09rem !important;">{{ __('Create a multiple choices quiz') }}</a>
                        <a class="read-more--with-arrow" href="#" data-toggle="modal" data-target="#modal_owner_name_multiple">
                            {{ __('Start') }}
                            <svg class="crumina-icon" width="15px" height="9px">
                                <path fill-rule="evenodd" d="M9.427,0.139 C9.236,-0.041 8.919,-0.041 8.722,0.139 C8.531,0.313 8.531,0.602 8.722,0.775 L12.299,4.035 L0.494,4.035 C0.218,4.035 -0.000,4.234 -0.000,4.484 C-0.000,4.737 0.218,4.941 0.494,4.941 L12.299,4.941 L8.722,8.196 C8.531,8.376 8.531,8.665 8.722,8.839 C8.919,9.018 9.237,9.018 9.427,8.839 L13.852,4.807 C14.049,4.633 14.049,4.344 13.852,4.171 L9.427,0.139 Z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>  --}}
    </div>
</section>

<section class="pt120 section-bg2">
    <div class="container">
        <div class="row align-center">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 m-auto">
                <h2>{{ __('Follow the latest articles on our blog') }}</h2>
                {{--  <p class="fs-18 fw-medium text-white">Purus gravida quis blandit turpis cursus in hac. Sollicitudin aliquam ultrices sagittis orci a scelerisque. Quisque egestas diam in arcu cursus euismod.</p>  --}}
                <div class="crumina-module crumina-our-video mt-5">
                    <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif>
                        <img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/demo-content/images/our-video.png')}}" alt="almiqias">

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('modal')
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
                                <button type="button" class="crumina-button button--green button--l w-100" onclick="open_create_quick_quiz_page()" >{{ __("Create a Quick Quiz") }}</button>
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

@endsection
@section('footer-content')

	<div class="footer-content">
		<div class="container">
			<div class="row justify-content-between">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 mb-0 mb-lg-0">
					<div class="widget w-info">
						<h5  class="widget-title">
                            {{-- @if(App::isLocale('ar')) {{ \App\Models\Settings::first()->sitename_ar}} @else {{ \App\Models\Settings::first()->sitename_en }} @endif --}}
						</h5>
                        {{-- <p>@if(App::isLocale('ar')) {{ \App\Models\Settings::first()->description_ar }} @else {{ \App\Models\Settings::first()->description_en }} @endif </p> --}}

					</div>
                </div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-0 mb-lg-0">
					<div class="widget w-info">
                        <h5  class="widget-title">
                            {{ __('keep in touch') }}
						</h5>
                        <ul  class="socials">
							{{-- <li><a href="{{ \App\Models\Settings::first()->twitter }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/twitter.svg')}}" alt="twitter"></a></li> --}}
							{{-- <li><a href="{{ \App\Models\Settings::first()->facebook }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/facebook.svg')}}" alt="facebook"></a></li> --}}
							{{-- <li><a href="{{ \App\Models\Settings::first()->instagram }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/instagram.svg')}}" alt="instagram"></a></li> --}}
							{{-- <li><a href="{{ \App\Models\Settings::first()->snapshat }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/snapchat.svg')}}" alt="instagram"></a></li> --}}
							{{--  <li><a href="{{ $snapshat }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/snapchat.svg')}}" alt="instagram"></a></li>
							<li><a href="{{ $snapshat }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/snapchat.svg')}}" alt="instagram"></a></li>  --}}
                        </ul>
					</div>
				</div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-lg-0">
					<div class="widget widget_links">
						{{-- <ul>
                            <b>
						  <li><a  @if(App::isLocale('ar')) <a href="{{route('about' , ['lang'=>'ar'] )}}" @else <a href="{{route('about' , ['lang'=>'en'] )}}" @endif >{{ __("About Almiqias") }}</a></li>
                          <li><a  @if(App::isLocale('ar')) <a href="{{route('common' , ['lang'=>'ar'] )}}" @else <a href="{{route('common' , ['lang'=>'en'] )}}" @endif {{--  target="_blank"  --}}>{{ __("Common Questions") }}</a></li>
                          {{-- <li><a  @if(App::isLocale('ar')) <a href="{{route('privacy_policy' , ['lang'=>'ar'] )}}" @else <a href="{{route('privacy_policy' , ['lang'=>'en'] )}}" @endif>{{ __("Privacy Policy") }}</a></li>
                          <li><a  @if(App::isLocale('ar')) <a href="{{route('terms_of_service' , ['lang'=>'ar'] )}}" @else <a href="{{route('terms_of_service' , ['lang'=>'en'] )}}" @endif>{{ __("Instructions for use") }}</a></li>
                          <li><a  @if(App::isLocale('ar')) <a href="{{route('contact' , ['lang'=>'ar'] )}}" @else <a href="{{route('contact' , ['lang'=>'en'] )}}" @endif>{{ __("Contact us") }}</a></li>
                        </b> --}}
						{{-- </ul> --}}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
