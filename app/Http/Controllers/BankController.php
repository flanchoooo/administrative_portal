<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {


            //API Key
            $auth = json_decode(TokenService::getToken());

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/bank/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            return view('bank.display')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');

        }



    }


    public function createview()

    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        return view('bank.create');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {

      //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
       try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/bank/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'bin' => $request->bin,
                    'name' => $request->name,
                    'status' => $request->state,
                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){

                return redirect('/bank/display');


            }else{
                session()->flash('error', $rec->description);
                return view('bank.create');
            }


        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.create');

        }




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {



            //API Key

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/bank/edit', [
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'bin' => $request->bin,
                    'status' => $request->state,
                    'name' => $request->name,
                    'updated_by' => $request->updated_by,
                ],
            ]);

            $records_r =  json_decode($result->getBody()->getContents());

            if($records_r->code == '00'){

                return redirect('/bank/display');
            }
            else{

            session()->flash('error_bank', 'Failed to Update Profile Contact Admin');
            return view('bank.update');

            }

        }
        catch (ClientException $e){
            //return $e;

            session()->flash('error_bank', 'Failed to Update Profile Contact Admin');
            return view('bank.update');

        }

    }

    public function updateview(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        session()->flash('id', $request->id);
        session()->flash('name', $request->name);
        session()->flash('bin', $request->bin);

       return view('/bank/update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {



            //API Key

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/bank/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'created_by' => $request->created_by,
                ],
            ]);




            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/bank/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $records_r =  $result_r->getBody()->getContents();
            return view('bank.display')->with('records' , json_decode($records_r));

        }
        catch (ClientException $e){


            return view('bank.display');

        }


    }



}
