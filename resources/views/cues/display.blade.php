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
                                    <h1 class="h4 text-gray-900 mb-4">Configure Key Profile</h1>

                                    <hr>
                                </div>

                                <a href="{{"/cues/create"}}"><label>Create a key profile</label></a> <br>

                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="-20">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->name}}</td>
                                                <td>{{$values->created_at}}</td>
                                                <td>
                                                    <form role="form" action="/cues/delete" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{  Auth::user()->id }}"  name="created_by" >


                                                        <div class="modal fade" id="cue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
                                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button  type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                                                        <a class="btn btn-danger" href="/cues/display">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <center><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#cue">
                                                                Delete
                                                            </a></center>





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

