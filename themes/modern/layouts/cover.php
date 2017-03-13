<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\CoverAppAsset;
//use app\assets\AppAsset;
//use app\assets\ltAppAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

//AppAsset::register($this);
//ltAppAsset::register($this);
CoverAppAsset::register($this);

$top_menu = [
    'main' => [
        'title' => 'Главная',
        'url' => Url::home(),
    ],
    'shop' => [
        'title' => 'Магазин',
        'url' => Url::to(['shop/index']),
    ],
    'payment' => [
        'title' => 'Оплата',
        'url' => Url::to(['page/view', 'slug' => 'oplata']),
    ],
    'delivery' => [
        'title' => 'Полезное',
        'url' => Url::to(['page/view', 'slug' => 'poleznoe']),
    ],
    'guarantees' => [
        'title' => 'Гарантии',
        'url' => Url::to(['page/view', 'slug' => 'garantii']),
    ],
    'news' => [
        'title' => 'Новости',
        'url' => Url::to(['news/index']),
    ],
    'blog' => [
        'title' => 'Блог',
        'url' => Url::to(['shop/index']),
    ],
    'partners' => [
        'title' => 'Партнеры',
        'url' => Url::to(['page/view', 'slug' => 'nashi-partnery']),
    ],
    'about' => [
        'title' => 'График работы',
        'url' => Url::to(['page/view', 'slug' => 'grafik-raboty']),
    ],
    'contact' => [
        'title' => 'Контакты',
        'url' => Url::to(['page/view', 'slug' => 'kontakty']),
    ],
];
$active_menu_item = isset($this->params['active_menu_item']) ? $this->params['active_menu_item'] : '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Вкус Жизни – Запорожье">
    <meta name="author" content="">
    <?= Html::csrfMetaTags(); ?>
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <title>Вкус Жизни – Запорожье</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="container mainpage">
                    <div class="inner">

                        <div class="row top-header-menu">
                            <div class="col-sm-4">
                                <div class="contactinfo">
                                    <ul class="nav nav-pills">
                                        <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                        <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-3">
                                <div class="search_box center-block">
                                    <form action="<?=Url::to(['shop/search']); ?>" method="get">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control top-s-input" aria-label="" name="search" placeholder="Поиск" maxlength="30">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit">
                                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                </button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-3">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-vk"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="logo pull-left">
                                    <a href="<?= Url::home(); ?>">
                                        <img class="main-logo" src="/images/home/logo_100x100.png" alt="<?=$this->title; ?>" align="left" />
                                        <p class="main-logo-title pull-right">Народная<br/>кооперация</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="mainmenu">
                                    <ul class="nav navbar-nav collapse navbar-collapse my-main-menu">
                                        <?php
                                        foreach($top_menu as $menu_key => $menu_item){
                                            $top_menu_class = ($menu_key == $active_menu_item) ? 'active' : '';
                                            ?>
                                            <li>
                                                <a href="<?=$menu_item['url']; ?>" class="<?=$top_menu_class; ?>"><?= $menu_item['title']; ?></a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav my-service-menu">
                                        <?php /*li><a href="/private"><i class="fa fa-user"></i> Личный Кабинет</a></li*/?>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i> Корзина <span id="top_cart_qty"><?= $this->params['cart_qty']; ?></a></li>
                                        <li>
                                        <?php if (Yii::$app->user->isGuest): ?>
                                        <i class="fa fa-lock"></i><a href="/site/login">Вход</a><?php /* &nbsp;|&nbsp; <a href="/site/signup">Регистрация</a*/?>
                                        <?php else: ?>
                                            <?= Html::beginForm(['/site/logout'], 'post', ['class' => '']); ?>
                                            <?= Html::submitButton(
                                                '<i class="fa fa-lock"></i>Выйти (' . Yii::$app->user->identity->username . ')',
                                                ['class' => 'btn btn-link logout-btn']
                                            ); ?>
                                            <?= Html::endForm(); ?>
                                        <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?= $content; ?>

            <div class="mastfoot">
                <div class="inner">
                    <p class="footer-copy-text">Все права защищены &copy; <?= date('Y'); ?></p>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>