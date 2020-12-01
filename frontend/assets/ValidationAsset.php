<?php


namespace frontend\assets;


class ValidationAsset extends \yii\validators\ValidationAsset
{
    public $depends = [
        'frontend\assets\CustomYiiAsset',
    ];
}