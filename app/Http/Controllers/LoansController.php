<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    public function display(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL').'/api/lending/pending/approval', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('loans.display')->with('records', json_decode($rec));
        }
        catch (\Exception $exception){
           return $exception;
            session()->flash('loan_failed', 'Please Contact System administrator for assistance');
           return redirect()->back();
        }
    }

    public function process(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/lending/update', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'id'        => $request->id,
                    'status'    => $request->status,
                ],
            ]);
             $rec =  $result->getBody()->getContents();
            $description = json_decode($rec);
            session()->flash('loan_success', $description->description);
            return redirect()->back();
        }
        catch (\Exception $exception){
            session()->flash('loan_failed', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function loanBook(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->get(env('TXN_MNG_BASE_URL').'/api/lending/loan/book', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',]
            ]);
            $rec =  $result->getBody()->getContents();
            $description = json_decode($rec);
            session()->flash('loan_book_position', $description->loan_book_position);
            session()->flash('interest_earnings', $description->interest_earnings);
            return view('loans.dashboard');
        }
        catch (\Exception $exception){
            session()->flash('loan_failed', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function applicant(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/lending/profile', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'applicant_details'        => $request->id,
                ],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('loans.applicant')->with('records',array(json_decode($rec)))
                                               ->with('loan_repayment',json_decode($rec)->loan_profile);
        }
        catch (\Exception $exception){
            session()->flash('loan_failed', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function installments(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/lending/loan/profile', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'loan_id'        => $request->id,
                ],
            ]);
            $rec =  $result->getBody()->getContents();
            return view('loans.applicant_loans')->with('records',json_decode($rec));
        }
        catch (\Exception $exception){
            session()->flash('loan_failed', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function payment(Request $request){

        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/lending/payment', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'loan_repayment_id' => $request->id,
                ],
            ]);
            $rec =  $result->getBody()->getContents();
            $res = json_decode($rec);
            session()->flash('loan_success', $res->description);
            return redirect('/loans/display');
        }
        catch (\Exception $exception){
            session()->flash('loan_failed', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function profile(){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
       return view('loans.profile');
    }

    public function search(Request $request){
        AuthService::getAuth(Auth::user()->role_permissions_id, 'loans');
        try {
            $client = new Client();
            $result = $client->post(env('TXN_MNG_BASE_URL').'/api/lending/loan/profile/search', [
                'auth' => [ env('TXN_USER'),env('TXN_PASSWORD')],
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'applicant_details' => $request->applicant_details,
                ],
            ]);
            $rec =  $result->getBody()->getContents();
            $res = json_decode($rec);
            if($res->code != '00'){
                session()->flash('notification', $res->description);
                return redirect()->back();
            }
            $rec =  $result->getBody()->getContents();
            return view('loans.applicants')->with('records',array($res))
                ->with('loan_repayment',$res->loan_profile);
        }
        catch (\Exception $exception){
            session()->flash('notification', $exception->getMessage());
            return redirect()->back();
        }
    }



}
