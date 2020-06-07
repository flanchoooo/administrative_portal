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
                                    <h1 class="h4 text-gray-900 mb-4">Create Wallet Fee Profile</h1>

                                    <hr>
                                </div>

                                <a href="{{"/internet/fee/createview"}}"><label>Create  Fee Profile</label> </a> <br>
                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%"  cellspacing="">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Minimum</th>
                                            <th>Maximum</th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>@php

                                                    $name = \App\TxnTypes::find($values->transaction_id);
                                                    echo $name["name"];

                                                @endphp</td>
                                                <td>{{$values->minimum_amount}}</td>
                                                <td>{{$values->maximum_amount}}</td>
                                                <td>

                                                    <form role="form" action="/internet/fee/update" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->fixed_fee}}"  name="fixed_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->percentage_fee}}"  name="percentage_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->minimum_amount}}"  name="minimum_amount" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->maximum_amount}}"  name="maximum_amount" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax_fixed}}"  name="tax_fixed" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax_percentage}}"  name="tax_percentage" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="transaction_id" >
                                                        <center><button type="submit" class="btn btn-success">Edit</button></center>
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

