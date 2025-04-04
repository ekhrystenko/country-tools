<?php

return [
    'json_path' => env('COUNTRY_JSON_PATH') && file_exists(env('COUNTRY_JSON_PATH'))
        ? env('COUNTRY_JSON_PATH')
        : realpath(__DIR__ . '/../../countries.json'),
];