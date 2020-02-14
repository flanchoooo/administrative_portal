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

                                    <h1 class="h4 text-gray-900 mb-4">{{session('transaction_type')}}</h1>

                                    <hr>

                                </div>


                                <form method="POST" action="#">
                                    @csrf
                                    <div class="box-body">



                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Card Number: {{  session('card_number')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Account: {{session('account_number')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Transaction Amount: {{session('amount') /100}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Terminal ID: {{session('terminal_id')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Response Code: {{session('response_code')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Acquirer Bank {{session('acquirer_bank')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Acquirer Bin {{session('acquirer_bin')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>BR Reference {{session('br_reference')}}</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Transaction Description {{session('narration')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Mode {{session('mode')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>RRN {{session('rrn')}}</label>
                                                </div>
                                            </div>



                                    </div>
                                    <!-- /.box-body -->

                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
