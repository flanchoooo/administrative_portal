<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     *
     */





    protected $redirectTo = '/internet/dashboard';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }


    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;



    }


    public function username()
    {
        return $this->username;
    }


    protected function login(Request $request)
    {
            session_start();

            try {

                $client = new Client();
                $result = $client->post(env('AUTH_SERVER_BASE_URL').'/login/', [

                   'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                    'headers' => ['Content-type' => 'application/json',],
                    'json' => [
                        'applicationUID'    => env('AUTH_AUID'),
                        'password'          => $request->password,
                        'username'          => $request->login,
                    ],
                ]);


                 $rec =  $result->getBody()->getContents();
                $response = json_decode($rec);

                if($response->statusCode != 0){

                    session()->flash('error', $response->message);
                    return view('auth.login');

                }



                //return $response->responseBody;
                //session()->flash();
                $_SESSION["token"] = $response->responseBody;
              // session('responseBody',$response->responseBody);


                $this->validateLogin($request);
                // If the class is using the ThrottlesLogins trait, we can automatically throttle

                // the login attempts for this application. We'll key this by the username and
                // the IP address of the client making these requests into this application.
                if ($this->hasTooManyLoginAttempts($request)) {
                    $this->fireLockoutEvent($request);

                    return $this->sendLockoutResponse($request);
                }

                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }

                // If the login attempt was unsuccessful we will increment the number of attempts
                // to login and redirect the user back to the login form. Of course, when this
                // user surpasses their maximum number of attempts they will get locked out.
                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);


            }

            catch (ClientException $e){
               // return $e;
                session()->flash('error', 'Please Contact System administrator for assistance');
                return view('auth.login');

            }




    }

    protected function authenticated(Request $request, $user)
    {
        $status = Auth::user()->status;
        if($status == '0'){
            session()->flash('error','Account Blocked');
            return view('auth.login');

        }

    }





}
