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
        $frecuency = getSetting('strict_time_request');

        switch ($frecuency) {
            case '1min':
                $schedule->command('strategies:apply')->everyMinute();
                break;
            case '5min':
                $schedule->command('strategies:apply')->everyFiveMinutes();
                break;
            case '15min':
                $schedule->command('strategies:apply')->everyFifteenMinutes();
                break;
            case '30min':
                $schedule->command('strategies:apply')->everyThirtyMinutes();
                break;
            case '60min':
                $schedule->command('strategies:apply')->hourly();
                break;
            case 'daily':
                $schedule->command('strategies:apply')->daily();
                break;
            case 'weekly':
                $schedule->command('strategies:apply')->weekly();
                break;
            default:
                $schedule->command('strategies:apply')->monthly();
                break;
        }

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
