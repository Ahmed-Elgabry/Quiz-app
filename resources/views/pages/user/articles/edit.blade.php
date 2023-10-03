@extends('layouts.profile')
@section('title' , __("Edit Article"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Edit Article") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Article details") }} </span>
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
                                            <h3 class="kt-section__title kt-section__title-lg">{{ __("Edit Article") }}: <b> {{ $article->title }} </b> </h3>
                                            <hr>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Title") }} </label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value ="{{old('title',$article->title)}}" placeholder="" required>
                                                    @error('title')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Change Article Image") }} </label>
                                                <div class="col-lg-6 col-xl-6">
                                                    <input type="file" name= "image" value="" class="form-control @error('image') is-invalid @enderror" required> <br>
                                                    @error('image')
                                                            <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                    <div class="col-lg-3 col-xl-3" >
                                                                <img alt="almiqias" src="{{ $article->image }}" class="img-thumbnail" width ="200px" height="100px" {{--  style="outline: 2px solid green;"  --}}>
                                                        </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Language") }} </label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio" name="language" value='1'  class="custom-control-input @error('language') is-invalid @enderror" {{old('language',$article->is_arabic)== __("Arabic")? 'checked':''}}> {{ __("Arabic") }}
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio" name="language" value='0' class="custom-control-input @error('language') is-invalid @enderror" {{old('language',$article->is_arabic)== __("English")? 'checked':''}} > {{ __("English") }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Content") }} </label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <textarea type="text" rows="4" name= "content" {{-- id="summernote2" --}} value ="" class="summernote form-control @error('content') is-invalid @enderror"> {{old('content',$article->content)}}</textarea>
                                                    @error('content')
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
                                                            <input type="hidden" id="article_id" name="article_id" value="{{ $article->id }}">
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
<script src="{{ asset('templete/pages/user/articles/scripts.js') }}" type="text/javascript"></script>
@endsection
