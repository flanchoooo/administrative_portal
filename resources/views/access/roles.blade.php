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
                                    <h1 class="h4 text-gray-900 mb-4">Link Role to User</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                    @if ($flash = session('error-message'))
                                        <div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                </div>

                                <form method="POST" action="/access/role" aria-label="{{ __('Add Product') }}">
                                    @csrf
                                    <div class="box-body">


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">User</label>
                                            <select id="user" type="text" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user" value="{{ old('user') }}" required autofocus  >
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                                @endforeach

                                            </select>                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role</label>
                                            <select id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="role" value="{{ old('status') }}" required autofocus  >
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{ $role->role_name }}</option>
                                                @endforeach
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