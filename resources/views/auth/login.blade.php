@extends('app.main')

@section('title', 'Log In')
@section('header-main', 'Log In')
@section('page-section', 'auth')
@section('page-id', 'login')

@section('content')
    <p>To access the members' area you need a username and password; these are provided once you have attended our induction. If you have attended this
        induction but have not received your log in details please <a href="mailto:sec@bts-crew.com">contact the secretary</a>.</p>

    {!! Form::open() !!}

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fa fa-user"></span>
                </span>
            </div>
            {!! Form::text('username', null, ['placeholder' => 'Enter your username or email address']) !!}
            @InputError('username')
        </div>
    </div>

    <div class="form-group @InputClass('password')">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fa fa-key"></span>
                </span>
            </div>
            {!! Form::input('password', 'password', null, ['placeholder' => 'Enter your password']) !!}
            @InputError('password')
        </div>
        <div class="form-text small">
            {!! link_to_route('auth.pwd.email', 'Forgotten your password?') !!}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-success" data-disable="click" type="submit">
            <span>Log in</span>
        </button>
    </div>
    {!! Form::close() !!}
@endsection
