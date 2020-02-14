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
                                    <h1 class="h4 text-gray-900 mb-4">Generate Cards</h1>
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

                                <form method="POST" action="/luhn/make">
                                    @csrf
                                    <div class="box-body">

                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1">BIN</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="prefix" value="605918" required autofocus readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quantity</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="quantity"  required autofocus>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Card Type</label>


                                            <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="card_type" value="{{ old('channel_name') }}" required autofocus>
                                                @foreach($records as $r )
                                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Issue Year</label>
                                            <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="issue_year" value="{{ old('channel_name') }}" required autofocus>
                                                <option value="19">2019</option>
                                                <option value="20">2020</option>
                                                <option value="21">2021</option>
                                                <option value="22">2022</option>
                                                <option value="23">2023</option>
                                                <option value="24">2024</option>
                                                <option value="25">2025</option>
                                                <option value="26">2025</option>
                                                <option value="27">2027</option>
                                                <option value="28">2028</option>
                                                <option value="29">2029</option>
                                                <option value="30">2030</option>
                                                <option value="31">2031</option>
                                                <option value="32">2032</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Issue Month</label>
                                            <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="issue_month" value="{{ old('channel_name') }}" required autofocus>
                                                <option value="1">JANUARY</option>
                                                <option value="2">FEBRUARY</option>
                                                <option value="3">MARCH</option>
                                                <option value="4">APRIL</option>
                                                <option value="5">MAY</option>
                                                <option value="6">JUNE</option>
                                                <option value="7">JULY</option>
                                                <option value="8">AUGUST</option>
                                                <option value="9">SEPTEMBER</option>
                                                <option value="10">OCTOBER</option>
                                                <option value="11">NOVEMBER</option>
                                                <option value="12">DECEMBER</option>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Expiry Year</label>
                                            <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="expiry_year" value="{{ old('channel_name') }}" required autofocus>
                                                <option value="19">2019</option>
                                                <option value="20">2020</option>
                                                <option value="21">2021</option>
                                                <option value="22">2022</option>
                                                <option value="23">2023</option>
                                                <option value="24">2024</option>
                                                <option value="25">2025</option>
                                                <option value="26">2025</option>
                                                <option value="27">2027</option>
                                                <option value="28">2028</option>
                                                <option value="29">2029</option>
                                                <option value="30">2030</option>
                                                <option value="31">2031</option>
                                                <option value="32">2032</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Expiry Month</label>
                                            <select id="mobile" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="expiry_month" value="{{ old('channel_name') }}" required autofocus>
                                                <option value="1">JANUARY</option>
                                                <option value="2">FEBRUARY</option>
                                                <option value="3">MARCH</option>
                                                <option value="4">APRIL</option>
                                                <option value="5">MAY</option>
                                                <option value="6">JUNE</option>
                                                <option value="7">JULY</option>
                                                <option value="8">AUGUST</option>
                                                <option value="9">SEPTEMBER</option>
                                                <option value="10">OCTOBER</option>
                                                <option value="11">NOVEMBER</option>
                                                <option value="12">DECEMBER</option>
                                            </select>
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
