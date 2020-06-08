<?php

namespace App\Http\Controllers;

use App\Role;
use App\Role_User;
use App\Services\AuthService;
use App\Transactions;
use App\TransactionType;
use App\TxnTypes;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/transactions/all',
                [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            return view('transactions.display')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('transactions.display');

        }




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function wallet()
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        return view('transactions.wallet');
    }

    public function display(Request $request)
    {
        try {
            AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
            $credit = Transactions::where('account_credited', $request->mobile)
                ->where('credit_amount', '>', 0)
                ->whereBetween('created_at',array($request->start_date, $request->end_date))
                ->get();

             $debit = Transactions::where('account_debited', $request->mobile)
                ->where('debit_amount', '>', 0)
                ->whereBetween('created_at',array($request->start_date, $request->end_date))
                ->get();

            $total_history = $debit->merge($credit)->sortByDesc('id');
            return view('transactions.display')->with('records',$total_history);
        }catch (\Exception $exception){

            session()->flash('search', 'Failed to process request please contact admin.');
            return redirect()->back();
        }
    }


    public function stats()
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'dashboard');


        try {


            $client = new Client();
            $result = $client->get(env('BASE_URL').'/kazang_balance', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            $balance = json_decode($rec);
            session()->flash('corporates', $balance->corporates);
            session()->flash('mobile_users', $balance->mobile_users);
            session()->flash('web', $balance->web);
            session()->flash('ecocash','ZWL'.' '.$balance->ecocash);
            session()->flash('zesa','ZWL'.' '.$balance->zesa);
            session()->flash('sms','ZWL'.' '.$balance->sms);

            try {




                $client = new Client();
                $result = $client->get(env('BASE_URL').'/statistics', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);


                $rec =  json_decode($result->getBody()->getContents());

                session()->flash('active_devices', $rec->active_devices);
                session()->flash('inactive_devices', $rec->inactive_devices);
                session()->flash('merchants', $rec->merchants);
                session()->flash('number_of_txns', $rec->number_of_txns);
                session()->flash('revenue_to_date', $rec->revenue_to_date);
                session()->flash('active_cards', $rec->active_cards);


                return view('transactions.statistics');


            }
            catch (ClientException $e){


                return view('transactions.statistics');

            }


        }
        catch (RequestException $requestException){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('internet.dashboard');

        }








    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        try {


            //API Key
            // $auth = json_decode(TokenService::getToken());

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/transactions/id',
                [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'id' => $request->id,

                    ],

                ]);


             $rec =  $result->getBody()->getContents();
            return view('transactions.view')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('transactions.display');

        }



    }

    public function wallet_view(Request $request)
    {




        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        try {


            //API Key
            // $auth = json_decode(TokenService::getToken());

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/transactions/wallet/id',
                [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'id' => $request->id,

                    ],

                ]);


             $rec =  $result->getBody()->getContents();
            return view('transactions.wallet_view')->with('records', json_decode($rec));


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('transactions.wallet_view');

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

    public function highcharts()
    {



        try {


            //API Key
            // $auth = json_decode(TokenService::getToken());

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/transactions/chartjs',
                [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);


            $rec =  $result->getBody()->getContents();
            return view('transactions.statistics')->with('records', $rec);


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('transactions.display');

        }




    }

}
