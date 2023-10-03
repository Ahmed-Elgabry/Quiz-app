@extends('layouts.layout')
@section('title', $article->title)
@section('meta')
<meta property="og:title" content="{{$article->title}}">
<meta property="og:image" itemprop="image" content="http://phplaravel-991000-3481149.cloudwaysapps.com/{{$article->image}}">
@endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link" href="{{ route('view_article', ['slug'=>$article->slug, 'lang'=>'en' ]) }}" >English</a> </li>
@else
<li class="navigation-item"><a class="navigation-link" href="{{ route('view_article', ['slug'=>$article->slug, 'lang'=>'ar' ]) }}">عربي</a> </li>
@endif
@endsection

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
								<form method="get" @if(App::isLocale('ar')) action="{{route('search_articles' , ['lang'=>'ar'] )}}" @else  action="{{route('search_articles' , ['lang'=>'en'] )}}"  @endif class="search-popup-form">
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
@section('banner')
      <section class="crumina-stunning-header stunning-header-bg12 pb60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
						<a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div>
                    <h1 class="page-title text-white">{{$article->title}}</h1>

                    <div class="author-block">
						{{--  <div class="avatar">
							<img loading="lazy" src="{{ asset('../asset1/img/demo-content/avatars/author5.png')}}" alt="Almiqias">
						</div>  --}}
						{{--  <div class="author-content text-center">
							<div class="description text-white">{{ __('Posted by') }}</div>
							<a  class="author-name text-white">{{ $article->user->name}}</a>
						</div>  --}}
					</div>
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
                        <span class="crumina-icon">»</span>
                    </li>
                    <li class="breadcrumbs-item">
                        <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif >{{ __('Articles') }}</a>
                    </li>
                    <li class="breadcrumbs-item active">
                        <span>{{ $article->title }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="medium-section-padding pb120">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-4 mb-md-0">
                <article class="entry post post-standard has-post-thumbnail post-standard-details">

                    <div class="post-additional-info">
                        <time class="post-date published" datetime="{{ $article->created_at }}">
                            <svg class="crumina-icon">
                                <use xlink:href="#icon-calendar"></use>
                            </svg>
                           {{ __('created at') }} : {{ $article->created_at }}
                        </time>

                        {{--  <a href="#comments" data-scroll class="post-comments">
                            <svg class="crumina-icon">
                                <use xlink:href="#icon-comment"></use>
                            </svg>
                            7 Comments
                        </a>  --}}
                    </div>
                        {{-- DIV for Ads --}}
                        @if (\App\Models\Ads::first()->view_article1)
                        <div class="sorting-section-js">
                            <div class="container">
                                <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                {!! \App\Models\Ads::first()->view_article1 !!}
                                </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <br>
                        {{--End DIV for Ads --}}
                        {!! $article->content !!}

                            {{-- <iframe class="embed-responsive embed-responsive-16by9 embed-responsive-item" width="640" height="360" src="https://www.youtube.com/embed/OaJdhnkJKyY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}


                    <br>
                    {{-- DIV for Ads --}}
                    @if (\App\Models\Ads::first()->view_article2)
                    <div class="sorting-section-js">
                        <div class="container">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            {!! \App\Models\Ads::first()->view_article2 !!}
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <br>
                    {{--End DIV for Ads --}}

                    {{--  <ul class="tags-list mt-5">

                        <li>
                            <a href="#">Startup</a>
                        </li>

                        <li>
                            <a href="#">Business</a>
                        </li>

                        <li>
                            <a href="#">Art</a>
                        </li>

                        <li>
                            <a href="#">Photographyp</a>
                        </li>

                        <li>
                            <a href="#">Creative</a>
                        </li>

                    </ul>  --}}

                </article>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside aria-label="sidebar" class="sidebar sidebar-right">
                    <div class="widget w-search widget-sidebar">
                        <h6 class="widget-title">{{ __('WHAT ARE YOU LOOKING FOR?') }}</h6>
                        <form method="get" @if(App::isLocale('ar')) action="{{route('search_articles' , ['lang'=>'ar'] )}}" @else  action="{{route('search_articles' , ['lang'=>'en'] )}}"  @endif class="search-popup-form">
                            @csrf
                            <div class="input--with-icon input--icon-right">
                                <input  class="input--grey input--squared" name="search" type="text" placeholder="{{ __('Search') }}">
                                <svg class="crumina-icon">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </div>
                        </form>
                    </div>

                    <div class="widget w-latest-posts widget-sidebar">
                        <h6 class="widget-title">{{ __('Latest Articles')  }}</h6>
                        @foreach ($latest_articles as $item)
                        <article class="entry latest-posts-item">
                            <time class="post-date published" datetime="{{ $item->created_at }}">
                                {{ __('Posted on') }} {{ $item->created_at }}
                            </time>
                            <a @if(App::isLocale('ar')) href="{{ route('view_article', ['slug'=>$item->slug, 'lang'=>'ar' ]) }}"  @else href="{{ route('view_article', ['slug'=>$item->slug, 'lang'=>'en' ]) }}" @endif class="post-title h6">{{ $item->title }}</a>
                        </article>
                        @endforeach
                        <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif class="crumina-button button--grey button--xs button--uppercase">{{ __('Read more') }}</a>

                    </div>
                    {{-- <div class="widget w-latest-posts widget-sidebar">
                        <h6 class="widget-title">{{ __('Most Viewed Articles')  }}</h6>
                        @foreach ($most_views_article as $item)
                        <article class="entry latest-posts-item">
                          <a @if(App::isLocale('ar')) href="{{ route('view_article', ['slug'=>$item->article->slug, 'lang'=>'ar' ]) }}"  @else href="{{ route('view_article', ['slug'=>$item->article->slug, 'lang'=>'en' ]) }}" @endif class="post-title h6">
                         <b @if($loop->iteration == 1) style="color:#00c6ff" @elseif($loop->iteration == 2) style="color:#ff0173" @elseif($loop->iteration == 3) style="color:#8ad524"  @elseif($loop->iteration == 4) style="color:#6419ff"  @else style="color:#ffd200" @endif> {{ $loop->iteration }}. </b> {{ $item->article->title }}</a>
                        </article>
                        @endforeach
                        <a @if(App::isLocale('ar')) href="{{route('all_articles' , ['lang'=>'ar'] )}}" @else href="{{route('all_articles' , ['lang'=>'en'] )}}" @endif class="crumina-button button--grey button--xs button--uppercase">{{ __('Read more') }}</a>

                    </div> --}}


                    <div class="widget w-socials widget-sidebar">
                        <h6 class="widget-title">{{ __('SOCIAL NETWORK') }}</h6>
                        <h6 class="fs-16">{{ __('We are awesome follow us:') }}</h6>

                        <ul class="socials socials--rounded">
                            <li><a href="{{ \App\Models\Settings::first()->twitter }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/twitter.svg')}}" alt="twitter"></a></li>
							<li><a href="{{ \App\Models\Settings::first()->facebook }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/facebook.svg')}}" alt="facebook"></a></li>
							<li><a href="{{ \App\Models\Settings::first()->instagram }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/instagram.svg')}}" alt="instagram"></a></li>
							<li><a href="{{ \App\Models\Settings::first()->snapshat }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/snapchat.svg')}}" alt="snapchat"></a></li>

                        </ul>
                    </div>
                    {{-- DIV for Ads --}}
                    @if (\App\Models\Ads::first()->view_article3)
                       <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb30 sorting-item marketing text-center" data-mh="blog-item">
                            {!! \App\Models\Ads::first()->view_article3 !!}
                        </div>
                    @endif
                    <br>
                    {{--End DIV for Ads --}}

                </aside>
            </div>

        </div>
    </div>
</section>
@endsection
