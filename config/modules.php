<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled Modules
    |--------------------------------------------------------------------------
    |
    | This option controls what modules/packages/plugins are enabled.
    |
    */
    'enabled' => [
        'Pluma',
        // 'Post',
        // 'User',
        // 'Auth',
        'Scheduler',
        'Client',
        'Employee',
        'Department',
        'Type',
        // 'Role',
        // 'Settings',
    ],

    /*
    |--------------------------------------------------------------------------
    | Disabled Modules
    |--------------------------------------------------------------------------
    |
    | This option controls what modules/packages/plugins are disabled.
    |
    */
    'disabled' => [],
    /*
    |--------------------------------------------------------------------------
    | Backend / Public Configs
    |--------------------------------------------------------------------------
    |
    */
    'backend' => [
        'prefix' => 'admin',
    ],

    'public' => [
        'prefix' => '',
    ],

    'settings' => [],

    'menus' => [],

    'breadcrumbs' => [],
];