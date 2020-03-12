<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => OneStop\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '587815095855-6k7aq4h55s3e35u6h31iq1qnkhmsshnu.apps.googleusercontent.com',
        'client_secret' => 'xRBC6yAB_KTnSkDtSTR6zldg',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

    'twitter' => [
        'client_id' => 'DviId5xVVxwR27HC2nxeMnE26',
        'client_secret' => 'fCb2OIXsIFBtV2CCIsfAZGf9hVgzIHNQEyAX5yQX7v6oykV404',
        'redirect' => 'http://localhost:8000/login/twitter/callback',
    ],

    

];
