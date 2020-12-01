<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    // require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
// require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => "uz",
    'modules' => [
        'treemanager' => [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'components' => [


        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],
        'functions' => [
            'class' => 'common\components\Functions'
        ],
        'request' => [
            'baseUrl' => "/api",
//            'enableSession' => false,
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            // 'enableSession'=>false,
            'enableAutoLogin' => false,
            'enableSession' => false,
//            'loginUrl' => '',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'baseUrl' => "/api",
            'showScriptName' => false,
            'rules' => [],
        ]
    ],
    'params' => $params,
];
