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
                                    <h1 class="h4 text-gray-900 mb-4">Bulk Upload</h1>
                                    <hr>

                                    @if ($flash = session('error'))
                                        <div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                    @if ($flash = session('success'))
                                        <div  class="alert alert-success" role="alert">
                                           <div style="text-align: center;">{{$flash}}</div>
                                        </div>
                                    @endif

                                </div>

                                <form enctype="multipart/form-data" method="POST" action="/disburse/create">
                                    @csrf

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input  type="file" name="csvfile" required >
                                        </div>
                                    </div>

                                    <div class="box-footer col-sm" >


                                        <div class="form-group" >
                                            <a href={{ asset('/sample.csv') }}>
                                                <label>   {{ __('Download  Sample CSV') }}</label>
                                            </a>
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
