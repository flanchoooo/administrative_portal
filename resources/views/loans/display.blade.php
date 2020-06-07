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
                                    <h1 class="h4 text-gray-900 mb-4">Loans Pending Approval</h1>
                                    <hr>
                                    <script>
                                        $("document").ready(function(){
                                            setTimeout(function(){
                                                $("div.alert").remove();
                                            },8000 ); // 5 secs

                                        });
                                    </script>
                                    @if ($flash = session('loan_success'))
                                        <center><div  class="alert alert-success" role="alert">
                                                {{$flash}}
                                            </div></center>
                                    @endif


                                    @if ($flash = session('loan_failed'))
                                        <center><div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div></center>
                                    @endif
                                </div>
                                <br>
                                <div class="box-body">
                                    <!-- /.table-responsive -->
                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Applicant</th>
                                            <th>Tenure</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>created_at</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>@php

                                                     $result = \App\LendingKYC::whereId($values->applicant_id)->first();
                                                      echo $result["first_name"] . ' '. $result["last_name"]
                                                        @endphp</td>
                                                <td>{{$values->loan_duration}}</td>
                                                <td>{{$values->status}}</td>
                                                <td>{{$values->amount}}</td>
                                                <td>{{$values->created_at}}</td>
                                                <td>{{$values->description}}</td>
                                                <td><form role="form" action="/loans/process" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="DECLINED"  name="status" >
                                                         @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->loans;

                                                          if(!isset($transactions)|| trim($transactions) == ''){
                                                              echo '';

                                                              }else{

                                                             echo $display = '<center><button type="submit" class="btn btn-danger">Decline</button></center>';
                                                             }
                                                        @endphp
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/loans/process" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="PENDING AUTHORIZATION"  name="status" >
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
                                                                        <a class="btn btn-danger" href="/loans/display">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->loans_approve;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                echo $display = '<center><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#delete_device">Approve</a><center>';
                                                                }
                                                        @endphp

                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/loans/process" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="AUTHORIZED"  name="status" >
                                                        <div class="modal fade" id="authorize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <a class="btn btn-danger" href="/loans/display">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->loans_authorize;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                echo $display = '<center><a class="btn btn-success" href="#" data-toggle="modal" data-target="#authorize">Authorize</a><center>';
                                                                }
                                                        @endphp



                                                    </form>
                                                </td>
                                                <td>
                                                    <form role="form" action="/loans/profile" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->loans;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                 echo $display = '<center><button type="submit" class="btn btn-primary">Applicant</button></center>';
                                                                }
                                                        @endphp
                                                    </form>
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
@endsection

