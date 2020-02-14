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

                                  <h5><label>Confirm destroying e-value </label></h5>

                                    <hr>

                                </div>


                                <form method="POST" action="/wallet_configurations/value_d">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Destination Mobile Account: {{session('destination_mobile')}}</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Account Name: {{session('first_name').' '. session('last_name')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Amount: {{session('amount')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Destination Account Balance: {{session('balance')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Narration: {{session('description')}}</label>
                                                </div>
                                            </div>


                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="amount" value="  {{session('amount')}}" required autofocus>
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="destination_mobile" value="{{session('destination_mobile')}}" required autofocus>
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="description" value="{{session('description')}}" required autofocus>
                                            </div>




                                        </div>
                                    </div>


                                    <!-- /.box-body -->

                                    <!-- /.box-body -->
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                    <a class="btn btn-danger" href="{{ URL::to('/wallet_configurations/destroy_view') }}">{{ __('Cancel') }}</a>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
