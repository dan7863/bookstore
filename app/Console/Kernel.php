<?php

namespace App\Console;

use App\Actions\ScheduleTasks\MostPurchasesByMonth;
use App\Actions\ScheduleTasks\NewBookReleases;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(new NewBookReleases)->everyMinute();
        $schedule->call(new MostPurchasesByMonth)->lastDayOfMonth('15:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
