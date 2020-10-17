<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $connection = 'mysql';

    public $table = "users";

    protected $fillable = [
        'name',
        'username',
        'password',
        'view_show',
    ];

    protected $hidden = [
        'password'
    ];

    protected $primaryKey = 'id';
}
