@extends('layouts.tab')


@section('content')
    <div class="row justify-content-center" style=" .container-fluid {
    padding-right:15px;
    padding-left:15px;
    margin-right:auto;
    margin-left:auto
 }">

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

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">

                                        <thead>
                                        <tr>
                                            <th>PAN</th>
                                            <th>Type</th>
                                            <th>Trace</th>
                                            <th>RRN</th>
                                            <th>Response</th>
                                            <th>Reverse</th>
                                            <th>Amount</th>
                                            <th>Destination</th>
                                            <th>Source</th>
                                            <th>BR Ref</th>
                                            <th>Date</th>
                                            <th>Bank</th>
                                            <th>Direction</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">

                                                <td>{{"$values->card_number"}}</td>
                                                <td>{{str_replace('_',' ',$values->transaction_type)}}</td>
                                                <td>{{"$values->trace_number"}}</td>
                                                <td>{{"$values->rrn"}}</td>
                                              <td>{{"$values->response_code"}}</td>
                                              <td>@php
                                                      if($values->response_code == 0){
                                                                echo 'NOT REVERSED';
                                                                }else{
                                                                    echo 'REVERSED';
                                                                }


                                                      @endphp</td>
                                                <td>@php
                                                       echo $cash_back = money_format('%i', $values->amount/100);

                                                        @endphp</td>
                                                <td>{{"$values->account_number"}}</td>
                                                <td>{{"$values->source_account_number"}}</td>
                                                <td>{{"$values->br_reference"}}</td>
                                                <td>{{--@php
                                                        $time = substr($values->created_at,0,10);
                                                        $gmtTimezone = new DateTimeZone('CAT');
                                                        $date = new DateTime('@'.$time, $gmtTimezone);
                                                        echo $dt =  $date->format('Y-m-d H:i:s');
                                                    @endphp--}}
                                                    {{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestampMs($values->created_at)->toDateTimeString())->addHours(2) }}
                                                </td>
                                                <td>{{"$values->acquirer_bank"}}</td>
                                                <td>{{"$values->direction"}}</td>
                                                <td>
                                                    <form role="form" action="/eft/view" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->card_number}}"  name="card_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->transaction_type}}"  name="transaction_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->trace_number}}"  name="trace_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->amount}}"  name="amount" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->rrn}}"  name="rrn" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->terminal_id}}"  name="terminal_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->response_code}}"  name="response_code" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->account_number}}"  name="account_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->acquirer_bank}}"  name="acquirer_bank" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->acquirer_bin}}"  name="acquirer_bin" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->br_reference}}"  name="br_reference" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->narration}}"  name="narration" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->mode}}"  name="mode" >
                                                        @php

                                                                   echo $display = '<center><button type="submit" class="btn btn-primary">&nbsp View  &nbsp</button></center>';

                                                        @endphp
                                                    </form>
                                                </td>

                                                </td>
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







@endsection

