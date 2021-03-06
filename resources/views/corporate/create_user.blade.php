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
                                    <h1 class="h4 text-gray-900 mb-4">Create Corporate User Profile</h1>
                                    <hr>
                                    @if ($flash = session('error'))
                                        <div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                    @if ($flash = session('success'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                </div>

                                <form method="POST" action="/corporate/users">
                                    @csrf

                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="corporate_id" value="{{ session('corporate_id') }}"  autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>
                                            </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input  type="email" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>
                                            </div>
                                        </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile</label>
                                                    <input  type="number"  placeholder="26377000000" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="" required autofocus>
                                                </div>
                                            </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">User Type</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="user_type_id" value="{{ old('channel_name') }}" required autofocus>
                                                    <option value="2">INITIATOR</option>
                                                    <option value="3">AUTHORIZER</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>

                                    </div>
                                    <!-- /.box-body -->


                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
