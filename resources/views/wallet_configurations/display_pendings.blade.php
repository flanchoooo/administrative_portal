@extends('layouts.tab')


@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Settlement Transactions</h1>

                                    <hr>
                                </div>

                                <a href="{{"/wallet_configurations/destroy_view"}}"><label>Settlement</label></a> <br>

                                <br>


                                @if ($flash = session('notification'))
                                    <center><div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div></center>
                                @endif



                                @if ($flash = session('success_notification'))
                                   <center><div  class="alert alert-success" role="alert">
                                        {{$flash}}
                                    </div></center>
                                @endif


                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%"  cellspacing="">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Narration</th>
                                            <th>Created</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->account_number}}</td>
                                                <td>{{$values->amount}}</td>
                                                <td>{{$values->narration}}</td>
                                                <td>{{$values->created_at}}</td>


                                                <td>
                                                    <form role="form" action="/wallet_configurations/destroy_value" method="POST">

                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{Auth::user()->id}}"  name="updated_by" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="1"  name="state" >

                                                        <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <a class="btn btn-danger" href="/wallet_configurations/display_pendings">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();

                                                             $transactions = $role->e_value_checker;

                                                              if(!isset($transactions)|| trim($transactions) == ''){
                                                                  echo '';

                                                                  }else{

                                                                echo $display = '<center><a class="btn btn-success" href="#" data-toggle="modal" data-target="#approve">  Approve </a></center>';
                                                                 }
                                                        @endphp






                                                    </form>
                                                </td>

                                                <td>

                                                        <form role="form" action="/wallet_configurations/destroy_value" method="POST">

                                                            @csrf
                                                            <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                            <input type="hidden" class="form-control"  placeholder="Company Name" value="{{Auth::user()->id}}"  name="updated_by" >
                                                            <input type="hidden" class="form-control"  placeholder="Company Name" value="2"  name="state" >

                                                            <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <a class="btn btn-danger" href="/wallet_configurations/display_pendings">Cancel</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $id = Auth::user()->role_permissions_id;
                                                                $role = \App\Role_User::where('id', $id)->get()->first();

                                                                 $transactions = $role->e_value_checker;

                                                                  if(!isset($transactions)|| trim($transactions) == ''){
                                                                      echo '';

                                                                      }else{

                                                                    echo $display = '<center><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#reject">  Reject  </a></center>';
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

