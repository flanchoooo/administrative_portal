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
                                    <h1 class="h4 text-gray-900 mb-4">Batch</h1>

                                    <hr>
                                </div>

                                <a href="{{"/luhn/create"}}"><label>Generate Cards</label></a> <br>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">

                                        <thead>
                                        <tr>


                                            <th>Name</th>
                                            <th hidden>PAN</th>
                                            <th hidden>Card Expiry</th>
                                            <th hidden>Track 2</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{'GETBUCKS DEBIT CARD'.' :'.$values->card_type_id}}</td>
                                                <td hidden>{{$values->track_1}}</td>
                                                <td hidden>{{$values->card_expiry}}</td>
                                                <td hidden>{{$values->track_2}}</td>

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

