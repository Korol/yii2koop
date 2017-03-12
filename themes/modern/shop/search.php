<?php
use yii\widgets\LinkPager;
?>
<div class="col-md-9 col-md-push-3 content-block">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="lined"><span>Результаты поиска</span></h3>
        </div>
    </div>
    <div class="row products-grid">
        <?php
        if(!empty($products)){
            foreach($products as $product){
                echo $this->render('_product_grid', ['product' => $product]);
            }
        }
        else{
        ?>
            <div class="col-lg-10 col-lg-offset-1 alert alert-danger text-center" role="alert"><h4>Ничего не найдено((</h4></div>
        <?php
        }
        ?>
    </div>
    <div class="row products-grid text-center">
        <?php
        // pagination
        if(!empty($pages)){
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        }
        ?>
    </div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->