<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\special_day as special_day;

class SettingController extends Controller
{
    public function Setting_Special_Days(Request $request)
    {
        return view('page/setting_special_day');
    }

    public function Get_Table_Setting_Special_Days(Request $request)
    {
        $data = special_day::get();        

        return Datatables::of($data)
            ->editColumn('special_day_status', function($data) {
                if($data->special_day_status == '1') {
                    $result =  'รอสร้าง OT';
                }else {
                    $result =  'สร้าง OT แล้ว';
                }
                return $result;
            })
            ->rawColumns([])
            ->make(true);
    }

    public function Save_Create_Special_Day(Request $request)
    {
        $insert_special_day = new special_day;
        $insert_special_day->special_day_date = $request->special_day_date;
        $insert_special_day->special_day_remark = $request->special_day_remark;
        $insert_special_day->special_day_status = '1';
        $insert_special_day->save();

        return response()->json(['massage' => 'อัพเดต วันที่ OT'], 200);
    }
}
