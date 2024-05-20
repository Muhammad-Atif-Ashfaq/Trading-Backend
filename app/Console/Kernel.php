<?php

namespace App\Console;

use App\Console\Commands\CheckLiveOrders;
use App\Console\Commands\CheckMarginLevels;
use App\Console\Commands\CheckPaddingOrders;
use App\Console\Commands\CheckStopOutLevels;
use App\Console\Commands\SaveBinanceHistory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CheckInactiveAccounts;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\CheckInactiveAccounts::class,
        Commands\CheckMarginLevels::class,
        Commands\CheckStopOutLevels::class,
        Commands\SaveBinanceHistory::class,
        Commands\CheckPaddingOrders::class,
        Commands\CheckLiveOrders::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command(CheckInactiveAccounts::class)->everyMinute();
        $schedule->command(CheckMarginLevels::class)->everyMinute();
        $schedule->command(CheckStopOutLevels::class)->everyMinute();
        $schedule->command(SaveBinanceHistory::class)->everyMinute();
        $schedule->command(CheckPaddingOrders::class)->everySecond();
        $schedule->command(CheckLiveOrders::class)->everySecond();
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
