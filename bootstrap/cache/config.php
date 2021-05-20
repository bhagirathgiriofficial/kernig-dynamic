<?php return array (
  'activitylog' => 
  array (
    'enabled' => true,
    'delete_records_older_than_days' => 365,
    'default_log_name' => 'default',
    'default_auth_driver' => NULL,
    'subject_returns_soft_deleted_models' => false,
    'activity_model' => 'Spatie\\Activitylog\\Models\\Activity',
    'table_name' => 'activity_logs',
    'database_connection' => NULL,
  ),
  'app' => 
  array (
    'name' => 'Kernig Krafts',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost/bagtesh',
    'asset_url' => NULL,
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:0R10EDgNawwqp1X0vK0kUJo4ZKVx9xzxRj41uQZpuDQ=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      23 => 'ZanySoft\\Zip\\ZipServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\EventServiceProvider',
      27 => 'App\\Providers\\RouteServiceProvider',
      28 => 'Spatie\\Permission\\PermissionServiceProvider',
      29 => 'Collective\\Html\\HtmlServiceProvider',
      30 => 'Laravolt\\Avatar\\ServiceProvider',
      31 => 'Intervention\\Image\\ImageServiceProvider',
      32 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      33 => 'Barryvdh\\Cors\\ServiceProvider',
      34 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      35 => 'Edujugon\\PushNotification\\Providers\\PushNotificationServiceProvider',
      36 => 'Laravel\\Socialite\\SocialiteServiceProvider',
      37 => 'Chencha\\Share\\ShareServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Illuminate\\Html\\FormFacade',
      'Html' => 'Illuminate\\Html\\HtmlFacade',
      'Avatar' => 'Laravolt\\Avatar\\Facade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'PushNotification' => 'Edujugon\\PushNotification\\Facades\\PushNotification',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'Share' => 'Chencha\\Share\\ShareFacade',
      'Zip' => 'ZanySoft\\Zip\\ZipFacade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'frontend' => 
      array (
        'driver' => 'session',
        'provider' => 'frontendusers',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Model\\AdminUser\\AdminUser',
      ),
      'frontendusers' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Model\\User\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'frontend' => 
      array (
        'provider' => 'frontendusers',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'kernig_krafts_cache',
  ),
  'constants' => 
  array (
    'adminUsers' => 
    array (
      'images_path' => 'public/uploads/images/admin-users/',
    ),
    'category' => 
    array (
      'images_path' => 'public/uploads/images/categories/',
      'sizeChart_path' => 'public/uploads/images/categories/sizeChart/',
    ),
    'gallary' => 
    array (
      'images_path' => 'public/uploads/images/gallary/',
    ),
    'measurement' => 
    array (
      'images_path' => 'public/uploads/images/measurement/chart/',
    ),
    'salwarMeasurement' => 
    array (
      'images_path' => 'public/uploads/images/measurement/salwar-measurement/',
    ),
    'blouseDesign' => 
    array (
      'images_path' => 'public/uploads/images/blouse-desgin/',
    ),
    'slider' => 
    array (
      'images_path' => 'public/uploads/images/slider/',
    ),
    'page' => 
    array (
      'images_path' => 'public/uploads/images/page/',
    ),
    'testimonials' => 
    array (
      'images_path' => 'public/uploads/images/testimonials/original/',
      'thumb_images_path' => 'storage/app/public/uploads/images/testimonials/',
      'images_path_thumb' => 'public/uploads/images/testimonials/',
    ),
    'homePage' => 
    array (
      'images_path' => 'public/uploads/images/homepage/',
      'images_path_thumb' => 'public/uploads/images/homepage/thumb/',
    ),
    'accountSetting' => 
    array (
      'images_path' => 'public/uploads/images/account-setting/',
    ),
    'homePageContent' => 
    array (
      'images_path' => 'public/uploads/images/homepage/',
      'thumb_images_path' => 'storage/app/public/uploads/images/homepage/thumb/',
    ),
    'products' => 
    array (
      'images_path' => 'public/uploads/images/product/product_image/',
      'thumb_images_path' => 'public/uploads/images/product/product_image/thumb/',
      'images_path_thumb' => 'public/uploads/images/product/product_image/thumb/',
      'zip_path' => 'public/uploads/zip/product/',
      'imageszoom_path' => 'public/uploads/images/product/product_imagezoom/',
    ),
    'productExcel' => 
    array (
      'download_path' => 'public/storage/downloads/product-excel/',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'kernig',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'kernig',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'kernig',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'kernig',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'predis',
        'prefix' => 'kernig_krafts_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'elastcoder' => 
  array (
    'encodings' => 
    array (
      'example' => 
      array (
        'type' => 1,
        'PresetId' => '',
        'width' => 1920,
        'height' => 1080,
        'aspect' => '16:9',
        'ext' => 'mp4',
        'PipelineId' => '1434059450461-nfuqq4',
        'Watermarks' => 
        array (
          0 => 
          array (
            'PresetWatermarkId' => 'BottomRight',
            'InputKey' => '1080.png',
          ),
        ),
        'TimeSpan' => 
        array (
          'StartTime' => '0.4',
          'Duration' => '5.3',
        ),
      ),
    ),
    'audio' => 
    array (
      'PipelineId' => '',
      'PresetId' => '',
      'StartTime' => '',
      'Duration' => '',
      'container' => 'mp3',
      'OutputKeyPrefix' => '',
      'AlbumArtMerge' => 'Fallback',
      'AlbumArtMaxWidth' => '',
      'AlbumArtMaxHeight' => '',
      'AlbumArtSizingPolicy' => '',
      'AlbumArtFormat' => '',
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\app/public',
        'url' => 'http://localhost/bagtesh/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'visibility' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'laravolt' => 
  array (
    'avatar' => 
    array (
      'driver' => 'gd',
      'generator' => 'Laravolt\\Avatar\\Generator\\DefaultGenerator',
      'ascii' => false,
      'shape' => 'circle',
      'width' => 100,
      'height' => 100,
      'chars' => 2,
      'fontSize' => 38,
      'uppercase' => true,
      'fonts' => 
      array (
        0 => 'C:\\xampp\\htdocs\\kernig-dynamic\\config\\laravolt/../fonts/OpenSans-Bold.ttf',
        1 => 'C:\\xampp\\htdocs\\kernig-dynamic\\config\\laravolt/../fonts/rockwell.ttf',
      ),
      'foregrounds' => 
      array (
        0 => '#FFFFFF',
      ),
      'backgrounds' => 
      array (
        0 => '#f44336',
        1 => '#E91E63',
        2 => '#9C27B0',
        3 => '#673AB7',
        4 => '#3F51B5',
        5 => '#2196F3',
        6 => '#03A9F4',
        7 => '#00BCD4',
        8 => '#009688',
        9 => '#4CAF50',
        10 => '#8BC34A',
        11 => '#CDDC39',
        12 => '#FFC107',
        13 => '#FF9800',
        14 => '#FF5722',
      ),
      'border' => 
      array (
        'size' => 0,
        'color' => 'foreground',
      ),
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'giribhagirath169@gmail.com',
      'name' => 'Kernig Krafts',
    ),
    'encryption' => 'tls',
    'username' => 'giribhagirath169@gmail.com',
    'password' => 'bhagirath@google',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\kernig-dynamic\\resources\\views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'paypal' => 
  array (
    'client_id' => 'AWezaWa3Z1Zrpn1t5GNXAvmjCwo8BVfrmXraJrAVMmIVv25awhJNm7FQxzJooicVkf0Z62371VlLYbQH',
    'secret' => 'ECTnRf0vDQtujyHVGs75nEyTHNQ9JjnnZyxcXHC_257x2MGntz6FCt6sjAQ2bx0vQYxhBGreYr4S71Hb',
    'settings' => 
    array (
      'mode' => 'sandbox',
      'http.ConnectionTimeOut' => 10000,
      'log.LogEnabled' => true,
      'log.FileName' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage/logs/paypal.log',
      'log.LogLevel' => 'FINE',
    ),
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'model_morph_key' => 'model_id',
    ),
    'display_permission_in_exception' => false,
    'cache' => 
    array (
      'expiration_time' => 
      DateInterval::__set_state(array(
         'y' => 0,
         'm' => 0,
         'd' => 0,
         'h' => 24,
         'i' => 0,
         's' => 0,
         'f' => 0.0,
         'weekday' => 0,
         'weekday_behavior' => 0,
         'first_last_day_of' => 0,
         'invert' => 0,
         'days' => false,
         'special_type' => 0,
         'special_amount' => 0,
         'have_weekday_relative' => 0,
         'have_special_relative' => 0,
      )),
      'key' => 'spatie.permission.cache',
      'model_key' => 'name',
      'store' => 'default',
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'app_jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'app_failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
      'webhook' => 
      array (
        'secret' => NULL,
        'tolerance' => 300,
      ),
    ),
    'google' => 
    array (
      'client_id' => '306981308891-81s9jpmdsamb60fccc52ravbdri5v0ip.apps.googleusercontent.com',
      'client_secret' => 'TZi_S7GycQjG_p-fEMiHzT20',
      'redirect' => 'http://localhost/kernig-dynamic/google-login/callback',
    ),
    'facebook' => 
    array (
      'client_id' => '3580171038690847',
      'client_secret' => '8c45d91769dc001318039b155dbf7390',
      'redirect' => 'http://localhost/kernig-dynamic/facebook-login/callback',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'kernig_krafts_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'sluggable' => 
  array (
    'source' => NULL,
    'maxLength' => NULL,
    'maxLengthKeepWords' => true,
    'method' => NULL,
    'separator' => '-',
    'unique' => true,
    'uniqueSuffix' => NULL,
    'includeTrashed' => false,
    'reserved' => NULL,
    'onUpdate' => false,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\kernig-dynamic\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\framework\\views',
  ),
  'cors' => 
  array (
    'supportsCredentials' => false,
    'allowedOrigins' => 
    array (
      0 => '*',
    ),
    'allowedOriginsPatterns' => 
    array (
    ),
    'allowedHeaders' => 
    array (
      0 => '*',
    ),
    'allowedMethods' => 
    array (
      0 => '*',
    ),
    'exposedHeaders' => 
    array (
    ),
    'maxAge' => 0,
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'social-share' => 
  array (
    'separator' => '&',
    'services' => 
    array (
      'delicious' => 
      array (
        'uri' => 'https://delicious.com/post',
      ),
      'digg' => 
      array (
        'uri' => 'http://www.digg.com/submit',
      ),
      'email' => 
      array (
        'view' => 'social-share::email',
      ),
      'evernote' => 
      array (
        'uri' => 'http://www.evernote.com/clip.action',
      ),
      'facebook' => 
      array (
        'uri' => 'https://www.facebook.com/sharer/sharer.php',
        'urlName' => 'u',
      ),
      'gmail' => 
      array (
        'uri' => 'https://mail.google.com/mail/',
        'urlName' => 'su',
        'titleName' => 'body',
        'extra' => 
        array (
          'view' => 'cm',
          'fs' => 1,
          'to' => '',
          'ui' => 2,
          'tf' => 1,
        ),
      ),
      'gplus' => 
      array (
        'uri' => 'https://plus.google.com/share',
        'only' => 
        array (
          0 => 'url',
        ),
      ),
      'linkedin' => 
      array (
        'uri' => 'http://www.linkedin.com/shareArticle',
        'extra' => 
        array (
          'mini' => 'true',
        ),
      ),
      'pinterest' => 
      array (
        'uri' => 'http://pinterest.com/pin/create/button/',
        'titleName' => 'description',
        'mediaName' => 'media',
      ),
      'reddit' => 
      array (
        'uri' => 'http://www.reddit.com/submit',
      ),
      'scoopit' => 
      array (
        'uri' => 'http://www.scoop.it/oexchange/share',
      ),
      'telegramMe' => 
      array (
        'uri' => 'https://telegram.me/share/url',
        'titleName' => 'text',
      ),
      'tumblr' => 
      array (
        'uri' => 'http://www.tumblr.com/share',
        'urlName' => 'u',
        'titleName' => 't',
        'extra' => 
        array (
          'v' => 3,
        ),
      ),
      'twitter' => 
      array (
        'uri' => 'https://twitter.com/intent/tweet',
        'titleName' => 'text',
      ),
      'viadeo' => 
      array (
        'uri' => 'http://www.viadeo.com/',
      ),
      'vk' => 
      array (
        'uri' => 'http://vk.com/share.php',
        'mediaName' => 'image',
        'extra' => 
        array (
          'noparse' => 'false',
        ),
      ),
      'whatsapp' => 
      array (
        'view' => 'social-share::whatsapp',
      ),
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'excel' => 
  array (
    'cache' => 
    array (
      'enable' => true,
      'driver' => 'memory',
      'settings' => 
      array (
        'memoryCacheSize' => '32MB',
        'cacheTime' => 600,
      ),
      'memcache' => 
      array (
        'host' => 'localhost',
        'port' => 11211,
      ),
      'dir' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\cache',
    ),
    'properties' => 
    array (
      'creator' => 'Maatwebsite',
      'lastModifiedBy' => 'Maatwebsite',
      'title' => 'Spreadsheet',
      'description' => 'Default spreadsheet export',
      'subject' => 'Spreadsheet export',
      'keywords' => 'maatwebsite, excel, export',
      'category' => 'Excel',
      'manager' => 'Maatwebsite',
      'company' => 'Maatwebsite',
    ),
    'sheets' => 
    array (
      'pageSetup' => 
      array (
        'orientation' => 'portrait',
        'paperSize' => '9',
        'scale' => '100',
        'fitToPage' => false,
        'fitToHeight' => true,
        'fitToWidth' => true,
        'columnsToRepeatAtLeft' => 
        array (
          0 => '',
          1 => '',
        ),
        'rowsToRepeatAtTop' => 
        array (
          0 => 0,
          1 => 0,
        ),
        'horizontalCentered' => false,
        'verticalCentered' => false,
        'printArea' => NULL,
        'firstPageNumber' => NULL,
      ),
    ),
    'creator' => 'Maatwebsite',
    'csv' => 
    array (
      'delimiter' => ',',
      'enclosure' => '"',
      'line_ending' => '
',
      'use_bom' => false,
    ),
    'export' => 
    array (
      'autosize' => true,
      'autosize-method' => 'approx',
      'generate_heading_by_indices' => true,
      'merged_cell_alignment' => 'left',
      'calculate' => false,
      'includeCharts' => false,
      'sheets' => 
      array (
        'page_margin' => false,
        'nullValue' => NULL,
        'startCell' => 'A1',
        'strictNullComparison' => false,
      ),
      'store' => 
      array (
        'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\storage\\exports',
        'returnInfo' => false,
      ),
      'pdf' => 
      array (
        'driver' => 'DomPDF',
        'drivers' => 
        array (
          'DomPDF' => 
          array (
            'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\vendor/dompdf/dompdf/',
          ),
          'tcPDF' => 
          array (
            'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\vendor/tecnick.com/tcpdf/',
          ),
          'mPDF' => 
          array (
            'path' => 'C:\\xampp\\htdocs\\kernig-dynamic\\vendor/mpdf/mpdf/',
          ),
        ),
      ),
    ),
    'filters' => 
    array (
      'registered' => 
      array (
        'chunk' => 'Maatwebsite\\Excel\\Filters\\ChunkReadFilter',
      ),
      'enabled' => 
      array (
      ),
    ),
    'import' => 
    array (
      'heading' => 'slugged',
      'startRow' => 1,
      'separator' => '_',
      'slug_whitelist' => '._',
      'includeCharts' => false,
      'to_ascii' => true,
      'encoding' => 
      array (
        'input' => 'UTF-8',
        'output' => 'UTF-8',
      ),
      'calculate' => true,
      'ignoreEmpty' => false,
      'force_sheets_collection' => false,
      'dates' => 
      array (
        'enabled' => true,
        'format' => false,
        'columns' => 
        array (
        ),
      ),
      'sheets' => 
      array (
        'test' => 
        array (
          'firstname' => 'A2',
        ),
      ),
    ),
    'views' => 
    array (
      'styles' => 
      array (
        'th' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'strong' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'b' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'i' => 
        array (
          'font' => 
          array (
            'italic' => true,
            'size' => 12,
          ),
        ),
        'h1' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 24,
          ),
        ),
        'h2' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 18,
          ),
        ),
        'h3' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 13.5,
          ),
        ),
        'h4' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'h5' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 10,
          ),
        ),
        'h6' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 7.5,
          ),
        ),
        'a' => 
        array (
          'font' => 
          array (
            'underline' => true,
            'color' => 
            array (
              'argb' => 'FF0000FF',
            ),
          ),
        ),
        'hr' => 
        array (
          'borders' => 
          array (
            'bottom' => 
            array (
              'style' => 'thin',
              'color' => 
              array (
                0 => 'FF000000',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
