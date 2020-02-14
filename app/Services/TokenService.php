<?php
/**
 * Created by PhpStorm.
 * User: deant
 * Date: 7/12/18
 * Time: 4:49 PM
 */

namespace App\Services;
use GuzzleHttp;
use Illuminate\Http\JsonResponse;


class TokenService
{
    public static function getToken()
    {
        /*  $client = new GuzzleHttp\Client();
          try {
              $res = $client->post(env('PINDA BASE_URL').'/login', ['json' => [
                  'username' => env('BR_USERNAME'),
                  'password' => env('BR_PASSWORD'),
                  'applicationUID' => env('BR_TOKEN_UID'),


              ]]);
              return $res->getBody()->getContents();

          } catch (GuzzleHttp\Exception\RequestException $e) {
              if ($e->hasResponse()) {
                  $exception = (string)$e->getResponse()->getBody();
                  $exception = json_decode($exception);
                  return new JsonResponse($exception, $e->getCode());
              } else {
                  return new JsonResponse($e->getMessage(), 503);
              }

          }
        */


        $headers = array(
            'Accept' => 'application/json',
            'Authorization' => env('TOKEN_LOGIN_TOKEN'),
        );

        $client = new GuzzleHttp\Client(['headers' => $headers]);
        try {
            $res = $client->post(env('AUTH_SERVER_BASE_URL') . '/login/', ['json' => [
                'applicationUID' => env('TOKEN_UID'),
                'username' => env('TOKEN_USERNAME'),
                'password' => env('TOKEN_PASSWORD')

            ]]);
            return $res->getBody()->getContents();
        } catch (GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $exception = (string)$e->getResponse()->getBody();
                $exception = json_decode($exception);
                return new JsonResponse($exception, $e->getCode());
            } else {
                return new JsonResponse($e->getMessage(), 503);
            }

        }

    }

}
