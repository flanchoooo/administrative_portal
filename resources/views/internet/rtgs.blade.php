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
                                    <h1 class="h4 text-gray-900 mb-4">RTGS Transactions</h1>

                                    <hr>
                                </div>


                                <br>
                                <div class="box-body">
                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Batch</th>
                                            <th>Source Account</th>
                                            <th>Destination Account</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th></th>
                                            <th hidden>destination_account_name</th>
                                            <th hidden>batch_id</th>
                                            <th hidden>bank_name</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td id="daterange-btn">{{$record->id}}</td>
                                                <td class="center">{{$record->batch_id}}</td>
                                                <td >{{$record->source_account}}</td>
                                                <td >{{$record->destination_account}}</td>
                                                <td>{{$record->amount}}</td>
                                                <td >{{$record->status}}</td>
                                                <td>{{$record->created_at}}</td>
                                                <td>
                                                    <form role="form" action="/internet/process_rtgs" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >

                                                        <div class="modal fade" id="delete_device" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
                                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button  type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                                                        <a class="btn btn-danger" href="/devices/display">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->rtgs;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                echo $display = '<center><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#delete_device">Process</a><center>';
                                                                }
                                                        @endphp



                                                    </form>
                                                </td>
                                                <td hidden>{{$record->destination_account_name}}</td>
                                                <td hidden>{{$record->batch_id}}</td>
                                                <td hidden>{{$record->bank_name}}</td>

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

