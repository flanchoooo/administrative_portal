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
                                    <h1 class="h4 text-gray-900 mb-4">Fee Configurations</h1>
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

                                <form method="POST" action="/fee/update">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="transaction_type_id" value="{{  session('transaction_type_id') }}" required autofocus>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">ID</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{  session ('id') }}" required autofocus readonly >
                                        </div>


                                        <div class="form-group row" >

                                            <div class="form-group row" >

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tax Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="tax_type" value="{{ old('tax_type') }}" required autofocus>

                                                            @php

                                                                if(session('tax_type') == 'FIXED'){
                                                                    echo '<option value="FIXED">FIXED</option>';
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                }else{
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                    echo '<option value="FIXED">FIXED</option>';

                                                                }

                                                            @endphp
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tax Fee</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="tax" value="{{session('tax')}}" required autofocus>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Zimswitch Fee Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="zimswitch_fee_type" value="{{ old('channel_name') }}" required autofocus>
                                                            @php

                                                                if(session('zimswitch_fee_type') == 'FIXED'){
                                                                    echo '<option value="FIXED">FIXED</option>';
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                }else{
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                    echo '<option value="FIXED">FIXED</option>';

                                                                }

                                                            @endphp
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Zimswitch Fee</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="zimswitch_fee" value="{{session('zimswitch_fee')}}" required autofocus>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Interchange Fee Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="interchange_fee_type" value="{{ old('channel_name') }}" required autofocus>
                                                            @php

                                                                if(session('interchange_fee_type') == 'FIXED'){
                                                                    echo '<option value="FIXED">FIXED</option>';
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                }else{
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                    echo '<option value="FIXED">FIXED</option>';

                                                                }

                                                            @endphp
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Interchange Fee</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="interchange_fee" value="{{session('interchange_fee')}}" required autofocus>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Acquirer Fee Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="acquirer_fee_type" value="{{ old('channel_name') }}" required autofocus>

                                                            @php

                                                            if(session('acquirer_fee_type') == 'FIXED'){
                                                                echo '<option value="FIXED">FIXED</option>';
                                                                echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                            }else{
                                                                echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                echo '<option value="FIXED">FIXED</option>';

                                                            }

                                                            @endphp

                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Acquirer Fee</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="acquirer_fee" value="{{session('acquirer_fee')}}" required autofocus>
                                                    </div>
                                                </div>





                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Cash Back Fee Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="cashback_fee_type" value="{{ old('channel_name') }}" required autofocus>
                                                            @php

                                                                if(session('cashback_fee_type') == 'FIXED'){
                                                                    echo '<option value="FIXED">FIXED</option>';
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                }else{
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                    echo '<option value="FIXED">FIXED</option>';

                                                                }

                                                            @endphp

                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Cash Back Fee</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="cash_back_fee" value="{{session('cash_back_fee')}}" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Product Fee Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="fee_type" value="{{session('fee_type')}}" required autofocus>
                                                            @php

                                                                if(session('fee_type') == 'FIXED'){
                                                                    echo '<option value="FIXED">FIXED</option>';
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                }else{
                                                                    echo '<option value="PERCENTAGE">PERCENTAGE</option>';
                                                                    echo '<option value="FIXED">FIXED</option>';

                                                                }

                                                            @endphp
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Product Fee</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="fee" value="{{session('fee')}}" required autofocus>
                                                    </div>
                                                </div>




                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Minimum Amount Per Transaction</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="minimum_daily" value="{{session('minimum_daily')}}" required autofocus>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Maximum Amount Per Transaction</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="maximum_daily" value="{{session('maximum_daily')}}" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Maximum Daily Limit Amount</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="max_daily_limit" value="{{session('max_daily_limit')}}" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Transaction Count per Day</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="transaction_count" value="{{session('transaction_count')}}" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Minimum Balance</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="minimum_balance" value="{{session('minimum_balance')}}" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Bill Type</label>
                                                        <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="type" value="{{ old('channel_name') }}" required autofocus>
                                                            <option value="EXCLUSIVE">EXCLUSIVE</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Agent Share in (%)</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="agent_fee" value="{{session('agent_fee')}}" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Biller Discount in (%)</label>
                                                        <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="biller_discount" value="{{session('biller_discount')}}" required autofocus>
                                                    </div>
                                                </div>



                                            </div>

                                    </div>

                                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>

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
