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

                                  <h5><label>Summary of Accounts</label></h5>

                                    <hr>

                                </div>


                                <form method="POST" action="/wallet_configurations/value">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>WALLET BALANCES:</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>{{session('wallet_balances')}}</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>TAX </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>{{session('tax')}}</label>
                                                </div>
                                            </div>




                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>FEES EARNED </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>{{session('revenue')}}</label>
                                                </div>
                                            </div>






                                        </div>
                                    </div>


                                    <!-- /.box-body -->

                                    <!-- /.box-body -->

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
