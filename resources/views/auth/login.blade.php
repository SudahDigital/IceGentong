@extends('layouts.app')

@section('content')

<form id="sign_in" action="{{ route('login') }}" aria-label="{{ __('Login') }}" method="POST">
    @csrf
    <div class="msg"><b>@section('title') Login @endsection</b></div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">email</i>
        </span>
        <div class="form-line">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="off" placeholder="Email">
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
            <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
        </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-8 p-t-5">
            <input class="filled-in chk-col-pink" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember Me</label>
        </div>
        <div class="col-xs-4">
            <button class="btn btn-block bg-pink waves-effect" type="submit">{{ __('Login') }}
            </button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
       
        <div class="col-xs-6 align-right">
            <a class="btn btn-link pl-0" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
    </div>
</form>
@endsection
