<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\ltAppAsset;
use yii\helpers\Url;

AppAsset::register($this);
ltAppAsset::register($this);

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
        'url' => Url::to(['site/static', 'alias' => 'payment']),
    ],
    'delivery' => [
        'title' => 'Доставка',
        'url' => Url::to(['site/static', 'alias' => 'delivery']),
    ],
    'guarantees' => [
        'title' => 'Гарантии',
        'url' => Url::to(['site/static', 'alias' => 'guarantees']),
    ],
    'news' => [
        'title' => 'Новости',
        'url' => Url::to(['news/index']),
    ],
    'blog' => [
        'title' => 'Блог',
        'url' => Url::to(['blog/index']),
    ],
    'partners' => [
        'title' => 'Партнеры',
        'url' => Url::to(['site/static', 'alias' => 'partners']),
    ],
    'about' => [
        'title' => 'О нас',
        'url' => Url::to(['site/static', 'alias' => 'about']),
    ],
    'contact' => [
        'title' => 'Контакты',
        'url' => Url::to(['site/contact']),
    ],
];
$active_menu_item = isset($this->params['active_menu_item']) ? $this->params['active_menu_item'] : '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
//    $this->registerJsFile('js/html5shiv.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lt IE 9']);
//    $this->registerJsFile('js/respond.min.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lt IE 9']);
    ?>
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <?php $this->head() ?>
</head><!--/head-->

<body>
<?php $this->beginBody() ?>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <div class="search_box center-block">
                        <form action="<?=Url::to(['shop/search']); ?>" method="get">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control top-s-input" aria-label="" name="search" placeholder="Поиск" maxlength="30">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Поиск по <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Названию</a></li>
                                        <li><a href="#">Производителю</a></li>
                                        <li><a href="#">Артикулу</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
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
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo pull-left">
                        <a href="<?= Url::home(); ?>" title="На главную страницу">
                            <?= Html::img('@web/images/home/logo_100x100.png', ['alt' => Html::encode($this->title), 'align' => 'left', 'class' => 'main-logo']); ?>
<!--                            <img class="main-logo" src="/images/home/logo_100x100.png" alt="--><?//=$this->title; ?><!--" align="left" />-->
                            <p class="main-logo-title pull-right">Народная<br/>кооперация</p>
                        </a>
                    </div>
                    <?php /*div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div*/?>
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
                <div class="col-sm-2 inner-pages">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav my-service-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Личный Кабинет</a></li>
                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Корзина (23)</a></li>
                            <li><a href="login.html"><i class="fa fa-lock"></i> Вход</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
</header><!--/header-->

<?= $content; ?>

<footer id="footer"><!--Footer-->
    <?php /*div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe1.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe2.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe3.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/images/home/iframe4.png" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="/images/home/map.png" alt="" />
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div*/?>

    <?php /*div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div*/?>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="footer-copy-text">Все права защищены &copy; <?= date('Y'); ?></p>
                </div>
            </div>
        </div>
    </div>

</footer><!--/Footer-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>