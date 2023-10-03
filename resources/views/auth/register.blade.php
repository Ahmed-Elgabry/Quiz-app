@extends('layouts.login')
@section('title', __("Sign Up"))
@section('meta')
<meta property="og:title" content="{{ __('Sign Up') }}" />
@endsection
@section('content')
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ __('Sign Up') }}</h3>
            <div class="kt-login__desc">{{ __('Enter your details to create your account:') }}</div>
        </div>
        <form class="kt-form" method="POST" action="{{ route('register') }}">
                @csrf
            <div class="input-group">
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" type="text" placeholder="{{ __('Name') }}" name="name" required>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert"> {{ $errors->first('name') }} </span>
                @endif
            </div>
            <div class="input-group">
                    <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" type="text" placeholder="{{ __('Username') }}" name="username" required>
                        @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert"> {{ $errors->first('username') }} </span>
                    @endif
                </div>
            <div class="input-group">
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" type="email" placeholder="{{ __('Email') }}" required>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert"> {{ $errors->first('email') }}</span>
                    @endif
            </div>
            <div class="input-group">
                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" value="{{ old('password') }}" placeholder="{{ __('Password') }}" name="password" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert"> {{ $errors->first('password') }} </span>
                    @endif
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" value="{{ old('password_confirmation') }}" name="password_confirmation" required>

            </div>
             <div class="kt-login__actions text-center">
                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block" role="alert"> {{ $errors->first('g-recaptcha-response') }} </span>
                    @endif
                 {{-- <div class="captcha">
                    <span >{!! captcha_img() !!}</span>
                    <button id="refresh" type="button" class="btn btn-waring"><i class="fa fa-retweet" ></i></button>
                    </div>

            <div class="input-group">
                   <input class="form-control" id="captcha" type="text" class="form-control" placeholder="{{ __('Captcha') }}" name="captcha" required>
                </div> --}}
         </div>

            <div class="kt-login__actions">
                <button type="submit" class="btn btn-brand btn-pill kt-login__btn-primary">{{ __('Sign Up') }}</button>
                @if(App::isLocale('ar')) <a href="{{route('home' , ['lang'=>'ar'] )}}" @else <a href="{{route('home' , ['lang'=>'en'] )}}" @endif class="btn btn-secondary btn-pill kt-login__btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
@endsection
{{--  @push('javaS')
<script type="text/javascript">
    $('#refresh').click(function(){
      $.ajax({
         type:'GET',
         url:'refreshcaptcha',
         success:function(data){
            $(".captcha span").html(data.captcha);
         }
      });
    });
    </script>
@endpush  --}}
