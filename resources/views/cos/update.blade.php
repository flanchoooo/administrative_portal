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
                                    <h1 class="h4 text-gray-900 mb-4">Create Class of Service</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="/cos/update" aria-label="{{ __('Add Product') }}">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group" hidden>
                                            <label for="exampleInputEmail1">Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="created_by" value="{{  Auth::user()->id }}" required autofocus>
                                        </div>

                                       @foreach($records as $rec)

                                            <div class="form-group row" hidden>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="exampleInputEmail1">Class of Service Name</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{$rec->id}}" required autofocus>
                                                </div>
                                            </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">Class of Service Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="cos_name" value="{{$rec->cos_name}}" required autofocus>
                                            </div>


                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="exampleInputEmail1">STATE</label>
                                                <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="status" value="" required autofocus>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="IN-ACTIVE">IN-ACTIVE</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <div class="checkbox">
                                                    <label>
                                                        @php if($rec->sale == 1){
                                                        echo '<input type="checkbox" name="sale" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="sale">';
                                                        } @endphp

                                                        {{ __('SALE') }}
                                                    </label>
                                                </div>
                                            </div>




                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->balance == 1){
                                                        echo '<input type="checkbox" name="balance" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox"  name="balance">';
                                                        } @endphp

                                                            {{ __('BALANCE') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->ministatement == 1){
                                                        echo '<input type="checkbox" name="ministatement" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="ministatement">';
                                                        } @endphp

                                                            {{ __('MINI-STATEMENT') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">

                                                            <label>
                                                                @php if($rec->sale_cashback == 1){
                                                        echo '<input type="checkbox" name="sale_cashback" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="sale_cashback">';
                                                        } @endphp

                                                                {{ __('SALE + CASHBACK') }}
                                                            </label>


                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->pin_issue == 1){
                                                        echo '<input type="checkbox" name="pin_issue" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="pin_issue">';
                                                        } @endphp

                                                            {{ __('PIN ISSUE') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->pin_change == 1){
                                                        echo '<input type="checkbox" name="pin_change" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="pin_change">';
                                                        } @endphp

                                                            {{ __('PIN CHANGE') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->reversal == 1){
                                                        echo '<input type="checkbox" name="reversal" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="reversal">';
                                                        } @endphp

                                                            {{ __('REVERSAL') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->deposit == 1){
                                                        echo '<input type="checkbox" name="deposit" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="deposit">';
                                                        } @endphp

                                                            {{ __('DEPOSIT') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->withdrawal == 1){
                                                        echo '<input type="checkbox" name="withdrawal" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="withdrawal">';
                                                        } @endphp

                                                            {{ __('WITHDRAWAL') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->settings == 1){
                                                        echo '<input type="checkbox" name="settings" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="settings">';
                                                        } @endphp

                                                            {{ __('SETTINGS') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->batch == 1){
                                                        echo '<input type="checkbox" name="batch" value="1" checked>';
                                                        }else{
                                                            echo '<input type="checkbox" name="batch">';
                                                        } @endphp

                                                            {{ __('BATCH CUT OFF') }}

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

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
