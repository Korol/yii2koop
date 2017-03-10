<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

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
    </div>
</div>

<div class="col-sm-9 padding-right">
<?php if(!empty($popular_products)): ?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Популярные товары</h2>
    <?php foreach($popular_products as $item): ?>
        <?php $pp_item_img = $item->getImage(); ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <div class="category-img-container">
                        <a href="<?=Url::to(['shop/product', 'id' => $item->id, 'slug' => $item->url]); ?>" title="<?=Html::encode($item->title); ?>">
                            <?= Html::img($pp_item_img->getUrl('x255'), ['alt' => Html::encode($item->title)]); ?>
                        </a>
                    </div>
                    <h2><?= $item->price; ?> грн/<?= $item->units; ?></h2>
                    <p>
                        <a href="<?=Url::to(['shop/product', 'id' => $item->id, 'slug' => $item->url]); ?>" class="product-title-link">
                            <?= Html::encode($item->title); ?>
                        </a>
                    </p>
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
                <?php $np_item_img = $new_product->getImage(); ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="tab-img-container">
                                <a href="<?=Url::to(['shop/product', 'id' => $new_product->id, 'slug' => $new_product->url]); ?>" title="<?=Html::encode($new_product->title); ?>">
                                    <?= Html::img($np_item_img->getUrl('x215'), ['alt' => Html::encode($new_product->title)]); ?>
                                </a>
                            </div>
                            <h2 class="np-tab-price"><?= $new_product->price; ?> грн/<?= $new_product->units; ?></h2>
                            <p>
                                <a href="<?=Url::to(['shop/product', 'id' => $new_product->id, 'slug' => $new_product->url]); ?>" class="product-title-link">
                                    <?= Html::encode($new_product->title); ?>
                                </a>
                            </p>
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
                <?php $hp_item_img = $hit_product->getImage(); ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="tab-img-container">
                                <a href="<?=Url::to(['shop/product', 'id' => $hit_product->id, 'slug' => $hit_product->url]); ?>" title="<?=Html::encode($hit_product->title); ?>">
                                    <?= Html::img($hp_item_img->getUrl('x215'), ['alt' => Html::encode($hit_product->title)]); ?>
                                </a>
                            </div>
                            <h2 class="hp-tab-price"><?= $hit_product->price; ?> грн/<?= $hit_product->units; ?></h2>
                            <p>
                                <a href="<?=Url::to(['shop/product', 'id' => $hit_product->id, 'slug' => $hit_product->url]); ?>" class="product-title-link">
                                    <?= Html::encode($hit_product->title); ?>
                                </a>
                            </p>
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
                <?php $sp_item_img = $sale_product->getImage(); ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="tab-img-container">
                                <a href="<?=Url::to(['shop/product', 'id' => $sale_product->id, 'slug' => $sale_product->url]); ?>" title="<?=Html::encode($sale_product->title); ?>">
                                    <?= Html::img($sp_item_img->getUrl('x215'), ['alt' => Html::encode($sale_product->title)]); ?>
                                </a>
                            </div>
                            <h2 class="sp-tab-price"><?= $sale_product->price; ?> грн/<?= $sale_product->units; ?></h2>
                            <p>
                                <a href="<?=Url::to(['shop/product', 'id' => $sale_product->id, 'slug' => $sale_product->url]); ?>" class="product-title-link">
                                <?= Html::encode($sale_product->title); ?>
                                </a>
                            </p>
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
                    <?php $rc_item_img = $r_chunk->getImage(); ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <div class="category-img-container">
                                    <a href="<?=Url::to(['shop/product', 'id' => $r_chunk->id, 'slug' => $r_chunk->url]); ?>" title="<?=Html::encode($r_chunk->title); ?>">
                                        <?= Html::img($rc_item_img->getUrl('x255'), ['alt' => Html::encode($r_chunk->title)]); ?>
                                    </a>
                                </div>
                                <h2><?= $r_chunk->price; ?> грн/<?= $r_chunk->units; ?></h2>
                                <p>
                                    <a href="<?=Url::to(['shop/product', 'id' => $r_chunk->id, 'slug' => $r_chunk->url]); ?>" class="product-title-link">
                                    <?= Html::encode($r_chunk->title); ?>
                                    </a>
                                </p>
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