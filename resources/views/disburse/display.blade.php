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
                                    <h1 class="h4 text-gray-900 mb-4">Bulk Disbursements</h1>

                                    <hr>
                                </div>

                                <a href="{{"/disburse/createview"}}"><label>Bulk upload</label></a> <br>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },2000 ); // 5 secs

                                    });
                                </script>
                                <div>


                                    @if ($flash = session('error'))
                                        <div  class="alert alert-danger" role="alert">
                                            <div style="text-align: center;">{{$flash}}</div>
                                        </div>
                                    @endif

                                </div>



                                <div>
                                    <a href="/disburse/cancel"><button type="submit" class="btn btn-outline-primary">CANCEL</button></a>
                                    <a href="/disburse/approve"><button type="submit" class="btn btn-outline-success">APPROVE</button></a>
                                    <a href="/disburse/reports"><button type="submit" class="btn btn-outline-danger">REPORTS</button></a>
                                </div>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Source</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->source_account}}</td>
                                                <td>{{$values->destination_account}}</td>
                                                <td>{{$values->amount}}</td>
                                                <td>@php
                                                        if($values->transaction_status == '1'){
                                                        echo 'INITIATED';
                                                        }

                                                      if($values->transaction_status == '3'){
                                                        echo 'COMPLETED';
                                                        }
                                                        @endphp</td>
                                                <td>{{ $values->description }}</td>
                                                <td>{{ $values->created_at }}</td>
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

