@extends('layouts.general_layout')
@section('title' , __("Control Panel"))
@section('page')
<!-- begin::Body -->
<body @if(App::isLocale('ar')) style="font-family: 'Droid Arabic Kufi', serif;" @endif  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
                @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}"> @else <a href="{{route('home' , ['lang'=>'en'] )}}"> @endif
                {{--  <img alt="Logo" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" width="8%" />  --}} <h3 style="color:goldenrod;">{{ __('Almiqias') }}</h3>
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>
    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Aside -->
            <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
            <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                <!-- begin:: Aside -->
                <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                    <div class="kt-aside__brand-logo">
                            @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}"> @else <a href="{{route('home' , ['lang'=>'en'] )}}"> @endif
                            {{--  <img alt="Logo" src="{{ asset('../storage/'.App\Models\Settings::first()->logo) }}" width="20%" />  --}}  <h3 style="color:goldenrod;">{{ __('Almiqias') }}</h3>
                        </a>
                    </div>
                    <div class="kt-aside__brand-tools">
                        <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                    </g>
                                </svg></span>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" />
                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                                    </g>
                                </svg></span>
                        </button>
                    </div>
                </div>

                <!-- end:: Aside -->

                <!-- begin:: Aside Menu -->
                <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" {{-- id="kt_aside_menu_wrapper" --}}>
                    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">

                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item " aria-haspopup="true"><a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">{{ __("Home") }} </span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-dashboard"></i><span class="kt-menu__link-text">{{ __("Dashboard") }} </span></a></li>
                            @if (auth()->user()->is_admin)

                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('users') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-group"></i><span class="kt-menu__link-text">{{ __("Almiqias Users") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('users') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-avatar"></i><span class="kt-menu__link-text">{{ __("Users") }} </span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('editors') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-user-ok"></i><span class="kt-menu__link-text">{{ __("Editors") }} </span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('users.blocked') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-delete"></i><span class="kt-menu__link-text">{{ __("Blocked Users") }} </span></a></li>
                                    </ul>
                                </div>
                            </li>

                            {{--  <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('categories') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-interface-9"></i><span class="kt-menu__link-text">{{ __("Categories") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('categories.create') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-add-1"></i><span class="kt-menu__link-text">{{ __("Create Category") }}</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('categories') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-squares-3"></i><span class="kt-menu__link-text">{{ __("All Categories") }} </span></a></li>
                                    </ul>
                                </div>
                            </li>  --}}

                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('categories') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-interface-9"></i><span class="kt-menu__link-text">{{ __("Categories") }} </span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('usersquizzes') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-checkmark"></i><span class="kt-menu__link-text">{{ __("Users Quizzes") }} </span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('quickquizzes') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-checkmark"></i><span class="kt-menu__link-text">{{ __("Quick Quizzes") }} </span></a></li>

                            {{-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('usersquizzes_results') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-statistics"></i><span class="kt-menu__link-text">{{ __("Quizzes Results") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a> --}}
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">{{ __("Website Settings") }}</span></span></li>
                                        {{-- <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('usersquizzes_results') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("Users Quizzes Results") }}</span></a></li> --}}
                                        {{-- <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('quickquizzes_results') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("Quick Quizzes Results") }}</span></a></li> --}}
                                    </ul>
                                </div>
                            </li>

                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('articles') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-notes"></i><span class="kt-menu__link-text">{{ __("Almiqias Articles") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        {{--  <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.create') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-add-1"></i><span class="kt-menu__link-text">{{ __("Create Arabic Article") }}</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.create_en') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-add-1"></i><span class="kt-menu__link-text">{{ __("Create English Article") }}</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.myarticles') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-list-1"></i><span class="kt-menu__link-text">{{ __("My Articles") }} </span></a></li>  --}}
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-notes"></i><span class="kt-menu__link-text">{{ __("All Articles") }} </span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.featured') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-notes"></i><span class="kt-menu__link-text">{{ __("Featured Articles") }} </span></a></li>
                                        <?php
                                        $users = \App\Models\User::select('id')->onlyTrashed()->get();
                                        $a_all = \App\Models\Article::whereNotIn('writer_id', $users)->count();
                                        $a_pending = \App\Models\Article::whereNotIn('writer_id', $users)->where('status','P')->count();
                                        $a_approved = \App\Models\Article::whereNotIn('writer_id', $users)->where('status','A')->count();
                                        $a_rejected = \App\Models\Article::whereNotIn('writer_id', $users)->where('status','R')->count();
                                        if($a_all > 99){  $a_all = '+99'; }
                                        if($a_pending > 99){  $a_pending = '+99'; }
                                        if($a_approved > 99){  $a_approved = '+99'; }
                                        if($a_rejected > 99){  $a_rejected = '+99'; }
                                        ?>

                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-exclamation"></i><span class="kt-menu__link-text">{{ __("Status") }}</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--warning">{{$a_all}}</span></span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                <ul class="kt-menu__subnav">
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.pending') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("Pending Articles") }} </span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--brand">{{ $a_pending }}</span></span></a></li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.approved') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i></i><span class="kt-menu__link-text">{{ __("Approved Articles") }} </span> <span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--success">{{ $a_approved }}</span></span></a></li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.rejected') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i></i><span class="kt-menu__link-text">{{ __("Rejected Articles") }} </span> <span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--danger">{{ $a_rejected }}</span></span></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('articles.trashed') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-delete"></i><span class="kt-menu__link-text">{{ __("Articles Archive") }} </span></a></li>

                                    </ul>
                                </div>
                            </li>

                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('ads') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-speaker"></i><span class="kt-menu__link-text">{{ __("Ads") }} </span></a></li>

                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('website_settings') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-settings"></i><span class="kt-menu__link-text">{{ __("Website Settings") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">{{ __("Website Settings") }}</span></span></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('website_settings') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("General Settings") }}</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('common_questions_index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("Common Questions") }}</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('privacy_policy1') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("Privacy Policy") }}</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('terms_of_service1') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __("Instructions for use") }}</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            @endif
                            @if (!auth()->user()->is_admin)
                                {{-- @if (auth()->user()->is_editor == "محرر" || auth()->user()->is_editor == "Editor")
                                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('user_quiz') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-checkmark"></i><span class="kt-menu__link-text">{{ __("All Quizzes") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" data-toggle="modal" data-target="#testcapcha2"  class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-add-1"></i><span class="kt-menu__link-text">{{ __("Create Quiz") }} </span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_quiz') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-checkmark"></i><span class="kt-menu__link-text">{{ __("All Quizzes") }} </span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" data-toggle="modal" data-target="#testcapcha2"  class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-add-1"></i><span class="kt-menu__link-text">{{ __("Create Quiz") }} </span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_quiz') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-checkmark"></i><span class="kt-menu__link-text">{{ __("All Quizzes") }} </span></a></li>
                                @endif --}}

                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_quiz') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-checkmark"></i><span class="kt-menu__link-text">{{ __("All Quizzes") }} </span></a></li>

                            @if (auth()->user()->is_editor == "محرر" || auth()->user()->is_editor == "Editor")
                            {{--  <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('articles') }}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-notes"></i><span class="kt-menu__link-text">{{ __("Articles") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_articles.create') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-add-1"></i><span class="kt-menu__link-text">{{ __("Create Article") }} </span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_articles') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-list-1"></i><span class="kt-menu__link-text">{{ __("Articles") }} </span></a></li>
                                </ul>
                                </div>
                            </li>  --}}
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_articles') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-notes"></i><span class="kt-menu__link-text">{{ __("Articles") }} </span></a></li>

                            @endif
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('user_reults') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-statistics"></i><span class="kt-menu__link-text">{{ __("Results") }} </span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- end:: Aside Menu -->
            </div>

            <section>
                    <div class="modal fade" id="testcapcha2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __("Verification") }}</h5>
                            </div>
                            <div class="modal-body">
                                    <div class="col-lg-12">
                                            <label class="control-label" for="">{{ __('Enter your answer Please') }} :</label>
                                        </div>
                                <?php
                                $first_num2 = rand(5,10);
                                $second_num2 = rand(1,5);
                                $operators2 = array("+" , "-");
                                $operator2 = rand(0 , count($operators2) - 1);
                                $operator1010 = $operators2[$operator2];
                                $answer2 = 0;
                                switch ($operator1010) {
                                    case "+":
                                        $answer2 = $first_num2 + $second_num2;
                                        break;
                                    case "-":
                                        $answer2 = $first_num2 - $second_num2;
                                        break;
                                }
                                $asnb2 = $answer2;
                                ?>
                                <form action="javascript:;" id="captchaForm2" method="get">
                                        {{-- {{ csrf_field() }} --}}
                                        <br>
                                        <div class="col-lg-12">
                                                <label class="control-label" for="">{{ $first_num2 }} {{ $operator1010 }} {{  $second_num2 }} = </label>
                                                <input {{--  type="number"  --}} type="text" {{--  pattern="^([0-9]+([\.][0-9]+)?)|([\u0660-\u0669]+([\.][\u0660-\u0669]+)?)$"  --}} class="form-control required" name = "answer2" id="banswer2">
                                                <p id="panswer2" style="color:red"> </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __("Close") }}</button>
                                            <button  name="" class="btn btn-danger" onclick="captchaformSubmit2()">{{ __("Submit") }}</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                <script type="text/javascript">
                    function captchaformSubmit2()
                    {
                        var guests2, message2,url2,ans_session2;
                        message2 = document.getElementById("panswer2");
                        message2.innerHTML = "";
                        guests2= document.getElementById("banswer2").value;
                        if (guests2 == null || guests2 == "") {
                            message2.innerHTML = "{{ __('you must enter your answer, to complete the verification process!') }}";
                        }else{
                            url2 = '{{ route("user_quiz.create") }}';
                            ans_session2 = '{{ $asnb2 }}';

                            var yas = guests2;
                            yas = yas.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (d) { return d.charCodeAt(0) - 1632; })
                                    .replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (d) { return d.charCodeAt(0) - 1776; });

                            guests2 = yas;

                            if (guests2 == ans_session2) {
                                $("#captchaForm2").attr('action', url2);
                                $("#captchaForm2").submit();
                            }else{
                                message2.innerHTML = "{{ __('Wrong Answer, You must complete the verification process to continue!') }}";
                            }
                        }

                    }
                </script>
            </section>
            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                    <!-- begin:: Header Menu -->

                    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    </div>

                    <!-- end:: Header Menu -->

                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">
                        <?php
                        $noti_counter = \App\Models\log::where('is_read', 0)->count();
                        if($noti_counter > 99){  $noti_counter = '+99'; }
                        if($noti_counter == 0){  $noti_counter = null; }
                        ?>

                        @if (auth()->user()->is_admin)
                        <!--begin: Notifications -->
                        <div class="kt-header__topbar-item dropdown">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
                                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24" />
                                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000" />
                                        </g>
                                    </svg> <p style="color:red;"><b>{{ $noti_counter }}</b></p><span class="kt-pulse__ring"></span>
                                </span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                                <form>

                                    <!--begin: Head -->
                                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url(./assets/media/misc/bg-1.jpg)">
                                        <h3 class="kt-head__title">
                                            {{ __("Admin Notifications") }}
                                            &nbsp;
                                            <span class="btn btn-success btn-sm btn-bold btn-font-md">{{ \App\Models\log::where('is_read','0')->count() }} {{ __("new") }}</span>
                                        </h3>
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                                            {{-- <li class="nav-item">
                                                <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Alerts</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Events</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
                                            </li> --}}
                                        </ul>
                                    </div>

                                    <!--end: Head -->
                                    <div class="tab-content">
                                        <div class="tab-pane active show" {{-- id="topbar_notifications_notifications" --}} role="tabpanel">
                                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">

                                                @if (\App\Models\log::count() >0)

                                                @foreach ( \App\Models\log::latest()->take(20)->get() as $item )
                                                        @if ($item->user && $item->article)
                                                        <a href="{{route('notifications.update_log' , ['id'=>$item->id ] )}}" @if ($item->is_read == 1) style="background-color: lightgray;" @endif class="kt-notification__item">

                                                            <div class="kt-notification__item-icon">
                                                                @if ($item->event == 'A')
                                                                <i class="flaticon2-add-1 kt-font-success"></i>
                                                                @elseif ($item->event == 'E')
                                                                <i class="flaticon2-edit kt-font-brand"></i>
                                                                @else
                                                                <i class="flaticon2-delete kt-font-danger"></i>
                                                                @endif
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">

                                                                @if ($item->event == 'A')
                                                                    {{ $item->user->username }}  {{ __("added a new article.") }} ( {{ $item->article->title }} )
                                                                @elseif ($item->event == 'E')
                                                                    {{ $item->user->username }}  {{ __("updated an article.") }} ( {{ $item->article->title }} )
                                                                @else
                                                                {{ $item->user->username }}  {{ __("deleted an article.") }}
                                                                @endif

                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{  $item->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                        @elseif($item->user && !$item->article)

                                                        @if ($item->event == 'D')
                                                        <a href="{{route('notifications.update_log' , ['id'=>$item->id ] )}}" @if ($item->is_read == 1) style="background-color: lightgray;" @endif class="kt-notification__item">

                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-delete kt-font-danger"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">

                                                                    {{ $item->user->username }}  {{ __("deleted an article.") }}

                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{  $item->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                        @endif
                                                        @endif

                                                @endforeach

                                                @if (\App\Models\log::count() >1)
                                                <a href="{{ route('notifications') }}" class="kt-notification__item">
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">

                                                            {{ __("show more") }}

                                                        </div>

                                                    </div>
                                                    </a>
                                                @endif

                                                @else
                                                <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                                    <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                                        <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                                            <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                                            <br>{{ __("No new notifications") }}.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif


                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--end: Notifications -->
                        @endif

                        <!--begin: Language bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-icon">
                                    @if (App::isLocale('ar'))
                                    <b>ع</b>
                                    @else
                                    <b>En</b>
                                    @endif

                                </span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                                    <li class="kt-nav__item kt-nav__item--active">
                                        <a href="{{ route('language' , ['en']) }}" class="kt-nav__link">
                                            <span class="kt-nav__link-icon"></span>
                                            <span class="kt-nav__link-text">English</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="{{ route('language' , ['ar']) }}" class="kt-nav__link">
                                            <span class="kt-nav__link-icon">{{-- <img src="{{asset('assets/media/flags/008-saudi-arabia.svg')}}" alt="" /> --}}</span>
                                            <span class="kt-nav__link-text">عربي</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--end: Language bar -->

                        <!--begin: User Bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                                <div class="kt-header__topbar-user">
                                    <span class="kt-header__topbar-welcome ">{{ __('Hi')}},</span>
                                    <span class="kt-header__topbar-username ">{{ auth()->user()->username }}</span>
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item text-center" href="{{ route('settings',['id'=>auth()->user()->id ]) }}">
                                            {{ __('Settings') }}
                                        </a>

                                <a class="dropdown-item text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>

                        <!--end: User Bar -->
                    </div>

                    <!-- end:: Header Topbar -->
                </div>

                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                    <!-- begin:: Subheader -->
                    @yield('subheader')
                    <!-- end:: Subheader -->

                    <!-- begin:: Content -->
                    @yield('content')
                    <!-- end:: Content -->

                    <!-- begin:: Content -->
                    @yield('modals')
                    <!-- end:: Content -->
                </div>

                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            {{ __("Copyright")}} &copy; 2021 {{ __("Almiqias") }} | {{ __("All rights Reserved.") }}
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>

    <!-- end:: Page -->


    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- end::Scrolltop -->
@endsection
