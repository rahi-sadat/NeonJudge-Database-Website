<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('neonjudge:about', function () {
    $this->info('NeonJudge is ready to run local programming contests.');
});
