<?php

namespace App\Console;

use App\Console\Commands\CleanExpiredEmailVerifications;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        CleanExpiredEmailVerifications::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(CleanExpiredEmailVerifications::class)->daily();
    }


    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
