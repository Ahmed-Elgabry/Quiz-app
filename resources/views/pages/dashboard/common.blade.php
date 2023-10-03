@extends('layouts.layout')
@section('title',__("Common Questions"))
@section('meta')
<meta property="og:title" content="{{ __('Common Questions') }}" />
@endsection
@section('navbar')
@if(App::isLocale('ar'))
<li class="navigation-item"> <a href="{{route('common' , ['lang'=>'en'] )}}" class="navigation-link">English</a> </li>
@else
<li class="navigation-item">  <a href="{{route('common' , ['lang'=>'ar'] )}}" class="navigation-link">عربي</a> </li>
@endif
@endsection
@section('banner')
      <section class="crumina-stunning-header stunning-header-bg13 pb60">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto align-center">
					<div class="page-category">
                        <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="page-category-item text-white" >{{ __('Home') }}</a>
					</div><br>
					<h1 class="page-title text-white">{{ __('FAQ') }}</h1>
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
                        <span>{{ __('FAQ') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
      <section class="large-section-padding bg-grey">
		<div class="container">
			<div class="row align-items-center">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 align-center ml-auto mr-auto mb-5">
					<h2>{{ __('FREQUENTLY ASKED QUESTIONS') }}</h2>
					<p class="fs-18 fw-medium">{{ __('Top Frequently Asked Questions and their Answers') }}.</p>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 mb-md-0">
                    <div class="crumina-module crumina-faqs-block crumina-faqs-block--without-border bg-yellow-themes">
                        <p class="fs-18 fw-medium">{{ __('Below you will find answers to the questions we get asked the most about Almiqias.') }}</p>
                    <div class="accordion crumina-module crumina-accordion accordion--style1 mt-5" id="accordion1">
                        @if(App::isLocale('ar'))
                        @foreach ($common_questions_ar as $common_question )
                        <div class="card">
							<div class="card-header" id="headingOne{{$common_question->id}}">
								<h2 class="mb-0">
									<button  class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$common_question->id}}" aria-expanded="true" aria-controls="collapseOne{{$common_question->id}}">
										{{$common_question->question}}
										<span class="icons">
											<svg class="crumina-icon icon-plus"><use xlink:href="#icon-plus"></use></svg>
											<svg class="crumina-icon active icon-minus"><use xlink:href="#icon-minus"></use></svg>
										</span>
									</button>
								</h2>
							</div>

							<div id="collapseOne{{$common_question->id}}" class="collapse show" aria-labelledby="headingOne{{$common_question->id}}" data-parent="#accordion1">
								<div class="card-body">
                                    {{$common_question->answer}}
									</div>
                            </div>

                        </div>
                        @endforeach
                        @else
                        @foreach ($common_questions_en as $common_question )
                        <div class="card">
							<div class="card-header" id="headingOne{{$common_question->id}}">
								<h2 class="mb-0">
									<button  class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$common_question->id}}" aria-expanded="true" aria-controls="collapseOne{{$common_question->id}}">
										{{$common_question->question}}
										<span class="icons">
											<svg class="crumina-icon icon-plus"><use xlink:href="#icon-plus"></use></svg>
											<svg class="crumina-icon active icon-minus"><use xlink:href="#icon-minus"></use></svg>
										</span>
									</button>
								</h2>
							</div>

							<div id="collapseOne{{$common_question->id}}" class="collapse show" aria-labelledby="headingOne{{$common_question->id}}" data-parent="#accordion1">
								<div class="card-body">
                                    {{$common_question->answer}}
									</div>
                            </div>

                        </div>
                        @endforeach

                        @endif

					</div>
                </div>
				</div>
			</div>
		</div>
    </section>


@endsection

