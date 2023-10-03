@extends('layouts.profile')
@section('title' , __("Edit Category"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Edit Category") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Category details") }} </span>
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
                    @if(session('success'))
                        <script>
                            var session_msg = '{{session('success')}}';
                            localStorage.setItem("toastr_status", session_msg );
                        </script>
                    @endif

                    @if(session('error'))
                        <script>
                            var session_error_msg = '{{session('error')}}';
                            localStorage.setItem("toastr_error_status", session_error_msg );
                        </script>
                    @endif
                        <form id="myEditForm" name="myEditForm"  novalidate  enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <h3 class="kt-section__title kt-section__title-lg">{{ __("Edit Category") }}: <b> {{ $category->name }} </b> </h3>
                                        <hr>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Name") }} </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name',$category->name)}}" placeholder="" required>
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Language") }} </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="lang" value='ar' class="custom-control-input @error('lang') is-invalid @enderror" {{old('lang',$category->lang) == "Arabic" || old('lang',$category->lang) == "العربية" ? 'checked':''}}> {{ __("Arabic") }}
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="lang" value='en' class="custom-control-input @error('lang') is-invalid @enderror" {{old('lang',$category->lang) == "English" || old('lang',$category->lang) == "الانجليزية" ? 'checked':''}}> {{ __("English") }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Description") }} -{{ __('Not required') }}- </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name="description" {{-- id="summernote2" --}} value="" class="summernote form-control @error('description') is-invalid @enderror"> {{old('description',$category->description)}}</textarea>
                                                @error('description')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-5">
                                                            <button type="submit" id="btn-edit-submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                            <a class="btn btn-light" href= "{{route('categories')}}">{{ __("Cancel") }}</a>
                                                            <input type="hidden" id="category_id" name="category_id" value="{{ $category->id }}">
                                                    </div>
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
<script src="{{ asset('templete/pages/categories/scripts.js') }}" type="text/javascript"></script>
@endsection
