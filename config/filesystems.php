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


        'ftp' => [

            'driver' => 'ftp',
            'port' => '21',
            'host' => '192.168.1.12',
            'username' => 'banking',
            'password' => '@Tryphine88!',
            'timeout'  =>'100',


        ],


        'sftp' =>[

            'driver' => 'sftp',
            'port' => '21',
            'host' => '192.168.1.12',
            'username' => 'banking',
            'password' => '@Tryphine88!',
            'timeout'  =>'100',
            'root'     => '/'

            /*'driver'   => 'sftp',
            'port'       => env('SFTP_PORT', '22'),
            'host'     => env('SFTP_HOST','192.168.1.109'),
           // 'username' => env('SFTP_USERNAME','venon'),
            //'password' => env('SFTP_PASSWORD','Pass$123'),
            'root' => '/',
            //'root'     => env('SFTP_ROOT', '/var/www/html/admin/storage/app/public'),
            'timeout'    => env('SFTP_TIMEOUT', '10'),
            'privateKey' => env('SFTP_PRIVATE_KEY_PATH', ''),
            */
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
