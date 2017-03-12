<?php
use yii\helpers\Url;
use yii\helpers\Html;

if(!empty($product)){
    $p_item_img = $product->getImage();
?>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
    <div class="thumbnail product-thumbnail" id="pt_<?=$product->id; ?>">
        <div class="product-grid-img">
            <a href="<?=Url::to(['shop/product', 'id' => $product->id, 'slug' => $product->url]); ?>" title="<?=Html::encode($product->title); ?>">
                <?= Html::img($p_item_img->getUrl('x242'), ['alt' => Html::encode($product->title)]); ?>
            </a>
        </div>
        <div class="caption clearfix">
            <div class="product-grid-title">
                <h3>
                    <a href="<?=Url::to(['shop/product', 'id' => $product->id, 'slug' => $product->url]); ?>" title="<?=Html::encode($product->title); ?>">
                        <?= Html::encode($product->title); ?>
                    </a>
                </h3>
            </div>
            <div class="product-grid-text">
                <?= strip_tags($product->content); ?>
            </div>
            <div class="row collapse pt-buttons" id="btns_pt_<?=$product->id; ?>">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8">
                    <div class="input-group product-qty-grid-block">
                                <span class="input-group-btn">
                                    <button class="btn btn-default pqminus" type="button" id="pqminus_<?=$product->id;?>">
                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                    </button>
                                </span>
                        <input type="text" class="form-control qty-input" value="1" readonly id="pqty_<?=$product->id;?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default pqplus" type="button" id="pqplus_<?=$product->id;?>">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                </span>
                    </div><!-- /input-group -->
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4">
                    <a href="<?=Url::to(['cart/add', 'id' => $product->id]); ?>" data-id="<?=$product->id; ?>" class="btn btn-success pull-right grid-buy-btn">Купить</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>