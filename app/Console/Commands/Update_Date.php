<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\finger as finger;
use App\Models\work as work;
use App\Models\employee as employee;

class Update_Date extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_date';

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
        $get_work = work::whereDate('date_work', Carbon::now()->format('Y-m-d'))->get();
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
                // อัพเดต เวลาล่าสุด      
                employee::where('emp_code', (int)$row->emp_code)
                        ->where('emp_team', $row->emp_team)
                        ->update(['emp_work_last' => $data_finger->punch_time]);
            }else if ($check_finger >= '2') {
                // ถ้ามีการหลายรอบ ออกงาน
                $data_finger = finger::whereDate('finger_date', $row->date_work)->where('emp_code', (int)$row->emp_code)->where('emp_team', $row->emp_team)->orderBy('finger_id', 'desc')->first();
                $update_work = work::find($row->work_id);
                $update_work->punch_time_out = $data_finger->punch_time;
                $update_work->save(); 
                // อัพเดต เวลาล่าสุด
                employee::where('emp_code', (int)$row->emp_code)
                        ->where('emp_team', $row->emp_team)
                        ->update(['emp_work_last' => $data_finger->punch_time]);
            }
        }
    }
}
