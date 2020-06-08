<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{


    protected $keyType = 'bigint';
    protected $casts = ['fk_user' => 'bigint', 'id' => 'bigint'];
    protected $guarded = [];
    protected $connection = 'mysql2';
    protected $table = 'sys_user_password';
    public $timestamps = false;



}
