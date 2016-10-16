<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
//        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/prettyPhoto.css',
        'css/price-range.css',
        'css/animate.css',
        'css/responsive.css',
        'css/main.css',
        'fancybox/source/jquery.fancybox.css?v=2.1.5',
        'fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5',
        'fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7',
    ];
    public $js = [
//        'js/jquery.js',
//        'js/bootstrap.min.js',
        'js/jquery.scrollUp.min.js',
        'js/price-range.js',
        'js/jquery.prettyPhoto.js',
        'js/jquery.cookie.js',
        'js/jquery.accordion.js',
        'js/main.js',
        'fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
        'fancybox/source/jquery.fancybox.pack.js?v=2.1.5',
        'fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5',
        'fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6',
        'fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
