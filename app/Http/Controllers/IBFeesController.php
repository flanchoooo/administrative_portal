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

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_fees.display');
        }
    }

    public function createview(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/products/all', [
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('internet_fees.create')->with('records', json_decode($rec));
        }
        catch (ClientException $e){
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_fees.display');
        }

    }

    public function create(Request $request)
    {
       //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/fee/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'name'          => $request->txn_type,
                    'fees_type'     => $request->fees_type,
                    'revenue_fee'   => $request->revenue_fee,
                    'maximum_limit' => $request->maximum,
                    'minimum_limit' => $request->minimum,
                    'product_id'    => $request->txn_type,
                    'tax_type'      => $request->tax_type,
                    'tax_fee'       => $request->tax_fee,
                    'created_by'    => $request->created_by,


                ],
            ]);
             //return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());
            if($rec->code != '00'){
                session()->flash('error', $rec->description);
                return view('internet_fees.create');
            }
            session()->flash('success', $rec->description);
            return redirect()->back();

        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_fees.create');
        }

    }

    public function update(Request $request)
    {
          //r//eturn $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/fee/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'name'          => $request->name,
                    'fees_type'     => $request->fees_type,
                    'revenue_fee'   => $request->revenue_fee,
                    'maximum_limit' => $request->maximum_limit,
                    'minimum_limit' => $request->minimum_limit,
                    'product_id'    => $request->product_id,
                    'tax_type'      => $request->tax_type,
                    'tax_fee'       => $request->tax_fee,
                    'updated_by'    => $request->created_by,
                    'id'            => $request->id,

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

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_fees.update');
        }

    }

    public function updateview(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        session()->flash('name', $request->name);
        session()->flash('id', $request->id);
        session()->flash('minimum_limit', $request->minimum_limit);
        session()->flash('maximum_limit', $request->maximum_limit);
        session()->flash('revenue_fee', $request->revenue_fee);
        session()->flash('tax_fee', $request->tax_fee);
        session()->flash('product_id', $request->product_id);
        return view('internet_fees.update');

    }
}
