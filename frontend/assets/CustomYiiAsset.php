<?php


namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\View;
use yii\web\YiiAsset;

class CustomYiiAsset extends YiiAsset
{

    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];

    public $depends = [
        'frontend\assets\CustomJqueryAsset',
    ];

}