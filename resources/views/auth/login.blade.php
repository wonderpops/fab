@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <h1 class="title" style="margin-left: 150px; color: white;">Вход</h1>

            <div class="field">
                <label class="login-lables">E-Mail</label>
                <div class="control has-icons-left">
                    <input id="email" type="email" class="input is-primary" name="email" value="{{ old('email') }}" required autofocus>
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color: rgb(131, 48, 48)">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="field">
                <label class="login-lables">Password</label>
                <div class="control has-icons-left">
                    <input id="password" type="password" class="input is-primary" name="password" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                    @if ($errors->has('password'))
                    <span class="help-block" style="color: rgb(131, 48, 48)">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><label style="color: white"> Remember Me</abel>
                        </label>
                    </div>
                </div>
            </div>

            <div class="field is-grouped is-grouped-centered">
                    <button type="submit" class="button is-primary is-inverted">
                        Login
                    </button>
            </div>
        </form>
    </div>
</div>
@endsection
