@extends('layouts.profile')
@section('title' , __("How to show the result"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("How to show the result") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter details") }} </span>
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


                    <form class="kt-form" id="kt_form" method="post" novalidate action="{{route('user_quiz.do_shown_result' , ['id'=>$quiz->id ] )}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <h3 class="kt-section__title kt-section__title-lg">{{ $quiz->quiz_name }} - {{ __("shown result") }}:</h3>
                                        <hr>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("From result") }} </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control @error('from') is-invalid @enderror" type="text" step="0.1" min="0" name="from" value="{{old('from')}}" placeholder="" required>
                                                @error('from')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("To result") }} </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control @error('to') is-invalid @enderror" type="text" step="0.1" min="0" name="to" value="{{old('to')}}" placeholder="" required>
                                                @error('to')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Text") }} </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name="text" {{-- id="summernote2" --}} value="" class="summernote form-control @error('text') is-invalid @enderror"> {{old('text')}}</textarea>
                                                @error('text')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-lg-15">
                                                        <button type="submit" name="btn_1" value="next" class="btn btn-dark">{{ __("Next") }}</button>
                                                        <button type="submit" name="btn_1" value="stop" class="btn btn-success">{{ __("Submit") }}</button>
                                                        <a class="btn btn-light" href="{{ route('user_quiz.editindex_shown_result', ['id'=>$quiz->id ]) }}">{{ __("Cancel") }}</a>
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
<script src="{{ asset('templete/pages/user/quiz/shown-result/scripts.js') }}" type="text/javascript"></script>
@endsection
