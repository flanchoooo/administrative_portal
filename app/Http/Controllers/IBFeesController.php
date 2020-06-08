<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IBFeesController extends Controller
{
    public function display(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/fee/all', [
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('internet_fees.display')->with('records', json_decode($rec));
        }
        catch (ClientException $e){
            session()->flash('error', $e->getMessage());
            return view('internet_fees.display');
        }
    }

    public function createview(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/transactions/all', [
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('internet_fees.create')->with('records', json_decode($rec));
        }
        catch (ClientException $e){
            session()->flash('error', $e->getMessage());
            return view('internet_fees.display');
        }

    }

    public function create(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/fee/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'fixed_fee'              => $request->fixed_fee,
                    'percentage_fee'         => $request->percentage_fee,
                    'minimum_amount'         => $request->minimum_amount,
                    'maximum_amount'         => $request->maximum_amount,
                    'tax_fixed'              => $request->tax_fixed,
                    'tax_percentage'         => $request->tax_percentage,
                    'transaction_id'         => $request->transaction_id,
                    '$request->created_by'   => Auth::user()->id,
                ],
            ]);
            $rec =  json_decode($result->getBody()->getContents());
            if($rec->code != '00'){
                session()->flash('error', $rec->description);
                return view('internet_fees.create');
            }
            session()->flash('success', $rec->description);
            return redirect('/internet_fees/display');

        } catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_fees.create');
        }

    }

    public function update(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/fee/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'fixed_fee'              => $request->fixed_fee,
                    'percentage_fee'         => $request->percentage_fee,
                    'minimum_amount'         => $request->minimum_amount,
                    'maximum_amount'         => $request->maximum_amount,
                    'tax_fixed'              => $request->tax_fixed,
                    'tax_percentage'         => $request->tax_percentage,
                    'id'                     => $request->id,
                    'transaction_id'         => $request->transaction_id,
                    '$request->created_by'   => Auth::user()->id,
                ],
            ]);

            $rec =  json_decode($result->getBody()->getContents());
           if ($rec->code != '00'){
               session()->flash('error', $rec->description);
               return view('internet_fee.update');
           }

           return redirect('/internet_fees/display');



        }
        catch (ClientException $exception){
            return$exception;
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_fees.update');
        }

    }

    public function updateview(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        session()->flash('fixed_fee', $request->fixed_fee);
        session()->flash('id', $request->id);
        session()->flash('percentage_fee', $request->percentage_fee);
        session()->flash('minimum_amount', $request->minimum_amount);
        session()->flash('maximum_amount', $request->maximum_amount);
        session()->flash('tax_fixed', $request->tax_fixed);
        session()->flash('tax_percentage', $request->tax_percentage);
        session()->flash('transaction_id', $request->transaction_id);
        return view('internet_fees.update');
    }
}
