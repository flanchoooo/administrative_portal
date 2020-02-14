<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class PosUsersController extends Controller
{
    public function display_employees(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'edit_merchant');
        try {
            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/users/search/', [
                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json', 'application_uid' => env('AUTH_AUID')],
                'json' => [
                    'belong_to' => $request->id,
                ],
            ]);

            $rec =  $result->getBody()->getContents();

            $response = json_decode($rec);
            //return $response->responseBody->belong_to->id;

            if($response->statusCode != '0'){
                $record = $request->id;
                return view('employees.create')->with(['records' => $record]);
            }
            session()->flash('id',$request->id);
            return view('pos_users.employees', array('records'=> $response->responseBody));

        }
        catch (RequestException $requestException){
            $record = $request->id;
            return view('employees.create')->with(['records' => $record]);
        }

    }


}
