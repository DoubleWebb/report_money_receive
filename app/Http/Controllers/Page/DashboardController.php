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

    public function Load_Empolyee_Data(Request $request)
    {
        $get_employee = employee::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)->first();

        return $get_employee;
    }

    public function Load_Dashboard_Data(Request $request)
    {
        $work_in_days = Carbon::parse($request->select_month)->daysInMonth;
        $count_in_work_days = work::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)
                            ->whereMonth('date_work', Carbon::parse($request->select_month)->format('m'))
                            ->whereYear('date_work', Carbon::parse($request->select_month)->format('Y'))
                            ->where('work_status', '1')->count();
        $count_not_in_work_days = work::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)
                            ->whereMonth('date_work', Carbon::parse($request->select_month)->format('m'))
                            ->whereYear('date_work', Carbon::parse($request->select_month)->format('Y'))
                            ->whereNull('punch_time_in')->where('work_status', '0')->count();
        $count_ot_days = work::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)
                            ->whereMonth('date_work', Carbon::parse($request->select_month)->format('m'))
                            ->whereYear('date_work', Carbon::parse($request->select_month)->format('Y'))
                            ->where('work_bonus_status', '1')->count();
        $sum_money_days = work::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)
                            ->whereMonth('date_work', Carbon::parse($request->select_month)->format('m'))
                            ->whereYear('date_work', Carbon::parse($request->select_month)->format('Y'))
                            ->sum('work_day_money');

        $block_1 = $count_in_work_days.' / '.$work_in_days.' วัน';
        $block_2 = $count_not_in_work_days.' วัน';
        $block_3 = $count_ot_days.' วัน';
        $block_4 = number_format($sum_money_days, 2).' บาท';

        $data = array(
            'bloack_1' => $block_1,
            'block_2' => $block_2,
            'block_3' => $block_3,
            'block_4' => $block_4
        );

        return response()->json(['massage' => 'ดึงข้อมูลสำเร็จ', 'data' => $data], 200);
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
            ->editColumn('punch_time_out', function($data) {
                if ($data->punch_time_out == null) {
                    $date = null;
                }else {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $data->punch_time_out)->format('H:i:s d/m/Y');
                }
                return $date;
            })
            ->editColumn('work_day_money', function ($data) {
                $get_employee = employee::where('emp_code', $data->emp_code)->where('emp_team', $data->emp_team)->first();
                if ($data->work_day_money == null OR $data->work_day_money == '0') {
                    if($get_employee->emp_salary == null) {
                        $result = 'ยังไม่ได้กรอกเงินเดือน';
                    }else {
                        $result = null;
                    }
                }else {
                    $result = $data->work_day_money;
                }
                return $result;
            })
            ->addColumn('work_text_status', function ($data) {
                // เช็ค สถานะ แต่ล่ะวัน
                if($data->work_status == '1' AND $data->work_status_remark == '0'){
                    // ทำงานปกติ
                    $text_status = 'ทำงานปกติ';
                }else if ($data->work_status == '1' AND $data->work_status_remark == '1') {
                    $text_status = 'วันหยุด ประจำ สัปดา';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '2') {
                    $text_status = 'ลา';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '3') {
                    $text_status = 'ป่วย';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '4') {
                    $text_status = 'เปลี่ยนวันหยุด';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '5') {
                    $text_status = 'หักเงิน 75%';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '6') {
                    $text_status = 'หักเงิน 50%';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '7') {
                    $text_status = 'หักเงิน 25%';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '0') {
                    $text_status = 'ขาดงาน';
                }

                return $text_status;
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-sm btn-primary" work_id="'.$data->work_id. '" onclick="Choose_A_Reduction(this)"><i class="fas fa-exchange-alt"></i> เปลี่ยนจำนวนเงิน</button>';
            })
            ->rawColumns(['punch_time_in','punch_time_out','action'])
            ->make(true);
    }

    public function Save_Choose_A_Reduction(Request $request)
    {
        work::where('work_id', $request->work_id)->update(['work_status_remark' => $request->choose_a_reduction]);

        return response()->json(['massage' => 'อัพเดตสำเร็จ รอ คำนวนเงิน Auto'], 200);
    }
}
