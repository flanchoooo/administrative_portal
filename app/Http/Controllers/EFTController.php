<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EFTController extends Controller
{
    public function status (){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        $client = new Client();
        try {
            $results = $client->get(env('EFT_SWITCH') . '/gateway-status/', [


            ]);

            $resu = $results->getBody()->getContents();
            $rec = json_decode($resu);



            $dts = $rec->data->last_refresh;
            $time = substr($dts,0,10);
            $date = new DateTime('@'. $time);
            $dt =  $date->format('Y-m-d H:i:s');

            if($rec->data->login_busy == false){
                $login =  'FALSE';
            }else{
                $login = 'TRUE';
            }

            if($rec->data->signed_on == false){
                $signed_on =  'FALSE';
            }else{
                $signed_on = 'TRUE';
            }

            if($rec->data->signing_in == false){
                $in =  'FALSE';
            }else{
                $in = 'TRUE';
            }

            if($rec->data->wait_for_key_exchange == false){
                $key =  'FALSE';
            }else{
                $key = 'TRUE';
            }


            session()->flash('signing_in_tries', $rec->data->signing_in_tries);
            session()->flash('login_busy', $login);
            session()->flash('signed_on', $signed_on);
            session()->flash('signing_in',$in);
            session()->flash('wait_for_key_exchange', $key);
            session()->flash('failed_echo_count', $rec->data->failed_echo_count);
            session()->flash('last_refresh', $dt);
            return view('eft.dashboard');

        } catch (RequestException  $requestException) {
            session()->flash('error', 'Failed to create teller account please contact system administrator');
            return view('eft.dashboard');

        }

    }

    public function restart_view (){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        $client = new Client();
        try {
            $results = $client->get(env('EFT_SWITCH') . '/gateway-status/', [


            ]);

            $resu = $results->getBody()->getContents();
            $rec = json_decode($resu);


            if($rec->data->login_busy == false){
                $login =  'FALSE';
            }else{
                $login = 'TRUE';
            }

            if($rec->data->signed_on == false){
                $signed_on =  'FALSE';
            }else{
                $signed_on = 'TRUE';
            }

            if($rec->data->signing_in == false){
                $in =  'FALSE';
            }else{
                $in = 'TRUE';
            }

            if($rec->data->wait_for_key_exchange == false){
                $key =  'FALSE';
            }else{
                $key = 'TRUE';
            }


            session()->flash('signing_in_tries', $rec->data->signing_in_tries);
            session()->flash('login_busy', $login);
            session()->flash('signed_on', $signed_on);
            session()->flash('signing_in',$in);
            session()->flash('wait_for_key_exchange', $key);
            session()->flash('failed_echo_count', $rec->data->failed_echo_count);
            session()->flash('last_refresh', $rec->data->last_refresh);
            return view('eft.gateway');

        } catch (RequestException  $requestException) {
            session()->flash('error', 'Failed to create teller account please contact system administrator');
            return view('eft.gateway');

        }

    }

    public function restart (Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        $client = new Client();
        try {
            $results = $client->post(env('EFT_SWITCH') . '/gateway-status/update', [
                'headers' => [
                    'Content-type' => 'application/json',
                    'FROM' => 'SECUREPAY_GATEWAY',
                    ],
                'json' => [
                    'failed_echo_count'     => 0,
                    'login_busy'            => false,
                    'signed_on'             => false,
                    'signing_in'            => false,
                    'wait_for_key_exchange' => false,
                    'signing_in_tries'      => 0,

                ],

            ]);

             $resu = $results->getBody()->getContents();
            $rec = json_decode($resu);

            if($rec->code != '00'){
                session()->flash('error', 'Failed to restart the gateway please contact support');
                return view('eft.gateway');
            }

            session()->flash('error', 'Gateway successfully restarted');
            return view('eft.gateway');

        } catch (RequestException  $requestException) {
            session()->flash('error', 'Failed to create teller account please contact system administrator');
            return view('eft.gateway');

        }

    }

    public function incoming (Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        return view('eft.transactions');

    }

    public function search(Request $request){
      //  return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        $client = new Client();
        try {
            $results = $client->post(env('EFT_SWITCH') . '/gateway-requests/search', [
                'headers' => [
                    'Content-type' => 'application/json',
                    'FROM' => 'SECUREPAY_GATEWAY',
                ],
                'json' => [
                    'from_date'            => $request->start_date,
                    'to_date'              => $request->end_date,


                ],

            ]);

            $resu = $results->getBody()->getContents();
            $e = json_decode($resu);

            return view('eft.display', array('records'=> $e->data));

        } catch (RequestException  $requestException) {
            session()->flash('error', 'Failed to create teller account please contact system administrator');
            return view('eft.transactions');

        }
    }

    public function view(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        session()->flash('card_number', $request->card_number);
        session()->flash('transaction_type', $request->transaction_type);
        session()->flash('trace_number', $request->trace_number);
        session()->flash('amount', $request->amount);
        session()->flash('rrn', $request->rrn);
        session()->flash('response_code', $request->response_code);
        session()->flash('account_number', $request->account_number);
        session()->flash('acquirer_bank', $request->acquirer_bank);
        session()->flash('acquirer_bin', $request->acquirer_bin);
        session()->flash('br_reference', $request->br_reference);
        session()->flash('narration', $request->narration);
        session()->flash('mode', $request->mode);

        return view('eft.view');
    }


}
