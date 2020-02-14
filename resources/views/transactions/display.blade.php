@extends('layouts.tab')


@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-11">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Transactions</h1>

                                    <hr>
                                </div>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%">

                                        <thead>
                                        <tr>

                                            <th>Ref</th>
                                            <th>Txn Type</th>
                                            <th>State</th>
                                            <th>Amount</th>
                                            <th>Batch</th>
                                            <th>Date</th>
                                            <th></th>
                                            <th hidden>account_debited</th>
                                            <th hidden>merchant_account</th>
                                            <th hidden>trust_account</th>
                                            <th hidden>zimswitch_txn_amount</th>
                                            <th hidden>revenue_fees</th>
                                            <th hidden>tax</th>
                                            <th hidden>debit_mdr_from_merchant</th>
                                            <th hidden>interchange_fees</th>
                                            <th hidden>zimswitch_fee</th>
                                            <th hidden>total_credited</th>
                                            <th hidden>switch_reference</th>
                                            <th hidden>merchant_id</th>
                                            <th hidden>description</th>
                                            <th hidden>pan</th>
                                            <th hidden>account_credited</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">

                                                <td>{{$values->id}}</td>
                                                <td>@php

                                                     $name = \App\TxnTypes::find($values->txn_type_id);
                                                    echo $name->name;

                                                @endphp
                                                   </td>
                                                <td>@php
                                                            if($values->transaction_status == '1'){

                                                            echo 'COMPLETED';
                                                            }else{

                                                            echo 'FAILED';

                                                            }

                                                            @endphp
                                                </td>
                                                <td>{{$values->transaction_amount}}</td>
                                                <td>{{$values->batch_id}}</td>
                                                <td>{{$values->created_at}}</td>

                                                <td>
                                                    <form role="form" action="/transaction/view" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-success">View</button></center>
                                                    </form>
                                                </td>
                                                <th hidden>{{$values->account_debited}}</th>
                                                <th hidden>{{$values->merchant_account}}</th>
                                                <th hidden>{{$values->trust_account}}</th>
                                                <th hidden>{{$values->zimswitch_txn_amount}}</th>
                                                <th hidden>{{$values->revenue_fees}}</th>
                                                <th hidden>{{$values->tax}}</th>
                                                <th hidden>{{$values->debit_mdr_from_merchant}}</th>
                                                <th hidden>{{$values->interchange_fees}}</th>
                                                <th hidden>{{$values->zimswitch_fee}}</th>
                                                <th hidden>{{$values->total_credited}}</th>
                                                <th hidden>{{$values->switch_reference}}</th>
                                                <th hidden>{{$values->merchant_id}}</th>
                                                <th hidden>{{$values->description}}</th>
                                                <th hidden>{{$values->pan}}</th>
                                                <th hidden>{{$values->account_credited}}</th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- Logout Modal-->
    @foreach($records as $record => $values)
    <div class="modal fade" id="txnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaction ID: {{ $values->id }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <script>
        $(function(){
            $('#orderModal').modal({
                keyboard: true,
                backdrop: "static",
                show:false,

            }).on('show', function(){
                var getIdFromRow = $(event.target).closest('tr').data('id');
                //make your ajax call populate items or what even you need
                $(this).find('#orderDetails').html($('<b> Order Id selected: ' + getIdFromRow  + '</b>'))
            });
        });
    </script>


@endsection

