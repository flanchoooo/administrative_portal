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
                                    <h1 class="h4 text-gray-900 mb-4">Create Fee Profile</h1>
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

                                <form method="POST" action="/internet/fee/create">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Fee Name</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="txn_type" value="{{ old('channel_name') }}" required autofocus>
                                                    @foreach($records as $record)
                                                        <option value="{{$record->id}}">{{$record->name}}</option>

                                                    @endforeach
                                                </select>

                                            </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"></label>
                                            </div>
                                        </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Tax Type</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="tax_type" value="{{ old('channel_name') }}" required autofocus>
                                                        <option value="FIXED">FIXED</option>
                                                        <option value="PERCENTAGE">PERCENTAGE</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Tax Fee</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="tax_fee" value="" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Revenue Fee Type</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="fees_type" value="{{ old('channel_name') }}" required autofocus>
                                                        <option value="FIXED">FIXED</option>
                                                        <option value="PERCENTAGE">PERCENTAGE</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Revenue Fee</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="revenue_fee" value="" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Minimum</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="minimum" value="" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Maximum</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="maximum" value="" required autofocus>
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
