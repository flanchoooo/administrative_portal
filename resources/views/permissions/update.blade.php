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
                                    <h1 class="h4 text-gray-900 mb-4">Update Role Profile</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="/permissions/update_profile" aria-label="{{ __('Add Product') }}">
                                    @csrf

                                    <div class="box-body">
                                        @foreach($records as $rec)
                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Role Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{$rec->id}}" required autofocus>
                                            </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Name</label>
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="role_name" value="{{$rec->role_name}}" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Status</label>
                                            <select id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="" required autofocus  >
                                                <option value="1">ACTIVE</option>
                                                <option value="0">IN-ACTIVE</option>
                                            </select>
                                        </div>


                                        <div class="form-group row">

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->dashboard != 'on'){
                                                        echo '<input type="checkbox" name="dashboard" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="dashboard" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Dashboard & Reports') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->reports != 'on'){
                                                        echo '<input type="checkbox" name="reports" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="reports" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Transaction Reports') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->wallet_services != 'on'){
                                                        echo '<input type="checkbox" name="wallet_services" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="wallet_services" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Wallet Services') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->update_wallet != 'on'){
                                                        echo '<input type="checkbox" name="update_wallet" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="update_wallet" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Update Wallet') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->wallet_pin != 'on'){
                                                        echo '<input type="checkbox" name="wallet_pin" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="wallet_pin" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Wallet Pin Reset') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->wallet_configs != 'on'){
                                                        echo '<input type="checkbox" name="wallet_configs" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="wallet_configs" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Wallet Configurations') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->acc != 'on'){
                                                        echo '<input type="checkbox" name="acc" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="acc" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Card Management') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->card_initiation != 'on'){
                                                        echo '<input type="checkbox" name="card_initiation" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="card_initiation" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Card Initiation') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->card_auth != 'on'){
                                                        echo '<input type="checkbox" name="card_auth" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="card_auth" value="on" checked>';
                                                        } @endphp


                                                            {{ __('Card Authorization') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->change_status != 'on'){
                                                        echo '<input type="checkbox" name="change_status" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="change_status" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Card Status') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>

                                                            @php if($rec->delete_card != 'on'){
                                                        echo '<input type="checkbox" name="delete_card" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="delete_card" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Decommission Card') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->merchants != 'on'){
                                                        echo '<input type="checkbox" name="merchants" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="merchants" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Merchant Configurations') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->merchant_profile != 'on'){
                                                        echo '<input type="checkbox" name="merchant_profile" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="merchant_profile" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Merchant Profile') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->create_merchant != 'on'){
                                                        echo '<input type="checkbox" name="create_merchant" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="create_merchant" value="on" checked>';
                                                        } @endphp
                                                            {{ __('Create Merchant') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->add_account != 'on'){
                                                        echo '<input type="checkbox" name="add_account" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="add_account" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Add Merchant Account') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->edit_merchant != 'on'){
                                                        echo '<input type="checkbox" name="edit_merchant" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="edit_merchant" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Edit Merchant Profile') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->pos_devices != 'on'){
                                                        echo '<input type="checkbox" name="pos_devices" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="pos_devices" value="on" checked>';
                                                        } @endphp

                                                            {{ __('POS Management') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->devices != 'on'){
                                                        echo '<input type="checkbox" name="devices" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="devices" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Devices') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->add_pos != 'on'){
                                                        echo '<input type="checkbox" name="add_pos" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="add_pos" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Add Merchant POS') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->update_merchant_pos != 'on'){
                                                        echo '<input type="checkbox" name="update_merchant_pos" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="update_merchant_pos" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Update Merchant POS') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->update_merchant_acc != 'on'){
                                                        echo '<input type="checkbox" name="update_merchant_acc" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="update_merchant_acc" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Edit Merchant Account') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->update_merchant_acc != 'on'){
                                                        echo '<input type="checkbox" name="update_pos_devices" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="update_pos_devices" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Edit Merchant POS') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->delete_pos_devices != 'on'){
                                                        echo '<input type="checkbox" name="delete_pos_devices" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="delete_pos_devices" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Delete Merchant POS') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->merchant_acc_management != 'on'){
                                                        echo '<input type="checkbox" name="merchant_acc_management" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="merchant_acc_management" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Merchant Management') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->card_production != 'on'){
                                                        echo '<input type="checkbox" name="card_production" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="card_production" value="on" checked>';
                                                        } @endphp
                                                            {{ __('Card Production') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->users != 'on'){
                                                        echo '<input type="checkbox" name="users" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="users" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Users') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->e_value_checker != 'on'){
                                                        echo '<input type="checkbox" name="e_value_checker" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="e_value_checker" value="on" checked>';
                                                        } @endphp
                                                            {{ __('E-Value Checker') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="checkbox">
                                                    <label>
                                                        @php if($rec->transaction_manager != 'on'){
                                                        echo '<input type="checkbox" name="transaction_manager" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="transaction_manager" value="on" checked>';
                                                        } @endphp

                                                        {{ __('System Configurations') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->ib_dashboard != 'on'){
                                                        echo '<input type="checkbox" name="ib_dashboard" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="ib_dashboard" value="on" checked>';
                                                        } @endphp

                                                            {{ __('IB Dashboard') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->ib_transactions != 'on'){
                                                        echo '<input type="checkbox" name="ib_transactions" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="ib_transactions" value="on" checked>';
                                                        } @endphp

                                                            {{ __('IB Transactions') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->ib_change_status != 'on'){
                                                        echo '<input type="checkbox" name="ib_change_status" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="ib_change_status" value="on" checked>';
                                                        } @endphp

                                                            {{ __('IB PIN & Status Change') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->rtgs != 'on'){
                                                        echo '<input type="checkbox" name="rtgs" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="rtgs" value="on" checked>';
                                                        } @endphp

                                                            {{ __('RTGS') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->corporate != 'on'){
                                                        echo '<input type="checkbox" name="corporate" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="corporate" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Corporate') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->account_management != 'on'){
                                                        echo '<input type="checkbox" name="account_management" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="account_management" value="on" checked>';
                                                        } @endphp

                                                            {{ __('Account Management') }}
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
