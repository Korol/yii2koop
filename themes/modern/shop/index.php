<?php

if(!empty($carousel))
    echo $this->render('_carousel', ['slides' => $carousel]);
?>
<div class="col-md-9 col-md-push-3 content-block">
<?php if(!empty($popular_products)): ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="lined"><span>Популярные продукты</span></h3>
        </div>
    </div>
    <div class="row products-grid">
        <?php
        foreach($popular_products as $p_product){
            echo $this->render('_product_grid', ['product' => $p_product]);
        }
        ?>
    </div>
<?php endif; ?>
<?php if(!empty($sale_products)): ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="lined"><span>Акционные продукты</span></h3>
        </div>
    </div>
    <div class="row products-grid">
        <?php
        foreach($sale_products as $s_product){
            echo $this->render('_product_grid', ['product' => $s_product]);
        }
        ?>
    </div>
<?php endif; ?>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->