<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'languages' => [
        'ru' => Yii::t('app', 'Russian'),
        'kr' => Yii::t('app', 'Uzb Cyrill'),
        'uz' => Yii::t('app', 'Uzbek'),
    ],
    'languageParam' => 'language',
    'defaultLanguage' => 'ru',

//    max price for filtering products
    'filterMaxPrice' => 50000000,
];
