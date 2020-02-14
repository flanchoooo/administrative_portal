<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\AuthService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;

class WalletConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_e_value()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        return view('wallet_configurations.create');
    }

    public function search()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        return view('wallet_configurations.search');
    }

    public function wallet_transactions(Request $request)

    {

        //return $request->all();


        AuthService::getAuth(Auth::user()->role_permissions_id, 'reports');
        try {

            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/history_web', [

                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'source_mobile'        => $request->account_number,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);

            if ($details->code != '00') {
                $notification = $details->description;
                return view('wallet_configurations.search')->with('notification', $notification);
            }


            return view('wallet_configurations.transactions')->with('records', $details->account_balance_list);

        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.search')->with('notification', $notification);

        }




    }

    public function register_home()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        return view('wallet_configurations.register');
    }

    public function create_e_value_preauth(Request $request)

    {



        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->destination_mobile,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.create')->with('notification', $notification);
            }




            session()->flash('destination_mobile', $request->destination_mobile);
            session()->flash('amount', $request->amount);
            session()->flash('created_by', $request->created_by);
            session()->flash('last_name',$details->account_details->last_name);
            session()->flash('first_name',$details->account_details->first_name);
            session()->flash('balance',$details->account_details->balance);
            session()->flash('description',$request->description);


            return view('wallet_configurations.preauth');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }



    }


    public function destroy_view()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        return view('wallet_configurations.destroy_view');
    }


    public function update_view(Request $request)
    {
        //return view('wallet_configurations.update_view');

        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/searchClassOfService', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id' => $request->id,

                ],
            ]);


              $rec =  $result->getBody()->getContents();
             $details = json_decode($rec);


            if ($details->code != '00') {

                $notification = 'Please Contact System administrator for assistance';
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.create')->with('notification', $notification);
            }


            session()->flash('cos_name', $details->description->cos_name);
            session()->flash('minimum_daily', $details->description->minimum_daily);
            session()->flash('maximum_daily',  $details->description->maximum_daily);
            session()->flash('minimum_balance', $details->description->minimum_balance);
            session()->flash('maximum_balance', $details->description->maximum_balance);
            session()->flash('minimum_monthly',$details->description->minimum_monthly);
            session()->flash('maximum_monthly', $details->description->maximum_monthly);
            session()->flash('id', $request->id);

            return view('wallet_configurations.update_view');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }

    }


    public function adjustment_view()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        return view('wallet_configurations.adjustment_view');
    }

    public function adjustment_preauth (Request $request)

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        if($request->destination_mobile == $request->source_mobile){

            $notification = 'Invalid transaction request.';
            //session()->flash('link_error', $details->description);
            return view('wallet_configurations.adjustment_view')->with('notification', $notification);

        }


        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->destination_mobile,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);

            if ($details->code != '00') {

                $notification = 'Invalid destination mobile';
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.adjustment_view')->with('notification', $notification);
            }




            $client1 = new Client();
            $result1 = $client1->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->source_mobile,

                ],
            ]);


            $rec1 =  $result1->getBody()->getContents();
            $details1 = json_decode($rec1);

            if ($details1->code != '00') {

                $notification = 'Invalid source mobile';
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.adjustment_view')->with('notification', $notification);
            }




            session()->flash('source_mobile', $details1->account_details->mobile);
            session()->flash('source_amount', $request->amount);
            session()->flash('last_name',$details1->account_details->last_name);
            session()->flash('source_first_name',$details1->account_details->first_name);
            session()->flash('source_balance',$details1->account_details->balance);


            session()->flash('destination_mobile', $details->account_details->mobile);
            session()->flash('source_amount', $request->amount);
            session()->flash('destination_last_name',$details->account_details->last_name);
            session()->flash('destination_first_name',$details->account_details->first_name);
            session()->flash('destination_balance',$details->account_details->balance);
            session()->flash('narration',$request->narration);



            return view('wallet_configurations.adjustment_preauth_view');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)

    {

        //return $request->all();


        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/agent_sign_up', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile'        => $request->mobile,
                    'name'          => $request->name,
                    'national_id'   => $request->national_id,
                    'dob'           => $request->dob,
                    'gender'        => $request->gender,
                    'created_by'    => $request->created_by,
                ],
            ]);


              $rec =  $result->getBody()->getContents();
              $details = json_decode($rec);

            if ($details->code != '00') {
                $notification = $details->description;
                return view('wallet_configurations.register')->with('notification', $notification);
            }

            $notification = $details->description;
            return view('wallet_configurations.register')->with('notification', $notification);

        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }




    }


    public function preauth_d(Request $request)

    {


        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'mobile' => $request->destination_mobile,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.destroy_view')->with('notification', $notification);
            }




            session()->flash('destination_mobile', $request->destination_mobile);
            session()->flash('amount', $request->amount);
            session()->flash('created_by', $request->created_by);
            session()->flash('last_name',$details->account_details->last_name);
            session()->flash('first_name',$details->account_details->first_name);
            session()->flash('balance',$details->account_details->balance);
            session()->flash('description',$request->description);


            return view('wallet_configurations.preauth_d');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.destroy_view')->with('notification', $notification);

        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function value__d(Request $request)
    {
        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        $final_amount = $request->amount * 100;

        try {

            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/destroy_value', [


                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'source_mobile' => $request->destination_mobile,
                    'amount' => $final_amount,
                    'created_by' => $request->created_by,
                    'description' => $request->description,

                ],
            ]);

             $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.destroy_view')->with('notification', $notification);
            }


            $notification = $details->description;
            return view('wallet_configurations.destroy_view')->with('success_notification', $notification);


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.destroy_view')->with('notification', $notification);

        }



    }

    public function value_d(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {

            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/e_value_management', [


                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->destination_mobile,
                    'amount' => $request->amount,
                    'txn_type' => '6',
                    'initiated_by' => $request->created_by,
                    'narration' => 'Destroy E-Value',
                    'state' => '0',
                    'description' => $request->description,

                ],
            ]);

            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.create')->with('notification', $notification);
            }


            return redirect('/wallet_configurations/display_pendings');




        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }



    }

    public function value(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {

            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/e_value_management', [


                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->destination_mobile,
                    'amount' => $request->amount,
                    'txn_type' => '18',
                    'initiated_by' => $request->created_by,
                    'narration' => 'E-Value creation',
                    'state' => '0',
                    'description' => $request->description,

                ],
            ]);

            $rec =  $result->getBody()->getContents();
           $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.create')->with('notification', $notification);
            }


            return redirect('/wallet_configurations/display_pending');




        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }



    }


    public function create_value(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {


            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/create_value', [


                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' => $request->id,
                    'state' => $request->state,
                    'created_by' => $request->updated_by,



                ],
            ]);

            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {


                $notification = $details->description;
                session()->flash('notification', $notification);
                return redirect('/wallet_configurations/display_pending');

            }

            $notification = $details->description;
            session()->flash('success_notification', $notification);
            return redirect('/wallet_configurations/display_pending');




        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.create')->with('notification', $notification);

        }



    }

    public function destroy_value(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {


            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/destroy_value', [


                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' => $request->id,
                    'state' => $request->state,
                    'created_by' => $request->updated_by,



                ],
            ]);

            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {


                $notification = $details->description;
                session()->flash('notification', $notification);
                return redirect('/wallet_configurations/display_pendings');

            }


            $notification = $details->description;
            session()->flash('success_notification', $notification);
            return redirect('/wallet_configurations/display_pendings');




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

    public function update(Request $request)
    {
        //return $request->all();




        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/updateClassOfService', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'wallet_cos_id' =>$request->id,
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

            $rec =  $result->getBody()->getContents();
            return redirect('/wallet_configurations/display');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.display')->with('notification', $notification);

        }


    }


    public function cos_d(Request $request)
    {

        //return $request->all();




        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/wallet/deleteClassOfService', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' =>$request->id,
                    'updated_by' =>$request->updated_by,


                ],

            ]);

            $rec =  $result->getBody()->getContents();
            return redirect('/wallet_configurations/display');


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.display')->with('notification', $notification);

        }


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adjust(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        $final_amount = $request->amount * 100;

        try {

            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/adjustment', [


                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'source_mobile' => $request->source_mobile,
                    'destination_mobile' => $request->destination_mobile,
                    'amount' => $final_amount,
                    'narration' => $request->narration,
                    'created_by' => $request->created_by,

                ],
            ]);


            $rec =  $result->getBody()->getContents();
            $details = json_decode($rec);




            if ($details->code != '00') {

                $notification = $details->description;
                //session()->flash('link_error', $details->description);
                return view('wallet_configurations.adjustment_view')->with('notification', $notification);
            }


            $notification = $details->description;
            return view('wallet_configurations.adjustment_view')->with('success_notification', $notification);


        }
        catch (ClientException $e){

            $notification = 'Please Contact System administrator for assistance';
            return view('wallet_configurations.adjustment_view')->with('notification', $notification);

        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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


    public function display_pending(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {

            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL').'/api/pending_approval', [

                'auth' => [ env('WEB_USER_NAME'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


             $rec =  $result->getBody()->getContents();
            //$rec =  json_decode($result->getBody()->getContents());
            return view('wallet_configurations.display_pending')->with('records', json_decode($rec));


        }
        catch (ClientException $exception){
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('wallet_configurations.display_pending');

        }




    }

    public function display_pendings(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'e_value_checker');
        try {


            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL').'/api/pending_approvals', [

                'auth' => [ env('WEB_USER_NAME'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);


            $rec =  $result->getBody()->getContents();
            //$rec =  json_decode($result->getBody()->getContents());


            return view('wallet_configurations.display_pendings')->with('records', json_decode($rec));


        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('wallet_configurations.display_pendings');

        }




    }


}
