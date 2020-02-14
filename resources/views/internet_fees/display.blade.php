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
                                    <h1 class="h4 text-gray-900 mb-4">Internet Banking Fees</h1>

                                    <hr>
                                </div>


                                <a href="{{"/internet/fee/createview"}}"><label>Create  Fee Profile</label> </a> <br>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Minimum</th>
                                            <th>Maximum</th>
                                            <th>Fee</th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->name}}</td>
                                                <td>{{$values->minimum_limit}}</td>
                                                <td>{{$values->maximum_limit}}</td>
                                                <td>{{$values->revenue_fee}}</td>
                                                <td>
                                                    <form role="form" action="/internet/fee/update" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->name}}"  name="name" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->minimum_limit}}"  name="minimum_limit" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->maximum_limit}}"  name="maximum_limit" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->revenue_fee}}"  name="revenue_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax_fee}}"  name="tax_fee" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->tax_fee}}"  name="product_id" >
                                                        <center><button type="submit" class="btn btn-success">Edit</button></center>
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

