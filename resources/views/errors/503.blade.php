@extends('layouts.errors')
@section('title', __("503") )
@section('css')
<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ asset('assets/css/demo1/pages/error/error-6.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="kt-error_container">
    <div class="kt-error_subtitle kt-font-light">
        <h1>Oops 503</h1>
    </div>
    <p class="kt-error_description kt-font-light">
        {{ __("Looks like something went wrong.") }}<br>
        {{ __("We are working on it") }}
    </p>
</div>
@endsection
