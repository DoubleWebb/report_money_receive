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
        'team_last_send',
        'team_day_off'
    ];

    public $timestamps = false;

    protected $primaryKey = 'team_id';
}
