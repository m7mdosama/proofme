@extends('layouts.login-new')
@section('pageTitle','Register')

@section('content')


    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('assets/Login_v1/images/img-01.png') }}" alt="IMG">
                </div>

                <div class="panel-body">


                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                     <span class="login100-form-title">Register New Member</span>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="wrap-input100">

                                <input id="name" type="text" class="input100" placeholder="Name" name="name"
                                       value="{{ old('name') }}" required autofocus>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="wrap-input100">

                                <input id="email" type="email" class="input100" placeholder="E-Mail Address"
                                       name="email" value="{{ old('email') }}" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="wrap-input100">

                                <input id="password" type="password" class="input100" placeholder="Password"
                                       name="password" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="wrap-input100">

                                <input id="password-confirm" type="password" class="input100"
                                       placeholder="Confirm Password" name="password_confirmation" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            </div>
                        </div>


                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Register
                            </button>
                        </div>
                    </form>


                </div>

            </div>

        </div>

    </div>


















@endsection
