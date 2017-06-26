<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$redis = require(__DIR__ . '/redis.php');

$config = [
    'id' => 'basic',
    'name' => 'Admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'   => 'zh-CN',
    "modules" => [
        "admin" => [
            "class" => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/main.php',
            'layout' => 'left-menu',
        ]
    ],
    "aliases" => [
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*'
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'F9Z6wEHuAdb8nX9d7dzInsiZXD5yU-k6',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile'=>'@runtime/logs/abnormal.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile'=>'@runtime/logs/normal.log',
                    'levels' => ['info','profile'],
                    'logVars'=>['_GET', '_POST', '_COOKIE']
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile'=>'@runtime/logs/app.log',
                    'levels' => ['trace'],
                    'logVars'=>['_GET', '_POST', '_COOKIE']
                ],
            ],
        ],
        'db' => $db,
        'redis' => $redis,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'common' => 'common.php'
                    ],
                ],
                'button' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'button' => 'button.php'
                    ],
                ],
                'menu' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'menu' => 'menu.php'
                    ],
                ],
            ],
        ]
    ],
    'params' => $params,
];

if (!YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
