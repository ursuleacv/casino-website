<?php

namespace Packages\Payments\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // run the main app tasks (because this Kernel class will replace the app Kernel)
        parent::schedule($schedule);

        $schedule->command('process:withdrawals')->everyFiveMinutes();
    }
}
