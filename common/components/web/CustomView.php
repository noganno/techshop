<?php
namespace common\components\web;

class CustomView extends \yii\web\View
{


    public function getUser()
    {
        return Yii::$app->user;
    }

    public function getHasUser()
    {
        return !\Yii::$app->isGuest;
    }

    public function registerAssetBundle($name, $position = null)
    {

        if ($name == 'yii\bootstrap4\BootstrapAsset' || $name == 'yii\bootstrap4\BootstrapPluginAsset'){
            return ;
        }

        return parent::registerAssetBundle($name, $position);
    }


}