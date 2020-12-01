<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@homeUrl/admin_lte';
    public $css = [
        'adminlte.min.css',
        '_all-skins.min.css',
    ];
    public $js = [
        'adminlte.min.js',
    ];
    public $depends = [
    	'yii\bootstrap\BootstrapPluginAsset',
    ];
    
}
