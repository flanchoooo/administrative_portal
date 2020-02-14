@extends('layouts.tab')


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-8 col-lg-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Role</h3>
                    @if ($flash = session('message'))
                        <div  class="alert alert-success" role="alert">
                            {{$flash}}
                        </div>
                    @endif
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="/assign/store" aria-label="{{ __('Add Product') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role Name</label>
                            <input id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="name" value="{{ old('status') }}" required autofocus  >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="description" value="{{ old('status') }}" required autofocus  >
                            </textarea>
                        </div>

                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer col-sm" >
                        <button type="submit" class="btn btn-primary">   {{ __('Add Role') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection