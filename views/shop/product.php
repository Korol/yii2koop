<?php
/**
 *  @var $this \yii\web\View
 * @see Shop::actionProduct()
 * @var Shop $product
 * @var Shop $recommended_product
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->params['active_menu_item'] = 'shop';
$product_images_path = '/images/shop/products/';
$products_marks = [
    'new' => [
        'mark' => '<div class="sale-box"><span class="on_sale sale-box-new title_shop">Новинка</span></div>',
        'price_class' => 'np-tab-price',
    ],
    'hit' => [
        'mark' => '<div class="sale-box"><span class="on_sale sale-box-hit title_shop">Хит продаж</span></div>',
        'price_class' => 'hp-tab-price',
    ],
    'sale' => [
        'mark' => '<div class="sale-box"><span class="on_sale sale-box-sale title_shop">Распродажа</span></div>',
        'price_class' => 'sp-tab-price',
    ],
];
$product_category = $product->category;
// фото товара
$mainImg = $product->getImage(); // главное
$gallery = $product->getImages(); // остальные
if(!empty($gallery)){
    foreach($gallery as $gal_k => $gal_itm){
        if($gal_itm->id == $mainImg->id){
            unset($gallery[$gal_k]); // удаляем копию главной картинки
        }
    }
}
?>

<section>
<div class="container">
<div class="row product-info-block">
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
    <h2 class="title text-center"><?= Html::encode($product->title); ?></h2>
<div class="product-details"><!--product-details-->
    <div class="col-sm-5 product-details-photos">
        <?php
        $product_mark = '';
        $price_class = $products_marks['sale']['price_class'];
        foreach($products_marks as $pm_key => $pm_div){
            if(!empty($product->$pm_key)){
                $product_mark = $pm_div['mark'];
                $price_class = $pm_div['price_class'];
                break;
            }
        }
        ?>
        <div class="view-product">
            <a rel="group" href="/<?=$mainImg->getPathToOrigin(); ?>" class="fancybox">
            <?= Html::img($mainImg->getUrl(), ['alt' => Html::encode($product->title), 'class' => 'pd-main-img']); ?>
            </a>
<!--            <h3>ZOOM</h3>-->
        </div>
        <?= $product_mark; ?>
    <?php if(!empty($gallery)): ?>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner product-details-photos-slide">
        <?php
        $gi = 0;
        $gallery_chunks = array_chunk($gallery, 3);
            foreach($gallery_chunks as $g_chunk):
        ?>
                <div class="item <?= ($gi == 0) ? 'active' : ''; ?>">
                    <?php foreach($g_chunk as $g_item): ?>
                    <a rel="group" class="fancybox" href="/<?=$g_item->getPathToOrigin(); ?>">
                        <img src="<?=$g_item->getUrl('90x90'); ?>" alt="<?=$product->title; ?>">
                    </a>
                    <?php endforeach; ?>
                </div>
        <?php
                $gi++;
            endforeach;
        ?>
            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    <?php endif; ?>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <h2><?= Html::encode($product->title); ?></h2>
            <div><b>ID:</b> <?= $product->id; ?></div>
            <div>
                <span class="product-details-price <?=$price_class; ?>"><?= $product->price; ?> грн/<?= $product->units; ?></span><br/>
                <label>Количество:</label>
                <input type="text" value="1" />
                <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Купить
                </button>
            </div><br/>
            <div>
                <span class="product-details-option">Категория:</span>
                <a href="<?= Url::to(['shop/category', 'id' => $product_category->id, 'slug' => $product_category->url]); ?>" class="pdo-link">
                    <?=Html::encode($product_category->title); ?>
                </a>
            </div>
            <div><span class="product-details-option">Доступность:</span> В наличии</div>
            <div><span class="product-details-option">Опция:</span> Значение</div>
            <a href=""><img src="/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
        <div class="product-description"><?= $product->content; ?></div>
    </div>
</div><!--/product-details-->

<div class="recommended_items pd-recommended"><!--recommended_items-->
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
                        <?php
                        foreach($recommended_chunk as $r_chunk):
                            $rch_main_img = $r_chunk->getImage();
                        ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="category-img-container">
                                                <a href="<?=Url::to(['shop/product', 'id' => $r_chunk->id, 'slug' => $r_chunk->url]); ?>" title="<?=Html::encode($r_chunk->title); ?>">
                                                    <?= Html::img($rch_main_img->getUrl('x255'), ['alt' => Html::encode($r_chunk->title)]); ?>
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