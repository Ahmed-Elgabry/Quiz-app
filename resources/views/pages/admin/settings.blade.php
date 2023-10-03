@extends('layouts.profile')
@section('title' , __("Settings"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Settings") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Settings details") }} </span>
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
                    <form id="myEditForm" name="myEditForm"  novalidate  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="kt-section__body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Site name in Arabic") }} <br><small style="color:green">-{{ __("for share link") }} & {{ __("for main page") }}-</small></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="sitename_ar" value ="{{$Settings->sitename_ar}}" placeholder="{{ __("Site name in Arabic") }}" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Site name in English") }}<br><small style="color:green">-{{ __("for share link") }} & {{ __("for main page") }}-</small></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="sitename_en" value ="{{$Settings->sitename_en}}" placeholder="{{ __("Site name in English") }}" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Email Address") }} <br><small style="color:green">-{{ __("for Contact page") }}-</small></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                            <input type="text" class="form-control" value ="{{$Settings->email}}" name="email" placeholder="{{ __("Email") }}" aria-describedby="basic-addon1" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Facebook URL") }}<br><small style="color:green">-{{ __("for footer") }} & {{ __("for Contact page") }}-</small> </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="facebook" value ="{{$Settings->facebook}}" placeholder="{{ __("Facebook") }}" >
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Twitter URL") }}<br><small style="color:green">-{{ __("for footer") }} & {{ __("for Contact page") }}-</small></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="twitter" value ="{{$Settings->twitter}}" placeholder="{{ __("Twitter") }}" >
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Instagram URL") }}<br><small style="color:green">-{{ __("for footer") }} & {{ __("for Contact page") }}-</small></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="instagram" value ="{{$Settings->instagram}}" placeholder="{{ __("Instagram") }}" >
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Snapshat URL") }}<br><small style="color:green">-{{ __("for footer") }} & {{ __("for Contact page") }}-</small></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="snapshat" value ="{{$Settings->snapshat}}" placeholder="{{ __("Snapshat") }}" >
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Logo") }}<br><small style="color:green">-{{ __("for share link") }} & {{ __("for main page") }}-</small> <br><small style="color:red">-{{ __("Take care that the logo is transparent") }}-</small></label>
                                                        <div class="col-lg-9 col-xl-9">
                                                                <img src="{{ asset('storage/' . $Settings->logo) }}" class="img-thumbnail" alt="almiqias" width ="100" height="100"> <br> <br>
                                                            <input class="form-control" type="file" name= "logo" value="" placeholder="{{ __("Logo") }}">
                                                        </div>
                                           </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Description in Arabic") }}<br><small style="color:green">-{{ __("for share link") }} & {{ __("for footer") }}-</small></label>
                                                <div class="col-12 col-sm-8 ">
                                                <div class="col-lg-9 col-xl-9">
                                                        <textarea type="text" rows="4" name= "description_ar"  value ="" class="form-control" > {{$Settings->description_ar}}</textarea>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Description in English") }}<br><small style="color:green">-{{ __("for share link") }} & {{ __("for footer") }}-</small></label>
                                            <div class="col-12 col-sm-8 ">
                                            <div class="col-lg-9 col-xl-9">
                                                    <textarea type="text" rows="4" name= "description_en"  value ="" class="form-control" > {{$Settings->description_en}}</textarea>
                                                </div>
                                            </div>
                                    </div>

                                    <h3 class="kt-section__title kt-section__title-lg">{{ __("About Us Page") }}:</h3>
                                    <hr>
                                    <h3 class="kt-section__title kt-section__title-lg" style="color:green">{{ __("For Quizzes") }}:</h3>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Text in Arabic") }}</label>
                                        <div class="col-12 col-sm-8 ">
                                        <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name= "aboutUs_text_ar"  value ="" class="form-control" > {{$Settings->aboutUs_text_ar}}</textarea>
                                            </div>
                                        </div>
                                </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Text in English") }}</label>
                                        <div class="col-12 col-sm-8 ">
                                        <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name= "aboutUs_text_en"  value ="" class="form-control" > {{$Settings->aboutUs_text_en}}</textarea>
                                            </div>
                                        </div>
                                </div>
                                <hr>
                                <h3 class="kt-section__title kt-section__title-lg" style="color:green">{{ __("For Articles") }}:</h3>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Text in Arabic") }}</label>
                                    <div class="col-12 col-sm-8 ">
                                    <div class="col-lg-9 col-xl-9">
                                            <textarea type="text" rows="4" name= "aboutUs_Articles_text_ar"  value ="" class="form-control" > {{$Settings->aboutUs_Articles_text_ar}}</textarea>
                                        </div>
                                    </div>
                            </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Text in English") }}</label>
                                    <div class="col-12 col-sm-8 ">
                                    <div class="col-lg-9 col-xl-9">
                                            <textarea type="text" rows="4" name= "aboutUs_Articles_text_en"  value ="" class="form-control" > {{$Settings->aboutUs_Articles_text_en}}</textarea>
                                        </div>
                                    </div>
                            </div>

                                            </div>
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-5">
                                                            <button type="submit" id="btn-edit-submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                            <a class="btn btn-light" href= "{{route('dashboard')}}">{{ __("Cancel") }}</a>
                                                            {{--  <input type="hidden" id="cq_edit_id" name="cq_edit_id" value="{{ $Ads->id }}">  --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection
@section('js')
<script src="{{ asset('templete/pages/admin/settings/settings-script.js') }}" type="text/javascript"></script>
@endsection
