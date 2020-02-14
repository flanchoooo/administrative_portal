<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;


class MerchantAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */






        public function lookup(Request $request)
    {


       // $prefix = '156535'. $time_stamp = Carbon::now()->format('ymdhis');

       // return strlen('156535885112951140');
        AuthService::getAuth(Auth::user()->role_permissions_id, 'add_account');
        try {


            $sec = 'Bearer ';


            $c = new Client();
            $r = $c->post(env('BR_BASE_URL').'/api/customers', [

                'headers' => ['Authorization' => $sec, 'Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->account_number,
                ]
            ]);

              $search_result =  $r->getBody()->getContents();
            $details = json_decode($search_result);
            session()->flash('client_name',$details->ds_account_customer->client_name);
            session()->flash('account_id',$details->ds_account_customer->account_id);
            session()->flash('branch_name',$details->ds_account_customer->branch_name);
            session()->flash('email_id',$details->ds_account_customer->email_id);
            session()->flash('acstatus',$details->ds_account_customer->acstatus);
            session()->flash('mobile',$details->ds_account_customer->mobile);
            session()->flash('id',$request->id);

            if($details->code === '00'){


                return view('merchantaccount.lookup');

            }
            else{

                return redirect('/merchantaccount/display');
            }

        }
        catch (ClientException $e){

            session()->flash('error','Invalid Account');
            return view('merchantaccount.create');

        }


    }





    public function index(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'add_account');
        session()->flash('id', $request->id);
        session()->flash('name', $request->name);
        return view('merchantaccount.create');

    }

    public function update_view(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_merchant_acc');
    session()->flash('account_number', $request->account_number);
    session()->flash('id', $request->id);
    return view('merchantaccount.update');

    }



    public function all(Request $request)
    {



      /* AuthService::getAuth
        (
            Auth::user()->id,
            'merchant_acc_management'

        );

      */



        try {



            $client = new Client();
            $result = $client->get(env('BASE_URL').'/merchantaccount/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result->getBody()->getContents();
            return view('merchantaccount.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('merchantaccount.display');

        }

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'merchant_acc_management');
        try {


            $client = new Client();
            $result = $client->post(env('BASE_URL').'/merchantaccount/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'account_number' => $request->account_number,
                    'merchant_id' => $request->id,
                    'created_by' => $request->created_by,
                ],
            ]);


            //$rec =  $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code != "00"){

                session()->flash('error', $rec->description);
                return view('merchantaccount.create');


            }

            return redirect('/merchantaccount/display');

        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('merchantaccount.create');

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

        AuthService::getAuth(Auth::user()->role_permissions_id, 'edit_merchant');
        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/merchantaccount/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->account_number,
                    'merchant_id' => $request->id,
                    'updated_by' => $request->updated_by,
                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code != "00"){
                session()->flash('error', $rec->description);
                return view('merchantaccount.update');

            }


            return redirect('/merchantaccount/display');

        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('merchantaccount.update');

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



        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_merchant_acc');

        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/merchantaccount/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,
                    'merchant_id' => $request->merchant_id,
                    'updated_by' => $request->updated_by,
                ],

            ]);


            $result1 = $client->get(env('BASE_URL').'/merchantaccount/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result1->getBody()->getContents();
            return view('merchantaccount.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('merchantaccount.display');

        }

    }
}
