@extends('layouts.profile')
@section('title' , __("Instructions for use"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Instructions for use") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Instructions details") }} </span>
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Instructions in Arabic") }} </label>
                                                    <div class="col-lg-9 col-xl-9">

                                                        <textarea type="text" name= "terms_ar" {{-- id="summernote" --}} value ="" class="summernote form-control @error('terms_ar') is-invalid @enderror" placeholder="{{ __("Instructions in Arabic") }}" > {{old('terms_ar', $terms_ar)}}</textarea>
                                                        @error('terms_ar')
                                                                <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Instructions in English") }}</label>
                                                    <div class="col-lg-9 col-xl-9">

                                                        <textarea type="text" name= "terms_en" {{-- id="summernote2" --}} value ="" class="summernote form-control @error('terms_en') is-invalid @enderror" placeholder="{{ __("Instructions in English") }}" > {{old('terms_en',$terms_en)}} </textarea>
                                                        @error('terms_en')
                                                                <p class="text-danger">{{$message}}</p>
                                                        @enderror
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
<script src="{{ asset('templete/pages/admin/settings/terms-script.js') }}" type="text/javascript"></script>
@endsection
