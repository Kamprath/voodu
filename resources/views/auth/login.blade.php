@extends('layouts.app')

@section('content')

<section id="section-login" class="hero is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <div class="box">
                    <figure class="avatar">
                        <img src="http://lorempizza.com/85/85">
                    </figure>

                    <h4 class="title">Voodu</h4>
                    <p class="subtitle has-text-grey">Sign in to your workspace</p>

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <div class="control">
                                <input class="input is-medium{{ $errors->has('email') ? ' is-danger' : null }}"
                                       type="email"
                                       placeholder="Email"
                                       autofocus=""
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('email'))
                                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-medium{{ $errors->has('password') ? ' is-danger' : null }}"
                                       id="password"
                                       type="password"
                                       name="password"
                                       required
                                       placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <button type="submit" class="button is-block is-success is-medium is-fullwidth">Login</button>
                    </form>
                </div>
                <p class="login-links">
                    <a href="{{ route('register') }}">Sign Up</a> &nbsp;·&nbsp;
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </p>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('button[type=submit]').className += ' is-loading';
    });
</script>

@endsection
