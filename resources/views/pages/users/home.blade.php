@extends('layouts.profile')
@section('title' , __("Dashboard"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Dashboard") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Home") }} </span>
            </div>
        </div>
    </div>
</div>

<!-- end:: Content Head -->
@endsection
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__body">
                    @if(session('message_flash'))
                    <div class="alert alert-success">
                        {{session('message_flash')}}
                    </div>
                    @endif
                    @if(count($errors)>0)

                    <div class="alert alert-danger fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                        <div class="alert-text">
                            @foreach ($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>@endforeach
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                    @endif
                    @if (auth()->user()->is_admin)
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="kt-portlet kt-iconbox kt-iconbox--primary">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" id="Combined-Shape" fill="#000000"/>
                                                    </g>
                                                </svg> </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('categories.create') }}">{{ __('Create a category') }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="kt-portlet kt-iconbox kt-iconbox--success">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    </g>
                                                </svg> </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('articles.create') }}">{{ __('Create an arabic article') }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="kt-portlet kt-iconbox kt-iconbox--warning">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    </g>
                                                </svg> </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('articles.create_en') }}">{{ __('Create an english article') }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M19,11 L20,11 C21.6568542,11 23,12.3431458 23,14 C23,15.6568542 21.6568542,17 20,17 L19,17 L19,20 C19,21.1045695 18.1045695,22 17,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,17 L5,17 C6.65685425,17 8,15.6568542 8,14 C8,12.3431458 6.65685425,11 5,11 L3,11 L3,8 C3,6.8954305 3.8954305,6 5,6 L8,6 L8,5 C8,3.34314575 9.34314575,2 11,2 C12.6568542,2 14,3.34314575 14,5 L14,6 L17,6 C18.1045695,6 19,6.8954305 19,8 L19,11 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('quickquizzes') }}">{{ __('Number of Quick Quizzes on Almiqias') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $quick_quizess_count }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--danger kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" id="check-path" fill="#000000" />
                                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" id="Combined-Shape" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('usersquizzes') }}">{{ __('Number of Users Quizzes on Almiqias') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $user_quizess_count }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('users') }}">{{ __("Number of Users on Amiqias") }}</a>
                                                </h3>
                                                <div class=" text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $users_num }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--info kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"/>
                                                        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3"/>
                                                        <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('editors') }}">{{ __("Number of Editors on Amiqias") }}</a>
                                                </h3>
                                                <div class=" text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $editors_num }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--danger kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('articles') }}">{{ __('Number of Articles on Almiqias in Arabic') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $articles_num_ar }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('articles') }}">{{ __('Number of Articles on Almiqias in English') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $articles_num_en }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- end:: Content -->
                    @if (!auth()->user()->is_admin)
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <div class="row">
                            @if (auth()->user()->is_editor == "محرر" || auth()->user()->is_editor == "Editor" )
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-callout kt-callout--brand kt-callout--diagonal-bg">
                                    <div class="kt-portlet__body">
                                        <div class="kt-callout__body">
                                            <div class="kt-callout__content">
                                                <h3 class="kt-callout__title">{{ __('Create a quiz') }}</h3>
                                                <p class="kt-callout__desc">
                                                    {{ __('Almiqias allows you to create your own Quizzes and share them with whoever you want, in addition to many features and services') }}.
                                                </p>
                                            </div>
                                            <div class="kt-callout__action">
                                                <a href="{{ route('user_quiz.create') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand">{{ __('Create a quiz') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-callout kt-callout--success kt-callout--diagonal-bg">
                                    <div class="kt-portlet__body">
                                        <div class="kt-callout__body">
                                            <div class="kt-callout__content">
                                                <h3 class="kt-callout__title">{{ __('Create an article') }}</h3>
                                                <p class="kt-callout__desc">
                                                    {{ __('Almiqias provides you topics and statistical information from various fields') }}.
                                                </p>
                                            </div>
                                            <div class="kt-callout__action">
                                                <a href="{{ route('user_articles.create') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-primary">{{ __('Create an article') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
								<div class="col-lg-12">
									<div class="kt-portlet kt-callout kt-callout--brand kt-callout--diagonal-bg">
										<div class="kt-portlet__body">
											<div class="kt-callout__body">
												<div class="kt-callout__content">
													<h3 class="kt-callout__title">{{ __('Create a quiz') }}</h3>
													<p class="kt-callout__desc">
														{{ __('Almiqias allows you to create your own Quizzes and share them with whoever you want, in addition to many features and services') }}.
													</p>
												</div>
												<div class="kt-callout__action">
													<a href="{{ route('user_quiz.create') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand">{{ __('Create a quiz') }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" id="check-path" fill="#000000" />
                                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" id="Combined-Shape" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('user_quiz') }}">{{ __('Number of Quizzes for User') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $user_quizess_num2 }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--danger kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                        <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" href="{{ route('user_reults') }}">{{ __('Number of Answers on User Quizzes') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $answers }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            @if (auth()->user()->is_editor == "محرر" || auth()->user()->is_editor == "Editor" )
                            <div class="col-lg-6">
                                <div class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
                                    <div class="kt-portlet__body">
                                        <div class="kt-iconbox__body">
                                            <div class="kt-iconbox__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-iconbox__desc">
                                                <h3 class="kt-iconbox__title">
                                                    <a class="kt-link" @if(App::isLocale('ar')) href="{{route('user_articles')}}" @else href="{{route('user_reults' , ['lang'=>'en'] )}}" @endif>{{ __('Number of Articles for User') }}</a>
                                                </h3>
                                                <div class="text-center kt-iconbox__content">
                                                    <br>
                                                    <h1>{{ $user_articles }} </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                        <!-- end:: Content -->
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
    <!-- end:: Content -->
    @endsection
