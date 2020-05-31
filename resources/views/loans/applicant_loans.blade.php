@extends('layouts.tab')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-11 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Applicant Profile</h1>
                                    <hr>
                                    @if ($flash = session('error'))
                                        <div style="text-align: center;"/>
                                        <div class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                    @if ($flash = session('success'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                </div>

                                @foreach($records as $rec)
                                <form method="POST" action="/fleet/creates">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="first_name"  value="{{$rec->loan_applicant->first_name}}" placeholder="First Name" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Last Name</label>
                                                    <input type="text" class="form-control input-default" name="last_name" value="{{$rec->loan_applicant->last_name}}" placeholder="Last Name" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="exampleInputEmail1">National ID</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="national_id" value="{{$rec->loan_applicant->national_id}}" placeholder="National ID" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="text" class="form-control input-default" name="email"value="{{$rec->loan_applicant->email}}" placeholder="Email Address" required>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date Of Birth</label>
                                                    <input type="text" class="form-control input-default" name="last_name" value="{{$rec->loan_applicant->dob}}" placeholder="Last Name" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Gender</label>
                                                    <select type="text" class="form-control input-default" name="user_type_id"  placeholder="Tax Clearance">
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Employee Number</label>
                                                    <input type="text" class="form-control input-default" name="employee_number"value="{{$rec->loan_applicant->employee_number}}" placeholder="Employee Number" required>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Employee Reference</label>
                                                    <input type="text" class="form-control input-default" name="employee_reference" value="{{$rec->loan_applicant->employee_reference}}" placeholder="Employee Reference" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile Number</label>
                                                    <input type="text" class="form-control input-default" name="mobile_number "value="{{$rec->loan_applicant->mobile}}" placeholder="Mobile Number" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                    <input type="text" class="form-control input-default" name="address" value="{{$rec->loan_applicant->address}}" placeholder="Address" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bank</label>
                                                    <input type="text" class="form-control input-default" name="bank" value="{{$rec->loan_applicant->bank}}" placeholder="Bank" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Account Number</label>
                                                    <input type="text" class="form-control input-default" name="account_number"value="{{$rec->loan_applicant->account_number}}" placeholder="Account Number" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Salary</label>
                                                    <input type="text" class="form-control input-default" name="salary" value="{{$rec->loan_applicant->salary}}" placeholder="Salary" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Initial Amount</label>
                                                    <input type="text" class="form-control input-default" name="initial amount" value="{{$rec->loan_applicant->initial_amount}}" placeholder="Initial  Amount" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Loan Balance</label>
                                                    <input type="text" class="form-control input-default" name="initial amount" value="{{$rec->loan_balance}}" placeholder="Initial  Amount" required>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.button-body -->
                                    </div>
                                    <!-- /.box-body -->
                            </form>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-lg-left">
                                            <h1 class="h4 text-gray-900 mb-4">Loans by Applicant</h1>
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
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($loan_repayment as $record => $values)
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
                                                        <td>
                                                            <form role="form" action="/loans/installments" method="POST">
                                                                @csrf
                                                                <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >

                                                                @php
                                                                    $id = Auth::user()->role_permissions_id;
                                                                    $role = \App\Role_User::where('id', $id)->get()->first();
                                                                    $transactions = $role->loans;

                                                                     if(!isset($transactions)|| trim($transactions) == ''){
                                                                         echo '';

                                                                         }else{

                                                                         echo $display = '<center><button type="submit" class="btn btn-primary">Instalments</button></center>';
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
