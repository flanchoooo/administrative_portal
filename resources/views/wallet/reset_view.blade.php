@extends('layouts.tab')

@section('content')

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4"> Wallet  PIN Reset </h1>
                                    <hr>
                                </div>

                                <div>
                                    @if (isset($success_notification))
                                        <div  class="alert alert-success" role="alert">{{$success_notification}}</div>
                                    @endif

                                    @if (isset($notification))
                                        <div  class="alert alert-danger" role="alert">{{$notification}}</div>
                                    @endif

                                </div>


                                <form method="POST" action="/wallet/reset_preauth">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Wallet Mobile</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" required autofocus>
                                        </div>

                                    </div>

                                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>







@endsection
