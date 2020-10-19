<?php

namespace App\Http\Controllers\Cronjob;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employee as employee;
use App\Models\team as team;
use App\Models\work as work;
use App\Models\special_day as special_day;

class Create_Date_Controller extends Controller
{
    public function Create_Date_Work(Request $request)
    {   
        $get_emp = employee::where('emp_status', '1')->get();
        $special_day_count = special_day::whereDate('special_day_date', Carbon::now()->format('Y-m-d'))->where('special_day_status', '1')->count();
        $special_day_data = special_day::whereDate('special_day_date', Carbon::now()->format('Y-m-d'))->first();
        foreach ($get_emp as $key => $row) {
            // เช็คว่าอยู่ Team ไหน
            $get_team = team::where('team_id', $row->emp_team)->first();
            // เช้คว่ามีข้อมูลใน work แล้วหรือยัง
            $work_date_count = work::whereDate('date_work', Carbon::now()->format('Y-m-d'))->where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)->count();
            if ($work_date_count == '0') {
                // ถ้าไม่มีข้อมูลให้ทำการสร้าง
                if (in_array(Carbon::now()->isoFormat('d'), explode(',', $get_team->team_day_off))) {
                    // วันหยุด
                    $insert_day_off = new work;
                    $insert_day_off->date_work = Carbon::now()->format('Y-m-d');
                    $insert_day_off->date_name = Carbon::now()->isoFormat('dddd');
                    $insert_day_off->work_status = '1';
                    $insert_day_off->work_status_remark = '1';
                    $insert_day_off->emp_code = $row->emp_code;
                    $insert_day_off->emp_team = $row->emp_team;
                    if ($special_day_count == '1') {
                        // ถ้ามีวันหยุด พิเศษ
                        $insert_day_off->work_bonus_status = '1';
                        $insert_day_off->work_bonus_remark = $special_day_data->special_day_remark;
                        special_day::where('special_day_id', $special_day_data->special_day_id)->update(['special_day_status' => '0']);
                    }else {
                        $insert_day_off->work_bonus_status = '0';
                    }
                    $insert_day_off->save();
                }else {
                    // วันทำงานปกติ
                    $insert_day_work = new work;
                    $insert_day_work->date_work = Carbon::now()->format('Y-m-d');
                    $insert_day_work->date_name = Carbon::now()->isoFormat('dddd');
                    $insert_day_work->work_status = '0';
                    $insert_day_work->work_status_remark = '0';
                    $insert_day_work->emp_code = $row->emp_code;
                    $insert_day_work->emp_team = $row->emp_team;
                    if ($special_day_count == '1') {
                        // ถ้ามีวันหยุด พิเศษ
                        $insert_day_work->work_bonus_status = '1';
                        $insert_day_work->work_bonus_remark = $special_day_data->special_day_remark;
                        special_day::where('special_day_id', $special_day_data->special_day_id)->update(['special_day_status' => '0']);
                    } else {
                        $insert_day_work->work_bonus_status = '0';
                    }
                    $insert_day_work->save();
                }
            }
        }

        return response()->json(['massage' => 'สร้างข้อมูล ประจำวันสำเร็จ'], 200);
    }

    public function Create_Date_Work_Mannal(Request $request)
    {

        $date = '2020-10-17';

        $get_emp = employee::where('emp_status', '1')->get();
        $special_day_count = special_day::whereDate('special_day_date', Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d'))->where('special_day_status', '1')->count();
        $special_day_data = special_day::whereDate('special_day_date', Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d'))->first();
        foreach ($get_emp as $key => $row) {
            // เช็คว่าอยู่ Team ไหน
            $get_team = team::where('team_id', $row->emp_team)->first();
            // เช้คว่ามีข้อมูลใน work แล้วหรือยัง
            $work_date_count = work::whereDate('date_work', Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d'))->where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)->count();
            if ($work_date_count == '0') {
                // ถ้าไม่มีข้อมูลให้ทำการสร้าง
                if (in_array(Carbon::createFromFormat('Y-m-d', $date)->isoFormat('d'), explode(',', $get_team->team_day_off))) {
                    // วันหยุด
                    $insert_day_off = new work;
                    $insert_day_off->date_work = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
                    $insert_day_off->date_name = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('dddd');
                    $insert_day_off->work_status = '1';
                    $insert_day_off->work_status_remark = '1';
                    $insert_day_off->emp_code = $row->emp_code;
                    $insert_day_off->emp_team = $row->emp_team;
                    if ($special_day_count == '1') {
                        // ถ้ามีวันหยุด พิเศษ
                        $insert_day_off->work_bonus_status = '1';
                        $insert_day_off->work_bonus_remark = $special_day_data->special_day_remark;
                        special_day::where('special_day_id', $special_day_data->special_day_id)->update(['special_day_status' => '0']);
                    }else {
                        $insert_day_off->work_bonus_status = '0';
                    }
                    $insert_day_off->save();
                }else {
                    // วันทำงานปกติ
                    $insert_day_work = new work;
                    $insert_day_work->date_work = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
                    $insert_day_work->date_name = Carbon::createFromFormat('Y-m-d', $date)->isoFormat('dddd');
                    $insert_day_work->work_status = '0';
                    $insert_day_work->work_status_remark = '0';
                    $insert_day_work->emp_code = $row->emp_code;
                    $insert_day_work->emp_team = $row->emp_team;
                    if ($special_day_count == '1') {
                        // ถ้ามีวันหยุด พิเศษ
                        $insert_day_work->work_bonus_status = '1';
                        $insert_day_work->work_bonus_remark = $special_day_data->special_day_remark;
                        special_day::where('special_day_id', $special_day_data->special_day_id)->update(['special_day_status' => '0']);
                    } else {
                        $insert_day_work->work_bonus_status = '0';
                    }
                    $insert_day_work->save();
                }
            }
        }

        return response()->json(['massage' => 'สร้างข้อมูล ประจำวันสำเร็จ'], 200);
    }
}
