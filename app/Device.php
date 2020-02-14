<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Merchant extends Model implements Authenticatable

{

    use AuthenticableTrait;

    protected $guarded = [];

    protected $table = 'merchant';

}