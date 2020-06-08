<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/transactions/statistics';


    public function __construct()
    {
        $this->middleware('guest');
    }


    public function reset(Request $request)
    {

        //return $request->all();
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        try {

            $client = new Client();
            $result = $client->post(env('AUTH_SERVER_BASE_URL').'/users/pasword-reset/', [

                'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'application_uid'  => env('AUTH_AUID'),
                    'password'        => $request->password,
                    'username'        => $request->email,
                ],
            ]);


             $rec =  $result->getBody()->getContents();
             $responses = json_decode($rec);

            if($responses->statusCode != '0'){
                session()->flash('error', 'Please Contact System administrator for assistance');
                return view('auth.login');
            }



            // Here we will attempt to reset the user's password. If it is successful we
            // will update the password on an actual user model and persist it to the
            // database. Otherwise we will parse the error and return the response.
                $response = $this->broker()->reset(
                $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }

            );

            // If the password was successfully reset, we will redirect the user back to
            // the application's home authenticated view. If there is an error we can
            // redirect them back to where they came from with their error message.
            return $response == Password::PASSWORD_RESET
                ? $this->sendResetResponse($response)
                : $this->sendResetFailedResponse($request, $response);


        }

        catch (ClientException $e){
            session()->flash('error', 'Please Contact System administrator for assistance');
            return view('auth.login');

        }


    }



}
