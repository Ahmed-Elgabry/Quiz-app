@extends('layouts.profile')
@section('title' , __("$status"))
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
                {{ __('Articles') }} </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Home') }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('articles') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Articles') }} "{{ __($status) }}"</a>
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
                    <i class="kt-font-brand flaticon-notes"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                      {{ __("Articles Table") }} : @isset($user_id) {{ $status }}@else  {{ __($status) }} @endisset

                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
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
            </div>
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
            @isset($user_id)
            <input type="hidden" id="var_status_article_user_id" name="var_status_article_user_id" value="{{ $user_id  }}">
            @endisset

            <div class="kt-datatable" id="local_record_selection"></div>

            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
@endsection
@section('modals')
    @include('pages.articles.modals.edit_status')
    @include('pages.articles.modals.edit_featured')
    @include('pages.articles.modals.statistics')
@endsection
@section('js')
<?php
    if($status == "Pending"){
        $url_status = 'pending-datatable.js';
    }else if($status== "Approved"){
        $url_status = 'approved-datatable.js';
    }else if($status== "Rejected"){
        $url_status = 'rejected-datatable.js';
    }else{
        $url_status = 'editor-datatable.js';
    }
?>

<script src="{{ asset('templete/pages/articles/'.$url_status) }}" type="text/javascript"></script>
<script src="{{ asset('templete/pages/articles/scripts.js') }}" type="text/javascript"></script>
@endsection
