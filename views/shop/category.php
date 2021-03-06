<?php
/**
 *  @var $this \yii\web\View
 * @see Shop::actionCategory()
 * @var Shop $category
 * @var Shop $products
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->params['active_menu_item'] = 'shop';
$product_images_path = '/images/shop/products/';
$products_marks = [
    'new' => '<div class="sale-box"><span class="on_sale sale-box-new title_shop">Новинка</span></div>',
    'hit' => '<div class="sale-box"><span class="on_sale sale-box-hit title_shop">Хит продаж</span></div>',
    'sale' => '<div class="sale-box"><span class="on_sale sale-box-sale title_shop">Распродажа</span></div>',
];
?>

<section>
    <div class="container">
        <div class="row shop-category">
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
            <div class="col-sm-9  padding-right">
                <?php if(!empty($products)): ?>
                    <div class="features_items"><!--products_items-->
                        <h2 class="title text-center"><?= Html::encode($category->title); ?></h2>
                        <?php foreach($products as $item): ?>
                            <?php
                            $product_mark = '';
                            foreach($products_marks as $pm_key => $pm_div){
                                if(!empty($item->$pm_key)){
                                    $product_mark = $pm_div;
                                    break;
                                }
                            }
                            $item_img = $item->getImage();
                            ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="category-img-container">
                                                <a href="<?=Url::to(['shop/product', 'id' => $item->id, 'slug' => $item->url]); ?>" title="<?=Html::encode($item->title); ?>">
                                                    <?= Html::img($item_img->getUrl('x255'), ['alt' => Html::encode($item->title)]); ?>
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
                                <?= $product_mark; ?>
                            </div>
                        <?php endforeach; ?>
                    </div><!--products_items-->
                    <?php
                    // pagination
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>
                <?php else: ?>
                <div class="features_items"><!--products_items-->
                    <h2 class="title text-center"><?= Html::encode($category->title); ?></h2>
                    <div class="alert alert-danger category-no-products" role="alert">
                        На данный момент в этой категории нет товаров.<br/>
                        Мы об этом знаем – и усиленно работаем над этим!
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>