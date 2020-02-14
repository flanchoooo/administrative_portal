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
                                    <h1 class="h4 text-gray-900 mb-4">User Matrix</h1>

                                    <hr>
                                </div>


                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>


                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Created</th>
                                            <th></th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->name}}</td>
                                                <td>@php
                                                        $role =  \App\Permissions::find($record->role_permissions_id);
                                                        echo $role['role_name'];


                                                    @endphp</td>
                                                <td>{{$record->created_at}}</td>

                                                <td>
                                                    <form role="form" action="/permissions/edit" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->role_permissions_id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-success">View Rights</button></center>
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

