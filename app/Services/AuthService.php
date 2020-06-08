<?php
/**
 * Created by PhpStorm.
 * User: deant
 * Date: 7/12/18
 * Time: 4:49 PM
 */

namespace App\Services;
use App\Role_User;
use GuzzleHttp;
use Illuminate\Http\JsonResponse;


class AuthService
{


    public static function getAuth($role_id,$actions){

          $result =   Role_User::where('id',$role_id)->first();
          $role_user = $result[$actions];

        if($role_user != 'on'){

            return abort(401, 'Whoops! You do not have permissions to access this page');

        }


    }



}
