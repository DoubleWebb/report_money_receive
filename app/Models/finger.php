<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class finger extends Model
{
    protected $connection = 'mysql';

    public $table = "finger";

    protected $fillable = [
        'emp_code',
        'finger_date',
        'punch_time',
        'emp_team'
    ];

    public $timestamps = false;

    protected $primaryKey = 'finger_id';
}
