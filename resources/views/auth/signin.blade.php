@extends('templates.default')

@section('content')
    <h3>Sign in</h3>
    <div class="row">
        <div class="col-lg-6">
            <form class="form-vertical" role="form" method="post" action="{{ route('auth.signin') }}">
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="username" class="control-label">Your Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="">
                </div>
                @if($errors->has('username'))
                    <span class="help-block">
                        {{ $errors->first('username') }}
                    </span>
                @endif
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="control-label">Your Password</label>
                    <input type="password" name="password" class="form-control" id="password" value="">
                </div>
                @if($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <div class="checkbox">
                    <label for="remeber-me">
                        <input type="checkbox" name="remember-me">Remember me
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Sign up</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@stop