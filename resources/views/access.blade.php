@extends('layouts.tab')


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-8 col-lg-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Access Control</h3>
                    @if ($flash = session('message'))
                        <div  class="alert alert-success" role="alert">
                            {{$flash}}
                        </div>
                    @endif
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="/access/store" aria-label="{{ __('Add Product') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">User</label>
                            <select id="user" type="text" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user" value="{{ old('user') }}" required autofocus  >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                @endforeach

                            </select>                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="role" value="{{ old('status') }}" required autofocus  >
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="transactions" value="on">
                                        {{ __('Transactions') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="dashboard" value="on">
                                        {{ __('Dashboard') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="rtgs" value="on">
                                        {{ __('RTGS') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="paynet" value="on">
                                        {{ __('Paynet') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="change_account_status" value="on">
                                        {{ __('Acc Management') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="configurations" value="on">
                                        {{ __('Configurations') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="add_channel" value="on">
                                        {{ __('Channel') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="add_category" value="on">
                                        {{ __('Category') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="view_products" value="on">
                                        {{ __('Products') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="add_sort_codes" value="on">
                                        {{ __('Sort Codes Button') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="view_banks" value="on">
                                        {{ __('Bank') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="view_fees" value="on">
                                        {{ __('Fees') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="add_fees_button" value="on">
                                        {{ __('Add Fees Button') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="update_channel" value="on">
                                        {{ __('Update Channel') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="update_bank" value="on">
                                        {{ __('Update Bank') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="update_category" value="on">
                                        {{ __('Update Category') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="update_product" value="on">
                                        {{ __('Update Product') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="users" value="on">
                                        {{ __('Users') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="add_corporate_user_button" value="on">
                                        {{ __('Add Corp User') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="update_corporate_button" value="on">
                                        {{ __(' Update Corporates') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="link_corporate_button" value="on">
                                        {{ __('Add Corporate Bank Account') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="corporate_tab" value="on">
                                        {{ __('Corporates') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="add_corporate_button" value="on">
                                        {{ __('Add Corporates') }}
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer col-sm" >
                        <button type="submit" class="btn btn-primary">   {{ __('Validate') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection