<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language' => "ru",
    'timeZone' => 'Asia/Tashkent',
    'bootstrap' => ['log'],
    'modules' => [
        'ipakyuli' => [
            'class' => 'backend\modules\ipakyuli\IpakYuli',
        ],
        'syncronisation' => [
            'class' => 'backend\modules\syncronisation\Sync',
        ],
        'click' => [
            'class' => 'backend\modules\click\Click',
        ],
        'c1manager' => [
            'class' => 'backend\modules\c1manager\C1',
        ],
        'admin' => [
            'class' => 'backend\modules\administration\Module',
            'layout' => 'left-menu'
        ],
        'loanmanagement' => [
            'class' => 'backend\modules\loanmanagement\LoanManager',
        ],

        'sms' => [
            'class' => 'backend\modules\sms\Sms',
        ],

        'smsmanager' => [
            'class' => 'backend\modules\smsmanager\Module',
        ],
        'treemanager' => [
            'class' => '\kartik\tree\Module',
        ],

        'postmanager' => [
            'class' => '\backend\modules\postmanager\Module',
        ],
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'translate-manager' => [
            'class' => '\backend\modules\translationmanager\TranslationManager',
        ],

        'profilemanager' => [
            'class' => '\backend\modules\profilemanager\Module',
        ],

        'usermanager' => [
            'class' => '\backend\modules\usermanager\Module',
        ],

    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl' => '',
                    'basePath' => '@frontend/web',
                    'path' => 'files/global',
                    'name' => 'Global'
                ],
                [
                    'class' => 'mihaildev\elfinder\volume\UserPath',
                    'baseUrl' => '',
                    'basePath' => '@frontend/web',
                    'path' => 'files/user_{id}',
                    'name' => 'My Documents'
                ],
            ],
            'watermark' => [
                'source' => __DIR__ . '/logo.png', // Path to Water mark image
                'marginRight' => 5,          // Margin right pixel
                'marginBottom' => 5,          // Margin bottom pixel
                'quality' => 95,         // JPEG image save quality
                'transparency' => 70,         // Water mark image transparency ( other than PNG )
                'targetType' => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP, // Target image formats ( bit-field )
                'targetMinPixel' => 200         // Target image minimum pixel size
            ]
        ]
    ],
    'components' => [

        'obmenlog' => [
            'class' => 'backend\components\Log',
        ],


        'ipakyuli' => [
            'class' => 'backend\modules\ipakyuli\components\IpakYuli',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],

        'view' => [
            'class' => '\backend\components\BackendView',
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
            ],
        ],
        /*   'view' => [
               'theme' => [
                   'pathMap' => [
                       '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                   ],
               ],
           ],*/
        'request' => [
            'baseUrl' => "/tm_control",
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'baseUrl' => "/tm_control",
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                '<language:\w+>/'=>'site/index',
//                '<language:\w+>/index'=>'site/index',
                '<language:\w+>/page/<id>' => 'site/page',

            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
        ]
    ],
    'params' => $params,
];
