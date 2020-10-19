<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setting as setting;

class Setting_Work_Controller extends Controller
{
    public function Setting_Work_In_Days(Request $request)
    {
        $days_work = Carbon::now()->daysInMonth;
        setting::where('setting_name', 'work_in_days')->update(['setting_value' => $days_work]);
        
        return response()->json(['massage' => 'อัพเดตจำนวนวันของเดือน สำเร็จ'], 200);
    }
}
