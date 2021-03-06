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
                                    <h1 class="h4 text-gray-900 mb-4">Create Merchant Device Profile</h1>
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

                                <form method="POST" action="/devices/create">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">ID</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="merchant_id" value="{{ session('merchant_id') }}" required autofocus readonly>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">IMEI</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="imei"  required autofocus >
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Vendor</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="vendor" value="{{ old('channel_name') }}" required autofocus>
                                                        <option value="NEXGO">NEXGO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Software Version</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="sw_version" value="" required autofocus>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="state" value="{{ old('channel_name') }}" required autofocus>
                                                        <option value="1">ACTIVE</option>
                                                        <option value="0">IN-ACTIVE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
