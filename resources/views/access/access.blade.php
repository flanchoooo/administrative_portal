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
                                    <h1 class="h4 text-gray-900 mb-4">Access Control</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif
                                </div>

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


                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="account" value="on">
                                                        {{ __('Account Management') }}
                                                    </label>
                                                </div>
                                            </div>



                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="card_initiation" value="on">
                                                        {{ __('Card Initiation') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="card_auth" value="on">
                                                        {{ __('Card Authorization') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="card_initiation" value="on">
                                                        {{ __('Card Initiation') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="change_status" value="on">
                                                        {{ __('Card Status') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="delete_card" value="on">
                                                        {{ __('Decommission Card') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="merchants" value="on">
                                                        {{ __('Merchants') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="merchant_profile" value="on">
                                                        {{ __('Merchant Profile') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="devices" value="on">
                                                        {{ __('Devices') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="account_management" value="on">
                                                        {{ __('Account Management') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="create_merchant" value="on">
                                                        {{ __('Create Merchant') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="edit_merchant" value="on">
                                                        {{ __('Edit Merchant Profile') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="add_account" value="on">
                                                        {{ __('Add Merchant Account') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="add_pos" value="on">
                                                        {{ __('Add Merchant POS') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="update_merchant_acc" value="on">
                                                        {{ __('Edit Merchant Account') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="update_pos_devices" value="on">
                                                        {{ __('Edit Merchant POS') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="delete_pos_devices" value="on">
                                                        {{ __('Delete Merchant POS') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="card_production" value="on">
                                                        {{ __('Card Production') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="card_production" value="on">
                                                        {{ __('Card Production') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="transaction_manager" value="on">
                                                        {{ __('Transaction Manager') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="reports" value="on">
                                                        {{ __('Reports') }}
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
                                                    </label>
                                                </div>
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