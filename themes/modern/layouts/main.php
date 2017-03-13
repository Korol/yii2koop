<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\ModernAppAsset;
use app\assets\ltAppAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;

ModernAppAsset::register($this);
ltAppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= Html::encode($this->title) ?></title>

    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- <div class="container"> -->
<!-- <div class="top-banner"></div> -->

<nav class="navbar navbar-default navbar-fixed-top koop-navbar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/shop">
                <?= Html::img('@web/images/modern/favicon-32x32.png', ['class' => 'admin-top-logo', 'alt' => 'Home page']); ?>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- search -->
            <form class="navbar-form navbar-left" action="<?=Url::to(['shop/search']); ?>" method="get" name="top_search">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Поиск...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                      </span>
                </div><!-- /input-group -->
            </form>
            <!-- /search -->
            <!-- top menu -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">О НАС <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/page/dogovor">Договор</a></li>
                        <li><a href="/page/nashi-partnery">Наши партнеры</a></li>
                        <li><a href="/page/poleznoe">Полезное</a></li>
                        <li><a href="/page/chavo">ЧАВО</a></li>
                    </ul>
                </li>
                <li><a href="/news">НОВОСТИ</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ДОСТАВКА <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/page/besplatnaya-dostavka">Безоплатно</a></li>
                        <li><a href="/page/oplata">Оплата</a></li>
                        <li><a href="/page/garantii">Гарантии</a></li>
                        <li><a href="/page/grafik-raboty">График работы</a></li>
                    </ul>
                </li>
                <li><a href="/page/kontakty">КОНТАКТЫ</a></li>
            </ul>
            <!-- /top menu -->
            <ul class="nav navbar-nav navbar-right">
                <!-- <li><span class="glyphicon glyphicon-shopping-cart top-cart-icon" aria-hidden="true"></span></li> -->
                <!-- <li><a href="#">Вход</a></li>
                <li><a href="#">Регистрация</a></li> -->
                <li><a href="#" onclick="return getModalCart();">Корзина <span id="top_cart_qty"><?= $this->params['cart_qty']; ?></span></a></li>
                <li><a href="<?=Url::to(['/admin']); ?>">Вход</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>

<div class="container">
    <div class="page-wrapper">
        <div class="row page-content">

            <?= $content; ?>

        </div><!-- /.page-content -->
    </div><!-- /.page-wrapper -->
</div><!-- /.container -->

<?php
Modal::begin([
    'header' => '<h2>Корзина</h2>',
    'id' => 'modal_cart',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <a href="' . Url::to(['cart/view']) . '" class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart();">Очистить корзину</button>',
]);

Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>