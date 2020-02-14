<?php

namespace App\Http\Controllers;

use App\BulkDisbursement;
use App\Services\AccountInformationService;
use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class WalletDisbursementController extends Controller
{

    public  function download(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
       return  $contents = Storage::get('sample.csv');

    }
    public function display()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {
            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL') . '/api/disburse/all', [
                'auth' => [env('TXN_USER'), env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);

            $rec = $result->getBody()->getContents();
            return view('disburse.display')->with('records', json_decode($rec));

        } catch (ClientException $e) {
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('disburse.display');
        }
    }

    public function cancel()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {
            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL') . '/api/disburse/cancel', [
                'auth' => [env('TXN_USER'), env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);

            $rec = $result->getBody()->getContents();
            return redirect('/disburse/display');

        } catch (ClientException $e) {
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('disburse.display');
        }
    }

    public function reports()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {
            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL') . '/api/disburse/reports', [
                'auth' => [env('TXN_USER'), env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);

            $rec = $result->getBody()->getContents();
            return view('disburse.reports')->with('records', json_decode($rec));

        } catch (ClientException $e) {
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('disburse.reports');
        }
    }

    public function createview()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        return view('disburse.create');

    }

    public function create(Request $request)
    {

        set_time_limit(1000000);
        $fp = file($request->csvfile);
        $number_of_rows = count($fp);

        if ($number_of_rows > 50) {
            session()->flash('error', 'CSV File is too big, number of rows should not exceed 50');
            return redirect()->back();
        }


        //open the csv file
        $read = fopen($request->csvfile, "r");
        while (($fileopen = fgetcsv($read, 1000, ",")) !== false) {

            if(!isset($fileopen[0])){
            return redirect('disburse/display');
            }

            try {

                $client = new Client();
                $result = $client->post(env('TXN_MNG_BASE_URL') . '/api/bulk_upload', [
                    'auth' => [env('TXN_USER'), env('TXN_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' =>[
                        'source_account'        => $fileopen[0],
                        'destination_account'  => $fileopen[1],
                        'amount'                => $fileopen[2],
                        'initiator'             => Auth::user()->id,
                        'transaction_reference' => $fileopen[3],
                    ],
                ]);

                $rec = $result->getBody()->getContents();



            } catch (\ErrorException $e) {
                //return $e;
                session()->flash('error', 'Please Contact System administrator for assistance');
                return view('disburse.create');
            }


        }

        return redirect('disburse/display');

    }

    public function disburse (Request $request){

        try {

            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL') . '/api/disburse', [
                'auth' => [env('TXN_USER'), env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' =>[
                    'validator'        => Auth::user()->id,

                ],
            ]);


              $rec = json_decode($result->getBody()->getContents());

              if($rec->code != '000'){
                  session()->flash('error', $rec->description);
                  return redirect('/disburse/display');
              }


            return redirect('/disburse/display');


        } catch (\ErrorException $e) {

           return $e;
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('disburse.create');
        }
    }

}
