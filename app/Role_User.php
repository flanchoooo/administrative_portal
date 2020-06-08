<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{



    //protected $fillable = ['role_id','user_id'];
    protected $guarded = [];


    //protected $table  = 'role_user';
    protected $table  = 'role_permissions';



}
