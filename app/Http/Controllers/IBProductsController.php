<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IBProductsController extends Controller
{
    public function display()

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/products/all', [
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('internet_products.display')->with('records', json_decode($rec));
        }
        catch (ClientException $e){
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_products.display');
        }

    }

    public function createview(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        return view('internet_products.create');

    }

    public function create(Request $request)
    {
        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/products/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'name' => $request->name,
                    'state' => (int)$request->state,
                ],
            ]);
           //return $result->getBody()->getContents();
             $rec =  json_decode($result->getBody()->getContents());

            if($rec->code != '00'){
                session()->flash('error', $rec->description);
                return view('internet_products.create');
            }
            session()->flash('success', $rec->description);
            return view('internet_products.create');

        }
        catch (ClientException $exception){
            return $exception;
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_products.create');
        }

    }

    public function editview(Request $request)
    {
         AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
         session()->flash('name' ,$request->name);
         session()->flash('id' ,$request->id);
         session()->flash('status' ,$request->status);

         return view('internet_products.update');

    }


    public function edit(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/products/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'updated_by' => $request->created_by,
                    'name' => $request->name,
                    'state' => (int)$request->state,
                    'id' => $request->id,
                ],
            ]);
            //return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code != '00'){
                session()->flash('error', $rec->description);
                return view('internet_products.update');
            }
            session()->flash('success', $rec->description);
            return view('internet_products.update');

        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_products.update');
        }

    }

    public function delete(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/products/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'name' => $request->name,
                    'state' => (int)$request->state,
                    'id' => $request->id,
                ],
            ]);

           //return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());


            if( $rec->code != '00'){
                session()->flash('error', $rec->description);
                return view('internet_products.update');
            }

            return redirect()->back();

        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet_products.update');
        }

    }
}
