@extends('layouts.profile')
@section('title' , __("shown result"))
@section('css')
<style>
    .kt-datatable.kt-datatable--default > .kt-datatable__table > .kt-datatable__head .kt-datatable__row > .kt-datatable__cell.kt-datatable__cell--check{
        display :table-cell !important;
    }
    .kt-datatable__cell.kt-datatable__cell--sort{
        display :table-cell !important;
    }
    .kt-datatable.kt-datatable--default > .kt-datatable__table > .kt-datatable__body .kt-datatable__row > .kt-datatable__cell.kt-datatable__cell--check{
        display :table-cell !important;
    }
    .kt-datatable.kt-datatable--default > .kt-datatable__table > .kt-datatable__body .kt-datatable__row > .kt-datatable__cell {
        display :table-cell !important;
    }
</style>
@endsection
@section('subheader')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __('shown result') }}
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Home') }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('user_quiz') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('User Quizzes') }} </a>

                <span class="kt-subheader__breadcrumbs-separator"></span>
                {{ $quiz->quiz_name }}
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('user_quiz.shown_result', ['id'=>$quiz->id ]) }}" class="btn kt-subheader__btn-primary">
                    {{ __('Add new Record') }} &nbsp;

                    <i class="flaticon2-add-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
@endsection
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-checkmark"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __("shown results table") }}

                </h3>

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

                <input type="hidden" value="{{ $quiz->id }}" name="quiz_id" id="quiz_id" >
            </div>
            {{--  <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <!--begin: Search Form -->
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" class="form-control" placeholder="{{ __('Search') }} ..." id="generalSearch">
                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                <span><i class="la la-search"></i></span>
                            </span>
                        </div>
                        <!--end: Search Form -->
                    </div>
                </div>
            </div>  --}}
        </div>
        <div class="kt-portlet__body">

            <!--begin: Selected Rows Group Action Form -->
            <div class="kt-form kt-form--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="kt-form__label kt-form__label-no-wrap">
                                <label class="kt-font-bold kt-font-danger-"> {{ __('Selected') }}
                                    <span id="kt_datatable_selected_number">0</span> {{ __('from records') }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <div class="btn-toolbar">
                                    <button class="btn btn-sm btn-danger" type="button" id="btn-ids">{{ __('Delete All') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end: Selected Rows Group Action Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <input type="hidden" value ="{{ \App::currentLocale() }}" name="lang" id="lang">
            <div class="kt-datatable" id="local_record_selection"></div>

            <!--end: Datatable -->
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection
@section('js')
<script src="{{ asset('templete/pages/user/quiz/shown-result/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('templete/pages/user/quiz/shown-result/scripts.js') }}" type="text/javascript"></script>
@endsection

