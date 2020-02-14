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
                                    <h1 class="h4 text-gray-900 mb-4">Mini-Statement</h1>

                                    <hr>
                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },3000 ); // 5 secs

                                    });
                                </script>
                                @if ($flash = session('error'))
                                    <div  class="alert alert-danger" role="alert">
                                      <center>{{$flash}}</center>
                                    </div>
                                @endif


                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->


                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>
                                            <th>Transaction Date</th>
                                            <th>Reference</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Closing Balance</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($response as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->trx_date}}</td>
                                                <td>{{$record->particulars }}</td>
                                                <td>{{$record->debit}}</td>
                                                <td>{{$record->credit}}</td>
                                                <td>{{$record->closing }}</td>

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

