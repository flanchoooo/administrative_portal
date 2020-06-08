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
    public static function getToken(){

        $client = new GuzzleHttp\Client();
        try {
            $res = $client->post(env('BASE_URL').'/login', ['json' => [
                'email' => env('TOKEN_USERNAME'),
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