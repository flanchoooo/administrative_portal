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
                                    <h1 class="h4 text-gray-900 mb-4">Ecocash Transactions</h1>

                                    <hr>
                                </div>





                                <br>
                                <div class="box-body">
                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Source Account</th>
                                            <th>Destination Mobile</th>
                                            <th>Amount</th>
                                            <th >Date</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td id="daterange-btn">{{$record->id}}</td>
                                                <td class="center">{{$record->source_account}}</td>
                                                <td>{{$record->mobile}}</td>
                                                <td>{{$record->amount}}</td>
                                                <td>{{$record->created_at}}</td>
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

