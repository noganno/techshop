<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AjaxCrudAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [

        "ajaxCrud/ModalRemote.js",
        "ajaxCrud/ajaxcrud.js",

    ];
    public $css = [


    ];

    public $depends = [
//        'frontend\assets\AppAsset',
    ];

  /*  public $jsOptions = [
        'position' => View::POS_END,
    ];*/

}
