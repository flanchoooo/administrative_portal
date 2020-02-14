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
                                    <h1 class="h4 text-gray-900 mb-4">Corporate Profiles</h1>

                                    <hr>
                                </div>

                                <a href="{{"/corporates/createview"}}"><label>Create Corporate Profile</label> </a> <br>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Account Number</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->corporate_id}}</td>
                                                <td>{{$values->name}}</td>
                                                <td>{{$values->account_id}}</td>
                                                <td>@php

                                                        if ($values->status == '1'){

                                                        echo 'ACTIVE';

                                                        }else{

                                                        echo 'IN-ACTIVE';

                                                        }
                                                    @endphp</td>
                                                <td>{{$values->created_at}}</td>

                                                <td>
                                                    <form role="form" action="/corporate/view" method="GET">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->corporate_id}}"  name="id" >


                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->corporate;

                                                          if(!isset($transactions)|| trim($transactions) == ''){
                                                              echo '';

                                                              }else{

                                                             echo $display = '<center><button type="submit" class="btn btn-success">View</button></center>';
                                                             }
                                                        @endphp
                                                    </form>
                                                </td>

                                            <!-- <td>
                                                    <form role="form" action="/corporate/accounts" method="GET">

                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->corporate_id}}" name="id" >


                                                        @php
                                                /*
                                                $id = Auth::user()->role_permissions_id;
                                                $role = \App\Role_User::where('id', $id)->get()->first();
                                                $transactions = $role->corporate;

                                              if(!isset($transactions)|| trim($transactions) == ''){
                                                  echo '';

                                                  }else{

                                                 echo $display = '<center><button type="submit" class="btn btn-success">Accounts</button></center>';
                                                 }
                                                    */
                                            @endphp
                                                </form>
                                            </td> -->
                                                <td>
                                                    <form role="form" action="/corporate/createuser" method="GET">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->corporate_id}}"  name="id" >


                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->corporate;

                                                          if(!isset($transactions)|| trim($transactions) == ''){
                                                              echo '';

                                                              }else{

                                                             echo $display = '<center><button type="submit" class="btn btn-primary">Users</button></center>';
                                                             }
                                                        @endphp
                                                    </form>
                                                </td>
                                                <td>
                                                    <form role="form" action="/corporate/delete" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->corporate_id}}"  name="id" >



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
                                                            $transactions = $role->corporate;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                echo $display = '<center><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#delete_device">Delete</a><center>';
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

