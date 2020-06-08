<?php

namespace App\Listeners;

use App\Mail\AccountBlocked;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;


class AuthFailed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    /**
     * Handle the event.
     *
     * @param Failed $event
     * @return void
     */
    public function handle(Failed $event){
        $user = $event->user;
        if ($user === NULL) {
            Log::alert('UNKNOWN User failed to login.', [$event->credentials]);
        } else {
            Log::info('User failed to login.', ['credentials' => $event->credentials, $user]);


            if(!$user->status){
                /** @noinspection PhpInconsistentReturnPointsInspection */
             //   return redirect()->back()->with(['error' =>'Please contact the bank for assistance.']);
            }

            $user->auth_attempts++;


            if ($user->auth_attempts >= 3) {
                //Block user
                $user->status = false; //Blocked Account
                $user->times_blocked++;

                //Mail::to($user->email)->send(new AccountBlocked($user));
            }
            $user->save();
        }
    }
}
