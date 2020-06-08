<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInternet extends Model
{





    protected $guarded = [];
    protected $connection = 'mysql';
    protected $table = 'users';
    public $timestamps = false;


}
