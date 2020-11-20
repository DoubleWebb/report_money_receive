<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\finger as finger;
use App\Models\work as work;
use App\Models\employee as employee;
use App\Models\setting as setting;

class Setting_Work extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting_work';

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
        $day_in_month = Carbon::now()->daysInMonth;
        setting::where('setting_name', 'work_in_days')->update(['setting_value' => $day_in_month]);
    }
}
