<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model
{


    protected $keyType = 'bigint';
    protected $casts = ['id' => 'bigint'];
    protected $guarded = [];
    protected $connection = 'mysql2';
    protected $table = 'sys_system_user';
    public $timestamps = false;



}
