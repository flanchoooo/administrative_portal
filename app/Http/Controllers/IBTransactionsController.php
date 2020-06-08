<?php

namespace App\Http\Controllers;

use App\RTGS;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class IBTransactionsController extends Controller
{


    public function index()
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_transactions');



        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/internet/transactions', [

                'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec = $result->getBody()->getContents();
            return view('internet.transactions')->with('records', json_decode($rec));

        } catch (ClientException $e) {


            session()->flash('notification', 'Please contact system administrator for assistance');
            return view('internet.transactions');


        }
    }

    public function rtgs()
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'rtgs');

        $records = RTGS::where('status','PENDING')->get();




        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/internet/rtgs', [

                'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec = $result->getBody()->getContents();
            return view('internet.rtgs')->with('records', json_decode($rec));

        } catch (ClientException $e) {


            session()->flash('notification', 'Please contact system administrator for assistance');
            return view('internet.transactions');


        }
    }

    public function process_rtgs(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'rtgs');

        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/internet/rtgs/process', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id'               => $request->id,
                    'updated_by'       => Auth::user()->id,

                ],

            ]);


            $rec = $result->getBody()->getContents();
            return Redirect('/internet/rtgs');

        } catch (ClientException $e) {


            session()->flash('notification', 'Please contact system administrator for assistance');
            return view('internet.transactions');


        }
    }


        public function airtime(){


            AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_transactions');

            try {

                $client = new Client();
                $result = $client->get(env('BASE_URL').'/internet/hot_recharge', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);


                $rec =  $result->getBody()->getContents();
                return view('internet.airtime')->with('records',json_decode($rec));

            }
            catch (ClientException $e){


                session()->flash('notification', 'Please contact system administrator for assistance');
                return view('internet.transactions');


            }



    }


        public function ecocash(){


        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_transactions');

        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/ecocash', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            return view('internet.ecocash ')->with('records',json_decode($rec));

        }
        catch (ClientException $e){

            session()->flash('notification', 'Please contact system administrator for assistance');
            return view('internet.transactions');

        }



    }

        public function electricity(){

        session_start();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_transactions');

        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/electricity', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            return view('internet.electricity')->with('records',json_decode($rec));

        }
        catch (ClientException $e){


            session()->flash('notification', 'Please contact system administrator for assistance');
            return view('internet.transactions');


        }



    }


        public function between_dates(Request $request){

       // return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_transactions');

        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/between_dates', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'start_date'    => $request->start_date,
                    'end_date'      => $request->end_date,
                    'txn_type'      => $request->txn_type,

                ],

            ]);


            if($request->txn_type == 'ecocash'){
                $rec =  $result->getBody()->getContents();
                return view('internet.ecocash')->with('records',json_decode($rec));
            }

            if($request->txn_type == 'airtime'){
                $rec =  $result->getBody()->getContents();
                return view('internet.airtime')->with('records',json_decode($rec));
            }

            if($request->txn_type == 'zetdc'){
                $rec =  $result->getBody()->getContents();
                return view('internet.electricity')->with('records',json_decode($rec));
            }

            $rec =  $result->getBody()->getContents();
            return view('internet.transactions')->with('records',json_decode($rec));

        }
        catch (ClientException $e){


            session()->flash('notification', 'Please contact system administrator for assistance');
            return view('internet.transactions');


        }



    }










}
