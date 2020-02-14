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
                                    <h1 class="h4 text-gray-900 mb-4">Link Account/Wallet To a Card Profile</h1>
                                    <hr>
                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },5000 ); // 5 secs

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


                                <form method="POST" action="/accountmanagement/lookup">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Wallet Mobile</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="account_number" required autofocus>
                                        </div>

                                    </div>


                                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-footer">
                                                    <button  type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                                    <a class="btn btn-danger" href="/accountmanagement/link">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Modal">
                                            Submit
                                        </a>



                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>








@endsection
