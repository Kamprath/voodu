@extends('layouts.app')

@section('content')

    <section id="section-register" class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <div class="box">
                        <h4 class="title">Voodu</h4>
                        <p class="subtitle has-text-grey">Register your account</p>

                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            {{-- Name --}}
                            <div class="field">
                                <div class="control">
                                    <input class="input"
                                           type="text"
                                           placeholder="Full Name"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="field">
                                <div class="control">
                                    <input class="input"
                                           type="email"
                                           placeholder="E-Mail Address"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required>

                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="field">
                                <div class="control">
                                    <input class="input"
                                           type="password"
                                           placeholder="Password"
                                           id="password"
                                           name="password"
                                           required>

                                    @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Password Confirm --}}
                            <div class="field">
                                <div class="control">
                                    <input class="input"
                                           type="password"
                                           placeholder="Confirm Password"
                                           id="password-confirm"
                                           name="password_confirmation"
                                           required>
                                </div>
                            </div>

                            <button type="submit" class="button is-block is-primary is-medium is-fullwidth">Register</button>
                        </form>
                    </div>
                    <p class="login-links">
                        Already have an account? <a href="{{ route('login') }}" class="is-underlined">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
