<?php

return [
    # Define your application mode here
    'mode' => 'sandbox',

    # Account credentials from developer portal
    'account' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'AWxcH7QeWSd2cdF76Y4_-UXao5QXS4koEmK6mqutZVG_20dC_JGAhm8qhcV-Mgyb-kPj0qq_wo60J1ZL'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', 'ELZtvExeYlusc_JLvN-QtCOfgQyYeHP-UfYMSMCz-AUQpIM23Y2CLZRxWosF2lQbnNSclWvr1wTjNGgS'),
    ],

    # Connection Information
    'http' => [
        'connection_time_out' => 30,
        'retry' => 1,
    ],

    # Logging Information
    'log' => [
        'log_enabled' => true,

        # When using a relative path, the log file is created
        # relative to the .php file that is the entry point
        # for this request. You can also provide an absolute
        # path here
        'file_name' => '../PayPal.log',

        # Logging level can be one of FINE, INFO, WARN or ERROR
        # Logging is most verbose in the 'FINE' level and
        # decreases as you proceed towards ERROR
        'log_level' => 'FINE',
    ],
];
