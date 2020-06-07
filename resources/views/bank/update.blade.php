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
                                    <h1 class="h4 text-gray-900 mb-4">Update Bank Profile</h1>
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

                                <form method="POST" action="/bank/update">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="updated_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">ID</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{session('id') }}" required autofocus readonly>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Bank Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="name" value="{{session('name')}}" required autofocus>
                                            </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">BIN</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="bin" value="{{session('bin')}}" required autofocus>
                                            </div>
                                        </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="state"  required autofocus>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="IN-ACTIVE">IN-ACTIVE</option>
                                                </select>
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
