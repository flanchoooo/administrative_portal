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
                                    <h1 class="h4 text-gray-900 mb-4">Update Wallet Class of Service</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="/wallet_configurations/update" aria-label="{{ __('Add Product') }}">

                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{session('id')}}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Minimum Daily Limit</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="min_daily" value="{{session('minimum_daily')}}" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Maximum Daily Limit</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="max_daily" value="{{session('maximum_daily')}}" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Minimum Balance</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="min_balance" value="{{session('minimum_balance')}}" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Maximum Balance</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="max_balance" value="{{session('maximum_balance')}}" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Minimum Monthly Limit</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="min_monthly" value="{{session('minimum_monthly')}}" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Maximum Monthly Limit</label>
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="max_monthly" value="{{session('maximum_monthly')}}" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Class of Service Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="cos_name" value="{{session('cos_name')}}" required autofocus>
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