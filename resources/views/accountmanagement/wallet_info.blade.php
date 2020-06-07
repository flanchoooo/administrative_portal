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
                                    <h1 class="h4 text-gray-900 mb-4">Link Wallet To a Card Profile</h1>
                               <hr>

                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },5000 ); // 5 secs

                                    });
                                </script>
                                @if ($flash = session('link_success'))
                                    <div  class="alert alert-success" role="alert">
                                        {{$flash}}
                                    </div>
                                @endif

                                <form method="POST" action="/accountmanagement/create">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="account_name" value="{{session('first_name')}}"  required autofocus readonly>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('last_name')}}" required autofocus readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Mobile</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="account_number" value="{{session('mobile')}}" required autofocus readonly>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">Balance</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="email_id" value="{{session('balance')}}" required autofocus readonly>
                                            </div>

                                            </div>



                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">State</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="state"
                                                       value="@php
                                                           $state = session('state');

                                                            if ($state == '1' ){

                                                            echo 'ACTIVE';
                                                            }else{echo  'BLOCKED';}
                                                @endphp" required autofocus readonly>

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="exampleInputEmail1">PAN</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="card_number"  required autofocus >
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
