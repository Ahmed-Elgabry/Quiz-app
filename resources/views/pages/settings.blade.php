@extends('layouts.profile')
@section('title',__('Settings'))
@section('subheader')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __('Settings') }} </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route("dashboard") }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Home') }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route("settings", ['id'=>auth()->user()->id ]) }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Settings') }} </a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
@endsection
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon kt-hidden">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __("Edit your Information :") }}
                </h3>
            </div>
        </div>

        @if(count($errors)>0)
        <div class="alert alert-danger fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                <div class="alert-text">
                        @foreach ($errors->all() as $error)
                        <li>
                        {{ $error}}
                    </li>@endforeach
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
            {{session('success')}}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
            {{session('error')}}
            </div>
        @endif

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_user_edit_tab_1" role="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg> {{ __("Account") }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_3" role="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect id="bound" x="0" y="0" width="24" height="24" />
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3" />
                                                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3" />
                                                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg> {{ __("Change Password") }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            {{-- <form action="" method=""> --}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="kt_apps_user_edit_tab_1" role="tabpanel">
                                        <div class="kt-form kt-form--label-right">
                                            <div class="kt-form__body">
                                                <div class="kt-section kt-section--first">
                                                    <div class="kt-section__body">
                                                        <div class="row">
                                                            <label class="col-xl-3"></label>
                                                            <div class="col-lg-9 col-xl-6">
                                                                <h3 class="kt-section__title kt-section__title-sm">{{ __("Edit your Information :") }}</h3>
                                                            </div>
                                                        </div>


                                                        <!--begin::Form-->
                                                        <form class="kt-form" method="post" novalidate action="{{ route('do_settings' ,['id'=>auth()->user()->id ]) }}">
                                                                @csrf
                                                            <div class="kt-portlet__body">
                                                                <div class="kt-form__section kt-form__section--first">
                                                                    <div class="form-group row">
                                                                        <label class="col-lg-2 col-form-label">{{ __("Full Name") }}:</label>
                                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                                            <input type="text" name= "name" value ="{{old('name',$user->name)}}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __("Full Name") }}" required>
                                                                            @error('name')
                                                                            <p class="text-danger">{{$message}}</p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                            <label class="col-lg-2 col-form-label">{{ __("Username") }}:</label>
                                                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                                                <input type="text" name= "username" value ="{{old('username',$user->username)}}" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __("Username") }}" required>
                                                                                @error('username')
                                                                                <p class="text-danger">{{$message}}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    <div class="form-group row">
                                                                            <label class="col-lg-2 col-form-label">{{ __("Email") }}:</label>
                                                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                                                <input type="email" name= "email" value ="{{old('email',$user->email)}}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __("Email") }}" required>
                                                                                @error('email')
                                                                                <p class="text-danger">{{$message}}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-portlet__foot">
                                                                <div class="kt-form__actions">
                                                                    <div class="row">
                                                                        <div class="col-lg-2"></div>
                                                                        <div class="col-lg-2">
                                                                                <button type="submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                                                <a class="btn btn-light" href= "{{route('dashboard')}}">{{ __("Cancel") }}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="kt_apps_user_edit_tab_3" role="tabpanel">
                                        <div class="kt-form kt-form--label-right">
                                            <div class="kt-form__body">
                                                <div class="kt-section kt-section--first">
                                                    <div class="kt-section__body">
                                                        <div class="row">
                                                            <label class="col-xl-3"></label>
                                                            <div class="col-lg-9 col-xl-6">
                                                                <h3 class="kt-section__title kt-section__title-sm">{{ __("Change Or Recover Your Password:") }}</h3>
                                                            </div>
                                                        </div>

                                                             {{-- @if(session('success'))
                                                                    <div class="alert alert-success">
                                                                    {{session('success')}}
                                                                    </div>
                                                                @endif

                                                                @if(session('error'))
                                                                    <div class="alert alert-danger">
                                                                    {{session('error')}}
                                                                    </div>
                                                                @endif --}}

                                                        <form class="kt-form" method="post" action="{{ route('changePassword') }}">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Current Password") }}</label>
                                                                <div class="col-lg-9 col-xl-6">
                                                                    <input type="password" name="current-password" class="form-control @error('current-password') is-invalid @enderror" placeholder="{{ __("Current Password") }}">
                                                                    @error('current-password')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("New Password") }}</label>
                                                                <div class="col-lg-9 col-xl-6">
                                                                    <input type="password" name="new-password" class="form-control @error('new-password') is-invalid @enderror"  placeholder="{{ __("New Password") }}">
                                                                    @error('new-password')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-last row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Confirm Password") }}</label>
                                                                <div class="col-lg-9 col-xl-6">
                                                                    <input type="password" name="new-password_confirmation" class="form-control"  placeholder="{{ __("Confirm Password") }}">
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__foot">
                                                <div class="kt-form__actions">
                                                    <div class="row">
                                                        <div class="col-lg-2"></div>
                                                        <div class="col-lg-2">
                                                                <button type="submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                                <a class="btn btn-light" href= "{{route('dashboard')}}">{{ __("Cancel") }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <!-- end:: Content -->
    </div>

    <!--end::Portlet-->
</div>

<!-- end:: Content -->



@endsection
