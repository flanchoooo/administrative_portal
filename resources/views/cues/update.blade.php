@extends('layouts.tab')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Bank Profile</h3>
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
                <!-- /.box-header -->
                <!-- form start -->
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

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bank Name</label>
                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="name" value="{{session('name')}}" required autofocus>
                            </div>
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
                                    <option value="1">ACTIVE</option>
                                    <option value="0">IN-ACTIVE</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer col-sm" >
                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
