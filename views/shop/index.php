<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Магазин – Народная Кооперация';
$this->params['active_menu_item'] = 'shop';
$product_images_path = '/images/shop/products/';
?>

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
<div class="container">
<div class="row">
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Категории</h2>
        <div class="category-products my-category-products-div">
            <ul class="catalog my-category-products" id="mainLevel">
                <?= \app\components\MenuWidget::widget(['tpl' => 'menu']); ?>
            </ul>
        </div>

        <?php /*div class="brands_products"><!--brands_products-->
            <h2>Производители</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center"><!--shipping-->
            <img src="/images/home/shipping.jpg" alt="" />
        </div><!--/shipping--*/?>

    </div>
</div>

<div class="col-sm-9 padding-right">
<?php if(!empty($popular_products)): ?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Популярные товары</h2>
    <?php foreach($popular_products as $item): ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <div class="category-img-container">
                    <?= Html::img('@web' . $product_images_path . $item->img, ['alt' => Html::encode($item->title)]); ?>
                    </div>
                    <h2><?= $item->price; ?> грн/<?= $item->units; ?></h2>
                    <p><?= Html::encode($item->title); ?></p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Купить</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div><!--features_items-->
<?php endif; ?>

<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs nav-justified">
            <?php
            $tab_cnt = 0;
            if(!empty($new_products)):
                $tab_class = ($tab_cnt == 0) ? 'active' : '';
            ?>
            <li class="new-products-tab <?= $tab_class; ?>"><a href="#new_products" data-toggle="tab">Новинки</a></li>
            <?php
                $tab_cnt++;
            endif;
            if(!empty($hit_products)):
                $tab_class = ($tab_cnt == 0) ? 'active' : '';
            ?>
            <li class="hit-products-tab <?= $tab_class; ?>"><a href="#hit_products" data-toggle="tab">Хиты продаж</a></li>
            <?php
                $tab_cnt++;
            endif;
            if(!empty($sale_products)):
                $tab_class = ($tab_cnt == 0) ? 'active' : '';
            ?>
            <li class="sale-products-tab <?= $tab_class; ?>"><a href="#sale_products" data-toggle="tab">Распродажа</a></li>
            <?php
                $tab_cnt++;
            endif;
            ?>
        </ul>
    </div>
    <div class="tab-content">
        <?php if(!empty($new_products)): ?>
        <div class="tab-pane fade active in" id="new_products" >
            <?php foreach($new_products as $new_product): ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="tab-img-container">
                            <?= Html::img('@web' . $product_images_path . $new_product->img, ['alt' => Html::encode($new_product->title)]); ?>
                            </div>
                            <h2 class="np-tab-price"><?= $new_product->price; ?> грн/<?= $new_product->units; ?></h2>
                            <p><?= Html::encode($new_product->title); ?></p>
                            <a href="#" class="btn btn-default add-to-cart atc-new"><i class="fa fa-shopping-cart"></i>Купить</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($hit_products)): ?>
        <div class="tab-pane fade" id="hit_products" >
            <?php foreach($hit_products as $hit_product): ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="tab-img-container">
                            <?= Html::img('@web' . $product_images_path . $hit_product->img, ['alt' => Html::encode($hit_product->title)]); ?>
                            </div>
                            <h2 class="hp-tab-price"><?= $hit_product->price; ?> грн/<?= $hit_product->units; ?></h2>
                            <p><?= Html::encode($hit_product->title); ?></p>
                            <a href="#" class="btn btn-default add-to-cart atc-hit"><i class="fa fa-shopping-cart"></i>Купить</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($sale_products)): ?>
        <div class="tab-pane fade" id="sale_products" >
            <?php foreach($sale_products as $sale_product): ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="tab-img-container">
                            <?= Html::img('@web' . $product_images_path . $sale_product->img, ['alt' => Html::encode($sale_product->title)]); ?>
                            </div>
                            <h2 class="sp-tab-price"><?= $sale_product->price; ?> грн/<?= $sale_product->units; ?></h2>
                            <p><?= Html::encode($sale_product->title); ?></p>
                            <a href="#" class="btn btn-default add-to-cart atc-sale"><i class="fa fa-shopping-cart"></i>Купить</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <?php if(!empty($recommended_products)): ?>
    <h2 class="title text-center">Рекомендуем купить</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $recommend_items_cnt = 0;
            $recommended_products_chunked = array_chunk($recommended_products, 3);
            foreach($recommended_products_chunked as $recommended_chunk):
                $recommended_item_class = ($recommend_items_cnt == 0) ? 'active' : '';
            ?>
            <div class="item <?= $recommended_item_class; ?>">
                <?php foreach($recommended_chunk as $r_chunk): ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <div class="category-img-container">
                                    <?= Html::img('@web' . $product_images_path . $r_chunk->img, ['alt' => Html::encode($r_chunk->title)]); ?>
                                </div>
                                <h2><?= $r_chunk->price; ?> грн/<?= $r_chunk->units; ?></h2>
                                <p><?= Html::encode($r_chunk->title); ?></p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Купить</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php
                $recommend_items_cnt++;
            endforeach;
            ?>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
    <?php endif; ?>
</div><!--/recommended_items-->

</div>
</div>
</div>
</section>