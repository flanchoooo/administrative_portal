<?php

namespace App\Http\Controllers;

use App\User;
use App\UserAuth;
use App\Password;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class MigrationsController extends Controller
{
    public  function  index(){

      $user_search = User::all();
        foreach ($user_search as $internet_banking) {

            try {
                UserAuth::create([


                    'created_date' => $internet_banking->created_at,
                    'modified_date' => $internet_banking->updated_at,
                    'status' => 'ACTIVE',
                    'version' => '0',
                    'account_status' => 1,
                    'first_name' => $internet_banking->name,
                    'last_name' => '',
                    'password_status' => 1,
                    'phone' => $internet_banking->mobile,
                    'user_name' => '',
                    'email' => $internet_banking->email,

                ]);


                $res = UserAuth::where('email', $internet_banking->email)->get()->first();

                Password::create([
                    'created_date' => $internet_banking->created_at,
                    'modified_date' => $internet_banking->updated_at,
                    'status' => 'ACTIVE',
                    'version' => '0',
                    'encrypted_password' => $internet_banking->password,
                    'fk_user' => $res->id,
                ]);

                $name = $internet_banking->name;
                Mail::to($internet_banking->email)->send(new SendMailable($name));


                echo $internet_banking->name . 'profile successfully migrated.' . '<br>';

            }catch (QueryException $queryException){
                echo $internet_banking->name . 'failed to migrate profile' . '<br>';
                continue;
            }
        }



    }
}
