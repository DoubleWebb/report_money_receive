<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class holiday extends Model
{
    protected $connection = 'mysql';

    public $table = "holiday";

    protected $fillable = [
        'holiday_date_start',
        'holiday_date_end',
        'holiday_remark',
        'holiday_status',
        'emp_code',
        'emp_team'
    ];

    public $timestamps = false;

    protected $primaryKey = 'holiday_id';
}
