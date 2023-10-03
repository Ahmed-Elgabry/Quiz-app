@extends('layouts.profile')
@section('title' , __("Edit Common Question"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Edit Common Question") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Common Question details") }} </span>
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
                                            <h3 class="kt-section__title kt-section__title-lg">{{ __("Edit Common Question") }}: <b> {{ $CommonQuestion->question }} </b> </h3>
                                            <hr>
                                            <div class="form-group row">
                                                <label class="col-form-label">{{ __("Question") }}</label> {{-- -<small style="color : red"><B>{{ __("required") }}</B></small>- --}}
                                                <div class="col-xl-12">
                                                    <input class="form-control @error('question') is-invalid @enderror" type="text" name="question" value ="{{old('question',$CommonQuestion->question)}}" placeholder="" required>
                                                    @error('question')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label">{{ __("language") }}</label>
                                                <div class="col-xl-12">
                                                    <select class="form-control"  name="language" required>
                                                    <option value="1" {{ (old("language") == $CommonQuestion->is_arabic ? "selected":"") }}> {{__("Arabic")}} </option>
                                                        <option value="0" {{ (old("language") == $CommonQuestion->is_arabic ? "selected":"") }}> {{__("English")}}  </option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label">{{ __("Answer") }}</label>{{--  -<small style="color : red"><B>{{ __("required") }}</B></small>- --}}
                                                <div class="col-xl-12">
                                                    <textarea class="form-control  @error('answer') is-invalid @enderror" type="text" name="answer" {{-- value ="{{old('answer',$CommonQuestion->answer)}}" --}} rows="4" cols="50" placeholder="" required> {{old('answer',$CommonQuestion->answer)}} </textarea>
                                                    @error('answer')
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
                                                            <input type="hidden" id="cq_edit_id" name="cq_edit_id" value="{{ $CommonQuestion->id }}">
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
<script src="{{ asset('templete/pages/admin/settings/commonQuestions/scripts.js') }}" type="text/javascript"></script>
@endsection
