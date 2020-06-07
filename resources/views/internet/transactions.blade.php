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
                                    <h1 class="h4 text-gray-900 mb-4">Internet Banking Transactions</h1>

                                    <hr>
                                </div>



                                <div class="container">

                                    <form method="POST" action="/internet/between_dates">
                                        @csrf


                                                <div class="form-group row justify-content-center ">


                                                    <div class="col-sm-3">
                                                        <label for="exampleInputEmail1">Start Date</label>
                                                        <input id="mobile" type="date" class="form-control datepicker" name="start_date" value="" required autofocus>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="exampleInputEmail1">End Date</label>
                                                        <input id="mobile" type="date" class="form-control datepicker" name="end_date" value="" required autofocus>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="exampleInputEmail1">Transaction Type</label>
                                                        <select id="mobile" type="date" class="form-control datepicker" name="txn_type" value="" required autofocus>

                                                            <option value="ecocash">Ecocash</option>
                                                            <option value="airtime">Airtime</option>
                                                            <option value="zetdc">ZETDC</option>
                                                        </select>
                                                    </div>


                                                    <div class="col-sm-3" style="margin-top: 30px">
                                                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                                    </div>

                                                </div>

                                        <!-- /.box-body -->
                                    </form>
                                </div>



                                <div>

                                    <a href="/internet/electricity"><button type="submit" class="btn btn-outline-primary">Electricity</button></a>
                                    <a href="/internet/airtime"><button type="submit" class="btn btn-outline-success">Airtime</button></a>
                                    <a href="/internet/ecocash"><button type="submit" class="btn btn-outline-primary">Ecocash</button></a>
                                </div>


                                <br>
                                <div class="box-body">
                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref</th>
                                            <th hidden>Source Account</th>
                                            <th hidden>Destination Account</th>
                                            <th>Type</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th hidden>Amount</th>
                                            <th>Status</th>
                                            <th >Description</th>


                                        </tr>
                                        </thead>



                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td id="daterange-btn">{{$record->created_at}}</td>
                                                <td class="center">{{$record->id}}</td>
                                                <td hidden>{{$record->source_account}}</td>
                                                <td hidden>{{$record->destination_account}}</td>
                                                <td>{{$record->product_id}}</td>
                                                <td >{{$record->debit}}</td>
                                                <td>{{$record->credit}}</td>
                                                <td hidden>{{$record->amount}}</td>
                                                <td>{{$record->status}}</td>
                                                <td >{{$record->description}}</td>

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

