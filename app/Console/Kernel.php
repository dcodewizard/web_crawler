<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * php version 7.4
 *
 * @category Web_Framework
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 *
 * @category Controller
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule comment.
     * 
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('crawl:homepage-links')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        include base_path('routes/console.php');
    }
}
