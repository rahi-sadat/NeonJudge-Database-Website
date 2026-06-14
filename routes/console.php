<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('neonjudge:about', function () {
    $this->info('NeonJudge demo skeleton is ready for database course presentation.');
});
