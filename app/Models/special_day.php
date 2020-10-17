<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class special_day extends Model
{
    protected $connection = 'mysql';

    public $table = "special_day";

    protected $fillable = [
        'special_day_date',
        'special_day_remark',
        'special_day_status'
    ];

    public $timestamps = false;

    protected $primaryKey = 'special_day_id';
}
