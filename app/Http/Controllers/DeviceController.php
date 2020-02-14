<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_view(Request $request){

        //AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
      //  session()->flash('merchant_id', $request->merchant_id);
        //return view ('devices.create');


        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/devices/id_devices', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id'        => $request->merchant_id,

                ],
            ]);

            $records =  $result->getBody()->getContents();
           $jos = json_decode($records);

            if($jos->code != '00'){
                AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
                session()->flash('merchant_id', $request->merchant_id);
                return view ('devices.create');
            }

            try {




                $client = new Client();
                $result = $client->post(env('BASE_URL').'/devices/id', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'id'        => $request->merchant_id,

                    ],
                ]);

                $records =  $result->getBody()->getContents();
                if(!isset($records)){
                    AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
                    session()->flash('merchant_id', $request->merchant_id);
                    return view ('devices.create');
                }



                session()->flash('merchant_id', $request->merchant_id);
                return view('devices.device')->with('records', json_decode($records));


            }
            catch (ClientException $e){

                AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
                session()->flash('merchant_id', $request->merchant_id);
                return view ('devices.create');

            }






        }
        catch (ClientException $e){
            return  $e;

            AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
            session()->flash('merchant_id', $request->merchant_id);
            return view ('devices.create');

        }





    }

    public function updateview(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_merchant_pos');
        session()->flash('imei', $request->imei);
        session()->flash('id', $request->id);
        session()->flash('state', $request->state);
        session()->flash('sw_version', $request->sw_version);
        session()->flash('vendor', $request->vendor);
        session()->flash('merchant_id', $request->merchant_id);
        return view ('devices.update');
    }


        public function creates (Request $request){
            AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
            session()->flash('merchant_id', $request->merchant_id);
            return view ('devices.create');
        }

    public function index()
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'devices');
        try {




            $client = new Client();
            $result = $client->get(env('BASE_URL').'/devices/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

             $records =  $result->getBody()->getContents();
            return view('devices.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('devices.display');

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'add_pos');
        try {


            $client = new Client();
            $result = $client->post(env('BASE_URL').'/devices/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'merchant_id' => $request->merchant_id,
                    'imei' => $request->imei,
                    'vendor' => $request->vendor,
                    'sw_version' => $request->sw_version,
                    'state' => $request->state,
                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){
                session()->flash('success', $rec->description);
                return view('devices.create');

            }else{
                session()->flash('error', $rec->description);
                return view('devices.create');
            }


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('devices.create');

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

        AuthService::getAuth(Auth::user()->role_permissions_id, 'update_merchant_pos');
        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/devices/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'updated_by' => $request->updated_by,
                    'merchant_id' => $request->merchant_id,
                    'imei' => $request->imei,
                    'vendor' => $request->vendor,
                    'sw_version' => $request->sw_version,
                    'state' => $request->state,
                    'id' => $request->id,
                ],
            ]);



            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){
                return redirect('/devices/display');

            }else{
                session()->flash('error', $rec->description);
                return view('devices.update');
            }


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('devices.create');

        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'delete_pos_devices');
        session()->flash('imei', $request->imei);
        session()->flash('id', $request->id);
        session()->flash('state', $request->state);
        session()->flash('sw_version', $request->sw_version);
        session()->flash('vendor', $request->vendor);
        session()->flash('terminal_id', $request->terminal_id);
        session()->flash('merchant_id', $request->merchant_id);
        return view ('devices.decommission');


    }


    public function delete(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'delete_pos_devices');
        try {

            $client = new Client();
            $result = $client->post(env('BASE_URL').'/devices/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' => $request->id,
                    'updated_by' => $request->updated_by,
                    'merchant_id' => $request->merchant_id,
                    'imei' => $request->imei,
                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code === "00"){

                return Redirect::to('/devices/display');

            }


        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('devices.decommission');

        }



    }

}
