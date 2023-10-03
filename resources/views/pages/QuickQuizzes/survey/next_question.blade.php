@extends('layouts.quick-quiz')
@section('title' , __("create a survey quiz"))
@section('navbar')
@if(App::isLocale('ar'))
<li class="kt-menu__item" ><a href="{{route('quick-quiz.create_survey_next_question' , ['slug'=>$quiz->slug,'lang'=>'en'] )}}" class="kt-menu__link "> <span class="kt-menu__link-text">English</span></a> </li>
@else
<li class="kt-menu__item" ><a href="{{route('quick-quiz.create_survey_next_question' , ['slug'=>$quiz->slug,'lang'=>'ar'] )}}" class="kt-menu__link "> <span class="kt-menu__link-text">عربي</span></a> </li>
@endif
@endsection

@section('subheader')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __('create a survey quiz') }} </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a @if(App::isLocale('ar')) href="{{route('quick-quiz.create_survey_next_question' , ['slug'=>$quiz->slug,'lang'=>'ar'] )}}" @else href="{{route('quick-quiz.create_survey_next_question' , ['slug'=>$quiz->slug,'lang'=>'en'] )}}" @endif class="kt-subheader__breadcrumbs-link">
                    {{ $quiz->owner_name }} </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __("Add new Question for") }}: {{ $quiz->quiz_name }}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" id="myCreateForm" name="myCreateForm"  novalidate  enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12"><h3 class="kt-section__title kt-section__title-lg">{{ __("Question #") }} {{ $counter+1 }} :</h3></label>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12">{{ __("Question Image") }}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12 text-center">
                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">
                            <div class="kt-avatar__holder" id="imagediv-question-img" style="height:100px;background-size: cover;background-image: url({{ asset('assets/media/users/default-png.png') }});"></div>
                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Change Image") }}">
                                <i class="fa fa-pen"></i>
                                <input type="file" name="question_img" id="question_img" accept=".png, .jpg, .jpeg">
                            </label>
                            <span class="kt-avatar__cancel" id="removeImage-question-img" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Delete Image") }}">
                                <i class="fa fa-times"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12">{{ __("Question Name") }}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class='input-group'>
                            <input class="form-control  @error('question_text') is-invalid @enderror" type="text" name="question_text" value="{{old('question_text')}}" placeholder="" required>
                        </div>
                        <span class="form-text text-primary">{{ __("required") }}</span>
                    </div>
                </div>
                {{--  <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12">{{ __("Question Type") }}</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="kt-radio-inline">
                            <label class="kt-radio">
                                <input type="radio"  checked="checked" name="type_q" value="m"> {{ __('multiple choices question') }}
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="type_q" value="s">{{ __('survey question') }}
                                <span></span>
                            </label>
                        </div>
                        <span class="form-text text-primary">{{ __("required") }}</span>
                    </div>
                </div>  --}}
                <input type="hidden" name="type_q" value="s">
                <div id="dynamic_field_s" class="question_div">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">{{ __("Option #") }} 1</label>
                        <div class="col-lg-2 col-md-9 col-sm-12">
                            <div class='input-group'>
                                <input class="form-control" type="text" name="option_s[]">
                            </div>
                            <span class="text-danger error-text option_s_0_error" id="option_s_0_error"></span>
                        </div>

                        <!--begin::Add custom field-->
                        <div class="col-lg-4 col-md-3 col-sm-3">
                            <button type="button" name="add_survey" id="add_survey" class="btn btn-primary me-auto">+</button>
                        </div>
                        <!--end::Add custom field-->
                    </div>
                </div>

            </div>
            <div class="kt-portlet__foot">
                <div class=" ">
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">

                            @if ($counter < 30)
                            <button type="submit" id="btn-next-question-submit" name="btn_1" class="btn btn-dark">{{ __("Add question #") }} {{ $counter+2 }}</button>
                            @endif
                            <button type="submit" id="btn-create-submit" name="btn_1" class="btn btn-success">{{ __("Submit") }}</button>
                            <a class="btn btn-light" @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif>{{ __("Cancel") }}</a>
                            <input type="hidden" name="owner_name" value="{{ $quiz->owner_name }}">
                            <input type="hidden" id="quiz_id" name="quiz_id" value="{{ $quiz->id }}">
                            <input type="hidden" id="page_type" value="survey_quiz">
                            <input type="hidden" value ="{{ \App::currentLocale() }}" name="lang" id="lang">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>

    <!--end::Portlet-->
</div>

<!-- end:: Content -->
@endsection
@section('js')
<script src="{{ asset('templete/pages/QuickQuizzes/_next-question-scripts.js') }}" type="text/javascript"></script>
@endsection



