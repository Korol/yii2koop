<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
//    'defaultRoute' => 'site/index',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
        ],
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    /* 'userClassName' => 'app\models\User', */
                    'idField' => 'id',
                    'usernameField' => 'username',
                ],
            ],
            'layout' => 'left-menu',
//            'mainLayout' => '@app/views/layouts/main.php',
            'mainLayout' => '@app/modules/admin/views/layouts/admin.php',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'doRvQh4wsypDj8PNeDAvQMxe07L-xx9s',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl' => ['site/login'],
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
                // категория
                'shop/category/<id:\d+>/<slug:[-\w]+>/<page:\d+>' => 'shop/category', // правила задавать именно в такой последовательности!!!
                'shop/category/<id:\d+>/<slug:[-\w]+>' => 'shop/category', // от более длинного URL - к более короткому!
                'shop/category/<id:\d+>' => 'shop/category',
                'shop' => 'shop/index',
                // товар
                'shop/product/<id:\d+>/<slug:[-\w]+>' => 'shop/product',
                // поиск
                'shop/search/<page:\d+>' => 'shop/search',
                'shop/search' => 'shop/search',
                // новости
                'news/article/<id:\d+>/<slug:[-\w]+>' => 'news/article',
                'news/<page:\d+>' => 'news/index',
                'news' => 'news/index',
                // блог
                'blog/article/<id:\d+>/<slug:[-\w]+>' => 'blog/article',
                'blog/<page:\d+>' => 'blog/index',
                'blog' => 'blog/index',
                // статика
                '<alias:(payment|delivery|about|guarantees|partners)>' => 'site/static',
                'contact' => 'site/contact',
            ],
        ],

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'shop/*',
            'news/*',
            'blog/*',
            'debug/*',
//            'admin/*',
//            'rbac/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
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
