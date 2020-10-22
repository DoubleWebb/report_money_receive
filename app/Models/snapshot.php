<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class snapshot extends Model
{
    protected $connection = 'mysql';

    public $table = "snapshot";

    protected $fillable = [
        'emp_code',
        'emp_team',
        'month_snapshot',
        'day_work_in',
        'day_work_not_in',
        'day_work_ot',
        'work_in_days',
        'money_of_day',
        'total_money',
        'month_salary'
    ];

    public $timestamps = false;

    protected $primaryKey = 'snapshot_id';
}
