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
                                    <h1 class="h4 text-gray-900 mb-4">Create Transaction Type</h1>
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

                                <form method="POST" action="/product/create">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>
                                             </div>


                                            <div class="col-lg-6">
                                                <label for="exampleInputEmail1">Status</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="state" value="{{ old('channel_name') }}" required autofocus>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="BLOCKED">BLOCK</option>
                                                </select>
                                            </div>



                                            <div class="col-lg-6">
                                                <br>

                                                <label for="exampleInputEmail1">Transaction Group</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="transaction_type" value="{{ old('channel_name') }}" required autofocus>
                                                    <option value="PURCHASE_CASH_BACK">PURCHASE_CASH_BACK</option>
                                                    <option value="BALANCE_ENQUIRY">BALANCE_ENQUIRY</option>
                                                    <option value="PURCHASE">PURCHASE</option>
                                                    <option value="ZIPIT_CREDIT_PUSH">ZIPIT_CREDIT_PUSH</option>
                                                    <option value="ZIPIT_TO_MOBILE_REDEEM">ZIPIT_TO_MOBILE_REDEEM</option>
                                                    <option value="PAYMENT_FOR_ACCOUNT">PAYMENT_FOR_ACCOUNT</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6">
                                                <br>
                                                <label for="exampleInputEmail1">On Us | Off Us</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="on_us" value="{{ old('channel_name') }}" required autofocus>
                                                    <option value="1">ON US TRANSACTION</option>
                                                    <option value="0">OFF US TRANSACTION</option>
                                                </select>
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
