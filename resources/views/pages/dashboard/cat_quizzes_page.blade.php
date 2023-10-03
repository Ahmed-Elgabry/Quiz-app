@extends('layouts.layout')

@section('title',$title)

@section('meta')
<meta property="og:title" content="$title" />
@endsection

@section('navbar')
    @if(App::isLocale('ar'))
    <li class="navigation-item"><a class="navigation-link" href="{{route('cate_quizzes' , ['slug'=>$category->slug,'lang'=>'en'] )}}" >English</a> </li>
    @else
    <li class="navigation-item"><a class="navigation-link" href="{{route('cate_quizzes' , ['slug'=>$category->slug,'lang'=>'ar'] )}}">عربي</a> </li>
    @endif
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
@section('banner')
      <section class="crumina-stunning-header stunning-header-bg12 pb60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
						<a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
                    </div>
                    <h1 class="page-title text-white">{{ $title }}</h1>
                    {{-- <p class="page-text text-white">{{ __("Create your Quiz now,  share it with whoever you want") }} <br><br> {{ __("Create your quiz now and see the results of the people who will take your quiz") }}</p> --}}
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
                        @if($title)
                        <span>{{$title }}</span>
                        @endif

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="sorting-section-js pb120">
    @if($count_categories>0 || $usersquizzes->count() >0 ||$quickquizzes->count() >0 )
    <div class="category-list-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="category-list sorting-menu">
                        @if(App::isLocale('ar'))
                            @if($usersquizzes_ar->count() > 0)
                            <div class="category-list-item  @if($status == "usersquizzes") active @endif " ><a  @if(App::isLocale('ar')) href="{{route('all_usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_usersquizzes' , ['lang'=>'en'] )}}" @endif  >{{ __('Almiqias Quizzes') }}</a></div>
                            @endif

                            @if($quickquizzes_ar->count() > 0)
                            <div class="category-list-item  @if($status == "quickquizzes") active @endif " ><a  @if(App::isLocale('ar')) href="{{route('all_quickquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_quickquizzes' , ['lang'=>'en'] )}}" @endif  >{{ __('Quick Quizzes') }}</a></div>
                            @endif

                            @if($categories_ar->count() >0)
                            @foreach ($categories_ar as $item)
                                    <div class="category-list-item @if($status == $item->id) active @endif" ><a @if(App::isLocale('ar')) href="{{route('cate_quizzes' , ['slug'=>$item->slug,'lang'=>'ar'] )}}" @else href="{{route('cate_quizzes' , ['slug'=>$item->slug,'lang'=>'en'] )}}" @endif >{{ $item->name }}</a></div>
                                @endforeach
                            @endif

                        @else
                            @if($usersquizzes_en->count() > 0)
                            <div class="category-list-item  @if($status == "usersquizzes") active @endif " ><a  @if(App::isLocale('ar')) href="{{route('all_usersquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_usersquizzes' , ['lang'=>'en'] )}}" @endif  >{{ __('Almiqias Quizzes') }}</a></div>
                            @endif

                             @if($quickquizzes_en->count() > 0)
                            <div class="category-list-item  @if($status == "quickquizzes") active @endif " ><a  @if(App::isLocale('ar')) href="{{route('all_quickquizzes' , ['lang'=>'ar'] )}}" @else href="{{route('all_quickquizzes' , ['lang'=>'en'] )}}" @endif  >{{ __('Quick Quizzes') }}</a></div>
                            @endif

                            @if($categories_en->count() >0)
                                 @foreach ($categories_en as $item)
                                <div class="category-list-item @if($status == $item->id) active @endif" ><a @if(App::isLocale('ar')) href="{{route('cate_quizzes' , ['slug'=>$item->slug,'lang'=>'ar'] )}}" @else href="{{route('cate_quizzes' , ['slug'=>$item->slug,'lang'=>'en'] )}}" @endif >{{ $item->name }}</a></div>
                                @endforeach
                            @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
    {{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->quizzes1)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->quizzes1 !!}
        </div>
        </div>
    </div>
</div>
@endif
{{--End DIV for Ads --}}

        <div class="container">
          <div class="row sorting-container medium-section-padding" data-layout="fitRows" id="blogs-items">
            @foreach ($data as $quiz)
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb30 sorting-item creative" data-mh="blog-item">
                <article class="entry post post-standard has-post-thumbnail video">

                    @if($quiz->type == 'U')
                    <?php $quiz_ = \App\Models\UserQuiz::where('id',$quiz->id)->first(); ?>
                    <div class="post-thumb">
                        <img src="{{ asset($quiz_->quiz_img) }}" alt="Almiqias" >
                    </div>

                    <div class="post-content">
                        <a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="post-title h6 text-center">{{ $quiz->quiz_name }}</a>
                        <div class="post-additional-info text-center">
                                <a @if (App::isLocale('ar')) href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('user-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--primary button--l">{{ __("Start") }}</a>
                        </div>

                    </div>

                    @elseif ($quiz->type == 'Q')
                    <div class="post-thumb">
                        <img src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" alt="Almiqias" >
                    </div>
                    <div class="post-content">
                        <a  @if (App::isLocale('ar')) href="{{route('quick-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="post-title h6 text-center">{{ $quiz->quiz_name }}</a>

                        <div class="post-additional-info text-center">
                                <a  @if (App::isLocale('ar')) href="{{route('quick-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.start_test' , ['slug'=>$quiz->slug,  'lang'=>'en'] )}}" @endif class="crumina-button button--primary button--l">{{ __("Start") }}</a>
                        </div>

                    </div>
                    @endif

                </article>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center pagination">{{$data->links()}}</div>
        </div>
    </section>

{{-- DIV for Ads --}}
@if (\App\Models\Ads::first()->quizzes2)
<div class="sorting-section-js">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        {!! \App\Models\Ads::first()->quizzes2 !!}
        </div>
        </div>
    </div>
</div>
@endif
{{--End DIV for Ads --}}
@endsection
