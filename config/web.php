<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language' => 'id_ID',
    'name' => 'AM<span>SYS</span>',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'dashboard/index',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            // 'layout' => 'top-menu', // available value 'left-menu', 'right-menu', 'top-menu'
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField' => 'user_id'
                ]
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => null, // disable menu
            ],
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ab1kxBZ8qB00zyQhBZkv75uQjlQvpvHL',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
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
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                      // 'pasar' => 'pasar',
                      'websvc8000' => 'websvc8000',
                      'websvc8010' => 'websvc8010',
                      // 'websvc8020' => 'websvc8020',
                      // 'websvc8030' => 'websvc8030',
                      'websvc8040' => 'websvc8040',
                    ],
                    'extraPatterns' => [ // patterns
                        'OPTIONS check-update' => 'options',
                        'OPTIONS daftar-provinsi' => 'options',
                        'OPTIONS daftar-kabupatenkota' => 'options',
                        'OPTIONS daftar-kecamatan' => 'options',
                        'OPTIONS daftar-desakelurahan' => 'options',
                        'OPTIONS daftar-komoditas' => 'options',
                        'OPTIONS daftar-varietas' => 'options',
                        'OPTIONS daftar-jenis' => 'options',
                        'OPTIONS daftar-jenis-bobot-kering' => 'options',
                        'OPTIONS daftar-pasar' => 'options',
                        'OPTIONS daftar-pasar-tag' => 'options',
                        'OPTIONS daftar-petani' => 'options',
                        'OPTIONS daftar-proposal' => 'options',
                        'OPTIONS daftar-survey-tanam' => 'options',
                        'OPTIONS tambah-petani' => 'options',
                        'OPTIONS tambah-proposal' => 'options',
                        'OPTIONS tambah-survey-tanam' => 'options',
                        'OPTIONS ganti-password' => 'options',
                        //'OPTIONS daftar-produksi' => 'options',
                    ],
                ]
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd-MM-yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'IDR',
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*',
            'site/*', // add or remove allowed actions to this list
            'dashboard/index',
            'websvc8000/*',
            'websvc8010/*',
            'websvc8040/*',
            'websvc-auth/*',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
