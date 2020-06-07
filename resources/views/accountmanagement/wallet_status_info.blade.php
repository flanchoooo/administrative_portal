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
                                    <h1 class="h4 text-gray-900 mb-4">Change Status For Card Link To Wallet</h1>
                                    <hr>

                                </div>

                                <form method="POST" action="/accountmanagement/change">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Account Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="account_name" value="{{session('first_name').' '.session('last_name')}}"  required autofocus readonly>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('mobile')}}" required autofocus readonly>
                                                </div>
                                            </div>



                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">State</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="status"  required autofocus>
                                                        <option value="ACTIVE">ACTIVE</option>
                                                        <option value="BLOCKED">BLOCK</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Reason</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="reason"  required autofocus>
                                                        <option value="000">RE-ACTIVATE</option>
                                                        <option value="104">EXPIRED CARD</option>
                                                        <option value="100">DO NOT HONOR</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Card Status</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('status')}}" required autofocus readonly>
                                                </div>
                                            </div>


                                        </div>



                                        <div class="col-lg-6" hidden>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Card</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="card_number" value="{{session('card')}}" required autofocus readonly>
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
