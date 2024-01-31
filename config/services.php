<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'dotapi' => [
        'disabled' => env('DOTAPI_DISABLED', false),
        'xuid_disabled' => env('DOTAPI_XUID_DISABLED', false),
        'key' => env('DOTAPI_KEY'),
        'domain' => env('DOTAPI_DOMAIN', 'https://grunt.api.dotapi.gg'),
        'version' => env('DOTAPI_VERSION', '2023-06-24'),
        'cooldown' => env('DOTAPI_COOLDOWN', 120),
        'competitive' => [
            'key' => env('DOTAPI_CURRENT_SEASON_KEY', '6-1'),
            'season' => env('DOTAPI_CURRENT_SEASON', 6),
        ],
        'warning_message' => env('DOTAPI_WARNING_MESSAGE'),
    ],

    'faceit' => [
        'key' => env('FACEIT_KEY'),
        'domain' => env('FACEIT_DOMAIN', 'https://open.faceit.com'),
        'webhook' => [
            'secret' => env('FACEIT_WEBHOOK_SECRET', ''),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],

    'tinify' => [
        'key' => env('IMAGE_OPTIMIZE_KEY'),
        'domain' => env('IMAGE_DOMAIN', 'https://api.tinify.com'),
    ],

    'sentry' => [
        'crons' => [
            'pull-metdata' => env('SENTRY_CRON_PULL_METADATA', 'e84010bc-19d7-4586-85b8-9c12855a2329'),
            'refresh-analytics' => env('SENTRY_CRON_REFRESH_ANALYTICS', '0c5b14b2-9929-45ec-b661-69ce66341e9d'),
        ],
    ],

    'halo' => [
        'playlists' => [
            'bot-bootcamp' => env('HALO_PLAYLISTS_BOT_BOOTCAMP', 'a446725e-b281-414c-a21e-31b8700e95a1'),
        ],
        'botfarmer_threshold' => env('HALO_BOTFARMER_THRESHOLD', .50),
    ],

];
