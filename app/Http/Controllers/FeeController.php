<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class FeeController extends Controller
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

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/fee/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

             $records =  $result->getBody()->getContents();
            return view('fee.display')->with('records' , json_decode($records));


        }
        catch (\Exception $e){

            return  $e;
            return view('fee.display');

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {


            //API Key

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/fee/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'cashback_fee_type'         => $request->cashback_fee_type,
                    'cash_back_fee'             => $request->cash_back_fee,
                    'zimswitch_fee_type'        => $request->zimswitch_fee_type,
                    'interchange_fee'           => $request->interchange_fee,
                    'interchange_fee_type'      => $request->interchange_fee_type,
                    'acquirer_fee_type'         => $request->acquirer_fee_type,
                    'acquirer_fee'              => $request->acquirer_fee,
                    'zimswitch_fee'             => $request->zimswitch_fee,
                    'tax_type'                  => $request->tax_type,
                    'fee_type'                  => $request->fee_type,
                    'tax'                       => $request->tax,
                    'fee'                       => $request->fee,
                    'minimum_daily'             => $request->minimum_daily,
                    'maximum_daily'             => $request->maximum_daily,
                    'max_daily_limit'           => $request->max_daily_limit,
                    'transaction_type_id'       => $request->transaction_type_id,
                    'card_type_id'              => $request->card_type_id,
                    'created_by'                => $request->created_by,
                    'transaction_count'         => $request->transaction_count,
                    'minimum_balance'           => $request->minimum_balance,
                    'type'                      => $request->type,
                    'agent_fee_type'            => 'PERCENTAGE',
                    'biller_discount'           => $request->biller_discount,
                    'agent_fee'                 => $request->agent_fee,


                ],
            ]);


          //  return $rec =  $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){

                $client = new Client();
                $result = $client->get(env('BASE_URL').'/fee/all', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);

                $records =  $result->getBody()->getContents();
                return view('fee.display')->with('records' , json_decode($records));

            }else{
                session()->flash('error', $rec->description);
                return view('fee.create');
            }


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('fee.create');

        }



    }


    public function createview()

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {


            $client_card = new Client();
            $result_card = $client_card->get(env('BASE_URL').'/card/manufacture/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);




            $client_txn = new Client();
            $result_txn = $client_txn->get(env('BASE_URL').'/product/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result_card->getBody()->getContents();
            $records_txn =  $result_txn->getBody()->getContents();




             return view('fee.create')->with('records' , json_decode($records))
                                            ->with('transactions' , json_decode($records_txn));


        }
        catch (ClientException $e){

            return 'Error';


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
    public function update(Request $request)
    {

        // return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/fee/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'updated_by'            => $request->created_by,
                    'id'                    => $request->id,
                    'cashback_fee_type'     => $request->cashback_fee_type,
                    'cash_back_fee'         => $request->cash_back_fee,
                    'zimswitch_fee_type'    => $request->zimswitch_fee_type,
                    'interchange_fee'       => $request->interchange_fee,
                    'interchange_fee_type'  => $request->interchange_fee_type,
                    'acquirer_fee_type'     => $request->acquirer_fee_type,
                    'acquirer_fee'          => $request->acquirer_fee,
                    'zimswitch_fee'         => $request->zimswitch_fee,
                    'tax_type'              => $request->tax_type,
                    'fee_type'              => $request->fee_type,
                    'tax'                   => $request->tax,
                    'fee'                   => $request->fee,
                    'minimum_daily'         => $request->minimum_daily,
                    'max_daily_limit'       => $request->max_daily_limit,
                    'maximum_daily'         => $request->maximum_daily,
                    'transaction_type_id'   => $request->transaction_type_id,
                    'card_type_id'          => $request->card_type_id,
                    'transaction_count'     => $request->transaction_count,
                    'minimum_balance'       => $request->minimum_balance,
                    'type'                  => $request->type,
                    'agent_fee_type'        => 'PERCENTAGE',
                    'biller_discount'       => $request->biller_discount,
                    'agent_fee'             => $request->agent_fee,



                ],
            ]);


            //$rec =  $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){
                $client = new Client();
                $result = $client->get(env('BASE_URL').'/fee/all', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);

                $records =  $result->getBody()->getContents();
                return view('fee.display')->with('records' , json_decode($records));

            }else{
                //session()->flash('error', $rec->description);
                //return view('fee.create');
            }


        }
        catch (ClientException $e){

           // session()->flash('error', 'Please Contact System administrator for assistance');
            return 'Error';

        }




    }

    public function updateview(Request $request )
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        session()->flash('id', $request->id);
        session()->flash('fee', $request->fee);
        session()->flash('tax', $request->tax);
        session()->flash('minimum_daily', $request->minimum_daily);
        session()->flash('maximum_daily', $request->maximum_daily);
        session()->flash('max_daily_limit', $request->max_daily_limit);
        session()->flash('zimswitch_fee', $request->zimswitch_fee);
        session()->flash('interchange_fee', $request->interchange_fee);
        session()->flash('acquirer_fee', $request->acquirer_fee);
        session()->flash('cash_back_fee', $request->cash_back_fee);
        session()->flash('transaction_type_id', $request->transaction_type_id);
        session()->flash('transaction_count', $request->transaction_count);
        session()->flash('fee', $request->fee);
        session()->flash('fee_type', $request->fee_type);
        session()->flash('minimum_balance', $request->minimum_balance);
        session()->flash('type', $request->type);
        session()->flash('biller_discount', $request->biller_discount);
        session()->flash('cashback_fee_type', $request->cashback_fee_type);
        session()->flash('zimswitch_fee_type', $request->zimswitch_fee_type);
        session()->flash('interchange_fee_type', $request->interchange_fee_type);
        session()->flash('acquirer_fee_type', $request->acquirer_fee_type);
        session()->flash('tax_type', $request->tax_type);
        session()->flash('fee_type', $request->fee_type);
        session()->flash('agent_fee_type', $request->agent_fee_type);
        session()->flash('agent_fee', $request->agent_fee);


        try {




            $client_card = new Client();
            $result_card = $client_card->get(env('BASE_URL').'/card/manufacture/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);




            $client_txn = new Client();
            $result_txn = $client_txn->get(env('BASE_URL').'/product/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result_card->getBody()->getContents();
            $records_txn =  $result_txn->getBody()->getContents();




            return view('fee.update')->with('records' , json_decode($records))
                                             ->with('transactions' , json_decode($records_txn));


        }
        catch (ClientException $e){

            return 'Error';


        }


        return view('fee.update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {



            //API Key

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/fee/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'created_by' => $request->created_by,
                ],
            ]);




            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/fee/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $records_r =  $result_r->getBody()->getContents();
            return view('fee.display')->with('records' , json_decode($records_r));

        }
        catch (ClientException $e){


            return view('fee.display');

        }

    }
}
