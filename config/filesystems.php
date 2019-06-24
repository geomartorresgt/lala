<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

        'foto_perfil' => [
            'driver' => 'local',
            'root' => storage_path('app/public/img/foto_perfil'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'muebles' => [
            'driver' => 'local',
            'root' => storage_path('app/public/muebles'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'foto_muebles' => [
            'driver' => 'local',
            'root' => storage_path('app/public/foto_muebles'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'editor_capturas' => [
            'driver' => 'local',
            'root' => storage_path('app/public/editor/capturas'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'logo_locales' => [
            'driver' => 'local',
            'root' => storage_path('app/public/logo_locales'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'texturas' => [
            'driver' => 'local',
            'root' => storage_path('app/public/texturas'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

    ],

];
