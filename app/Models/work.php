<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class work extends Model
{
    protected $connection = 'mysql';

    public $table = "work";

    protected $fillable = [
        'date_work',
        'date_name',
        'punch_time_in',
        'punch_time_out',
        'work_status',
        'work_bonus_remark',
        'emp_code',
        'emp_team',
        'work_day_money'
    ];

    public $timestamps = false;

    protected $primaryKey = 'work_id';
}
