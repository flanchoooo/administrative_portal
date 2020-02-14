<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;


class WalletManagementController extends Controller
{

    public function update_view()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_wallet');
        return view('wallet.update_view');
    }

    public function reset_view()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'wallet_pin');
        return view('wallet.reset_view');
    }


    public function preauth(Request $request)

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_wallet');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->mobile,

                ],
            ]);



            $result_cos = $client->get(env('BASE_URL').'/wallet/listClassOfService', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

             $cos_rec =  $result_cos->getBody()->getContents();


             $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet.update_view')->with('notification', $notification);
            }




            session()->flash('last_name',$details->account_details->last_name);
            session()->flash('mobile',$details->account_details->mobile);
            session()->flash('first_name',$details->account_details->first_name);
            session()->flash('balance',$details->account_details->balance);
            session()->flash('account_number',$details->account_details->account_number);
            session()->flash('gender',$details->account_details->gender);
            session()->flash('national_id',$details->account_details->national_id);
            session()->flash('dob',$details->account_details->dob);
            session()->flash('auth_attempts',$details->account_details->auth_attempts);

            return view('wallet.info')->with('records', json_decode($cos_rec));


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet.update_view')->with('notification', $notification);

        }



    }


    public function update(Request $request)

    {


        //return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_wallet');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/updateWallet', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->mobile,
                    'first_name' => $request->first_name,
                    'mobile' => $request->mobile,
                    'last_name' => $request->last_name,
                    'auth_attempts' => 0,
                    'gender' => $request->gender,
                    'national_id' => $request->national_id,
                    'dob' => $request->dob,
                    'state' => $request->state,
                    'updated_by' => $request->created_by,
                    'wallet_cos_id' => $request->wallet_cos_id,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet.update_view')->with('notification', $notification);
            }



            $notification = $details->description;
            return view('wallet.update_view')->with('success_notification', $notification);



        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet.update_view')->with('notification', $notification);

        }



    }

    public function reset_preauth(Request $request)

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'wallet_pin');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->mobile,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet.reset_view')->with('notification', $notification);
            }




            session()->flash('last_name',$details->account_details->last_name);
            session()->flash('mobile',$details->account_details->mobile);
            session()->flash('first_name',$details->account_details->first_name);
            session()->flash('balance',$details->account_details->balance);
            session()->flash('account_number',$details->account_details->account_number);
            session()->flash('gender',$details->account_details->gender);
            session()->flash('national_id',$details->account_details->national_id);
            session()->flash('dob',$details->account_details->dob);
            session()->flash('state',$details->account_details->state);


            return view('wallet.reset_preauth');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet.reset_view')->with('notification', $notification);

        }



    }


    public function reset(Request $request)

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'wallet_pin');

        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/pin/reset', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'mobile' => $request->mobile,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet.reset_view')->with('notification', $notification);
            }





            $notification = $details->description;
            //session()->flash('link_error', $details->description);
            return view('wallet.reset_view')->with('success_notification', $notification);



        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet.reset_view')->with('notification', $notification);

        }



    }




}
