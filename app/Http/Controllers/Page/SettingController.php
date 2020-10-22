<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use App\Models\special_day as special_day;
use App\Models\team as team;
use App\Models\User as User;

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
            ->setRowClass(function ($data) {
                if($data->special_day_status == '1') {
                    $reclass =  'bg-danger text-light';
                }else {
                    $reclass =  'bg-success text-light';
                }
                return $reclass;
            })
            ->make(true);
    }

    public function Save_Create_Special_Day(Request $request)
    {
        $insert_special_day = new special_day;
        $insert_special_day->special_day_date = $request->special_day_date;
        $insert_special_day->special_day_remark = $request->special_day_remark;
        $insert_special_day->special_day_status = '1';
        $insert_special_day->save();

        return response()->json(['message' => 'อัพเดต วันที่ OT'], 200);
    }

    public function Setting_Team(Request $request)
    {
        return view('page/setting_team');
    }

    public function Get_Card_Setting_Team(Request $request)
    {
        $get_team = team::whereIn('team_id', explode(',', $request->team_id))->get();

        return response()->json([
            'message' => 'ดึงข้อมูล ทีม',
            'data_team' => $get_team,
        ], 200);  
    }

    public function Save_Setting_Team(Request $request)
    {
        $update_team = team::find($request->team_id);
        $update_team->team_name = $request->team_name;
        $update_team->team_location = $request->team_location;
        $update_team->team_day_off = implode(',', $request->team_day_off);
        $update_team->team_late_of_work = $request->team_late_of_work;
        $update_team->save();

        return response()->json([
            'message' => 'อัพเดต ข้อมูลทีม สำเร็จ'
        ], 200);  
    }

    public function Save_Create_Team(Request $request)
    {
        $insert_team = new team;
        $insert_team->team_name = $request->team_name;
        $insert_team->team_location = $request->team_location;
        $insert_team->team_day_off = implode(',', $request->team_day_off);
        $insert_team->team_late_of_work = $request->team_late_of_work;
        $insert_team->save();

        return response()->json([
            'message' => 'สร้าง ข้อมูลทีม สำเร็จ'
        ], 200);  
    }

    public function Setting_User(Request $request)
    {
        return view('page/setting_user');
    }

    public function Get_Select_Team(Request $request)
    {
        $data = team::get();

        return response()->json([
            'message' => 'ดึงข้อมูลสำเร็จ',
            'data' => $data
        ], 200);  
    }

    public function Get_Table_Setting_User(Request $request)
    {
        $data = User::get();  

        return Datatables::of($data)
            ->editColumn('view_show', function($data) {
                // เช็คข้อมูล Team
                $get_team = team::whereIn('team_id', explode(',', $data->view_show))->get();
                foreach ($get_team as $key => $row) {
                    $team_name[] = $row->team_name;
                }

                return implode(',', $team_name);
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-sm btn-warning" user_id="'.$data->id. '" onclick="Open_Edit_User(this)"><i class="fas fa-edit"></i> แก้ไขข้อมูล</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function Save_Create_User(Request $request)
    {
        if (isset($request->username) && isset($request->password) && isset($request->name)) {
            $insert_user = new User;
            $insert_user->name = $request->name;
            $insert_user->username = $request->username;
            $insert_user->password = Hash::make($request->password);
            $insert_user->type = $request->type;
            $insert_user->view_show = implode(',', $request->view_show);
            $insert_user->save();     
            return response()->json(['message' => 'สมัครสมาชิก สำเร็จ'],200);
        } else {
            return response()->json(['message' => 'Parameter ไม่ครบ'],400);
        }
    }

    public function Get_User_Data(Request $request)
    {
        $get_user = User::where('id', $request->user_id)->first();

        return response()->json([
            'message' => 'ดึงข้อมูลสำเร็จ',
            'data' => $get_user
        ], 200);  
    }

    public function Save_Edit_User(Request $request)
    {
        $update_user = User::find($request->user_id);
        $update_user->name = $request->name;
        $update_user->type = $request->type;
        $update_user->view_show = implode(',', $request->view_show);
        $update_user->save();

        return response()->json(['message' => 'อัพเดขข้อมูล สำเร็จ'],200);
    }
}
