<?php

namespace App\Http\Controllers\Cronjob;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\finger as finger;
use App\Models\work as work;

class Update_Date_Controller extends Controller
{
    public function Update_Date_Work(Request $request)
    {
        // ดึงข้อมูลวันล่าสุด เพื่อค้นหาว่ามีข้อมูลมาหรือยัง
        $get_work = work::whereDate('date_work', Carbon::now()->format('2020-10-17'))->get();
        foreach ($get_work as $key => $row) {
            $check_finger = finger::whereDate('finger_date', $row->date_work)->where('emp_code', (int)$row->emp_code)->where('emp_team', $row->emp_team)->count();
            // ถ้าพบข้อมูลให้ทำการ อัพเดต
            if($check_finger == '1') {
                // ถ้ามีการเข้างาน
                $data_finger = finger::whereDate('finger_date', $row->date_work)->where('emp_code', (int)$row->emp_code)->where('emp_team', $row->emp_team)->first();
                $update_work = work::find($row->work_id);
                $update_work->punch_time_in = $data_finger->punch_time;
                $update_work->work_status = '1';
                $update_work->save();                
            }else {
                // ถ้ามีการหลายรอบ ออกงาน
                $data_finger = finger::whereDate('finger_date', $row->date_work)->where('emp_code', (int)$row->emp_code)->where('emp_team', $row->emp_team)->orderBy('finger_id', 'desc')->first();
                $update_work = work::find($row->work_id);
                $update_work->punch_time_out = $data_finger->punch_time;
                $update_work->save(); 
            }
        }

        return response()->json(['massage' => 'อัพเดตข้อมูล ประจำวันสำเร็จ'], 200);
    }
}
