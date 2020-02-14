<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{


    public function create_view(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');
        return view('employees.create')->with(['id' => $request->id]);
    }

    public function creates(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');
        $record = session('id');
        return view('employees.create')->with(['records' => $record]);
    }

    public function create(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');
        session_start();

       /* if(!isset($_SESSION["token"])){
            Auth::logout();
            return redirect('/login');
        }

       */


        try {

            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/users/', [
                'auth'    =>    [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' =>    [

                    'Content-type' => 'application/json',
                ],

               'json' => [
                    "application_uid"    => env('AUTH_AUID'),
                    "belong_to"          => $request->merchant_id,
                    "email"             => $request->email,
                    "firstname"         => $request->first_name,
                    "lastname"          => $request->last_name,
                    "password"          => $request->password,
                    "phone"             => $request->phone,
                    "user_type"          => "ADMIN",
                    "username"          => $request->phone,
                ],

            ]);



           $rec =  json_decode($result->getBody()->getContents());
          if($rec->statusCode !='0'){
              session()->flash('error', $rec->message);
              return redirect('/merchant/display');
          }

          //Create Teller if the account number is set.
          if(isset($account_number)) {
              session()->flash('error', 'Service not available');
              return view('employees.create');
              try {
                  $results = $client->post(env('SECUREPAY_CLIENT_BASE_URL') . '/tellers/', [
                      'headers' => [

                          'Authorization' => $_SESSION["token"],
                          'Content-type' => 'application/json',
                      ],
                      'json' => [
                          'merchant' => array('id' => $request->id),
                          'user_id' => $rec->responseBody->id,
                          'account_number' => $request->account_number,
                          'balance' => 0,

                      ],

                  ]);

                  $results->getBody()->getContents();
                  $recs = json_decode($results->getBody()->getContents());
                  if ($rec->statusCode != '200') {
                      session()->flash('error', $recs->message);
                      return view('employees.create');
                  }
                  return redirect('/merchant/display');

              } catch (RequestException  $requestException) {
                  return $requestException;
                  session()->flash('success', 'Employee successfully created.');
                  return view('employees.create');
              }
          }

            return redirect('/merchant/display');

        }

        catch (RequestException  $requestException){
            session()->flash('error', 'Please Contact System administrator for assistance.');
            return redirect('/merchant/display');
        }

    }

    public function display_teller (Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');
        session()->flash('merchant_id', $request->merchant_id);
        session()->flash('user_id', $request->user_id);
        session()->flash('teller', $request->teller);
        return view('pos_users.create');

       // return  $request->all();

        session_start();
        if(!isset($_SESSION['token'])){
            Auth::logout();
            return redirect('/login');
        }


        try {
            $client = new Client();
            $results = $client->post(env('SECUREPAY_CLIENT_BASE_URL') . '/tellers/search/', [
                'headers' => [

                    'Authorization' => $_SESSION['token'],
                    'Content-type' => 'application/json',
                ],
                'json' => [
                    'user_id' => $request->user_id,


                ],

            ]);


            $rec = json_decode($results->getBody()->getContents());
             return $rec = $results->getBody()->getContents();

            if(empty($rec->code != '00')){
                session()->flash('error', $rec->message);
                return redirect('/merchant/display');
            }


            session()->flash('merchant_id', $request->merchant_id);
            session()->flash('user_id', $request->user_id);
            session()->flash('teller', $request->teller);
            return view('pos_users.create');



        } catch (RequestException  $requestException) {

                session()->flash('merchant_id', $request->merchant_id);
                session()->flash('user_id', $request->user_id);
                return view('pos_users.create');

        }

    }

    public function teller_create(Request $request){
           //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');

        session_start();
        if(!isset($_SESSION['token'])){
            Auth::logout();
            return redirect('/login');
        }


        $client = new Client();
        try {
            $results = $client->post(env('SECUREPAY_CLIENT_BASE_URL') . '/tellers', [
                'headers' => [

                    'Authorization' => $_SESSION["token"],
                    'Content-type' => 'application/json',
                ],
                'json' => [
                    'merchant_id'       => $request->merchant,
                    'user_id'           => $request->user_id,
                    'account_number'    => $request->account_number,
                    'balance'           => 0,

                ],

            ]);

             $resu = $results->getBody()->getContents();
             $rec = json_decode($resu);
            if ($rec->code != '00') {
                session()->flash('error', $rec->description);
                return redirect('/merchant/display');

            }


            return redirect('/merchant/display');

        } catch (RequestException  $requestException) {
            session()->flash('error', 'Failed to create teller account please contact system administrator');
            return redirect('/merchant/display');
        }
    }



}
