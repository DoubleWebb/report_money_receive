<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $connection = 'mysql';

    public $table = "employee";

    protected $fillable = [
        'emp_code',
        'emp_team',
        'emp_firstname',
        'emp_lastname',
        'emp_status',
        'emp_salary'
    ];

    public $timestamps = false;

    protected $primaryKey = 'emp_id';
}
