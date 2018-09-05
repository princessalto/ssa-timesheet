<div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Address</label>

    <div class="col-md-8">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="your.email@domain.com">

        @if ($errors->has('email'))
            <span class="error help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

    <div class="col-md-8">
        <input id="password" type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="error help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember Me
            </label>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-log-in">&nbsp;</i>Login
        </button>

        <a class="btn btn-link" href="{{ action('Auth\PasswordController@showResetForm') }}"><small>Forgot Your Password?</small></a>
    </div>
</div>