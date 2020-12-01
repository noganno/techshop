<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@homeUrl' => '/',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'components' => [

        'c1' => [
            'class' => 'backend\modules\c1manager\components\C1'
        ],

        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6Lcri88ZAAAAABPycjpYDwiP2MQUK_0ydQxUwLDS',
            'secretV2' => '6Lcri88ZAAAAAC_2j6pG4W7GRNinRKNtTHTqfyj-',
        ],

        'sms' => [
            'class' => 'backend\modules\sms\components\Sms',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => 'soft\i18n\SFormatter',
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'UZS',
        ],

        'site' => [

            'class' => 'soft\components\Site',

        ],

        'help' => [
            'class' => 'soft\components\Helper',
        ]
    ],

    'as beforeRequest' => [
        'class' => 'soft\behaviors\ChangeLanguage',
    ],
];
