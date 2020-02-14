<?php

namespace App\Http\Middleware;

use App\Permissions;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //return $request->all();
        if ($request->user() === null) {
              return redirect('/login');;
        }

        $user = Auth::user()->role_permissions_id;
        $role = Permissions::where('id',$user)->get()->first();

        if(!isset($role)){
            return abort(404,'Your role profile you are accessing is in-active, please contact system administrator.');

        }



        if($role->status != '1'){
            return abort(404,'Your role profile you are accessing is in-active, please contact system administrator.');
        }



       return $next($request);


    }


}
