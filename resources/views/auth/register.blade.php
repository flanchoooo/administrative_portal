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
                                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        }, 2000 ); // 5 secs

                                    });
                                </script>

                                @if ($flash = session('notification'))

                                    @php

                                    if(session('notification') == 'Operation completed.'){

                                    echo '<center><div  class="alert alert-success" role="alert">'.$flash
                                        .'</div></center>';

                                    }else{

                                     echo '<center><div  class="alert alert-danger" role="alert">'.$flash
                                        .'</div></center>';

                                    }


                                    @endphp

                                @endif



                                <form method="POST"  action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                    @csrf
                                    <div class="form-group has-feedback">

                                        <input placeholder="First Name" id="name" type="text" class=" form-control-user form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input placeholder="Last Name" id="text" type="text" class="form-control-user form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required>
                                        @if ($errors->has('lastname'))
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input placeholder="Email" id="email" type="email" class="form-control-user form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input placeholder="Username" id="text" type=text class="form-control-user form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" required>

                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-6">
                                            <input  placeholder="Mobile" id="mobile" type="number" class=" form-control-user form-control" name="mobile" required>

                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                            @endif

                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input placeholder="Password" id="password" type="password" class="form-control-user form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-6">
                                            <input  placeholder="Confirm Password" id="password-confirm" type="password" class=" form-control-user form-control" name="password_confirmation" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                            @endif

                                        </div>
                                    </div>





                                    <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>

                                </form>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
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



