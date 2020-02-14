<?php

namespace App\Http\Controllers;


use App\Access;

use App\Role;
use App\Permissions;
use App\Role_User;
use App\UserLogs;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;



class AccessController extends Controller
{
    /**internet_banking@192.168.1.109
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\ConnectionInterface|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder|User[]
     */






    public function display()
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        $permissions = Permissions::all();
        return view('permissions.display')->with('records',$permissions);

    }


    public function index()
    {


        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        $users = User::all();
        return view('access.state')->with('users', $users);

    }

    public function status(Request $request)
    {
       //return $request->all();

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');

        if ($request->state == '0'){

            User::where('id', $request->user)->update([
                'times_blocked' => '1',
                'status' => '0',
                'reason' => $request->description,
            ]);

            session()->flash('message', 'Account successfully blocked');
            return Redirect::to('/access/state');

        }
        else{

            User::where('id', $request->user)->update([
                'status' => '1',
                'times_blocked' => '0',
                'auth_attempts' => '0',
                'reason' => $request->description,
            ]);

            session()->flash('message', 'Account successfully activated');
            return Redirect::to('/access/state');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        //return $request->all();

        //DB update tabel
        Role_User::where('user_id', $request->user)
            ->update(
                [
                    'role_id' => $request->role,
                    'acc' => $request->account,
                    'card_initiation' => $request->card_initiation,
                    'card_auth' => $request->card_auth,
                    'change_status' => $request->change_status,
                    'delete_card' => $request->delete_card,
                    'merchants' => $request->merchants,
                    'merchant_profile' => $request->merchant_profile,
                    'devices' => $request->devices,
                    'create_merchant' => $request->create_merchant,
                    'edit_merchant' => $request->edit_merchant,
                    'add_account' => $request->add_account,
                    'add_pos' => $request->add_pos,
                    'update_merchant_acc' => $request->update_merchant_acc,
                    'update_pos_devices' => $request->update_pos_devices,
                    'delete_pos_devices' => $request->delete_pos_devices,
                    'card_production' => $request->card_production,
                    'transaction_manager' => $request->transaction_manager,
                    'reports' => $request->reports,
                    'users' => $request->users,

                ]
            );




        session()->flash('message','Role Successfully Assigned to User');
        return redirect('/access/access');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function accessview(Request $request)

    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');

        $users = User::all();
        $roles = Role::all();
        return view('access.access')->with('users', $users)->with('roles', $roles);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function assignrole(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        $users = User::all();
        $roles = Permissions::all();
        return view('access.roles')->with('users', $users)->with('roles', $roles);

    }


    public function link(Request $request)
    {
        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');

        try {

           $user = User::find($request->user);
           $user->role_permissions_id=$request->role;
           $user->save();

            session()->flash('message', 'Role Successfully linked to User');

            return redirect('/access/roles');

        } catch (QueryException $exception){

            session()->flash('error-message','Duplicate Role for User');
            return redirect('/access/roles');


        }
    }


    public function create_r(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');

        Role::create([

            'name' => $request->name,
            'description' => $request->description,
            'created-by' => $request->created_by,
        ]);


      session()->flash('roles_success',' Role successful created');
      return view('access.createroles');

    }


    public function create_roles(Request $request)
    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');
        return view('access.createroles');

    }

    public function postAdminAssignRoles(Request $request)

    {

        AuthService::getAuth(Auth::user()->role_permissions_id, 'users');

        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }


}

