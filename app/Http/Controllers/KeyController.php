<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        $client = new Client();

        $result = $client->get(env('BASE_URL').'/cue/all', [

            'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
            'headers' => ['Content-type' => 'application/json',],

        ]);

        $records =  $result->getBody()->getContents();
        return view('cues.display')->with('records' , json_decode($records));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creates(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/cue/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'name' => $request->name,
                    'value' => $request->value,
                    'lmk_value' => $request->zm,
                    'created_by' => $request->created_by,

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {


                $result = $client->get(env('BASE_URL').'/cue/all', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);

                $records =  $result->getBody()->getContents();
                return view('cues.display')->with('records' , json_decode($records));

            }

        } catch (ClientException $e) {

            session()->flash('key_error', 'Error , contact admin');
            return view('cues.create');

        }







    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function creatview(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        return view('cues.create');
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


        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/cue/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' => $request->id,
                    'created_by' => $request->created_by,

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {


                $result = $client->get(env('BASE_URL').'/cue/all', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);

                $records =  $result->getBody()->getContents();
                return view('cues.display')->with('records' , json_decode($records));

            }

        } catch (ClientException $e) {


            $result = $client->get(env('BASE_URL').'/cue/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result->getBody()->getContents();
            return view('cues.display')->with('records' , json_decode($records));


        }




    }
}
