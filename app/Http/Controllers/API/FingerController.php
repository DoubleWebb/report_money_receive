<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\finger as finger;
use App\Models\team as team;

class FingerController extends Controller
{
    public function Receive_Finger(Request $request)
    {
        if(!empty($request->emp_code) && !empty($request->punch_time) && !empty($request->emp_team)) {
            $check_finger = finger::where('emp_code', $request->emp_code)->where('punch_time', $request->punch_time)->where('emp_team', $request->emp_team)->count();
            if ($check_finger == '0') {
                // ถ้ายังไม่มีข้อมูล ให้เพิ่มข้อมูลเข้าสู่ระบบ
                $insert_finger = new finger;
                $insert_finger->emp_code = $request->emp_code;
                $insert_finger->finger_date = Carbon::parse($request->punch_time)->format('Y-m-d');
                $insert_finger->punch_time = $request->punch_time;
                $insert_finger->emp_team = $request->emp_team;
                $insert_finger->save();            
            }
            // อัพเวลาที่ส่งเข้ามาล่าสุด
            team::where('team_id', $request->emp_team)
                    ->update(['team_last_send' => Carbon::now()]);
                    
            return response()->json([
                'message' => 'อัพเดตข้อมูลสำเร็จ'
            ], 200);  
        }else {
            return response()->json([
                'message' => 'Parameter ไม่ครบ'
            ], 400); 
        }
    }
}
