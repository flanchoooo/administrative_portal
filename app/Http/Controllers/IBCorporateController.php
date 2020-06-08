<?php

namespace App\Http\Controllers;

use App\CorporateUser;
use App\IBCorp;
use App\IBCorpUsers;
use App\Services\AuthService;
use App\Services\TokenService;
use App\User;
use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use http\Exception;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IBCorporateController extends Controller
{

    public function display(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {

            $client = new Client();
            $result = $client->get(env('BASE_URL').'/internet/corporates/all', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],

            ]);
            $rec =  $result->getBody()->getContents();
            return view('corporate.display')->with('records', json_decode($rec));
        }
        catch (ClientException $e){

            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('bank.display');
        }

    }

    public function createview(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        return view('corporate.create');
    }

    public function show(Request $request)
    {

        try {

            $c = new Client();
            $r = $c->post(env('BR_BASE_URL') . '/api/customers', [

                'headers' => ['Authorization' => 'Corporate', 'Content-type' => 'application/json',],
                'json' => [
                    'account_number' => $request->account_number,
                ]
            ]);

             $search_result = $r->getBody()->getContents();
            $details = json_decode($search_result);

            if ($details->code != '00') {
                $notification = 'Account does not exists';
                return view('corporate.create')->with('notification', $notification);
            }

            session()->flash('client_name', $details->ds_account_customer->client_name);
            session()->flash('account_id', $details->ds_account_customer->account_id);
            session()->flash('branch_name', $details->ds_account_customer->branch_name);
            session()->flash('email_id', $details->ds_account_customer->email_id);
            session()->flash('acstatus', $details->ds_account_customer->acstatus);
            session()->flash('mobile', $details->ds_account_customer->mobile);
            return view('corporate.info');



        } catch (ClientException $e) {
            //return $e;

            $notification = 'Invalid Account';
            return view('corporate.create')->with('notification', $notification);


        }

    }

    public function create(Request $request)
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporates/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by'    => $request->created_by,
                    'name'          => $request->account_name,
                    'account_id'    => $request->account_number,
                    'status'        => 1,
                ],
            ]);


            $rec =  json_decode($result->getBody()->getContents());
            if($rec->code != "00") {
                $notification = $rec->description;
                return view('corporate.create')->with('notification', $notification);
            }


            return redirect('/corporates/display');
        }
        catch (RequestException $requestException){
           return $requestException;

            $notification = 'Duplicate entry';
            return view('corporate.create')->with('notification', $notification);


        }



    }

    public function delete(Request $request)
    {

        // return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporates/remove_account', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'corporate_id'    => $request->id,
                    'created_by'     => Auth::user()->id

                ],
            ]);
         return    $rec =  $result->getBody()->getContents();

            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code == "00"){
                return redirect('/corporates/display');

            }else{
                $notification = $rec->description;
                return view('corporate.create')->with('notification', $notification);

            }


        }
        catch (ClientException $exception){

            $notification = 'Please Contact System administrator for assistance';
            return view('corporate.create')->with('notification', $notification);


        }



    }

    public function createuser(Request $request){

        session()->flash('corporate_id', $request->id);
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        return view('corporate.create_user');
    }

    public function users(Request $request){

        $email = IBCorpUsers::where('email', $request->email)->get()->count();
        if($email > 0){
            session()->flash('error_email', 'Email arealdy taken');
            return redirect('/corporates/display');
        }
        $mobile = IBCorpUsers::where('mobile', $request->mobile)->get()->count();
        if($mobile > 0){
            session()->flash('error_email', 'Mobile arealdy taken');
            return redirect('/corporates/display');
        }


        try {
            $id = $this->genRandomNumber();
            DB::beginTransaction();
            $user = IBCorpUsers::create([
                'id'                => $id,
                'name'              =>$request->name,
                'login_identifier'  => $request->mobile,
                'mobile'            => "263" . substr($request->mobile, -9),
                'email'             => $request->email,
                'password'          => Hash::make(Str::random(60)),
                'token'             => Str::random(60),
                'user_type_id'      => $request->user_type_id,
                'status'            => true,
            ]);

            IBCorp::create([
                'corporate_id' => $request->corporate_id,
                'user_id' => $id,
            ]);

            DB::commit();

            try {
                $headers = array(
                    'Accept'                 => 'application/json',
                    'application_uid'        => env('NOTIFY_UUID'),
                );

                $app_url = 'https://getbucksonline.com' . '/registration/confirm?token=';
                $client = new GuzzleHttp\Client(['headers' => $headers]);
                $client->post(env('NOTIFY_URL') .'/email/html', [

                    'json' => [
                        'to'                        => [$request->email],
                        'personalization_text'      => 'Internet Banking Registration',
                        'subject'                   => 'Internet Banking Registration',
                        'message'              => "<h4>Hello $request->name</h4>
<br>
Please visit this <a href='$app_url$user->token'>link</a>  to complete your account registration.
<br><br>
If you are failing to click the link copy and paste the following into your browser:
<br><br>
$app_url$user->token
<br><br>

<b>Please contact the bank if you have not initiated this transaction</b>
<br>
Kind Regards,<br>
Getbucks
",
                        "isHTML"               => "true",
                        "personalization_text" => "Getbucks",
                    ]]);


                return redirect('/corporates/display');


            }catch (GuzzleHttp\Exception\RequestException $requestException){
                session()->flash('error_email', 'Please contact system for assistance');
                return redirect('/corporates/display');
            }


        } catch (Exception $exception) {
            DB::rollback();
            session()->flash('error_email', 'Please contact system for assistance');
            return redirect('/corporates/display');
        }

    }

    public function genRandomNumber($length = 10, $formatted = false){
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

    protected function createCorporateUserRules(array $data){
        return Validator::make($data, [
            'email'        => 'required|string|email|max:255',
            'mobile'       => 'required|string|max:255|unique:users',
            'name'         => 'required',
            'user_type_id' => 'required|exists:user_types,id|integer|between:2,3',
            'corporate_id' => 'required|exists:corporates,id',
        ]);
    }

    public function users_(Request $request)
    {

        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post('https://getbucksonline.com/api/corporate/register', [


                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'corporate_id'      => $request->corporate_id,
                    'email'             => $request->email,
                    'mobile'            => $request->mobile,
                    'name'              => $request->name,
                    'user_type_id'      => $request->user_type_id,

                ],
            ]);

           // return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());


            if($rec->code !='00'){
                session()->flash('error','Mobile or Email already taken.');
                return view('corporate.create_user');
            }

            return redirect('/corporates/display');
        }
        catch (ClientException $exception){


            session()->flash('error','Please Contact System administrator for assistance');
            return view('corporate.create_user');
        }



    }

    public function view(Request $request)
    {

        //return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporate/users', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'corporate_id'    => $request->id,


                ],
            ]);



            $rec =  $result->getBody()->getContents();

            return view('corporate.view')->with('records', json_decode($rec));



        }
        catch (ClientException $exception){
            session()->flash('error','Please Contact System administrator for assistance');
            return redirect('/corporate/display');
        }



    }

    public function accounts(Request $request){

        session()->flash('corporate_id', $request->id);
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        return view('corporate.accounts');
    }

    public function add_lookup(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');


        $token = json_decode(TokenService::getToken());
        $headers = array(
            'Accept'        => 'application/json',
            'Authorization' => $token->responseBody,
        );

        try {



            $c = new Client();
            $r = $c->post(env('BR_BASE_URL') . '/api/customers', [

                'headers' => $headers,
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

                return view('corporate.add_info');

            } else {

                $notification = 'Please Contact System administrator for assistance';
                return view('corporate.accounts')->with('notification', $notification);
            }

        } catch (ClientException $e) {

            $notification = 'Invalid Account';
            return view('corporate.accounts')->with('notification', $notification);


        }

    }

    public function account_create(Request $request)
    {

        // return $request->all();
        AuthService::getAuth(Auth::user()->role_permissions_id, 'corporate');
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL').'/internet/corporates/create', [

                'auth' => [ env('WEB_USER_NAME'),env('WEB_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'created_by'    => $request->created_by,
                    'name'          => $request->account_name,
                    'account_id'    => $request->account_number,
                    'status'        => 1,
                ],
            ]);

            //return $result->getBody()->getContents();
            $rec =  json_decode($result->getBody()->getContents());

            if($rec->code == "00"){
                return redirect('/corporates/display');

            }else{
                $notification = $rec->description;
                return view('corporate.create')->with('notification', $notification);

            }


        }
        catch (ClientException $exception){

            $notification = 'Please Contact System administrator for assistance';
            return view('corporate.create')->with('notification', $notification);


        }



    }

}
