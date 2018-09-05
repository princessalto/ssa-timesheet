@extends('Pluma::layouts.auth')

@section('content')
<div class="container">
    <div class="login-box">
        <div class="login-logo">
            <a href="dashboard"><img src="../img/logos/main.png" alt=""></a>
            <div class="login-box-body">
                <p class="login-box-msg log-in">Sign In</p>
                <form role="form" method="POST" action="{{ action('\Pluma\Controllers\Auth\LoginController@login') }}">

                    {{ csrf_field() }}

                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="Email">
                        <span style="font-size: 14px;" class="fa fa-lock form-control-feedback"></span>
                        @include('Pluma::errors.span', ['field' => 'email'])
                    </div>

                    <div class="form-group has-feedback">
                        <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                        <span style="font-size: 14px;" class="fa fa-user form-control-feedback"></span>
                        @include('Pluma::errors.span', ['field' => 'password'])
                    </div>

                    <div class="checkbox icheck">
                        <label class="log-in">
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('css')
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/dist/css/AdminLTE.min.css') }}">

    <style>
        body {
            background: #d2d6de !important;
        }
    </style>
@endpush
