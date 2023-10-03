@extends('layouts.profile')
@section('title' , __("Answers order"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Answers order") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Answers order") }} </span>
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

                    <form class="kt-form" id="kt_form" method="get" action="{{route('user_quiz.do_options_order' , ['id'=>$order->id ] )}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <h3 class="kt-section__title kt-section__title-lg">{{ __("Enter Answers order") }}: "{{ $quiz->quiz_name }}"</h3>
                                        <input type="text" name="quiz_id" value="{{ $quiz->id }}" hidden>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Number") }} 1<br></label>
                                            <div class="col-lg-9 col-xl-9">
                                                {{-- <input class="form-control" type="text" name="answer1" value ="" required> --}}
                                                <select class="form-control" name="answer1" required>
                                                    <option value="1" {{ (old("answer1",$order->op1) == 1 ? "selected":"") }}> {{ __("for Answer #") }} 1 </option>
                                                    <option value="2" {{ (old("answer1",$order->op1) == 2 ? "selected":"") }}> {{ __("for Answer #") }} 2 </option>
                                                    <option value="3" {{ (old("answer1",$order->op1) == 3 ? "selected":"") }}> {{ __("for Answer #") }} 3 </option>
                                                    <option value="4" {{ (old("answer1",$order->op1) == 4 ? "selected":"") }}> {{ __("for Answer #") }} 4 </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Number") }} 2<br></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select class="form-control" name="answer2" required>
                                                    <option value="1" {{ (old("answer2",$order->op2) == 1 ? "selected":"") }}> {{ __("for Answer #") }} 1 </option>
                                                    <option value="2" {{ (old("answer2",$order->op2) == 2 ? "selected":"") }}> {{ __("for Answer #") }} 2 </option>
                                                    <option value="3" {{ (old("answer2",$order->op2) == 3 ? "selected":"") }}> {{ __("for Answer #") }} 3 </option>
                                                    <option value="4" {{ (old("answer2",$order->op2) == 4 ? "selected":"") }}> {{ __("for Answer #") }} 4 </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Number") }} 3<br></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select class="form-control" name="answer3" required>
                                                    <option value="1" {{ (old("answer3",$order->op3) == 1 ? "selected":"") }}> {{ __("for Answer #") }} 1 </option>
                                                    <option value="2" {{ (old("answer3",$order->op3) == 2 ? "selected":"") }}> {{ __("for Answer #") }} 2 </option>
                                                    <option value="3" {{ (old("answer3",$order->op3) == 3 ? "selected":"") }}> {{ __("for Answer #") }} 3 </option>
                                                    <option value="4" {{ (old("answer3",$order->op3) == 4 ? "selected":"") }}> {{ __("for Answer #") }} 4 </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Number") }} 4<br></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select class="form-control" name="answer4" required>
                                                    <option value="1" {{ (old("answer4",$order->op4) == 1 ? "selected":"") }}> {{ __("for Answer #") }} 1 </option>
                                                    <option value="2" {{ (old("answer4",$order->op4) == 2 ? "selected":"") }}> {{ __("for Answer #") }} 2 </option>
                                                    <option value="3" {{ (old("answer4",$order->op4) == 3 ? "selected":"") }}> {{ __("for Answer #") }} 3 </option>
                                                    <option value="4" {{ (old("answer4",$order->op4) == 4 ? "selected":"") }}> {{ __("for Answer #") }} 4 </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="text-danger">{{ __("When there are two or three answers, they will be shown in this order also.") }}</label>

                                        </div>

                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-5">
                                                        <button type="submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                        <a class="btn btn-light" href="{{route('user_quiz')}}">{{ __("Cancel") }}</a>
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
<script src="{{ asset('templete/pages/user/quiz/order-option-scripts.js') }}" type="text/javascript"></script>
@endsection
