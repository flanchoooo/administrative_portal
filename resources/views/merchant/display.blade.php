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

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },3000 ); // 5 secs

                                    });
                                </script>
                                @if ($flash = session('error'))
                                    <div  class="alert alert-danger" role="alert">
                                      <center>{{$flash}}</center>
                                    </div>
                                @endif

                                @php

                                    $id = Auth::user()->role_permissions_id;
                                    $role = \App\Role_User::where('id', $id)->get()->first();
                                     $transactions = $role->create_merchant;

                                      if(!isset($role->create_merchant)|| trim($role->create_merchant) == ''){
                                          echo '';

                                          }else{

                                         echo $display = '<a href="/merchant/create"><label>Create Merchant Profile</label></a> <br>';
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
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th hidden>Identification No.</th>
                                            <th hidden>Address</th>
                                            <th hidden>Mobile</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">

                                                <td>{{$values->id}}</td>
                                                <td>{{$values->name}}</td>
                                                <td>@php

                                                        if ($values->state === '1'){

                                                        echo 'ACTIVE';

                                                        }else{

                                                        echo 'IN-ACTIVE';

                                                        }
                                                    @endphp</td>


                                                <td>
                                                    <form role="form" action="/merchant/updateview" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->name}}"  name="name" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->merchant_code}}"  name="merchant_code" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->mobile}}"  name="mobile" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->address}}"  name="address" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id_number}}"  name="id_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->name}}"  name="name" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax}}"  name="tax" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->reg_number}}"  name="reg_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->city}}"  name="city" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->mdr}}"  name="mdr" >
                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                               $transactions = $role->edit_merchant;

                                                                if(!isset($transactions)|| trim($transactions) == ''){
                                                                    echo '';

                                                                    }else{

                                                                   echo $display = '<center><button type="submit" class="btn btn-primary">&nbsp View  &nbsp</button></center>';
                                                                   }
                                                        @endphp
                                                    </form>
                                                </td>

                                                <td>  <form role="form" action="/pos/display_employees" method="POST">

                                                        @csrf

                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();

                                                             $transactions = $role->add_account;

                                                              if(!isset($transactions)|| trim($transactions) == ''){
                                                                  echo '';

                                                                  }else{

                                                                 echo $display = '<center><button type="submit" class="btn btn-success">Employees</i></button></center>';
                                                                 }
                                                        @endphp
                                                    </form>
                                                </td>
                                                <td>
                                                    <form role="form" action="/merchantaccount/create" method="POST">

                                                        @csrf

                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->name}}"  name="name" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->merchant_code}}"  name="merchant_code" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->mobile}}"  name="mobile" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->address}}"  name="address" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id_number}}"  name="id_number" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->name}}"  name="name" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="idname" @php

                                                            session('idname', $values->id)
                                                        @endphp>
                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();

                                                             $transactions = $role->add_account;

                                                              if(!isset($transactions)|| trim($transactions) == ''){
                                                                  echo '';

                                                                  }else{

                                                                 echo $display = '<center><button type="submit" class="btn btn-primary">Account</i></button></center>';
                                                                 }
                                                        @endphp
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/devices/createview" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="merchant_id" >
                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->add_pos;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                echo $display = '<center><button type="submit" class="btn btn-success">Devices   </i></button><center>';
                                                                }
                                                        @endphp
                                                    </form>
                                                </td>

                                                <td hidden>{{$values->id_number}}</td>
                                                <td hidden>{{$values->address}}</td>
                                                <td hidden>{{$values->mobile}}</td>



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

