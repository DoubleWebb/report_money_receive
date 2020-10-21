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
use App\Models\holiday as holiday;
use App\Models\special_day as special_day;

class DashboardController extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('page/dashboard');
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
                            ->where('work_status', '0')->where('work_status_remark', '0')->count();
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

        return response()->json(['message' => 'ดึงข้อมูลสำเร็จ', 'data' => $data], 200);
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
                        // ยังไม่ได้กรอกเงินเดือน
                        $result = 'ยังไม่ได้กรอกเงินเดือน';
                    }else {
                        if ($data->work_status == '0' AND $data->work_status_remark == '0') {
                            // ขาดงาน
                            $result = '0 บาท';
                        }else if ($data->work_status == '0' AND $data->work_status_remark == '3') {
                            // ลา ไม่ได้เงิน
                            $result = '0 บาท';
                        }else {
                            // อื่นๆ
                            $result = 'รอการคำนวนเงิน Auto';
                        }
                    }
                }else {
                    // มีจำนวนเงินแล้ว
                    $result = number_format($data->work_day_money, 2).' บาท';
                }
                return $result;
            })
            ->addColumn('work_text_status', function ($data) {
                $special_day_name = special_day::where('special_day_date', $data->date_work)->first();
                $get_late_of_work = team::where('team_id', $data->emp_team)->first();
                // OT
                if ($data->work_bonus_status == '1') {
                    $ot = '<i class="fas fa-splotch" style="color:green" data-toggle="tooltip" data-placement="top" title="'.$special_day_name->special_day_remark.'"></i>';
                }else {
                    $ot = '';
                }
                // เช็ค สถานะ แต่ล่ะวัน
                if($data->work_status == '1' AND $data->work_status_remark == '0'){
                    $date_start = Carbon::parse($data->punch_time_in)->format($get_late_of_work->team_late_of_work);
                    $date_end = Carbon::parse($data->punch_time_in)->format('H:i:s');
                    $Late_for_work = Carbon::parse($date_start)->floatDiffInMinutes($date_end, false); 
                    if($Late_for_work >= '0.1') {
                        $text_status = '<span class="badge badge-warning">เข้าทำงานสาย</span>';
                    }else {
                        $text_status = '<span class="badge badge-success">เข้าทำงาน</span>';
                    }
                }else if ($data->work_status == '1' AND $data->work_status_remark == '1') {
                    $text_status = '<span class="badge badge-primary">วันหยุด ประจำ สัปดา</span>';
                }else if ($data->work_status == '1' AND $data->work_status_remark == '2') {
                    $text_status = '<span class="badge badge-secondary">วันหยุดล่วงหน้า</span>';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '3') {
                    $text_status = '<span class="badge badge-secondary">ลา</span>';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '4') {
                    $text_status = '<span class="badge badge-warning">หักเงิน 75%</span>';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '5') {
                    $text_status = '<span class="badge badge-warning">หักเงิน 50%</span>';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '6') {
                    $text_status = '<span class="badge badge-warning">หักเงิน 25%</span>';
                }else if ($data->work_status == '0' AND $data->work_status_remark == '0') {
                    $text_status = '<span class="badge badge-danger">ขาดงาน</span>';
                }else {
                    $text_status = 'Error ยังไม่ได้ทำ';
                }

                return $ot.' '.$text_status;
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-sm btn-primary" work_id="'.$data->work_id. '" onclick="Choose_A_Reduction(this)"><i class="fas fa-exchange-alt"></i> เปลี่ยนจำนวนเงิน</button>';
            })
            ->rawColumns(['work_text_status','action'])
            ->make(true);
    }

    public function Change_The_Amount(Request $request)
    {
        employee::where('emp_code',$request->emp_code)->where('emp_team',$request->emp_team)->update(['emp_salary' => $request->emp_salary]);

        return response()->json(['message' => 'อัพเดตเงินเดือนสำเร็จ'], 200);
    }

    public function Save_Choose_A_Reduction(Request $request)
    {
        work::where('work_id', $request->work_id)->update(['work_status_remark' => $request->choose_a_reduction]);

        return response()->json(['message' => 'อัพเดตสำเร็จ รอ คำนวนเงิน Auto'], 200);
    }

    public function Get_Table_Holiday_In_Advance(Request $request)
    {
        $data = holiday::where('emp_code', $request->emp_code)->where('emp_team', $request->emp_team)->orderBy('holiday_id', 'desc')->get();
        return Datatables::of($data)
            ->editColumn('holiday_status', function($data) {
                if ($data->holiday_status == '0') {
                    $status = '<span class="badge badge-secondary">รอสร้าง</span>';
                }else if ($data->holiday_status == '1') {
                    $status = '<span class="badge badge-primary">กำลังดำเนินการ</span>';
                }else if ($data->holiday_status == '2') {
                    $status = '<span class="badge badge-success">สร้างเสร็จสิ้น</span>';
                }
                return $status;
            })
            ->addColumn('date_start_and_end', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->holiday_date_start)->format('d/m/Y').' ถึง '.Carbon::createFromFormat('Y-m-d', $data->holiday_date_end)->format('d/m/Y');
            })
            ->rawColumns(['holiday_status'])
            ->make(true);
    }

    public function Save_Holiday_In_Advance(Request $request)
    {
        $array_Date = explode(" ",$request->holiday_date);
        $date_start = $array_Date[0];
        $date_end   = $array_Date[2];
        // insert_holiday
        $insert_holiday = new holiday;
        $insert_holiday->holiday_date_start = $date_start;
        $insert_holiday->holiday_date_end =$date_end;
        $insert_holiday->holiday_remark = $request->holiday_remark;
        $insert_holiday->holiday_status = '0';
        $insert_holiday->emp_code = $request->emp_code;
        $insert_holiday->emp_team = $request->emp_team;
        $insert_holiday->save();

        return response()->json(['message' => 'เพิ่มข้อมูล ลาล่วงหน้า สำเร็จ'], 200);
    }
}
