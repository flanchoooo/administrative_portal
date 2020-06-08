<?php


namespace App\Http\Controllers;


use App\ClientAccounts;
use App\Logs;
use App\MobilesUsers;
use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MultipleAccountController
{

    public  function search(){
        return view('multiple.search');
    }

    public  function statement(){
        return view('multiple.statement');
    }

    public  function statements(Request $request){


        //return $request->all();

       ;

        try {

            $sec = 'Bearer ';

            $headers = array(
                'Accept' => 'application/json',
                'Authorization' => $sec,
            );

            $client = new Client();
            $result = $client->post(env('BR_BASE_URL') . '/api/accounts/balance/mini-statement', [

                'headers' => $headers,
                'json' => [
                    'account_number'=> $request->account_number,
                    'start_date'    =>  date('d-m-Y', strtotime($request->start_date)),
                    'end_date'      =>  date('d-m-Y', strtotime($request->end_date)),

                ]
            ]);


             $responses = $result->getBody()->getContents();
            return view('multiple.display_statement')->with('response', json_decode($responses)->account_balance_list);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                session()->flash('notification', 'Statement could not be generated. Please provide valid details');
                return view('multiple.statement');
            }

            session()->flash('notification', 'Statement could not be generated. Please provide valid details');
            return view('multiple.statement');
        }

    }


    public  function preauth(Request $request){

        $mobile_user_id = MobilesUsers::where('mobile',$request->mobile)->first();
        if(!isset($mobile_user_id)){
            session()->flash('notification', 'Mobile number not found.');
            return view('multiple.search');
        }

        session()->flash('name', $mobile_user_id->name);
        $results = ClientAccounts::where('user_id',$mobile_user_id->id)->get();

        return view('multiple.display')->with('records',$results);


    }

    public function remove (Request $request){
        $results = ClientAccounts::find($request->id);


        Logs::create([
            'description'   => "Removed client account".$results->account_id,
            'user'          => Auth::user()->id,

        ]);

        ClientAccounts::destroy($request->id);

        session()->flash('notification', 'Account successfully removed..');
        return view('multiple.search');
    }


    public function add (Request $request){

        session()->flash('user_id', $request->id);
        return view('multiple.link');

    }

    public function add_account (Request $request){

        $results = ClientAccounts::find($request->id);

        ClientAccounts::create([
            'account_id'    => $request->mobile,
            'account_type'  => $request->channel,
            'user_id'       => $request->user_id,
        ]);

        Logs::create([
            'description'   => "Added an account:".$request->account_id,
            'user'          => Auth::user()->id,

        ]);


        session()->flash('notification', 'Account successfully added.');
        return view('multiple.search');

    }


}
