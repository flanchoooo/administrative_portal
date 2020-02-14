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
                                    <h1 class="h4 text-gray-900 mb-4">Create Fee Profile</h1>

                                    <hr>
                                </div>

                                <div>
                                    <a href="{{"/fee/createview"}}"><label>Create Card Fee Profile</label></a> <br>
                                </div>



                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Minimum</th>
                                            <th>Maximum</th>
                                            <th>Created</th>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>@php

                                                  $name = \App\TxnTypes::where('id',$values->transaction_type_id)->get()->first();

                                                    if(!isset($name)){

                                                    echo  '';

                                                    }
                                                    echo $name->name


                                                @endphp


                                                  </td>
                                                <td>{{$values->minimum_daily}}</td>
                                                <td>{{$values->maximum_daily}}</td>
                                                <td>{{$values->created_at}}</td>
                                                <td>
                                                    <form role="form" action="/fee/updateview" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->fee}}"  name="fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax}}"  name="tax" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->minimum_daily}}"  name="minimum_daily" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->maximum_daily}}"  name="maximum_daily" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->max_daily_limit}}"  name="max_daily_limit" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->zimswitch_fee}}"  name="zimswitch_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->interchange_fee}}"  name="interchange_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->acquirer_fee}}"  name="acquirer_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->cash_back_fee}}"  name="cash_back_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->transaction_type_id}}"  name="transaction_type_id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->transaction_count}}"  name="transaction_count" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->fee}}"  name="fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->fee_type}}"  name="fee_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->minimum_balance}}"  name="minimum_balance" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->type}}"  name="type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->biller_discount}}"  name="biller_discount" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->agent_fee}}"  name="agent_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->cashback_fee_type}}"  name="cashback_fee_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->zimswitch_fee_type}}"  name="zimswitch_fee_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->interchange_fee_type}}"  name="interchange_fee_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->acquirer_fee_type}}"  name="acquirer_fee_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax_type}}"  name="tax_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->fee_type}}"  name="fee_type" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->agent_fee_type}}"  name="agent_fee_type" >
                                                        <center><button type="submit" class="btn btn-success">Edit</button></center>
                                                    </form>
                                                </td>

                                                <td>

                                                    <form role="form" action="/fee/delete" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{  Auth::user()->id }}"  name="created_by" >

                                                        <div class="modal fade" id="fee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <a class="btn btn-danger" href="/fee/display">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <center><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#fee">
                                                                Delete
                                                            </a></center>

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

