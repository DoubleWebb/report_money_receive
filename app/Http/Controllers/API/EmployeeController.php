<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\employee as employee;

class EmployeeController extends Controller
{
    public function Receive_Employee(Request $request)
    {
        if(!empty($request->emp_code) && !empty($request->emp_team) && !empty($request->emp_firstname) && !empty($request->emp_lastname)) {
            $check_employee = employee::where('emp_code', $request->emp_code)->count();
            if ($check_employee == '0') {
                // ถ้าไม่มี พนักงาน ในระบบ
                $insert_employee = new employee;
                $insert_employee->emp_code = $request->emp_code;
                $insert_employee->emp_team = $request->emp_team;
                $insert_employee->emp_firstname = $request->emp_firstname;
                $insert_employee->emp_lastname = $request->emp_lastname;
                $insert_employee->emp_status = '1';
                $insert_employee->emp_salary = null;
                $insert_employee->save();
            }else {
                // ถ้ามีในระบบแล้ว ให้อัพเดต ชื่อ นามสกุล
                employee::where('emp_code',$request->emp_code)
                    ->update(['emp_firstname' => $request->emp_firstname, 'emp_lastname' => $request->emp_lastname]);
            }
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
