<?php

namespace App\Http\Controllers;

use App\Check;
use App\Http\Middleware\CheckRole;
use App\Services\TokenService;
use App\Token;
use App\WA;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;


class AccountManagerController extends Controller
{



    public function reject(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_auth');

        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/account/reject', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' => $request->id,
                    'created_by' => $request->created_by,

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {


                $result = $client->get(env('BASE_URL').'/account/auth', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);

                $records =  $result->getBody()->getContents();
                return view('accountmanagement.display')->with('records' , json_decode($records));

            }


        } catch (ClientException $e) {


            $result = $client->get(env('BASE_URL').'/account/auth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result->getBody()->getContents();
            return view('accountmanagement.display')->with('records' , json_decode($records));

        }
    }

    public function decommission(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'delete_card');
        return view('accountmanagement.decommission');
    }

    public function unlink(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'delete_card');
        return view('accountmanagement.unlink');
    }


    public function decommissions(Request $request){
       // return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'delete_card');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/account/decommission', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'card' => $request->card_number,
                    'unlink' => $request->unlink,

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {
                session()->flash('de_success', $rec->description);

                return view('accountmanagement.decommission');

            }else{

                session()->flash('de_error', $rec->description);
                return view('accountmanagement.decommission');
            }


        } catch (ClientException $e) {

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('accountmanagement.decommission');

        }



    }

    public function unlinks(Request $request){
        // return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'delete_card');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/account/decommission', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'card' => $request->card_number,
                    'unlink' => 'true'

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {
                session()->flash('de_success', $rec->description);

                return view('accountmanagement.unlink');

            }else{

                session()->flash('de_error', $rec->description);
                return view('accountmanagement.unlink');
            }


        } catch (ClientException $e) {

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('accountmanagement.unlink');

        }



    }

    public function activate(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_auth');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/account/activate', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'updated_by' => $request->updated_by,
                    'id' => $request->id,

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {


                $result = $client->get(env('BASE_URL').'/account/auth', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],

                ]);

                $records =  $result->getBody()->getContents();
                return view('accountmanagement.display')->with('records' , json_decode($records));

            }


        } catch (ClientException $e) {

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('accountmanagement.update');

        }

    }

    public function updateview(Request $request){

         //AuthService::getAuth(Auth::user()->id, 'card_auth');

        //return $request->all();
        session()->flash('id', $request->id);
        session()->flash('account', $request->account);
        session()->flash('card', $request->card);

        return view('accountmanagement.update');

    }


    public function display ()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_auth');

        try {



            $client = new Client();
            $result = $client->get(env('BASE_URL').'/account/auth', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

             $records =  $result->getBody()->getContents();
            return view('accountmanagement.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('accountmanagement.display');

        }


    }


    public function status()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'change_status');
        return view('accountmanagement.status');

    }


    public function index()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_initiation');
        return view('accountmanagement.link');

    }

    public function create(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_initiation');
        $res_ = substr($request->account_number, 0, 3);

        if($res_ == '263'){
            $mobile = WA::where('mobile',$request->account_number)->first();
            if(!isset($mobile)){
                return view('accountmanagement.link')->with('notification', 'Mobile not found.');
            }

            $card = Token::where('track_1',$request->card_number)->first();
            if(!isset($card)){
                return view('accountmanagement.link')->with('notification', 'Card not found.');
            }

            if(isset($card->account_number)){
                return view('accountmanagement.link')->with('notification', 'Account is already linked');
            }

            $card->account_number = $request->account_number;
            $card->version = 0;
            $card->state = 2;
            $card->status = 'BLOCKED';
            $card->save();
            $card->wallet_id = $mobile->id;
            $card->save();
            $success_notification = 'Card successfully linked';
            return view('accountmanagement.link')->with('success_notification', $success_notification);


        }

        $card = Token::where('track_1',$request->card_number)->first();
        if(!isset($card)){
            return view('accountmanagement.link')->with('notification', 'Card not found.');
        }


        if(isset($card->account_number)){
            return view('accountmanagement.link')->with('notification', 'Account is already linked');
        }

        $card->account_number = $request->account_number;
        $card->version = 0;
        $card->state = 2;
        $card->status = 'BLOCKED';
        $card->save();
        $success_notification = 'Card successfully linked';
        return view('accountmanagement.link')->with('success_notification', $success_notification);

        }




    public function info(Request $request)

    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_initiation');
         return view('accountmanagement.info');
    }


    public function show(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'card_initiation');

        $resultz = Check::where('account_number',$request->account_number)->get()->count();
        if($resultz != 0){
            $notification = 'Account number already linked to a card profile.';
            return view('accountmanagement.link')->with('notification', $notification);
        }

         $result = substr($request->account_number, 0, 3);

       if($result == '263'){


           try {

               $client = new Client();
               $result = $client->post(env('BASE_URL').'/wallet/preauth', [

                   'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                   'headers' => ['Content-type' => 'application/json',],
                   'json' => [
                       'mobile' => $request->account_number,

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

                   return view('accountmanagement.wallet_info');


               }

               if ($details->code != '00') {

                   $notification = $details->description;
                   //session()->flash('link_error', $details->description);
                   return view('accountmanagement.link')->with('notification', $notification);
               }

           }
           catch (ClientException $e){

               $notification = 'Please Contact System administrator for assistance';
               return view('accountmanagement.link')->with('notification', $notification);

           }


       }


       else {

           //return $request->all();

           try {

               $client = new Client();
               $result = $client->post(env('BASE_URL') . '/account/search_admin', [

                   'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                   'headers' => ['Content-type' => 'application/json',],
                   'json' => [
                       'account_number' => $request->account_number,

                   ],
               ]);

               //return $rec = $result->getBody()->getContents();
               $rec = json_decode($result->getBody()->getContents());

               if ($rec->code === "00") {


                   try {



                       $sec = 'Bearer';


                       $c = new Client();
                       $r = $c->post(env('BR_BASE_URL') . '/api/customers', [

                           'headers' => ['Authorization' => $sec, 'Content-type' => 'application/json',],
                           'json' => [
                               'account_number' => $request->account_number,
                           ]
                       ]);

                       $search_result = $r->getBody()->getContents();
                       $details = json_decode($search_result);
                       session()->flash('client_name', $details->ds_account_customer->client_name);
                       session()->flash('account_id', $details->ds_account_customer->account_id);
                       session()->flash('branch_name', $details->ds_account_customer->branch_name);
                       session()->flash('email_id', $details->ds_account_customer->email_id);
                       session()->flash('acstatus', $details->ds_account_customer->acstatus);
                       session()->flash('mobile', $details->ds_account_customer->mobile);

                       if ($details->code === '00') {


                           return view('accountmanagement.info');

                       } else {

                           $notification = 'Please Contact System administrator for assistance';
                           return view('accountmanagement.link')->with('notification', $notification);
                       }

                   } catch (ClientException $e) {

                       $notification = 'Invalid Account';
                       return view('accountmanagement.link')->with('notification', $notification);



                   }


               } else {

                   $notification = $rec->description;
                   return view('accountmanagement.link')->with('notification', $notification);
               }


           } catch (ClientException $e) {

               $notification =  'Please Contact System administrator for assistance';
               return view('accountmanagement.link')->with('notification', $notification);

           }

       }








    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function status_info(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'change_status');


        try{
        $client = new Client();
        $result = $client->post(env('BASE_URL') . '/account/preauth', [

            'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
            'headers' => ['Content-type' => 'application/json',],
            'json' => [
                'account_number' => $request->account_number,

            ],
        ]);

     //return$result = $result->getBody()->getContents();
        $rec = json_decode($result->getBody()->getContents());
        if($rec->code != '00'){
            session()->flash('notification', 'Invalid card profile details');
            return view('accountmanagement.status');
        }

        return view('accountmanagement.status_info', array('records'=> $rec->data));

        } catch (ClientException $e){


            session()->flash('status_error', 'Please Contact System administrator for assistance');
            return view('accountmanagement.status');

        }


    }

    public function change(Request $request)
    {


       //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'change_status');

        try {


            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/account/block/web', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'updated_by'        => $request->created_by,
                    'state'             => $request->status,
                    'reason'            => $request->reason,
                    'card_number'       => $request->card_number,
                    'pin_tries'         => '0',
                    'status'            => $request->status,
                ],
            ]);


          // return $rec = $result->getBody()->getContents();
           $rec = json_decode($result->getBody()->getContents());

            if($rec->code === '00'){

                session()->flash('notification','Card profile successfully updated.');
                return view('accountmanagement.status');
            }


        }catch (RequestException $requestException){


           // return $requestException;
            $notifications = 'Please Contact System administrator for assistance';
            return view('accountmanagement.status')->with('notification', $notifications);

        }



    }



}
