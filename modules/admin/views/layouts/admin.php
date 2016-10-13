<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAppAsset;
use app\assets\ltAppAsset;
use yii\helpers\Url;
use mdm\admin\components\Helper;

AdminAppAsset::register($this);
ltAppAsset::register($this);


?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Административная панель</title>
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
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Url::to(['admin']); ?>">
                    <img class="admin-top-logo" alt="Административная панель" src="/images/favicons/favicon-32x32.png">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <?php
                $menuItems = [
                    ['label' => 'Категории', 'url' => ['/admin/category']],
                    ['label' => 'Пользователи', 'url' => ['/rbac/user']],
//                    ['label' => 'Личка', 'url' => ['/private/index']],
                    Yii::$app->user->isGuest ? (
                    ['label' => 'Вход', 'url' => ['/site/login']]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                        . Html::submitButton(
                            'Выход (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                ];
                $menuItems = Helper::filter($menuItems);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid admin-content">
        <?= Breadcrumbs::widget([
            'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if( Yii::$app->session->hasFlash('success') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif;?>
        <?= $content; ?>
    </div>
<!--    <footer id="footer"><!--Footer-->
<!--        <div class="footer-bottom">-->
<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div class="col-sm-12">-->
<!--                        <p class="footer-copy-text">Все права защищены &copy; --><?//= date('Y'); ?><!--</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </footer><!--/Footer-->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>