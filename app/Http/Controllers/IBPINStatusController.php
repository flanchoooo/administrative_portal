<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class IBPINStatusController extends Controller
{
    public function search()
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_change_status');
        return view('internet.search');
    }

    public function preauth(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_change_status');


        if ($request->channel == 'MOBILE') {

            if (filter_var($request->mobile, FILTER_VALIDATE_EMAIL)) {
                session()->flash('notification', 'Please provide a valid mobile');
                return view('internet.search');
            }

            try {
                $client = new Client();
                $result = $client->post(env('BASE_URL') . '/internet/mobile', [
                    'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'mobile' => $request->mobile,
                    ],
                ]);

                $rec = json_decode($result->getBody()->getContents());;
                if ($rec->code == '01') {
                    session()->flash('notification', 'Mobile not found.');
                    return view('internet.search');

                }

                session()->flash('id', $rec->body->id);
                session()->flash('name', $rec->body->name);
                session()->flash('mobile', $rec->body->mobile);
                //session()->flash('id_number', $rec->body->id_number);
                session()->flash('auth_attempts', $rec->body->auth_attempts);
                session()->flash('active', $rec->body->active);
                session()->flash('email', $rec->body->email);
                session()->flash('uuid', $rec->body->uuid);
                session()->flash('account_number', $rec->body->account_number);
                session()->flash('device_name', $rec->body->device_name);

                return view('internet.info');

            } catch (ClientException $e) {
                return abort(404, 'Please contact system administrator for assistance');
            }


        }

        if ($request->channel == 'INTERNET') {

            if (!filter_var($request->mobile, FILTER_VALIDATE_EMAIL)) {
                session()->flash('notification', 'Please provide a valid email.');
                return view('internet.search');
            }


            try {
                $client = new Client();
                $result = $client->post(env('BASE_URL') . '/internet/internet', [
                    'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'email' => $request->mobile,
                    ],
                ]);


                $rec = json_decode($result->getBody()->getContents());;
                if ($rec->code == '01') {
                    session()->flash('notification', 'Email not found.');
                    return view('internet.search');

                }

                session()->flash('id', $rec->body->id);
                session()->flash('name', $rec->body->name);
                session()->flash('mobile', $rec->body->mobile);
                session()->flash('auth_attempts', $rec->body->auth_attempts);
                session()->flash('email', $rec->body->email);
                session()->flash('account_number', $rec->body->account_number);
                session()->flash('active', $rec->body->status);


                return view('internet.internet_info');

            } catch (ClientException $e) {
                return abort(404, 'Please contact system administrator for assistance');
            }

        }

    }

    public function update(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_change_status');

        if (!filter_var($request->active, FILTER_VALIDATE_EMAIL)) {

            if ($request->active == '1') {
                try {
                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/mobile/update', [
                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'updated_by' => $request->updated_by,
                            'id' => $request->id,
                            'name' => $request->name,
                            'mobile' => $request->mobile,
                            'email' => $request->email,
                            'active' => (int)$request->active,
                            'uuid' => '',
                            'device_name' => '',
                            'auth_attempts' => 0,
                            'account_number' => $request->account_number,
                        ],

                    ]);

                    $rec = json_decode($result->getBody()->getContents());;
                    if ($rec->code == '00') {
                        session()->flash('notification', 'Profile successfully updated.');
                        return view('internet.search');
                    }

                } catch (ClientException $e) {
                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');

                }
            }

            if ($request->active == '0') {

                try {
                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/mobile/update', [
                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'updated_by' => $request->updated_by,
                            'id' => $request->id,
                            'name' => $request->name,
                            'mobile' => $request->mobile,
                            'email' => $request->email,
                            'active' => (int)$request->active,
                            'uuid' => '',
                            'device_name' => '',
                            'auth_attempts' => 0,
                            'account_number' => $request->account_number,
                        ],

                    ]);

                    $rec = json_decode($result->getBody()->getContents());;
                    if ($rec->code == '00') {
                        session()->flash('notification', 'Profile successfully updated.');
                        return view('internet.search');
                    }

                } catch (ClientException $e) {
                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');

                }
            }

            if ($request->active == '4') {

                try {

                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/mobile/delink', [

                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'updated_by' => $request->updated_by,
                            'mobile' => $request->mobile,
                            'channel' => 'MOBILE',
                        ],

                    ]);

                    $rec = json_decode($result->getBody()->getContents());;

                    if ($rec->code != '00') {
                        session()->flash('notification', 'Failed to update profile');
                        return view('internet.search');
                    }

                    session()->flash('notification', 'Profile successfully updated.');
                    return view('internet.search');

                } catch (ClientException $e) {
                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');
                }
            }

            if ($request->active == '3') {

                try {

                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/mobile/reset', [

                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'updated_by' => $request->updated_by,
                            'mobile' => $request->mobile,
                        ],

                    ]);

                  //return  $result->getBody()->getContents();
                    $rec = json_decode($result->getBody()->getContents());;

                    if ($rec->code != '00') {
                        session()->flash('notification', 'Failed to process pin reset request.');
                        return view('internet.search');
                    }

                    session()->flash('notification', 'Profile successfully updated.');
                    return view('internet.search');

                } catch (ClientException $e) {

                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');
                }
            }
        }




    }

    public function internet_updates(Request $request)
        {

         //  return $request->all();
            AuthService::getAuth(Auth::user()->role_permissions_id, 'ib_change_status');



            if ($request->active =='1'){
                try {

                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/internet/update', [
                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'mobile'        => $request->mobile,
                            'name'          => $request->name,
                            'email'         => $request->email,
                            'status'        => (int)$request->active,
                            'times_blocked' => 0,
                            'auth_attempts' => 0,
                            'account_number'=> (string)$request->account_number,
                            'updated_by'    => $request->updated_by,
                            'id'            => $request->id,
                            'user_type_id'  => $request->user_type_id,

                        ],

                    ]);


                    //return $rec = $result->getBody()->getContents();;
                    $rec = json_decode($result->getBody()->getContents());;

                    if ($rec->code == '00') {
                        session()->flash('notification', 'Profile successfully updated.');
                        return view('internet.search');
                    }

                } catch (ClientException $e) {
                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');
                }

            }

            if ($request->active =='0'){
                try {

                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/internet/update', [
                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'mobile'        => $request->mobile,
                            'name'          => $request->name,
                            'email'         => $request->email,
                            'status'        => (int)$request->active,
                            'times_blocked' => 0,
                            'auth_attempts' => 0,
                            'account_number'=> (string)$request->account_number,
                            'updated_by'    => $request->updated_by,
                            'id'            => $request->id,
                            'user_type_id'  => $request->user_type_id,

                        ],

                    ]);


                    //return $rec = $result->getBody()->getContents();;
                    $rec = json_decode($result->getBody()->getContents());;

                    if ($rec->code == '00') {
                        session()->flash('notification', 'Profile successfully updated.');
                        return view('internet.search');
                    }

                } catch (ClientException $e) {
                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');
                }

            }

            if ($request->active =='4') {



                try {

                    $client = new Client();
                    $result = $client->post(env('BASE_URL') . '/internet/mobile/delink', [

                        'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                        'headers' => ['Content-type' => 'application/json',],
                        'json' => [
                            'updated_by' => $request->updated_by,
                            'mobile' => $request->email,
                            'channel' => 'INTERNET',
                        ],

                    ]);

                    $rec = json_decode($result->getBody()->getContents());;

                    if ($rec->code != '00') {
                        session()->flash('notification', 'Failed to de-register account.');
                        return view('internet.search');
                    }

                    session()->flash('notification', 'Profile successfully updated.');
                    return view('internet.search');

                } catch (ClientException $e) {
                    session()->flash('notification', 'Please contact system administrator for assistance');
                    return view('internet.search');
                }
            }


            try {

                $client = new Client();
                $result = $client->post(env('BASE_URL') . '/internet/internet/update', [

                    'auth' => [env('WEB_USER_NAME'), env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'mobile' => $request->updated_by,
                        'name' => $request->name,
                        'email' => $request->email,
                        'status' => (int)$request->active,
                        'times_blocked' => 0,
                        'auth_attempts' => 0,
                        'account_number' => (string)$request->account_number,
                        'updated_by' => $request->updated_by,
                        'id' => $request->id,
                        'user_type_id' => $request->user_type_id,

                    ],

                ]);


                //return $rec = $result->getBody()->getContents();;
                $rec = json_decode($result->getBody()->getContents());;

                if ($rec->code == '00') {
                    session()->flash('notification', 'Profile successfully updated.');
                    return view('internet.search');
                }

            } catch (ClientException $e) {
                session()->flash('notification', 'Please contact system administrator for assistance');
                return view('internet.search');
            }

        }




}
