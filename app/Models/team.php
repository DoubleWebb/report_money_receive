<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $connection = 'mysql';

    public $table = "team";

    protected $fillable = [
        'team_name',
        'team_location',
        'team_day_off',
        'team_late_of_work',
        'team_last_send'
    ];

    public $timestamps = false;

    protected $primaryKey = 'team_id';
}
