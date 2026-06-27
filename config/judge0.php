<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Judge0 API
    |--------------------------------------------------------------------------
    |
    | For a local Judge0 server, use: http://127.0.0.1:2358
    | Keep the API key empty when you run Judge0 on your own machine.
    |
    */

    'url' => env('JUDGE0_URL', ''),
    'api_key' => env('JUDGE0_API_KEY', ''),

    'languages' => [
        54 => 'C++',
        50 => 'C',
        62 => 'Java',
        71 => 'Python',
        68 => 'PHP',
    ],
];
