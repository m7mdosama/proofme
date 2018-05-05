@extends('layouts.login-new')
@section('pageTitle','Login')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 -align-left">

                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('assets/Login_v1/images/img-01.png') }}" alt="IMG">
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        <span class="login100-form-title">Member Login</span>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                            <div class="wrap-input100">
                                <input id="email" type="email" class="input100 " placeholder="Email" name="email"
                                       value="{{ old('email') }}" required autofocus>

                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>


                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
						</span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox ">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    Login
                                </button>
                            </div>

                            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                            {{--Forgot Your Password?--}}
                            {{--</a>--}}
                            <div class="text-center ">
                                <a class="txt2" href="{{ route('register') }}">
                                    Create your Account
                                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

















@endsection
