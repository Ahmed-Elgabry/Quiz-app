@extends('layouts.login')
@section('title', __("Sign In") )
@section('meta')
<meta property="og:title" content="{{ __('Sign In') }}" />
@endsection
@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title" >{{ __('Sign In') }}</h3>
        </div>
        <form class="kt-form" method="POST" action="{{ route('login') }}">
                @csrf
            <div class="input-group">
                <input class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                type="text" placeholder="{{ __('Username or Email') }}" name="email"
                value="{{ old('username') ?: old('email') }}" required  autocomplete="off">
                    @if ($errors->has('username')|| $errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('username') ?: $errors->first('email')}}
                            </span>
                    @endif
            </div>
            <div class="input-group">
                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Password') }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
            </div>
            <div class="row kt-login__extra">
                <div class="col">
                    <label class="kt-checkbox " >
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                        <span></span>
                    </label>
                </div>
                @if (Route::has('password.request'))
                <div class="col kt-align-right">
                    <a href="{{ route('password.request') }}" {{-- id="kt_login_forgot" --}} class="kt-login__link">{{ __('Forget Password ?') }} </a>
                </div>
                @endif
            </div>
            <div class="kt-login__actions">
                <button type ="submit" class="btn btn-brand btn-pill kt-login__btn-primary">{{ __('Sign In') }}</button>
                @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif class="btn btn-secondary btn-pill kt-login__btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
    <div class="kt-login__account">
        <span class="kt-login__account-msg">
            {{ __('Do not have an account yet ?') }}
        </span>
        &nbsp;&nbsp;
        <a href="{{ route('register') }}"  class="kt-login__account-link" ><B>{{ __('Sign Up') }}!</B></a><br>
    </div>
@endsection
