<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class WalletCOSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/wallet/listClassOfService', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $rec =  $result->getBody()->getContents();
            return view('wallet_configurations.display')->with('records',json_decode($rec));
        }
        catch (\Exception $e){
            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_cos()
    {
        return view('wallet_configurations.create_cos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_cos_(Request $request)
    {
        //return $request->all();




        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/createClassOfService', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'cos_name' =>$request->cos_name,
                    'minimum_daily' =>$request->min_daily,
                    'maximum_daily' =>$request->max_daily,
                    'minimum_balance' =>$request->min_balance,
                    'maximum_balance' =>$request->max_balance,
                    'minimum_monthly' =>$request->min_monthly,
                    'maximum_monthly' =>$request->max_monthly,
                    'updated_by' =>$request->created_by,


                ],

            ]);


            return redirect('/wallet_configurations/display');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }


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
    public function destroy($id)
    {
        //
    }
}
