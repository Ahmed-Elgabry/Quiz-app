{{--  @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
  --}}

  @extends('layouts.login')
@section('title', __("Reset Password"))
@section('content')
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ __('Reset Password') }}</h3>
        </div>
        <form class="kt-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}"  placeholder="{{ __('Email') }}" required>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert"> {{ $errors->first('email') }}</span>
                    @endif
            </div>

            <div class="input-group">
                <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" value="{{ old('password') }}" placeholder="{{ __('Password') }}" name="password" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert"> {{ $errors->first('password') }} </span>
                    @endif
            </div>

            <div class="input-group">
                <input id="password-confirm" class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" value="{{ old('password_confirmation') }}" name="password_confirmation" required>
            </div>

            <div class="kt-login__actions">
                <button type="submit" class="btn btn-brand btn-pill kt-login__btn-primary">{{ __('Reset Password') }}</button>
                <a  href="{{ route('login') }}" class="btn btn-secondary btn-pill kt-login__btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
@endsection
