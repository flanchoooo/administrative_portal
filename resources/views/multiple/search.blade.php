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
                                    <h1 class="h4 text-gray-900 mb-4">Search Account</h1>
                                    <hr>
                                </div>


                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        }, 2000 ); // 5 secs

                                    });
                                </script>

                                @if ($flash = session('notification'))

                                    @php

                                        if(session('notification') == 'Profile successfully updated.'){

                                        echo '<center><div  class="alert alert-success" role="alert">'.$flash
                                            .'</div></center>';

                                        }else{

                                         echo '<center><div  class="alert alert-danger" role="alert">'.$flash
                                            .'</div></center>';

                                        }


                                    @endphp

                                @endif


                                <form method="POST" action="/multiple/preauth">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="mobile" value="{{session('email_id')}}" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Channel</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="channel"  required autofocus>
                                                        <option value="MOBILE">MOBILE</option>

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
