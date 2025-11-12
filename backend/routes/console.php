<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Message;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $time = now()->format('H:i');

    Message::create([
        'user_id' => 1,
        'content' => "guk guk! saat {$time}"
    ]);
})->everyFifteenMinutes();
