<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Default Instance Name
   |--------------------------------------------------------------------------
   |
   | Default eupheme instance used when not instance specified
   |
   */
    'default' => env('EUPHEME_DEFAULT_INSTANCE', 'ads'),

    /*
    |--------------------------------------------------------------------------
    | Eupheme Instance
    |--------------------------------------------------------------------------
    |
    | eupheme instance and configurations
    |
    */
    'instances' => [
        'ads' => [
            'base_url' => '',
            'app_key' => '',
            'app_hash' => ''
        ]
    ],

    'user_helper' => \Sanmark\EuphemeLaravelSdk\UserHelper::class,

    'auto_approve' => 0
];