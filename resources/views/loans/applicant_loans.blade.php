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
                                    <h1 class="h4 text-gray-900 mb-4">Loan Installments</h1>
                                    <script>
                                        $("document").ready(function(){
                                            setTimeout(function(){
                                                $("div.alert").remove();
                                            },5000 ); // 5 secs

                                        });
                                    </script>
                                    @if ($flash = session('payment_success'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                    <hr>
                                </div>

                                <div class="box-body">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="20">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Tenure</th>
                                            <th>Penalties</th>
                                            <th>Installment</th>
                                            <th>Amount Paid</th>
                                            <th>Balance</th>
                                            <th>Created</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->status}}</td>
                                                <td>{{$values->time_period}}</td>
                                                <td>{{$values->penalty_fee}}</td>
                                                <td>{{$values->monthly_installments}}</td>
                                                <td>{{$values->loan_payment}}</td>
                                                <td>{{$values->balance}}</td>
                                                <td>{{$values->created_at}}</td>

                                                <td>
                                                    <form role="form" action="/loans/payment" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                            $transactions = $role->loans;

                                                             if(!isset($transactions)|| trim($transactions) == ''){
                                                                 echo '';

                                                                 }else{

                                                                 echo $display = '<center><button type="submit" class="btn btn-primary">Pay</button></center>';
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
