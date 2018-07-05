@extends('app.main')

@section('title', 'Reset Your Password')
@section('header-main', 'Reset Your Password')
@section('page-section', 'auth')
@section('page-id', 'password-reset')

@section('content')
    <p>To complete the process, confirm your email address and enter a new password.</p>
    {!! Form::open() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-envelope"></span>
                    </span>
                </div>
                {!! Form::text('email', null, ['placeholder' => 'Confirm your email address']) !!}
                @InputError('email')
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-key"></span>
                    </span>
                </div>
                {!! Form::input('password', 'password', null, ['placeholder' => 'Enter a new password']) !!}
                @InputError('password')
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-key"></span>
                    </span>
                </div>
                {!! Form::input('password', 'password_confirmation', null, ['placeholder' => 'Confirm your password']) !!}
                @InputError('password_confirmation')
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-full" data-disable="click" data-disable-text="Resetting password ..." type="submit">
                <span class="fa fa-check"></span>
                <span>Reset Password</span>
            </button>
            <span class="form-link">
                <a href="{{ route('auth.login') }}">Cancel</a>
            </span>
        </div>
    {!! Form::close() !!}
@endsection
