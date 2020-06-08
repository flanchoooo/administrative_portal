<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;


class CardTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */


    public function update_view (Request $request){


    /*use App\Services\AuthService;
    use Illuminate\Support\Facades\Auth;
        AuthService::getAuth
        (
            Auth::user()->id,
            'merchant_profile'

        );

        */

        AuthService::getAuth
        (
            Auth::user()->role_permissions_id,
            'card_production'

        );


        return view('card.update')->with('id', $id = $request->id)
                                        ->with('name', $name = $request->name);


    }


    public function index()
    {

        AuthService::getAuth
        (
            Auth::user()->role_permissions_id,
            'card_production'

        );


        try {




            $client = new Client();
            $result = $client->get(env('BASE_URL').'/card/manufacture/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

           $records =  $result->getBody()->getContents();
            return view('card.display')->with('records' , json_decode($records));


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

        AuthService::getAuth
        (
            Auth::user()->role_permissions_id,
            'card_production'

        );


        try {


            $client = new Client();
            $result = $client->post(env('BASE_URL').'/card/manufacture/cardtype', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'name' => $request->name,
                    'state' => $request->state,
                    'created_by' => $request->created_by,
                ],
            ]);


            //Return View with records
            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/card/manufacture/all', [
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);

            $records_r =  $result_r->getBody()->getContents();
            return view('card.display')->with('records' , json_decode($records_r));

        }
        catch (ClientException $e){

            session()->flash('error','Failed to create card type please contact admin');
            return view('card.create');

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
        return view('card.create');


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
    public function update(Request $request)

    {
        AuthService::getAuth
        (
            Auth::user()->role_permissions_id,
            'card_production'

        );


        try {


            //API Key

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/card/manufacture/update', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                   'id' => $request->id,
                    'name' => $request->name,
                    'state' => $request->state,
                    'updated_by' => $request->updated_by,
                ],
            ]);




            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/card/manufacture/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $records_r =  $result_r->getBody()->getContents();
            return view('card.display')->with('records' , json_decode($records_r));

        }
        catch (ClientException $e){

            session()->flash('error','Failed to create card type please contact admin');
            return view('card.display');

        }



    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        AuthService::getAuth
        (
            Auth::user()->role_permissions_id,
            'card_production'

        );


        try {



            //API Key

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/card/delete_cardtype', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'created_by' => $request->created_by,
                ],
            ]);




            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/card/manufacture/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $records_r =  $result_r->getBody()->getContents();
            return view('card.display')->with('records' , json_decode($records_r));

        }
        catch (ClientException $e){


            return view('card.display');

        }


    }
}
