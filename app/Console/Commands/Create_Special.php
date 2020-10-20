<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Create_Special extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_special';

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
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'X-IBM-Client-Id' => '8860c4bf-3b6c-4b80-9c21-4f85e138e370'
        ])->get('https://apigw1.bot.or.th/bot/public/financial-institutions-holidays/');
        // ดึงข้อมูล Json
        $response->json();
        // วนลูปข้อมูล
        foreach ($response['result']['data'] as $key => $row) {
            if (Carbon::now()->format('Y-m-d') <= $row->Date) {
                $checkdata = special_day::where('special_day_date', $row->Date)->count();
                if($checkdata == '0') {
                    $insert_special_day = new special_day;
                    $insert_special_day->special_day_date = $row->Date;
                    $insert_special_day->special_day_remark = $row->HolidayDescriptionThai;
                    $insert_special_day->special_day_status = '1';
                    $insert_special_day->save();                  
                }
            }
        }
    }
}
