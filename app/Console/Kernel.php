<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Jobs\UpdatePostData;
use App\Jobs\UpdatePostInsights;
use App\Jobs\UpdateStories;
use App\Jobs\UpdateSocialMediaData;
use App\Jobs\NotificationsJob;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new UpdatePostData)->everyFiveMinutes();
        $schedule->job(new UpdatePostInsights)->everyFiveMinutes();
        $schedule->job(new UpdateStories)->everyFiveMinutes();
        $schedule->job(new UpdateSocialMediaData)->everyFiveMinutes();
        $schedule->job(new NotificationsJob)->everyMinute();
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
