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
                                    <h1 class="h4 text-gray-900 mb-4">Role Configurations</h1>

                                    <hr>
                                </div>


                                <a href="{{"/permissions/create_permissions"}}"><label>Create Role Profile</label> </a> <br>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>


                                            <th>ID</th>
                                            <th>Role Name</th>
                                            <th>State</th>
                                            <th>Created</th>
                                            <th></th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->role_name}}</td>
                                                <td>@php

                                                        if ($record->status === '1'){

                                                        echo 'ACTIVE';

                                                        }else{

                                                        echo 'IN-ACTIVE';

                                                        }
                                                    @endphp</td>
                                                <td>{{$record->created_at}}</td>

                                                <td>
                                                    <form role="form" action="/permissions/edit" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
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

