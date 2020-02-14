@extends('layouts.tab')

@section('content')

    <div class="row justify-content-center" xmlns="">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Add a Corporate Account</h1>
                                    <hr>
                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },2000 ); // 5 secs

                                    });
                                </script>
                                <div>
                                    @if (isset($success_notification))
                                        <div  class="alert alert-success" role="alert">{{$success_notification}}</div>
                                    @endif


                                    @if (isset($notification))
                                        <div  class="alert alert-danger" role="alert">{{$notification}}</div>
                                    @endif

                                </div>


                                <form method="POST" action="/corporate/accountmanagement/add_lookup">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Corporate Account Number</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="account_number" required autofocus>
                                        </div>

                                    </div>





                                    <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#Modal">
                                        Submit
                                    </button>



                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>








@endsection
