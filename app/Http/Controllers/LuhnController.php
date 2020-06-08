<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class LuhnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */



    public function decommissioned()
    {
        try {


            AuthService::getAuth(Auth::user()->role_permissions_id, 'card_production');
            $client = new Client();
            $result = $client->get(env('BASE_URL').'/decommissioned', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);
            $records =  $result->getBody()->getContents();
            return view('luhn.decommissioned')->with('records' , json_decode($records));
        }
        catch (ClientException $e){
            return view('card.decommissioned');

        }

    }


    public function batch(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_production');

        try {


            //API Key
            $auth = json_decode(TokenService::getToken());

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/card/manufacture/whereluhn', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                  'json' => [
                'batch_id' => $request->batch_id,

            ],

            ]);

           $records =  $result->getBody()->getContents();
          return view('luhn.batch')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('luhn.display');

        }

    }


    public function index()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_production');
        try {


            $client = new Client();
            $result = $client->get(env('BASE_URL').'/card/manufacture/allluhncards', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result->getBody()->getContents();
            return view('luhn.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('card.display');

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_production');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/card/manufacture/luhncards', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'prefix' => $request->prefix,
                    'card_type_id' => $request->card_type,
                    'quantity' => $request->quantity,
                    'issue_year' => $request->issue_year,
                    'issue_month' => $request->issue_month,
                    'expiry_year' => $request->expiry_year,
                    'expiry_month' => $request->expiry_month,
                    'expiry_month' => $request->expiry_month,
                    'created_by' => $request->created_by,
                ],
            ]);



            $rec =  json_decode($result->getBody()->getContents());

             if($rec->code === "00"){
                 return redirect('/luhn/display');
             }else{
                 $client = new Client();
                 $result = $client->get(env('BASE_URL').'/card/manufacture/allluhncards', [
                     'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                     'headers' => ['Content-type' => 'application/json',],

                 ]);
                 $records =  $result->getBody()->getContents();
                 return view('luhn.display')->with('records' , json_decode($records));
             }
        }
        catch (\Exception $e){
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('luhn.create');

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
    public function show()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_production');
        try {




            $client = new Client();
            $result = $client->get(env('BASE_URL').'/card/manufacture/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

           $records =  $result->getBody()->getContents();
           return view('luhn.create')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('card.display');

        }





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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_production');

        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/batch/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'created_by' => $request->created_by,
                ],
            ]);




            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/card/manufacture/allluhncards', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $records_r =  $result_r->getBody()->getContents();
            return view('luhn.display')->with('records' , json_decode($records_r));

        }
        catch (ClientException $e){


            return view('luhn.display');

        }



    }
}
