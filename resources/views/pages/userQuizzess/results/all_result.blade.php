@extends('layouts.layout')
@section('title',__("Results"))
@section('meta')
<meta property="og:title" content="{{ __('Results of') }} {{ $quiz->quiz_name}}">
<meta property="og:image" content="http://phplaravel-991000-3481149.cloudwaysapps.com{{$quiz->quiz_img}}">
@endsection

@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link"  href="{{route('user-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" >English</a></li>
@else
<li class="navigation-item"><a class="navigation-link"  href="{{route('user-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" >عربي</a></li>
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
      <section class="crumina-stunning-header stunning-header-bg3 pb60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
						<a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div>
					<h1 class="page-title text-white">{{ __('Results of') }} ( <b>{{ $quiz->quiz_name }}</b> ) {{ __('for user ') }} "{{ $name1 }}"</h1>
				</div>
			</div>
		</div>
	</section>
@endsection  --}}
@section('content')
{{--  <div class="crumina-breadcrumbs breadcrumbs--red-themes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif >{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ __('Quiz Results') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  --}}
{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->results1)
<div class="sorting-section-js">

@section('margin-top') style="margin-top: 130px;"@endsection
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->results1 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}

@if (($quiz->results_share == "مشاركة" || $quiz->results_share == "Shared") && ($quiz->is_private == "عام" || $quiz->is_private == "Public"))
    <section class="large-section-padding section-bg2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                        {{-- <img class="mb-4 " loading="lazy" src="{{ asset('asset1/img/demo-content/images/image12.png')}}" alt="almiqias"> --}}
                    <h2>{{ __('Results of') }} "<b>{{ $quiz->quiz_name }}</b>" {{ __('for user ') }} "{{ $name1 }}"</h2>
                    <p class="fs-18 fw-medium"></p>

                    @if (App::isLocale('ar'))
                    <a class="crumina-button button--primary button--xl button--bordered mt-4" href="{{route('user-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}">{{ __("Back to the quiz") }} </a>
                    @else
                    <a class="crumina-button button--primary button--xl button--bordered mt-4" href="{{route('user-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}">{{ __("Back to the quiz") }}</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (($quiz->hide_result == "ظاهرة" || $quiz->hide_result == "Unhidden"))
    @if($multiple_questions_counter > 0)
    <section class="large-section-padding section-bg1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 align-center mb-5 ml-auto mr-auto">
                    <h2>{{ __("Results Table") }}</h2>
                    <p class="fs-18 fw-medium">{{ __('Results of') }} "<b>{{ $quiz->quiz_name }}</b>" {{ __('for user ') }} "{{ $name1 }}".</p>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 m-auto">

                    <form class="form--bordered" method="get"   @if (App::isLocale('ar')) action="{{route('user-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else
                        action="{{route('user-quiz.get_results' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif>
                        {{-- <h6 class="form-title-with-border">ACTIVE FORM</h6> --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 m-auto">
                                <input type="text" name="name" placeholder="{{ __('Search') }}" value="{{$name}}" class="input--grey input--squared" type="text" >
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m-auto">
                                <select name="status" class="input--grey input--squared" data-minimum-results-for-search="Infinity">
                                    <option value="">{{ __('New results') }}</option>
                                    <option value="oldest" {{$status == 'oldest'? 'selected' : '' }}>{{ __('Old results') }}</option>
                                    <option value="higher" {{$status == 'higher'? 'selected' : '' }}>{{ __('High results') }}</option>
                                    <option value="lower" {{$status == 'lower'? 'selected' : '' }}>{{ __('Less results') }}</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m-auto">
                                <button type="submit" class="crumina-button button--primary button--l">{{ __("SEARCH") }}</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <?php $x=1 ;?>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Result') }} {{ __('from') }} {{ $quiz->grade }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($results)>0)
                            @foreach ($results as $result)
                            <tr>
                                <td class="fw-medium">{{ $x }}</td>
                                <td>{{ $result->name }}</td>
                                <td class="font-weight-bold">{{ $result->results  }} </td>
                            </tr>
                            <?php $x++ ;?>
                            @endforeach
                            @else
                            <td colspan="3" class="font-weight-bold text-center"><h5>{{ __('No Results yet') }}</h5></td>
                            @endif

                        </tbody>
                    </table>
                    <div class="row justify-content-center pagination">
                        @if($status != 'higher' &&  $status != 'lower' &&  $status != 'newest')
                        @if ($name != null)
                        {{$results->appends(['name' => $name])->links()}}
                        @else
                        {{$results->links()}}
                        @endif

                        @elseif ($status == 'higher')
                                    @if ($name != null)
                                    {{$results->appends(['name' => $name,'status' => 'higher'])->links()}}
                                    @else
                                    {{$results->appends(['status' => 'higher'])->links()}}
                                    @endif

                        @elseif ($status == 'lower')
                                @if ($name != null)
                                    {{$results->appends(['name' => $name,'status' => 'lower'])->links()}}
                                    @else
                                    {{$results->appends(['status' => 'lower'])->links()}}
                                    @endif

                        @elseif ($status == 'newest')
                                    @if ($name != null)
                                    {{$results->appends(['name' => $name,'status' => 'newest'])->links()}}
                                    @else
                                    {{$results->appends(['status' => 'newest'])->links()}}
                                    @endif

                                @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endif

    @if (($quiz->hide_survey_result== "ظاهرة" || $quiz->hide_survey_result== "Unhidden"))
        @if($survey_questions_counter > 0)
        <section class="large-section-padding bg-grey">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 align-center mb-5 ml-auto mr-auto">
                        <h2>{{ __('Survey questions results') }}</h2>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 m-auto">
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

                    </div>
                </div>
            </div>
        </section>
        <input type="hidden" id= "survey_questions_counter" value="{{ $survey_questions_counter }}">
        @endif
    @endif

    <section class="large-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
                    <img class="mb-4 " loading="lazy" src="{{ asset('asset1/img/demo-content/icons/info-icon30.png')}}" alt="almiqias">
                    <h2>{{ __('Share the Results') }}</h2>
                    <footer class="entry-footer">
                            <ul class="socials socials--rounded">
                                <li><a id="facebook" @if (App::isLocale('ar')) href="{{ route('Uresults_facebook_share', ['slug'=>$quiz->slug, 'lang'=>'ar' ]) }}" @else  href="{{ route('Uresults_facebook_share', ['slug'=>$quiz->slug, 'lang'=>'en' ]) }}" @endif title="{{ __('Share it on Facebook') }}" target="_blank"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/facebook3.svg')}}" alt="facebook"></a></li>
                                <li><a id="twitter" @if (App::isLocale('ar'))  href="{{ route('Uresults_twitter_share', ['slug'=>$quiz->slug, 'lang'=>'ar' ]) }}" @else href="{{ route('Uresults_twitter_share', ['slug'=>$quiz->slug, 'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Twitter') }}"><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/twitter2.svg')}}" alt="twitter"></a></li>
                                <li><a id="whatsapp" @if (App::isLocale('ar')) href="{{ route('Uresults_whatsapp_share', ['slug'=>$quiz->slug, 'lang'=>'ar' ]) }}" @else href="{{ route('Uresults_whatsapp_share', ['slug'=>$quiz->slug, 'lang'=>'en' ]) }}" @endif target="_blank" title="{{ __('Share it on Whatsapp') }}" data-action="share/whatsapp/share" ><img class="crumina-icon " loading="lazy" src="{{ asset('asset1/img/theme-content/social-icons/whatsapp2.svg')}}" alt="whatsapp"></a></li>
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
                <p class="fs-18 fw-medium">{{ __('you can not able to see the results') }}</p>
                @if (App::isLocale('ar'))
                <a class="crumina-button button--primary button--xl button--bordered mt-4" href="{{route('user-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}">{{ __("Back to the quiz") }} </a>
                @else
                <a class="crumina-button button--primary button--xl button--bordered mt-4" href="{{route('user-quiz.share_quiz' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}">{{ __("Back to the quiz") }}</a>
                @endif

            </div>
        </div>
    </div>
</section>

@endif

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
{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->results2)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->results2 !!}
        </div>
        </div>
    </div>
</div>
@endif
<br>
{{--End DIV for Ads --}}
<script>
    $(document).ready(function () {
        $(".pagination").rPage();
    });
</script>

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
// console.log(url);
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
@section('js')
<script src="{{ asset('asset1/js/js-plugins/jquery-countTo.min.js') }}"></script>
<script src="{{ asset('asset1/js/js-plugins/waypoints.min.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>

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
    var ajaxurl = BASE_URL + "/user-quiz/get/option/"+question_id;
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
