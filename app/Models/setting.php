<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    protected $connection = 'mysql';

    public $table = "setting";

    protected $fillable = [
        'setting_name',
        'setting_value'
    ];

    public $timestamps = false;

    protected $primaryKey = 'setting_id';
}
