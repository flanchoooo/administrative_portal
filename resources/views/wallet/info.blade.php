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
                                    <h1 class="h4 text-gray-900 mb-4">Update Wallet Profile</h1>
                                    <hr>

                                </div>

                                @if ($flash = session('link_success'))
                                    <div  class="alert alert-success" role="alert">
                                        {{$flash}}
                                    </div>
                                @endif

                                <form method="POST" action="/wallet/update">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="first_name" value="{{session('first_name')}}"  required autofocus>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="last_name" value="{{session('last_name')}}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Mobile</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('mobile')}}" required autofocus readonly>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">Balance</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="" value="{{session('balance')}}"  autofocus readonly>
                                            </div>



                                        </div>



                                        <div class="form-group row">

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">State</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="state">
                                                    <option value="1">ACTIVE</option>
                                                    <option value="0">BLOCKED</option>
                                                </select>
                                            </div>




                                            <div class="col-sm-6 mb-3 mb-sm-0">

                                                <label for="exampleInputEmail1">National ID</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="national_id" value="{{session('national_id')}}" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <br>
                                                <label for="exampleInputEmail1">Gender</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="gender" value="{{session('gender')}}" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <br>
                                                <label for="exampleInputEmail1">DOB</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="dob" value="{{session('dob')}}" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <Br>
                                                <label for="exampleInputEmail1">Wallet Class of Service</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="wallet_cos_id">
                                                    @foreach($records as $item)
                                                        <option value="{{$item->id}}">{{$item->cos_name}}</option>
                                                    @endforeach

                                                </select>
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
