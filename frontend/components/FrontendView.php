<?php
namespace frontend\components;

use Yii;
use yii\helpers\Html;

class FrontendView extends \soft\web\SView
{


    public function getUser()
    {
        return Yii::$app->user;
    }

    public function getHasUser()
    {
        return !\Yii::$app->isGuest;
    }

//    public function registerAssetBundle($name, $position = null)
//    {
//
//        $exludeAssets = [
//
//            'yii\bootstrap4\BootstrapAsset',
//            'yii\bootstrap\BootstrapAsset',
//            'yii\bootstrap4\BootstrapPluginAsset',
//            'yii\bootstrap\BootstrapPluginAsset',
//
//        ];
//
//        if ($name == "yii\web\JqueryAsset"){
//            $name = "frontend\assets\CustomJqueryAsset";
//        }
//
//        if ($name == "yii\web\YiiAsset"){
//            $name = "frontend\assets\CustomYiiAsset";
//        }
//
//        if ($name == 'yii\validators\ValidationAsset'){
//            $name = "frontend\assets\ValidationAsset";
//        }
//
//        if ( in_array($name, $exludeAssets)  ){
//            return ;
//        }
//
//        return parent::registerAssetBundle($name, $position);
//    }


}