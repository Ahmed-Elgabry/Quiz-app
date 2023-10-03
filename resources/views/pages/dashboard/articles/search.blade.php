@extends('layouts.layout')
@section('title',__("Search"))
@section('meta')
<meta property="og:title" content="{{ __('Search') }}" />
@endsection

@section('navbar')

@if(App::isLocale('ar'))
<li class="navigation-item"><a class="navigation-link" href="{{route('search_articles' , ['lang'=>'en'] )}}" >English</a> </li>
@else
<li class="navigation-item"><a class="navigation-link" href="{{route('search_articles' , ['lang'=>'ar'] )}}">عربي</a> </li>
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
					<h1 class="page-title text-white">{{ __("Results Search for: ") }}{{$query}}</h1>
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
                        <span>{{ __('Search') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="sorting-section-js pb120">
    <div class="container">
        <div class="row sorting-container medium-section-padding" data-layout="fitRows" id="blogs-items">
            @if ($articles->count() > 0)
                @foreach ($articles as $item)
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
            @else
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 align-center m-auto">
            <h2> {{ __("No results found!") }}   </h2>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection


