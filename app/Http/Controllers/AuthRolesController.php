<?php

namespace App\Http\Controllers;
use App\UserAuth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthRolesController extends Controller
{


        public function display(Request $request){


            session_start();
            AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
            //return view('authentication.display');

            if(!isset($_SESSION['token'])){
                Auth::logout();
                return redirect('/login');
            }

            try {

                $client = new Client();
                $result = $client->get(env('AUTH_SERVER_BASE_URL').'/roles/?page=0&size=100', [

                    'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                    'headers' => [
                        'Content-type' => 'application/json',
                        'Authorization' =>$_SESSION["token"],
                        'application_uid' => env('AUTH_AUID'),
                    ],

                ]);


                return $rec =  $result->getBody()->getContents();


                return view('roles.display')->with('records', $response = json_decode($rec)->responseBody->content);


            }
            catch (ClientException $e){

                return $e;
                session()->flash('error', 'Please Contact System administrator for assistance');
                return view('authentication.display');

            }

            session_close();

        }

        public function create_view(){
            AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        return view('roles.create');

    }

        public function create(Request $request){

        //return $request->all();
            AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/connected-systems/', [

                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'applicationUID'  => $request->applicationUID,
                    'applicationUrl'    => $request->system_name,
                    'systemName'        => $request->system_url,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $response = json_decode($rec);

            if($response->statusCode != '200'){

                session()->flash('error', $response->message);
                return view('create.display');

            }

            return redirect('/authentication/display');


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('create.display');

        }

    }

        public function search(Request $request){

        session_start();
            AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');

            if(!isset($_SESSION['token'])){
                Auth::logout();
                return redirect('/login');
            }

        try {

            $client = new Client();
            $result = $client->get(env('AUTH_SERVER_BASE_URL').'/connected-systems/?page=0&size=100', [

                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' =>$_SESSION["token"],
                    'application_uid' => '{4aecdd14-8a3f-4aa8-8adc-7b0b06355aaa}',
                ],

            ]);


            $rec =  $result->getBody()->getContents();
            return view('roles.search')->with('records', $response = json_decode($rec)->responseBody->
            content);


        }
        catch (ClientException $e){


            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('authentication.display');

        }

        session_close();

    }

        public function  search_user (Request $request){

            AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
            $name  = $request->name;

            if(is_numeric($name)){

                $mobile =  UserAuth::where('phone',$name)->first();

                if(!isset($mobile)){
                    session()->flash('error','User not found.');
                    return redirect('/roles/search');
                }
                   session()->flash('status',$mobile->status);
                   session()->flash('account_status',$mobile->account_status);
                   session()->flash('email',$mobile->email);
                   session()->flash('first_name',$mobile->first_name);
                   session()->flash('last_name',$mobile->last_name);
                   session()->flash('phone',$mobile->phone);
                   session()->flash('user_name',$mobile->user_name);
                   session()->flash('id',$mobile->id);

                return view('roles.user');

            }


            if(filter_var($name, FILTER_VALIDATE_EMAIL)) {

                $mobile=  UserAuth::where('email',$name)->first();

                if(!isset($mobile)){
                    session()->flash('error','User not found.');
                    return redirect('/roles/search');
                }
                session()->flash('status',$mobile->status);
                session()->flash('account_status',$mobile->account_status);
                session()->flash('email',$mobile->email);
                session()->flash('first_name',$mobile->first_name);
                session()->flash('last_name',$mobile->last_name);
                session()->flash('phone',$mobile->phone);
                session()->flash('user_name',$mobile->user_name);
                session()->flash('id',$mobile->id);

                return view('roles.user');
            }

            if($name){


                $mobile=  UserAuth::where('email',$name)->first();

                if(!isset($mobile)){
                    session()->flash('error','User not found.');
                    return redirect('/roles/search');
                }
                session()->flash('status',$mobile->status);
                session()->flash('account_status',$mobile->account_status);
                session()->flash('email',$mobile->email);
                session()->flash('first_name',$mobile->first_name);
                session()->flash('last_name',$mobile->last_name);
                session()->flash('phone',$mobile->phone);
                session()->flash('user_name',$mobile->user_name);
                session()->flash('id',$mobile->id);

                return view('roles.user');
            }




        }


        public function update_user(Request $request)
        {
            AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');

            $result = UserAuth::where('email', $request->email)->first();
            $result->status = $request->status;
            $result->last_name = $request->last_name;
            $result->first_name = $request->first_name;
            $result->email = $request->email;
            $result->phone = $request->mobile;
            $result->user_name = $request->user_name;
            $result->save();

            session()->flash('success','User profile successfully updated.');
            return redirect('/roles/search');


        }
}
