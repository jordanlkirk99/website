@extends('app.main')

@section('title', 'Reset Your Password')
@section('header-main', 'Reset Your Password')
@section('page-section', 'auth')
@section('page-id', 'password-email')

@section('content')
    <p>If you have forgotten the password for your Backstage account, simply enter your email address into the field below. You will be sent a code which
        will allow you to change your password.</p>
    {!! Form::open() !!}
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fa fa-envelope"></span>
                </span>
            </div>
            {!! Form::text('email', null, ['placeholder' => 'Enter your email address']) !!}
            @InputError('email')
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-success btn-full" data-disable="click" type="submit">
            <span class="fa fa-send"></span>
            <span>Send Reset Link</span>
        </button>
        <span class="form-link">
            <a href="{{ route('auth.login') }}">Cancel</a>
        </span>
    </div>
    {!! Form::close() !!}
@endsection
