<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Devices;
use App\Merchant;
use App\Permissions;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;


class PermissionsController extends Controller
{
    public function display(){


            AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
            $permissions = Permissions::all();
            return view('permissions.display')->with('records',$permissions);
    }

    public function create_permissions(){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        return view('permissions.create');

    }

    public function create(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
    //  return $request->all();
       Permissions::create(
           [

               'role_name'              => $request->role_name,
               'status'                 => $request->status,


           ]
       );

        return redirect('/permissions/display');

    }

    public function edit(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
          $records =  Permissions::where('id',$request->id)->get();
        return view('permissions.update')->with('records',$records);

    }

    public function update(Request $request){

    //return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');

     //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        Permissions::where('id', $request->id)->update([
            'wallet_configs'         => $request->wallet_configs,
            'transaction_manager'    => $request->transaction_manager,
            'dashboard'              => $request->dashboard,
            'devices'                => $request->devices,
            'card_production'        => $request->card_production,
            'merchants'              => $request->merchants,
            'role_name'              => $request->role_name,
            'reports'                => $request->reports,
            'card_initiation'        => $request->card_initiation,
            'card_auth'              => $request->card_auth,
            'change_status'          => $request->change_status,
            'merchant_profile'       => $request->merchant_profile,
            'merchant_acc_management'=> $request->merchant_acc_management,
            'pos_devices'            => $request->pos_devices,
            'create_merchant'        => $request->create_merchant,
            'edit_merchant'          => $request->edit_merchant,
            'add_account'            => $request->add_account,
            'add_pos'                => $request->add_pos,
            'update_merchant_acc'    => $request->update_merchant_acc,
            'update_pos_devices'     => $request->update_pos_devices,
            'delete_pos_devices'     => $request->delete_pos_devices,
            'users'                  => $request->users,
            'e_value_checker'        => $request->e_value_checker,
            'delete_card'            => $request->delete_card,
            'acc'                    => $request->acc,
            'status'                 => $request->status,
            'account_management'     => $request->account_management,
            'wallet_services'        => $request->wallet_services,
            'update_wallet'          => $request->update_wallet,
            'wallet_pin'             => $request->wallet_pin,
            'update_merchant_pos'    => $request->update_merchant_pos,
            'ib_dashboard'           => $request->ib_dashboard,
            'ib_transactions'        => $request->ib_transactions,
            'ib_change_status'       => $request->ib_change_status,
            'rtgs'                   => $request->rtgs,
            'corporate'             => $request->corporate,
        ]);

        return redirect('/permissions/display');

    }

    public function users(){




        $admins = Admin::all();
        return view('permissions.users')->with('records', $admins);
    }

    public function error(){
        return view('error.401');
    }

}
