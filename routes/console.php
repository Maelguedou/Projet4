<?php
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\FreeExpiredSalles;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
// Exécution toutes les 5 minutes
Schedule::command(FreeExpiredSalles::class)->everyFiveMinutes();