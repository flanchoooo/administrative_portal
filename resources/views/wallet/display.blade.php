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
                                    <h1 class="h4 text-gray-900 mb-4">Card Activation</h1>

                                    <hr>
                                </div>




                                <div class="box-body">

                                    <!-- /.table-responsive -->
                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Card Profile</th>
                                            <th>Account Number</th>
                                            <th>State</th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">

                                                <td>{{$values->id}}</td>
                                                <td>
                                                    @php
                                                        $var = substr_replace($values->track_1, str_repeat("*", 8), 6, 6);
                                                        echo $var;
                                                    @endphp
                                                </td>
                                                <td>{{$values->account_number}}</td>
                                                <td>@php

                                                        if ($values->state === '1'){

                                                        echo 'ACTIVE';

                                                        }else{

                                                        echo 'IN-ACTIVE';

                                                        }
                                                    @endphp</td>


                                                <td>
                                                    <form role="form" action="/accountmanagement/updateview" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->account_number}}"  name="account" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$var}}"  name="card" >
                                                        <center><button type="submit" class="btn btn-success">Activate</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/accountmanagement/reject" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{  Auth::user()->id }}"  name="created_by" >
                                                        <center><button type="submit" class="btn btn-danger">Reject</button></center>
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

