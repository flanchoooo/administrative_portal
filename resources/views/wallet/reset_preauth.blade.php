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

                                    <h5><label>Confirm PIN  Reset</label></h5>

                                    <hr>

                                </div>


                                <form method="POST" action="/wallet/reset">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Mobile Account: {{session('mobile')}}</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Account Name: {{session('first_name').' '. session('last_name')}}</label>
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Gender: {{session('gender')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>National ID: {{session('national_id')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Date of Birth: {{session('dob')}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>State:

                                                        @php

                                                            if (session('state') === '1'){

                                                            echo 'ACTIVE';

                                                            }else{

                                                            echo 'IN-ACTIVE';

                                                            }
                                                        @endphp

                                                       </label>
                                                </div>
                                            </div>



                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                            </div>


                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('mobile')}}" required autofocus>
                                            </div>




                                        </div>
                                    </div>


                                    <!-- /.box-body -->

                                    <!-- /.box-body -->
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                    <a class="btn btn-danger" href="{{ URL::to('/wallet/reset_view') }}">{{ __('Cancel') }}</a>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
