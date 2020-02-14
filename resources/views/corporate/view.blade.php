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

                                    <h1 class="h4 text-gray-900 mb-4">Corporate Profile Information</h1>

                                    <hr>

                                </div>

                                @foreach($records as $rec)
                                <form method="POST" action="#">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Name: {{$rec->name}}</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Mobile: {{$rec->mobile}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label>Email: {{$rec->email}}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>User Type:
                                                        @php
                                                            if($rec->user_type_id == '2'){

                                                            echo 'INITIATOR';
                                                            }else{

                                                            echo 'AUTHORIZER';

                                                            }

                                                        @endphp
                                                    </label>
                                                </div>
                                            </div>



                                        </div>

                                        <hr>
                                    </div>
                                    <!-- /.box-body -->


                                </form>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
