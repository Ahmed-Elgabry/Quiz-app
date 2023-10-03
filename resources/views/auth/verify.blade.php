@extends('layouts.login')
@section('title', __("Verify Your Email Address"))
@section('meta')
<meta property="og:title" content="{{ __('Verify Your Email Address') }}" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-18">
            <div class="card">
                <div class="card-header text-center">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    <br>
                    <br>
                    @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif> {{ __("Return to home page") }}</a>
                    <br><br>
                    <a   class="text-center" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
