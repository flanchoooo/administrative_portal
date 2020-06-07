@extends('layouts.non_master')

@section('content')

    <div class="row justify-content-center">

    <div class="col-xl-6 col-lg-12 col-md-9">
        <br>
        <br>
        <br>
        <br>

        <div class="text-center">

        </div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h3 class="h4 text-gray-900 mb-4"></h3>
                            </div>

                            @if ($flash = session('error'))
                                <div  class="alert alert-danger" role="alert">
                                    {{$flash}}
                                </div>
                            @endif
                            A<center><h2 class="h4 text-gray-900 mb-4"><img src="\Capture.png"></h2></center>
                            <hr>
                            <center><h2 class="h4 text-gray-900 mb-4">Login</h2></center>

                            <form  method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group has-feedback">
                                    <input id="email" placeholder="Username or Email" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login"  value="{{ old('username') ?: old('email') }}" required autofocus>

                                    @if ($errors->has('username') || $errors->has('email'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>


                                <div class="form-group has-feedback">
                                    <input id="password"  placeholder="Password" type="password" class="form-control-user form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary btn-user btn-block">Sign In</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>


@endsection
