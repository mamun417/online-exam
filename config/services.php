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

    'facebook' => [
         'client_id' => '906129273056222',
         'client_secret' => '261558c8965e54ce14d78644ba2d7d37',
         'redirect' => 'https://127.0.0.1:8000/login/facebook/callback'
    ],

    /*'google' => [
         'client_id' => '257002395849-hqbrgcngod7iprnb07qdcn4cdv2vab5i.apps.googleusercontent.com',
         'client_secret' => 'SuERtUzVaBLvpmwjEz3Eex1e',
         'redirect' => 'http://127.0.0.1:8000/login/google/callback'
    ],*/

    'google' => [
        'client_id' => '257002395849-oo4sv6g9m4idh7euijlemgs9v4jf2c5g.apps.googleusercontent.com',
        'client_secret' => 'hi6oPUNFxaozctFFQ8rVzMBX',
        'redirect' => 'http://glossybazar.com/demo/medi_spark/login/google/callback'
    ],

    /*'facebook' => [
        'client_id' => '906129273056222',
        'client_secret' => '261558c8965e54ce14d78644ba2d7d37',
        'redirect' => 'https://127.0.0.1:8000/login/facebook/callback'
    ],*/
];
