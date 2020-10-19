<?php

namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\employee as employee;
use App\Models\team as team;

class DashboardController extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('page\dashboard');
    }

    public function Get_Employee_All(Request $request)
    {
        if (Auth::user()->view_show != null) {
            $view_show = Auth::user()->view_show;
            $get_emp = employee::whereIn('employee.emp_team', explode(',', $view_show))->get();
            $get_team = team::whereIn('team_id', explode(',', $view_show))->get();
             return response()->json([
                'message' => 'ดึงข้อมูลสำเร็จ',
                'data_emp' => $get_emp,
                'data_team' => $get_team
            ], 200);            
        }else {
            return response()->json([
                'message' => 'Parameter ไม่ครบ'
            ], 400); 
        }
    }
}
