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
                                    <h1 class="h4 text-gray-900 mb-4">Suspended Card Profiles</h1>

                                    <hr>
                                </div>



                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID </th>
                                            <th>PAN</th>
                                            <th>Account Number</th>
                                            <th>Created</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>
                                                @php

                                                    echo $var = substr_replace($values->track_1, str_repeat("*", 6), 6, 6);


                                                        @endphp


                                                </td>
                                                <td>{{$values->account_number}}</td>
                                                <td>{{$values->created_at}}</td>


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

