<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/flexslider.css',
        'css/font-awesome.min.css',
        'css/magnific-popup.min.css',
        'css/magnific-popup-animate.css',
        'css/slick.css',
        'css/slick-theme.css',
        'css/jquery.custom-scrollbar.css',
        'css/jquery.jscrollpane.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.wow.min.js',
        'js/jquery.flexslider.js',
        'js/jquery.timer.js',
        'js/jquery.easing.js',
        'js/jquery.mousewheel.js',
        'js/jquery.magnific-popup.js',
        'js/jquery.cookie.js',
        'js/jquery.custom-scrollbar.min.js',
        'js/jquery.jscrollpane.min.js',
        'js/bootstrap.min.js',
        'js/slick.js',
        'js/modernizr.js',
        'js/buzz.min.js',
        'js/index.js',
        // 'js/scripts.js',
        'js/special.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}