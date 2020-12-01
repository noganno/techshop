<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
//    'homeUrl' => "/",
    'language' => "ru",
    'timeZone' => 'Asia/Tashkent',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
//        'ipakyuli' => [
//            'class' => 'backend\modules\ipakyuli\IpakYuli',
//        ],
        'click' => [
            'class' => 'backend\modules\click\Click',
        ],
        'treemanager' => [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
    ],
    'components' => [

        'ipakyuli' => [
            'class' => 'backend\modules\ipakyuli\components\IpakYuli',
        ],

        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        '/js/jQuery-3.4.1.js',
                    ]
                ],

                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [
                        '/css/bootstrap.min.css',
                    ]
                ],

                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        '/js/bootstrap.min.js',
                    ]
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'js' => [],
                    'depends' => [
                        'yii\web\JqueryAsset',
                        'yii\bootstrap\BootstrapPluginAsset'
                    ],
                ],
                'yii\bootstrap4\BootstrapAsset' => [
                    'css' => [],
                    'depends' => ['yii\bootstrap\BootstrapAsset'],
                ],
            ]
        ],

        'functions' => [
            'class' => 'common\components\Functions'
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
            ],
        ],


        // ...


        'view' => [
            'class' => 'frontend\components\FrontendView',
        ],

        'help' => [
            'class' => 'soft\components\Helper',
        ],

        'emailer' => [
            'class' => 'frontend\components\Mailer',
        ],

        'request' => [
            'baseUrl' => "",
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'class' => 'soft\web\SUrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [


                '<language:\w+>/profile/personal-data' => 'profile/personal-data',
                '<language:\w+>/profile/index' => 'profile/index',

                '<language:\w+>/user/register/<type>' => 'user/register',
                '<language:\w+>/user/register' => 'user/register',

                '<language:\w+>/katalog/<c1>/<c2>/<c3>/<id>' => 'product/detail',
                '<language:\w+>/katalog/<c1>/<c2>/<id>' => 'product/category',
                '<language:\w+>/katalog/<c1>/<id>' => 'product/category',
                '<language:\w+>/katalog/<id>' => 'product/category',
                '<language:\w+>/katalog' => 'site/catalog',

                '<language:\w+>/product/brand/<id>' => 'product/brand',
//                '<language:\w+>/product/detail/<id>' => 'product/detail',
//                '<language:\w+>/product/detail2/<id>' => 'product/detail2',
                '<language:\w+>/product/search' => 'product/search',

                '<language:\w+>/fast-order/show/<id>' => 'fast-order/show',
                '<language:\w+>/balance/add-to-balance/<id>' => 'balance/add-to-balance',

                '<language:\w+>/shop/checkout' => 'shop/checkout',

                '<language:\w+>/blog/discounts' => 'blog/discounts',
                '<language:\w+>/blog/discount/<id>' => 'blog/discount',
                '<language:\w+>/blog/reviews' => 'blog/reviews',
                '<language:\w+>/blog/review/<id>' => 'blog/review',
                '<language:\w+>/blog/all-news' => 'blog/all-news',
                '<language:\w+>/blog/news/<id>' => 'blog/news',

                '<language:\w+>/' => 'site/index',
                '<language:\w+>/index' => 'site/index',
                '<language:\w+>/page/<id>' => 'site/page',
                '<language:\w+>/<action:(logout|signup|login|verify-code|resend|request-password-reset|about|contact|sklad-map)>' => 'site/<action>',
            ],
        ],
        'cart' => [
            'class' => 'frontend\components\Cart',
        ],

        'recent' => [
            'class' => 'frontend\components\Recent',
        ],

        'm1c' => [
            'class' => 'frontend\components\M1c',
        ],

        'balance' => [
            'class' => 'frontend\components\Balance',
        ]


    ],
    'params' => $params,
];