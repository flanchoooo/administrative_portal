<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class IBDashController extends Controller
{

    public function dashboard (Request $request){


        /*try {

            //Generate API Token
            $client = new Client();
            $result = $client->get(env('IB_DASH_BASE_URL'), [

            ]);


           //return $token = $result->getBody()->getContents();
            $token = json_decode($result->getBody()->getContents());

            session()->flash('ecocash',$token->ecocash);
            session()->flash('hot_recharge',$token->hot_recharge);
            session()->flash('sms',$token->sms);


            return view('internet.dashboard');

        }
        catch (ClientException $e){
            return abort(404,'Could process your request please contact system administrator');

        }
        */


        try {


            $client = new Client();
            $result = $client->get(env('BASE_URL').'/kazang_balance', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            $balance = json_decode($rec);
            session()->flash('corporates', $balance->corporates);
            session()->flash('mobile_users', $balance->mobile_users);
            session()->flash('web', $balance->web);
            session()->flash('ecocash','ZWL'.' '.$balance->ecocash);
            session()->flash('zesa','ZWL'.' '.$balance->zesa);
            session()->flash('sms','ZWL'.' '.$balance->sms);
            return view('internet.dashboard');

        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet.dashboard');

        }




    }
}
