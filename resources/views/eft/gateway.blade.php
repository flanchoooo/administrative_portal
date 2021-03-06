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

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },5000 ); // 5 secs

                                    });
                                </script>
                                @if ($flash = session('error'))
                                    <div  class="alert alert-success" role="alert">
                                        <center>{{$flash}}</center>
                                    </div>
                                @endif

                                <h5><label>Restart EFT Gateway </label></h5>

                                <hr>

                            </div>


                            <form method="POST" action="/eft/restarts">
                                @csrf
                                <div class="box-body">

                                    <div class="form-group row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Signing-In Tries:</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('signing_in_tries')}}</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Login Busy :</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('login_busy')}}</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Signed On:</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('signed_on')}}</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Signing In:</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('signing_in')}}</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Waiting for key exchange:</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('wait_for_key_exchange')}}</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Failed echo count:</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('failed_echo_count')}}</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Last refresh</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{session('last_refresh')}}</label>
                                            </div>
                                        </div>



                                    </div>
                                </div>


                                <!-- /.box-body -->

                                <!-- /.box-body -->
                            <div>
                                <button type="submit" class="btn btn-primary">   {{ __('Restart') }}</button>
                            </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
