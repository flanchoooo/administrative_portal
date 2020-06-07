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
                                    <h1 class="h4 text-gray-900 mb-4">Update Fee Profile</h1>
                                    <hr>
                                    @if ($flash = session('error'))
                                        <div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                    @if ($flash = session('success'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                </div>

                                <form method="POST" action="/internet/fee/updates">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>


                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{ session('id') }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="transaction_id" value="{{ session('transaction_id') }}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Fixed Fee</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="fixed_fee" value="{{session('fixed_fee')}}" required autofocus>
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Percentage Fee</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="percentage_fee" value="{{session('percentage_fee')}}" required autofocus>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Tax Fixed</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="tax_fixed" value="{{session('tax_fixed')}}" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Tax Percentage</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="tax_percentage" value="{{session('tax_percentage')}}" required autofocus>
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Minimum Amount</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="minimum_amount" value="{{session('minimum_amount')}}" required autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <br>
                                                    <label for="exampleInputEmail1">Maximum Amount</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="maximum_amount" value="{{session('maximum_amount')}}" required autofocus>
                                                </div>
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
