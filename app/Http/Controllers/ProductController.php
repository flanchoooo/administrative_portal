<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
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
            $result = $client->get(env('BASE_URL').'/product/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result->getBody()->getContents();
            return view('product.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return view('product.display');

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {



        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        try {




            $client = new Client();
            $result = $client->post(env('BASE_URL').'/product/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by' => $request->created_by,
                    'name' => $request->name,
                    'state' => $request->state,
                    'on_us' => $request->on_us,
                    'transaction_type' => $request->transaction_type,

                ],
            ]);



            $rec =  json_decode($result->getBody()->getContents());



            if($rec->code === "00"){

                return redirect('/product/display');

            }else{
                session()->flash('error', $rec->description);
                return view('product.create');
            }


        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('product.create');

        }



    }

    public function createview()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        return view('product.create');
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

        $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');




        try {


            $client = new Client();
            $result = $client->post(env('BASE_URL').'/product/edit', [

                'headers' => ['Content-type' => 'application/json',],
                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'json' => [
                    'updated_by' => $request->updated_by,
                    'name' => $request->name,
                    'state' => $request->state,
                    'on_us' => $request->on_us,
                    'transaction_type' => $request->transaction_type,
                    'id' => $request->id,



                ],
            ]);



            $rec =  json_decode($result->getBody()->getContents());



            if($rec->code === "00"){

                return redirect('/product/display');

            }else{
                session()->flash('error', $rec->description);
                return view('product.update');
            }


        }
        catch (ClientException $exception){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('product.update');

        }


    }


    public function updateview(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'transaction_manager');
        session()->flash('id', $request->id);
        session()->flash('name',$request->name);
        return view('product.update');
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
            $result = $client->post(env('BASE_URL') . '/product/delete', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [

                    'id' => $request->id,
                    'created_by' => $request->created_by,

                ],
            ]);


            $rec = json_decode($result->getBody()->getContents());

            if ($rec->code === "00") {



                return redirect('/product/display');

            }

        } catch (ClientException $exception) {


            return redirect('/product/display');


        }




    }
}
