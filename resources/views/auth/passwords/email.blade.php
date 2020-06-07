@extends('layouts.non_master')

@section('content')

<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="p-5">


                            <div class="text-center">
                                <center><h2 class="h4 text-gray-900 mb-4"><img src="\Capture.png"></h2></center>
                                <hr>
                                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>

                                <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                            </div>

                            <form  method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                                @csrf
                                <div class="form-group has-feedback">
                                    <input id="email" type="email" class="form-control-user form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter your address" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button class="btn btn-primary btn-user btn-block" >Reset Password</button>

                            </form>


                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">Create an Account!</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>







@endsection
