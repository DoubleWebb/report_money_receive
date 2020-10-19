<?php

namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\employee as employee;
use App\Models\team as team;
use App\Models\work as work;

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

    public function Load_Select_Empolyee(Request $request)
    {
        $get_data = work::select(work::raw('MONTH(date_work) as month, YEAR(date_work) as year, DATE_FORMAT(date_work, "เดือน %m/%Y") as select_month_show, DATE_FORMAT(date_work, "%Y-%m-%d") as select_month_value, emp_code, emp_team'))
                        ->where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)->groupBy('month', 'year')->orderBy('select_month_value', 'desc')->get();

        return $get_data;
    }

    public function Get_Table_Emplyee_Work(Request $request)
    {
        $data = work::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)
                    ->whereMonth('date_work', Carbon::parse($request->select_month)->format('m'))
                    ->whereYear('date_work', Carbon::parse($request->select_month)->format('Y'))->get();

        return Datatables::of($data)
            ->editColumn('date_work', function($data) {
                $date = Carbon::parse($data->date_work)->format('d/m/Y');
                return $date;
            })
            ->editColumn('punch_time_in', function($data) {
                if ($data->punch_time_in == null) {
                    $date = null;
                }else {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $data->punch_time_in)->format('H:i:s d/m/Y');
                }
                return $date;
            })
            ->addColumn('money_of_days', function ($data) {
                $result = '!';
                return $result;
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-sm btn-primary" finger_id="'.$data->finger_id. '" onclick="Choose_A_Reduction(this)"><i class="fas fa-exchange-alt"></i> เปลี่ยนจำนวนเงิน</button>';
            })
            ->rawColumns(['punch_time_in','punch_time_out','action'])
            ->make(true);
    }
}
