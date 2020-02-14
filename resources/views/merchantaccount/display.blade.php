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
                                    <h1 class="h4 text-gray-900 mb-4">Merchant Configuration</h1>

                                    <hr>
                                </div>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Merchant Name</th>
                                            <th>Account</th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>@php
                                                        $name =  \App\Merchant::all()->where('id',$values->merchant_id);
                                                            foreach ($name as $n){

                                                            echo $n->name;

                                                            }
                                                    @endphp
                                                </td>
                                                <td>{{$values->account_number}}</td>

                                                <td>
                                                    <form role="form" action="/merchantaccount/updateview" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->account_number}}"  name="account_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->merchant_id}}"  name="id" >

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->update_merchant_acc;

                                                          if(!isset($transactions)|| trim($transactions) == ''){
                                                              echo '';

                                                              }else{

                                                             echo $display = '<center><button type="submit" class="btn btn-success">Edit</button></center>';
                                                             }
                                                        @endphp
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/merchantaccount/delete" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->merchant_id}}"  name="merchant_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{Auth::user()->id}}"  name="updated_by" >

                                                        <div class="modal fade" id="delete_merchant_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <a class="btn btn-danger" href="/merchantaccount/display">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>







                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                         $transactions = $role->update_merchant_acc;

                                                          if(!isset($transactions)|| trim($transactions) == ''){
                                                              echo '';

                                                              }else{

                                                             echo $display = '<center><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#delete_merchant_account">Delete</a></center>';
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

