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

                                    @foreach($records as $rec)
                                        @php


                                       $name = \App\TxnTypes::find($rec->txn_type_id);
                                         echo  '<h1 class="h4 text-gray-900 mb-4">'. $name->name.'</h1>';

                                        @endphp


                                    @endforeach

                                    <hr>

                                </div>

                                @foreach($records as $rec)
                                <form method="POST" action="#">
                                    @csrf
                                    <div class="box-body">



                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Transaction Reference: {{$rec->id}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Account Debited: {{$rec->account_debited}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Account Credited: {{$rec->account_credited}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Transaction Amount: {{$rec->transaction_amount}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Total Debited From Client: {{$rec->total_debited}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tax: {{$rec->tax}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Revenue Fees: {{$rec->revenue_fees}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Zimswitch Fees: {{$rec->interchange_fees}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Transaction Date: {{$rec->created_at}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>MDR Debit from Merchant:{{$rec->debit_mdr_from_merchant}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Interchange fee Debited from Zimswitch:{{$rec->interchange_fees}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Transaction Status:
                                                        @php
                                                            if($rec->transaction_status == '3'){

                                                            echo 'REVERSED';
                                                            }
                                                            if($rec->transaction_status == '1'){

                                                            echo 'COMPLETED';
                                                             }

                                                        if($rec->transaction_status == '0'){

                                                            echo 'FAILED';
                                                             }





                                                        @endphp
                                                        </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Merchant: @php

                                                                $name = \App\Merchant::find($rec->merchant_id);

                                                                if(!isset($name)){

                                                               echo 'Wallet Transaction';
                                                                }else{

                                                                    echo $name->name;

                                                                }


                                                                @endphp</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Description:{{$rec->description}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Card: @php



                                                            echo $var = substr_replace($rec->pan, str_repeat("*", 6), 6, 6);
                                                        @endphp</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Reversed:{{$rec->reversed}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bill Reference:{{$rec->switch_reference}}</label>
                                                </div>
                                            </div>






                                        </div>


                                    </div>
                                    <!-- /.box-body -->


                                </form>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
