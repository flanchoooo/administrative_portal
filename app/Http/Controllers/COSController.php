<?php

namespace App\Http\Controllers;

use App\Role_User;
use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class COSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */






    public function index()

    {
        //return  $result =   Role_User::where('id','9')->first();
         AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');


        try {


            //API Key
            $auth = json_decode(TokenService::getToken());

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/cos', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            return view('cos.display')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createview()

    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');

        return view('cos.create');
    }

    public function create(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');


        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/cos/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'cos_name' => $request->cos_name,
                    'sale' => $request->sale,
                    'balance' => $request->balance,
                    'ministatement' => $request->ministatement,
                    'sale_cashback' => $request->sale_cashback,
                    'pin_issue' => $request->pin_issue,
                    'pin_change' => $request->pin_change,
                    'withdrawal' => $request->withdrawal,
                    'reversal' => $request->reversal,
                    'batch' => $request->batch,
                    'settings' => $request->settings,
                    'status' => $request->status,
                    'deposit' => $request->deposit,

                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){

                return redirect('/cos/display');


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


    public function update(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');

       //return $request->all();

        try {



            $client = new Client();
            $result = $client->post(env('BASE_URL').'/cos/update', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id'      => $request->id,
                    'created_by' => $request->created_by,
                    'cos_name' => $request->cos_name,
                    'sale' => $request->sale,
                    'balance' => $request->balance,
                    'ministatement' => $request->ministatement,
                    'sale_cashback' => $request->sale_cashback,
                    'pin_issue' => $request->pin_issue,
                    'pin_change' => $request->pin_change,
                    'withdrawal' => $request->withdrawal,
                    'reversal' => $request->reversal,
                    'batch' => $request->batch,
                    'settings' => $request->settings,
                    'status' => $request->status,
                    'deposit' => $request->deposit,

                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){

                return redirect('/cos/display');


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateview(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');

        try {



            $client = new Client();
            $result = $client->post(env('BASE_URL').'/cos/id', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,

                ],
            ]);


        $rec =  $result->getBody()->getContents();

        return view('cos.update')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');

        }







        return view('cos.update');

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




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/cos/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'created_by' => $request->created_by,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            return redirect('/cos/display');


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');

        }


    }


    public function where_id(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');

        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/cos/id', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'created_by' => $request->created_by,

                ],
            ]);

            //return $rec =  $result->getBody()->getContents();
             $rec =  $result->getBody()->getContents();
            return view('cos.update')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');

        }


    }
}
