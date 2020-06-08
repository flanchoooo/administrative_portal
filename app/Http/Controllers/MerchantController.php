<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function update_view (Request $request){


        AuthService::getAuth(Auth::user()->role_permissions_id, 'edit_merchant');
        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/cos', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records = $result->getBody()->getContents();
            return view('merchant.update')->with('id', $id = $request->id)
                ->with('name', $name = $request->name)
                ->with('mobile', $mobile = $request->mobile)
                ->with('id_number', $id_number = $request->id_number)
                ->with('address', $address = $request->address)
                ->with('merchant_code', $merchant_code = $request->code)
                ->with('records', json_decode($records))
                ->with('tax', $tax = $request->tax)
                ->with('city', $city = $request->city)
                ->with('reg_number',$request->reg_number)
                ->with('mdr',$request->mdr);

        }catch (ClientException $exception){

            return redirect('/merchant/display');

        }

    }



    public function index()
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'merchants');
        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/merchant/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

            $records =  $result->getBody()->getContents();
            return view('merchant.display')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

           return view('merchant.display');

        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');
         $id =  '15655'. $this->genRandomNumber(6, false);

     //return $request->all();
        try {

            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/companies/', [

                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id'                => $id,
                    'company_type'       => 'AGENT',
                    'contact_email'      => $request->contactEmail,
                    'contact_number'     => $request->mobile,
                    'description'       => 'Company registration',
                    'name'              => $request->name,
                    'status'            => 'ACTIVE',
                    'physical_address'   =>  $request->address,
                    'version'           =>  0,


                ],
            ]);



            $rec =  $result->getBody()->getContents();
            $response = json_decode($rec);



            if($response->statusCode != '0'){
                session()->flash('notification',$response->message);
                return redirect('/merchant/create');

            }


            try {

                $client = new Client();
                $result = $client->post(env('BASE_URL').'/merchant/create', [

                    'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'created_by'    => $request->created_by,
                        'name'          => $request->name,
                        'mobile'        => $request->mobile,
                        'tax'           => $request->tax,
                        'reg_number'    => $request->reg_number,
                        'merchant_type' => $request->merchant_type,
                        'id_number'     => $request->id_number,
                        'state'         => $request->state,
                        'address'       => $request->address,
                        'id'            => $response->responseBody->id,
                        'cos'           => $request->cos,
                        'city'          => $request->city,
                        'mdr'           => $request->mdr,
                    ],
                ]);



                //$rec =  $result->getBody()->getContents();
                $rec =  json_decode($result->getBody()->getContents());


                if($rec->code === "00"){
                    return redirect('/merchant/display');

                }else{
                    session()->flash('merchant_error', $rec->description);
                    return redirect('/merchant/create');
                }


            }
            catch (ClientException $e){

                session()->flash('notification','Please Contact System administrator for assistance');
                return redirect('/merchant/create');

            }



        }
        catch (RequestException $e){


            session()->flash('notification',$response->message);
            return redirect('/merchant/create');

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
    public function show()

    {
        try {


            AuthService::getAuth(Auth::user()->role_permissions_id, 'create_merchant');
            $client = new Client();
            $result = $client->get(env('BASE_URL').'/cos', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);

           $records =  $result->getBody()->getContents();
            return view('merchant.create')->with('records' , json_decode($records));


        }
        catch (ClientException $e){

            return redirect('/merchant/display');

        }


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
            $result = $client->post(env('BASE_URL').'/merchant/edit', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'name' => $request->name,
                    'class_of_service_id' => $request->class_of_service_id,
                    'mobile' => $request->mobile,
                    'id_number' => $request->id_number,
                    'state' => $request->state,
                    'address' => $request->address,
                    'tax' =>$request->tax,
                    'reg_number' =>$request->reg_number,
                    'merchant_type' =>$request->tax,
                    'created_by' => $request->created_by,
                    'city' => $request->city,
                    'id' => $request->id,
                    'updated_by' => Auth::id(),
                    'mdr' => $request->mdr,

                ],
            ]);


            $rec =  $result->getBody()->getContents();

            $client_r = new Client();
            $result_r = $client_r->get(env('BASE_URL').'/merchant/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $records_r =  $result_r->getBody()->getContents();
            return view('merchant.display')->with('records' , json_decode($records_r));


        }
        catch (ClientException $exception){

            session()->flash('error','Failed to create card type please contact admin');
            return view('merchant.update');

        }


    }

    public function genRandomNumber($length = 6, $formatted = true){
        $nums = '0123456789';

        // First number shouldn't be zero
        $out = $nums[ mt_rand(1, strlen($nums) - 1) ];

        // Add random numbers to your string
        for ($p = 0; $p < $length - 1; $p++)
            $out .= $nums[ mt_rand(0, strlen($nums) - 1) ];

        // Format the output with commas if needed, otherwise plain output
        if ($formatted)
            return number_format($out);

        return $out;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
