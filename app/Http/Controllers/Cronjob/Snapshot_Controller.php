<?php

namespace App\Http\Controllers\Cronjob;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employee as employee;
use App\Models\work as work;
use App\Models\snapshot as snapshot;

class Snapshot_Controller extends Controller
{
    public function SnapShot_Month(Request $request)
    {
        $get_employee = employee::where('emp_status', '1')->get();
        //
        foreach ($get_employee as $key => $row) {
            // เช็คว่ามีข้อมูลรายเดือนแล้วหรือยัง
            $snap_month_count = snapshot::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)->whereMonth('month_snapshot', Carbon::now()->format('m'))
                                    ->whereYear('month_snapshot', Carbon::now()->format('Y'))->count();
            $work_in_days = Carbon::parse(Carbon::now())->daysInMonth;
            $count_in_work_days = work::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)
                                ->whereMonth('date_work', Carbon::parse(Carbon::now())->format('m'))
                                ->whereYear('date_work', Carbon::parse(Carbon::now())->format('Y'))
                                ->where('work_status', '1')->count();
            $count_not_in_work_days = work::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)
                                ->whereMonth('date_work', Carbon::parse(Carbon::now())->format('m'))
                                ->whereYear('date_work', Carbon::parse(Carbon::now())->format('Y'))
                                ->where('work_status', '0')->where('work_status_remark', '0')->count();
            $count_ot_days = work::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)
                                ->whereMonth('date_work', Carbon::parse(Carbon::now())->format('m'))
                                ->whereYear('date_work', Carbon::parse(Carbon::now())->format('Y'))
                                ->where('work_bonus_status', '1')->count();
            $sum_money_days = work::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)
                                ->whereMonth('date_work', Carbon::parse(Carbon::now())->format('m'))
                                ->whereYear('date_work', Carbon::parse(Carbon::now())->format('Y'))
                                ->sum('work_day_money');
            $money_of_day = $row->emp_salary / $work_in_days;
            // ถ้าไม่มีการสร้าง ให้สร้างข้อมูลก่อน
            if ($snap_month_count == '0') {
                $insert_snap = new snapshot;
                $insert_snap->emp_code = $row->emp_code;
                $insert_snap->emp_team = $row->emp_team;
                $insert_snap->month_snapshot = Carbon::now()->format("Y-m-01");
                $insert_snap->day_work_in = $count_in_work_days;
                $insert_snap->day_work_not_in = $count_not_in_work_days;
                $insert_snap->day_work_ot = $count_ot_days;
                $insert_snap->work_in_days = $work_in_days;
                $insert_snap->money_of_day = $money_of_day;
                $insert_snap->total_money = $sum_money_days;
                $insert_snap->month_salary = $row->emp_salary;
                $insert_snap->save(); 
            }else {
                $snap_data = snapshot::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)->whereMonth('month_snapshot', Carbon::now()->format('m'))
                                    ->whereYear('month_snapshot', Carbon::now()->format('Y'))->first();
                $update_snap = snapshot::find($snap_data->snapshot_id);
                $update_snap->month_snapshot = Carbon::now()->format("Y-m-01");
                $update_snap->day_work_in = $count_in_work_days;
                $update_snap->day_work_not_in = $count_not_in_work_days;
                $update_snap->day_work_ot = $count_ot_days;
                $update_snap->work_in_days = $work_in_days;
                $update_snap->money_of_day = $money_of_day;
                $update_snap->total_money = $sum_money_days;
                $update_snap->month_salary = $row->emp_salary;
                $update_snap->save();
            }
        }
    }
}
