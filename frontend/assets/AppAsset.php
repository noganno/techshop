<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

//        '/css/bootstrap.min.css',
        '/css/owl.carousel.min.css',
        '/css/owl.theme.default.min.css',
        '/css/jquery.fancybox.min.css',
        '/css/jquery-ui.css',
        '/css/main.custom.css',
        '/css/main.css',
        '/css/main2.css',
        '/css/slick.css',
        '/css/custom.css',
        '/css/material-design/css/material-design-iconic-font.min.css'
    ];
    public $js = [

//        '/js/jQuery-3.4.1.js',
//        '/js/bootstrap.min.js',
        '/js/jquery-ui.js',
        '/js/owl.carousel.min.js',
        '/js/isotope.pkgd.min.js',
        '/js/jquery.inputmask.js',
        '/js/jquery.fancybox.min.js',
        '/js/cookie.js',
        '/js/jquery.hsmenu.min.js',
        "/js/slick.min.js",
        '/js/index.js',
        '/js/flyToCart.js',
        '/js/custom.js',
//        '/js/signup.js',
        '/js/cart.js',
        'js/balance.js',
        "ajaxCrud/ModalRemote.js",
        "js/fastOrder.js",

    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\YiiAsset',
    ];


}