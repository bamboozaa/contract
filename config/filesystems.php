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

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'sftp' => [
            'driver' => 'sftp',
            'host' => env('NAS_SFTP_HOST'),
            'username' => env('NAS_SFTP_USER'),
            'password' => env('NAS_SFTP_PASSWORD'),
            'port' => (int) env('NAS_SFTP_PORT', 22),
            'root' => env('NAS_SFTP_ROOT'),
            'timeout' => (int) env('NAS_SFTP_TIMEOUT', 30),
            // Use NAS_URL when set; otherwise fall back to APP_URL. Trim trailing slash if present.
            'url' => rtrim(env('NAS_URL', env('APP_URL')), '/') . '/Uploads/contracts',
        ],

        // Alias disk for NAS uploads. Use UPLOAD_DISK=nas_sftp to point
        // application uploads to the NAS without changing code.
        'nas_sftp' => [
            'driver' => 'sftp',
            'host' => env('NAS_SFTP_HOST'),
            'username' => env('NAS_SFTP_USER'),
            'password' => env('NAS_SFTP_PASSWORD'),
            'port' => (int) env('NAS_SFTP_PORT', 22),
            'root' => env('NAS_SFTP_ROOT'),
            'timeout' => (int) env('NAS_SFTP_TIMEOUT', 30),
            // Use NAS_URL when set; otherwise fall back to APP_URL. Trim trailing slash if present.
            'url' => rtrim(env('NAS_URL', env('APP_URL')), '/') . '/Uploads/contracts',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
