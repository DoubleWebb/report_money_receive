<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\create_date',
        'App\Console\Commands\create_special',
        'App\Console\Commands\setting_work',
        'App\Console\Commands\update_date',
        'App\Console\Commands\update_money_date',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('create_date')->everyMinute();
        $schedule->command('create_special')->everyMinute();
        $schedule->command('setting_work')->everyMinute();
        $schedule->command('update_date')->everyMinute();
        $schedule->command('update_money_date')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
