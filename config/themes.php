<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable or disable the package
    |--------------------------------------------------------------------------
    |
    | Set the value to true or false to enable or disable the package.
    |
    */
    'enable' => env('THEMES_ENABLE', true),

    /*
    |--------------------------------------------------------------------------
    | Default theme provider
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the theme provider connections
    | below you wish to use as your default provider.
    |
    | Available drivers: "file"
    |
    */
    'driver' => 'file',

    /*
    |--------------------------------------------------------------------------
    | Theme providers
    |--------------------------------------------------------------------------
    |
    | Here you may specify configs for each provider.
    |
    */
    'connections' => [

        'file' => [
            'driver'        => 'file',
            'default_theme' => 'default',
            'path'          => base_path('resources/themes'),
        ],

    ],

];
