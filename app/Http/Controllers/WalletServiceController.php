<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class WalletServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wallet.link');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        //return  $request->all();

        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->mobile,

                ],
            ]);


            //return $rec =  $result->getBody()->getContents();
            $details =  json_decode($result->getBody()->getContents());


            if ($details->code == '00') {

                session()->flash('mobile', $details->account_details->mobile);
                session()->flash('first_name', $details->account_details->first_name);
                session()->flash('last_name', $details->account_details->last_name);
                session()->flash('state', $details->account_details->state);
                session()->flash('balance', $details->account_details->balance);

                return view('wallet.info');


            }

            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet.link')->with('notification', $notification);
            }

        }
        catch (ClientException $e){

           $notification = 'Please Contact System administrator for assistance';
            return view('wallet.link')->with('notification', $notification);

        }








    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function link_card(Request $request)
    {

        //return $request->all();


        try {





            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->mobile,

                ],
            ]);



            //return $rec =  $result->getBody()->getContents();
            $details =  json_decode($result->getBody()->getContents());


            if ($details->code == '00') {


                session()->flash('mobile', $details->account_details->mobile);
                session()->flash('first_name', $details->account_details->first_name);
                session()->flash('last_name', $details->account_details->last_name);
                session()->flash('state', $details->account_details->state);
                session()->flash('balance', $details->account_details->balance);

                return view('wallet.info');


            }


            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet.link')->with('notification', $notification);
            }

        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet.link')->with('notification', $notification);

        }







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
