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
                                    <h1 class="h4 text-gray-900 mb-4">Destroy E-Value</h1>
                                    <h5 class="box-title">NB:This feature  will destroy e-value and this can only be reversed by an administrator.</h5>
                                    <hr>

                                    @if (isset($success_notification))
                                        <div  class="alert alert-success" role="alert">{{$success_notification}}</div>
                                    @endif

                                    @if (isset($notification))
                                        <div  class="alert alert-danger" role="alert">{{$notification}}</div>
                                    @endif
                                </div>

                                <form method="POST" action="/wallet_configurations/preauth_d" aria-label="{{ __('Add Product') }}">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Destination Mobile Account</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="destination_mobile" value="" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Amount</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="amount" value="" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <br>
                                                <label for="exampleInputEmail1">Narration</label>
                                                <textarea id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="description" value="" required autofocus></textarea>
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /.box-body -->
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