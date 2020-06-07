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
                                    <h1 class="h4 text-gray-900 mb-4">Configure  Wallet Class of Service</h1>

                                    <hr>
                                </div>

                                <a href="{{"/wallet_configurations/create_cos"}}"><label>Create Wallet Class of Service</label></a> <br>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%"  cellspacing="">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">


                                                <td>{{$values->id}}</td>
                                                <td>{{$values->cos_name}}</td>
                                                <td>{{$values->created_at}}</td>


                                                <td>
                                                    <form role="form" action="/wallet_configurations/update_view" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{  Auth::user()->id }}"  name="created_by" >
                                                        <center><button type="submit" class="btn btn-success"> Edit </button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/wallet_configurations/cos_d" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{  Auth::user()->id }}"  name="updated_by" >
                                                        <center><button type="submit" class="btn btn-danger">Delete</button></center>
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

