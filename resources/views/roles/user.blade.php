@extends('layouts.tab')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Update User Profile</h1>
                                    <hr>
                                    @if ($flash = session('error'))
                                        <div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif



                                </div>

                                <form method="POST" action="/roles/update_user">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">System Owner</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{  session('id')}}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="first_name" value="{{session('first_name')}}" required autofocus>
                                            </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="last_name" value="{{session('last_name')}}" required autofocus>
                                            </div>
                                        </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="email" value="{{session('email')}}" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('phone')}}" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">User Name</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="user_name" value="{{session('user_name')}}" required autofocus>
                                                </div>
                                            </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="status" value=""  autofocus>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="IN-ACTIVE">IN-ACTIVE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.box-body -->

                                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
