<?php
use yii\helpers\Html;
use yii\helpers\Url;

if(!empty($product)):
    $mainImage = $product->getImage();
    $mainImages = $product->getImages();
    array_shift($mainImages);
?>
<div class="col-md-9 col-md-push-3 content-block">
    <div class="row product-info-block">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="row">
                <div class="col-lg-12 product-image-block">
                    <a class="fancybox thumbnail" rel="group" href="<?=$mainImage->getUrl(); ?>">
                        <?= Html::img($mainImage->getUrl('250x'), ['alt' => Html::encode($product->title)]); ?>
<!--                        <span class="glyphicon glyphicon-search product-zoom-icon" aria-hidden="true"></span>-->
                    </a>
                </div>
            </div>
            <div class="row pc-additional-images">
                <div class="col-xs-12 clearfix">
                    <?php
                    if(!empty($mainImages)) {
                        $i = 1;
                        foreach($mainImages as $image) {
                    ?>
                    <div class="pc-a-i-item">
                        <a class="fancybox thumbnail" rel="group" href="<?=$image->getUrl(); ?>">
                            <img src="<?=$image->getUrl('150x150'); ?>" alt="<?=$product->title . ' image ' . $i; ?>">
                        </a>
                    </div>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 product-about-info">
            <div class="row pc-title">
                <div class="col-xs-12">
                    <h1 class="product-card-title"><?= $product->title; ?></h1>
                </div>
            </div>
            <div class="row pc-id">
                <div class="col-xs-12">
                    <span class="product-card-id-label">ID:</span>
                    <span class="product-card-id-value"><?= $product->id; ?></span>
                </div>
            </div>
            <div class="row pc-price">
                <div class="col-xs-12">
                    <div class="product-card-price"><?= $product->price; ?> грн/<?= $product->units; ?></div>
                </div>
            </div>
            <div class="well clearfix product-qty-block">
                <span class="p-qty-price"><span id="pprice_<?= $product->id; ?>"><?= $product->price; ?></span> x</span>
                <div class="p-qty-num">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default ppqminus" type="button" id="ppqminus_<?= $product->id; ?>">
                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                        </button>
                    </span>
                        <input type="text" class="form-control qty-input" value="1" readonly id="pqty_<?= $product->id; ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default ppqplus" type="button" id="ppqplus_<?= $product->id; ?>">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </span>
                    </div><!-- /input-group -->
                </div>
                <span class="p-qty-price">= <span id="pcost_<?= $product->id; ?>"><?= $product->price; ?></span> грн</span>
                <a href="<?=Url::to(['cart/add', 'id' => $product->id]); ?>" data-id="<?=$product->id; ?>" class="btn btn-success pull-right btn-lg grid-buy-btn">Купить</a>
            </div>
            <div class="row pc-description">
                <div class="col-xs-12">
                    <p><?= $product->content; ?></p>
                </div>
            </div>
        </div>
        <?php /* ?>
    <div class="col-lg-12">
        <textarea class="form-control" rows="3" placeholder="Ваш комментарий к заказу"></textarea>
    </div>
    <?php */ ?>
        <?php if(!empty($similar_products)): ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-similar-header">
<!--            <h3 class="lined"><span>С этим товаром чаще всего покупают</span></h3>-->
            <h3 class="lined"><span>Другие товары из этого раздела</span></h3>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 small-product-grid">
            <div class="row">
                <?php
                foreach($similar_products as $s_product):
                    $sp_image = $s_product->getImage();
                ?>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                    <a href="<?=Url::to(['shop/product', 'id' => $s_product->id, 'slug' => $s_product->url]); ?>" title="<?=Html::encode($s_product->title); ?>" class="thumbnail">
                        <?= Html::img($sp_image->getUrl('100x100'), ['alt' => Html::encode($s_product->title)]); ?>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php /*div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <button type="button" class="btn btn-success btn-lg">Ещё N товаров</button>
        </div*/?>
        <?php endif; ?>
    </div>
</div><!-- /.content-block -->
<?php endif; ?>
<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->