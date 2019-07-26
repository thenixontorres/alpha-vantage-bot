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
        'app\Console\Commands\DumpAutoload',
        'app\Console\Commands\ApplyStrategiesCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('strategies:apply', ['interval', '1min'])->everyMinute();
        $schedule->command('strategies:apply', ['interval', '5min'])->everyFiveMinutes();
        $schedule->command('strategies:apply', ['interval', '15min'])->everyFifteenMinutes();
        $schedule->command('strategies:apply', ['interval', '30min'])->everyThirtyMinutes();
        $schedule->command('strategies:apply', ['interval', '60min'])->hourly();
        $schedule->command('strategies:apply', ['interval', 'daily'])->daily();
        $schedule->command('strategies:apply', ['interval', 'weekly'])->weekly();
        $schedule->command('strategies:apply', ['interval', 'monthly'])->monthly();
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
