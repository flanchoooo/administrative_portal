<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthenticationServiceController extends Controller
{
    public function display(Request $request){

        session_start();

        if(!isset($_SESSION['token'])){
            Auth::logout();
            return redirect('/login');
        }

        $token = $_SESSION['token'];

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->get(env('AUTH_SERVER_BASE_URL').'/connected-systems/?page=0&size=100', [
                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' =>$token,
                    'application_uid' => '{4aecdd14-8a3f-4aa8-8adc-7b0b06355aaa}',
                ],

            ]);


            $rec =  $result->getBody()->getContents();


            return view('authentication.display')->with('records', $response = json_decode($rec)->responseBody->
            content);


        }
        catch (ClientException $e){


            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('authentication.display');

        }

        session_close();

    }

    public function create_view(){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        return view('authentication.create');

    }

    public function create(Request $request){


        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/connected-systems/', [

                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'application_owner'  => $request->system_owner,
                    'application_url'    => $request->system_url,
                    'system_name'        => $request->system_name,

                ],
            ]);


         $rec =  $result->getBody()->getContents();
         $response = json_decode($rec);

         if($response->statusCode != 0){

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

    public function updateview(Request $request){

        session_start();

        if(!isset($_SESSION['token'])){
            Auth::logout();
            return redirect('/login');
        }

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->GET(env('AUTH_SERVER_BASE_URL').'/connected-systems/'.$request->id.'/?eager=false', [
                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                    'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => $_SESSION["token"],
                        'application_uid'  => '{4aecdd14-8a3f-4aa8-8adc-7b0b06355aaa}',

                    ],


            ]);


            $rec =  $result->getBody()->getContents();

          $response = json_decode($rec);

          session()->flash('systemName', $response->responseBody->system_name);
          session()->flash('status', $response->responseBody->status);
          session()->flash('applicationOwner', $response->responseBody->application_owner);
          session()->flash('applicationUrl', $response->responseBody->application_url);
          session()->flash('applicationUID', $response->responseBody->application_uid);
          session()->flash('id', $response->responseBody->id);

          return view('authentication.update');

        }
        catch (ClientException $e){

            return redirect('/authentication/display');


        }

    }

    public function update(Request $request){

        session_start();

        if(!isset($_SESSION['token'])){
            Auth::logout();
            return redirect('/login');
        }
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/connected-systems/'.$request->id.'/', [
                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => $_SESSION["token"],
                    'application_uid'  => '{4aecdd14-8a3f-4aa8-8adc-7b0b06355aaa}',



                ],


                'json' => [

                    'system_name'  => $request->name,
                    'application_owner'    => $request->applicationOwner,
                    'status'        => $request->state,
                    'application_url'       => $request->applicationUrl,

                ],
            ]);



            return redirect('/authentication/display');


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return redirect('/authentication/display');

        }

    }


}
