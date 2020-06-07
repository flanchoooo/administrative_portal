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

                                  <h5><label>Confirm adjustment </label></h5>

                                    <hr>

                                </div>


                                <form method="POST" action="/wallet_configurations/adjust">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <p>Source Mobile Account Details</p>
                                                <p>Account Name: {{session('source_first_name').' '.session('source_last_name')}}</p>
                                                <p>Source Balance: {{session('source_balance')}}</p>
                                                <p>Debit: - {{session('source_amount')}}</p>
                                                <p>Narration:  {{session('narration')}}</p>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <p>Destination Mobile Account Details</p>
                                                    <p>Account Name: {{session('destination_first_name').' '.session('destination_last_name')}}</p>
                                                    <p>Source Balance: {{session('destination_balance')}}</p>
                                                    <p>Credit:  {{session('source_amount')}}</p>
                                                    <p>Narration:  {{session('narration')}}</p>
                                                </div>
                                            </div>


                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}">
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">amount</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="amount" value="{{   session('source_amount') }}">
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">source_mobile</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="source_mobile" value="{{  session('source_mobile') }}">
                                            </div>


                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">destination_mobile</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="destination_mobile" value="{{ session('destination_mobile') }}">
                                            </div>


                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">narration</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="narration" value="{{ session('narration') }}">
                                            </div>









                                        </div>
                                    </div>


                                    <!-- /.box-body -->

                                    <!-- /.box-body -->
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                    <a class="btn btn-danger" href="{{ URL::to('/wallet_configurations/adjustment_view') }}">{{ __('Cancel') }}</a>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
