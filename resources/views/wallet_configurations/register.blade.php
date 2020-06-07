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
                                    <h1 class="h4 text-gray-900 mb-4">Register Agent</h1>
                                    <hr>

                                    <script>
                                        $("document").ready(function(){
                                            setTimeout(function(){
                                                $("div.alert").remove();
                                            },2000 ); // 5 secs

                                        });
                                    </script>
                                    @if ($flash = session('link_success'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                @if (isset($success_notification))
                                        <div  class="alert alert-success" role="alert">{{$success_notification}}</div>
                                    @endif

                                    @if (isset($notification))
                                        <div  class="alert alert-danger" role="alert">{{$notification}}</div>
                                    @endif
                                </div>

                                <form method="POST" action="/wallet_configurations/register/agent" aria-label="{{ __('Add Product') }}">

                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Agent Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Agent Mobile</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value=""  minlength="12" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">National ID</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="national_id" value="" required autofocus>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Date of Birth</label>
                                                <input id="mobile" type="text"  placeholder="DD-MM-YY" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="dob" value="" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Gender</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="gender" value="" required autofocus>
                                               <option value="M">MALE</option>
                                               <option value="F">FEMALE</option>
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
