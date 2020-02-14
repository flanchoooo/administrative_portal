<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IBCorporateController extends Controller
{

    public function display(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/corporates/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);
            $rec =  $result->getBody()->getContents();
            return view('corporate.display')->with('records', json_decode($rec));
        }
        catch (ClientException $e){
            return $e;
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');
        }

    }

    public function createview(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        return view('corporate.create');
    }

    public function show(Request $request)
    {

        $user = new Client();
        $res = $user->post(env('BR_BASE_URL').'/api/authenticate', [
            'json' => [
                'username' => env('BR_USERNAME'),
                'password' => env('BR_PASSWORD'),
            ]
        ]);

         $tok = $res->getBody()->getContents();
        $bearer = json_decode($tok, true);
        $sec = 'Bearer ' . $bearer['id_token'];

        try {



            $c = new Client();
            $r = $c->post(env('BR_BASE_URL') . '/api/customers', [

                'headers' => ['Authorization' => $sec, 'Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->account_number,
                ]
            ]);

             $search_result = $r->getBody()->getContents();
            $details = json_decode($search_result);
            session()->flash('client_name', $details->ds_account_customer_info->client_name);
            session()->flash('account_id', $details->ds_account_customer_info->account_id);
            session()->flash('branch_name', $details->ds_account_customer_info->branch_name);
            session()->flash('email_id', $details->ds_account_customer_info->email_id);
            session()->flash('acstatus', $details->ds_account_customer_info->acstatus);
            session()->flash('mobile', $details->ds_account_customer_info->mobile);

            if ($details->code === '00') {

                return view('corporate.info');

            } else {

                $notification = 'Please Contact System administrator for assistance';
                return view('corporate.create')->with('notification', $notification);
            }

        } catch (ClientException $e) {
            //return $e;

            $notification = 'Invalid Account';
            return view('corporate.create')->with('notification', $notification);


        }

    }

    public function create(Request $request)
    {

        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporates/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by'    => $request->created_by,
                    'name'          => $request->account_name,
                    'account_id'    => $request->account_number,
                    'status'        => 1,
                ],
            ]);

            //return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code != "00") {
                $notification = $rec->description;
                return view('corporate.create')->with('notification', $notification);
            }


            return redirect('/corporates/display');
        }
        catch (RequestException $requestException){

            $notification = 'Duplicate entry';
            return view('corporate.create')->with('notification', $notification);


        }



    }

    public function delete(Request $request)
    {

        // return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporates/remove_account', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'corporate_id'    => $request->id,
                    'created_by'     => Auth::user()->id

                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code == "00"){
                return redirect('/corporates/display');

            }else{
                $notification = $rec->description;
                return view('corporate.create')->with('notification', $notification);

            }


        }
        catch (ClientException $exception){

            $notification = 'Please Contact System administrator for assistance';
            return view('corporate.create')->with('notification', $notification);


        }



    }

    public function createuser(Request $request){

        session()->flash('corporate_id', $request->id);
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        return view('corporate.create_user');
    }

    public function users(Request $request)
    {

        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('IB_BANKING_URL').'/api/corporate/register', [


                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'corporate_id'      => $request->corporate_id,
                    'email'             => $request->email,
                    'mobile'            => $request->mobile,
                    'name'              => $request->name,
                    'user_type_id'      => $request->user_type_id,

                ],
            ]);

            // return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());


            if($rec->code !='00'){
                session()->flash('error','Mobile or Email already taken.');
                return view('corporate.create_user');
            }



            return redirect('/corporates/display');

        }
        catch (ClientException $exception){

            //  return $exception;
            session()->flash('error','Please Contact System administrator for assistance');
            return view('corporate.create_user');
        }



    }

    public function view(Request $request)
    {

        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporate/users', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'corporate_id'    => $request->id,


                ],
            ]);



            $rec =  $result->getBody()->getContents();

            return view('corporate.view')->with('records', json_decode($rec));



        }
        catch (ClientException $exception){
            session()->flash('error','Please Contact System administrator for assistance');
            return redirect('/corporate/display');
        }



    }

    public function accounts(Request $request){

        session()->flash('corporate_id', $request->id);
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        return view('corporate.accounts');
    }

    public function add_lookup(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');


        $token = json_decode(TokenService::getToken());
        $headers = array(
            'Accept'        => 'application/json',
            'Authorization' => $token->responseBody,
        );

        try {



            $c = new Client();
            $r = $c->post(env('BR_BASE_URL') . '/api/customers', [

                'headers' => $headers,
                'json' => [
                    'account_number' => $request->account_number,
                ]
            ]);

            $search_result = $r->getBody()->getContents();
            $details = json_decode($search_result);
            session()->flash('client_name', $details->ds_account_customer->client_name);
            session()->flash('account_id', $details->ds_account_customer->account_id);
            session()->flash('branch_name', $details->ds_account_customer->branch_name);
            session()->flash('email_id', $details->ds_account_customer->email_id);
            session()->flash('acstatus', $details->ds_account_customer->acstatus);
            session()->flash('mobile', $details->ds_account_customer->mobile);


            if ($details->code === '00') {

                return view('corporate.add_info');

            } else {

                $notification = 'Please Contact System administrator for assistance';
                return view('corporate.accounts')->with('notification', $notification);
            }

        } catch (ClientException $e) {

            $notification = 'Invalid Account';
            return view('corporate.accounts')->with('notification', $notification);


        }

    }

    public function account_create(Request $request)
    {

        // return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporates/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by'    => $request->created_by,
                    'name'          => $request->account_name,
                    'account_id'    => $request->account_number,
                    'status'        => 1,
                ],
            ]);

            //return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code == "00"){
                return redirect('/corporates/display');

            }else{
                $notification = $rec->description;
                return view('corporate.create')->with('notification', $notification);

            }


        }
        catch (ClientException $exception){

            $notification = 'Please Contact System administrator for assistance';
            return view('corporate.create')->with('notification', $notification);


        }



    }

}
