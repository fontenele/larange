<?php

$env = $app->detectEnvironment(function() {
    $environmentPath = __DIR__.'/../.env';
    if (file_exists($environmentPath)) {
        $setEnv = trim(file_get_contents($environmentPath));
        putenv("APP_ENV={$setEnv}");
        if (getenv('APP_ENV') && file_exists(__DIR__.'/../.'.getenv('APP_ENV').'.env')) {
            Dotenv::load(__DIR__ . '/../', '.' . getenv('APP_ENV') . '.env');
        }
    }
});