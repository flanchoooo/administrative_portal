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
                                    <h1 class="h4 text-gray-900 mb-4">Role Configurations</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="/permissions/create" aria-label="{{ __('Add Product') }}">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="role_name" value="" required autofocus>
                                          </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Status</label>
                                            <select id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="" required autofocus  >
                                                <option value="1">ACTIVE</option>
                                                <option value="0">IN-ACTIVE</option>
                                            </select>
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