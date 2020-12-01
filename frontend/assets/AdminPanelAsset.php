<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class AdminPanelAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@homeUrl';
    public $css = [
        'admin_panel/admin.custom.css',
    ];
    public $js = [
        'admin_panel/admin.custom.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        "yii\web\YiiAsset",
        'frontend\assets\AdminLteAsset',
        'frontend\assets\FaAsset',
    ];
    
}
