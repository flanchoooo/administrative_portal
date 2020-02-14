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
                                    <h1 class="h4 text-gray-900 mb-4">POS Employees</h1>

                                    <hr>
                                </div>
                                @php

                                    $id = Auth::user()->role_permissions_id;
                                    $role = \App\Role_User::where('id', $id)->get()->first();
                                     $transactions = $role->create_merchant;

                                      if(!isset($role->create_merchant)|| trim($role->create_merchant) == ''){
                                          echo '';

                                          }else{

                                         echo $display = '<a href="/employee/creates"><label>Create Employee</label></a> <br>';
                                         }
                                @endphp

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">

                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>State</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">

                                                <td>{{$values->id}}</td>
                                                <td>{{$values->first_name.' '. $values->last_name}}</td>
                                                <td>{{$values->account_status}}</td>
                                                <td>{{$values->user_name}}</td>
                                                <td>{{$values->email}}</td>
                                                <td>
                                                    <form role="form" action="/roles/search_user" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->phone}}"  name="name" >
                                                        <center><button type="submit" class="btn btn-primary">View</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/tellers/display" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->belong_to->id}}"  name="merchant_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="user_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->first_name.' '. $values->last_name}}"  name="teller" >
                                                        <center><button type="submit" class="btn btn-success">Add Teller</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/tellers/update" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->belong_to->id}}"  name="merchant_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="user_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->first_name.' '. $values->last_name}}"  name="teller" >
                                                        <center><button type="submit" class="btn btn-primary">Reset PIN</button></center>
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

