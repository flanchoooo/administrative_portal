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
                                    <h1 class="h4 text-gray-900 mb-4">Change Internet Banking Account Status</h1>
                               <hr>

                                </div>

                                @if ($flash = session('link_success'))
                                    <div  class="alert alert-success" role="alert">
                                        {{$flash}}
                                    </div>
                                @endif

                                <form method="POST" action="/internet/internet/updates">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{  session('id') }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="updated_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Account Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="name" value="{{session('name')}}"  required autofocus readonly>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">Mobile</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('mobile')}}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="email" value="{{session('email')}}" required autofocus >
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">Account</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="account_number" value="{{session('account_number')}}"  autofocus >
                                            </div>

                                            </div>



                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">State</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="stat" value="@php

                                                    if(session('active') != '1'){
                                                echo 'IN-ACTIVE';
                                                }
                                                else{ echo 'ACTIVE';} @endphp" required autofocus readonly>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">ACTION</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="active"  required autofocus>
                                                    <option value="1">UNBLOCK AN ACCOUNT</option>
                                                    <option value="0">BLOCK  AN ACCOUNT</option>
                                                    <option value="4">DE-REGISTER</option>
                                                </select>
                                            </div>


                                            <div class="col-sm-6">
                                                <br>
                                                <label for="exampleInputEmail1">User Type</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="user_type_id"  required autofocus>
                                                    @php
                                                   if(session('user_type_id') == '1'){
                                                        echo '<option value="1">INDIVIDUAL USER</option>';
                                                        echo '<option value="2">CORPORATE INITIATOR</option>';
                                                        echo ' <option value="3">CORPORATE AUTHORIZER</option>';
                                                        echo '<option value="4">CORPORATE ACCEPTOR</option>';
                                                    }

                                                    if(session('user_type_id') == '2'){
                                                        echo '<option value="2">CORPORATE INITIATOR</option>';
                                                        echo '<option value="1">INDIVIDUAL USER</option>';
                                                        echo ' <option value="3">CORPORATE AUTHORIZER</option>';
                                                        echo '<option value="4">CORPORATE ACCEPTOR</option>';
                                                    }

                                                    if(session('user_type_id') == '3'){
                                                        echo ' <option value="3">CORPORATE AUTHORIZER</option>';
                                                        echo '<option value="2">CORPORATE INITIATOR</option>';
                                                        echo '<option value="1">INDIVIDUAL USER</option>';
                                                        echo '<option value="4">CORPORATE ACCEPTOR</option>';
                                                    }

                                                     if(session('user_type_id') == '4'){

                                                         echo '<option value="4">CORPORATE ACCEPTOR</option>';
                                                        echo ' <option value="3">CORPORATE AUTHORIZER</option>';
                                                        echo '<option value="2">CORPORATE INITIATOR</option>';
                                                        echo '<option value="1">INDIVIDUAL USER</option>';

                                                    }


                                                    @endphp






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
