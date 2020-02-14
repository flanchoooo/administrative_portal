<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string'
           ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)


    {

        return User::create([
            'name' => $data['name'].' '.$data['lastname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);



    }


    public function register(Request $request)
    {

      //r//eturn $request->all();

        try {



        $client = new Client();
        $result = $client->post(env('AUTH_SERVER_BASE_URL').'/users/', [
            'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
            'headers' => [
                'Content-type' => 'application/json'
            ],
            'json' => [
                'application_uid' => env('AUTH_AUID'), //applicationUid
                'belong_to'          => env('AUTH_COMPANY_ID'), //belongTo
                'email'             =>  $request->email, //email
                'firstname'         =>  $request->name, //firstname
                'lastname'          =>  $request->lastname, //lastname
                'password'          =>  $request->password,  //password
                'phone'             =>  $request->mobile,  //phone
                'user_type'          =>  'ADMIN',   //userType
                'username'          =>  $request->username,  //username
            ],
        ]);


        $rec =  $result->getBody()->getContents();
        $response = json_decode($rec);

        if($response->statusCode != 0){

            session()->flash('notification', $response->message);
            return view('auth.register');

        }





        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        session()->flash('notification',  $response->message);
        return  redirect('/register');


    }
    catch (ClientException $e){

        return $e;

    }


        /*

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

        */
    }

}
