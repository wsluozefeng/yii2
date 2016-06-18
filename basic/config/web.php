<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',                 //todo 用来区分其他应用的唯一标识ID
    'basePath' => dirname(__DIR__),  //todo 指定该应用的根目录， 系统预定义 @app 代表这个路径！！！
    'bootstrap' => ['log'],          //todo 它允许你用数组指定启动阶段yii\base\Application::bootstrap()需要运行的组件或模块，比如，如果你希望一个 模块 自定义 URL 规则，你可以将模块ID加入到bootstrap数组中
    'modules' => [                   //todo 模块
        'youxi' => [
            'class' => 'app\modules\youxi\Module',
        ],
    ],
    'components' => [                //todo 组件，应用组件就像全局变量，使用太多可能加大测试和维护的难度。 一般情况下可以在需要时再创建本地组件
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pq4OXcvG_vQcS94aWr5oEKrncAyK6Fbm',
        ],

        // 使用类名注册 "cache" 组件
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
        /*'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                //todo 不同等级，不同标签的日志配置
                'info_log'=>[
                    'class' => 'yii\log\MyFileTarget',
                    'levels' => ['info', 'warning', 'trace'],
                    //'categories' => ['info'],  //对应的category参数必须是info
                    //'logFile' => '@app/runtime/logs/info.log',  //默认是app.log文件
                    //maxFileSize' => 1024 * 2,
                    //'maxLogFiles' => 20,     
                ],

                'error_log'=>
                    [
                        'class' => 'yii\log\MyFileTarget',
                        'levels' => ['error'],
                        'logFile' => '@app/runtime/logs/error.log',
                    ],
            ],
        ],*/

        // 使用配置数组注册 "db" 组件
        'db' => require(__DIR__ . '/db.php'),

        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

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
