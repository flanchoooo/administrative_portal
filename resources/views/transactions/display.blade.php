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
                                    <h1 class="h4 text-gray-900 mb-4">Wallet Transactions</h1>

                                    <hr>
                                </div>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%"  cellspacing="">
                                        <thead>
                                        <tr>

                                            <th>Ref</th>
                                            <th>Type</th>
                                            <th>Account Debited</th>
                                            <th>Account Credited</th>
                                            <th>Amount</th>
                                            <th>Reference</th>
                                            <th>Status</th>
                                            <th hidden>Balance Before</th>
                                            <th hidden>Balance After</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>@php
                                                        $name = \App\TxnTypes::find($values->txn_type_id);
                                                            echo $name["name"];
                                                    @endphp</td>
                                                <td>{{$values->account_debited}}</td>
                                                <td>{{$values->account_credited}}</td>
                                                <td>{{$values->transaction_amount}}</td>
                                                <td>{{$values->transaction_reference}}</td>
                                                <td>{{$values->transaction_status}}</td>
                                                <td hidden>{{$values->balance_before}}</td>
                                                <td hidden>{{$values->balance_after}}</td>
                                                <td>{{$values->created_at}}</td>
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


@endsection

