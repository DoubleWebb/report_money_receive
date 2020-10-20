<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\employee as employee;
use App\Models\work as work;
use App\Models\setting as setting;

class Update_Money_Date extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_money_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $check_work = work::whereMonth('date_work', Carbon::now()->format('m'))
                            ->whereYear('date_work', Carbon::now()->format('Y'))->get();       
        foreach ($check_work as $key => $row) {
            $check_salary_emp = employee::where('emp_code', $row->emp_code)->where('emp_team', $row->emp_team)->first();
            $setting_days = setting::where('setting_name', 'work_in_days')->first();
            // ถ้ามีการตั้งค่า เงินเดือนของ พนักงาน
            if ($check_salary_emp->emp_salary != null) {
                if ($row->work_bonus_status == '1') {
                    // แบบ มี โบนัส
                    if ($row->work_status == '1' AND $row->work_status_remark == '0') {
                        // เข้าทำงาน ปกติ
                        $sum_money_days = $check_salary_emp->emp_salary / $setting_days->setting_value * '2';
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }else {
                        // ไม่เข้าทำงาน หรือ วันหยุด
                        $sum_money_days = $check_salary_emp->emp_salary / $setting_days->setting_value * '1';
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }
                }else {
                    // แบบ ไม่มี โบนัส
                    if ($row->work_status == '1' AND $row->work_status_remark == '0') { 
                        // ได้เงินเต็ม
                        $sum_money_days = $check_salary_emp->emp_salary / $setting_days->setting_value;
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }else if ($row->work_status == '1' AND $row->work_status_remark == '1') {
                        // วันหยุด
                        $sum_money_days = $check_salary_emp->emp_salary / $setting_days->setting_value;
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }else if ($row->work_status == '1' AND $row->work_status_remark == '3') {
                        // ได้เงิน 25%
                        $sum_money = $check_salary_emp->emp_salary / $setting_days->setting_value;
                        $sum_money_days = $sum_money / 100 * 25;
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }else if ($row->work_status == '1' AND $row->work_status_remark == '4') {
                        // ได้เงิน 50%
                        $sum_money = $check_salary_emp->emp_salary / $setting_days->setting_value;
                        $sum_money_days = $sum_money / 100 * 50;
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }else if ($row->work_status == '1' AND $row->work_status_remark == '5') {
                        // ได้เงิน 75%
                        $sum_money = $check_salary_emp->emp_salary / $setting_days->setting_value;
                        $sum_money_days = $sum_money / 100 * 75;
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }else {
                        // ไม่ได้เงิน
                        $sum_money_days = '0';
                        work::where('work_id', $row->work_id)->update(['work_day_money' => $sum_money_days]);
                    }
                }
            }
        }
    }
}
