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
                                    <h1 class="h4 text-gray-900 mb-4">Wallet Transactions</h1>

                                    <hr>
                                </div>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%">

                                        <thead>
                                        <tr>

                                            <th>Ref</th>
                                            <th>Txn Type</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Account Credited</th>
                                            <th>Account Debited</th>
                                            <th>Date</th>
                                            <th>Closing</th>
                                            <th>Reference</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->particulars}}</td>
                                                <td>{{$values->debit}}</td>
                                                <td>{{$values->credit}}</td>
                                                <td>{{$values->a_credit}}</td>
                                                <td>{{$values->a_debit}}</td>
                                                <td>{{$values->value_date}}</td>
                                                <td>{{$values->closing}}</td>
                                                <td>{{$values->batch_id}}</td>
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


    <!-- Logout Modal-->
    @foreach($records as $record => $values)
    <div class="modal fade" id="txnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaction ID: {{ $values->id }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <script>
        $(function(){
            $('#orderModal').modal({
                keyboard: true,
                backdrop: "static",
                show:false,

            }).on('show', function(){
                var getIdFromRow = $(event.target).closest('tr').data('id');
                //make your ajax call populate items or what even you need
                $(this).find('#orderDetails').html($('<b> Order Id selected: ' + getIdFromRow  + '</b>'))
            });
        });
    </script>


@endsection

