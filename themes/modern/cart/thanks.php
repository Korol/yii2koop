<?php
$this->title = 'Благодарим вас за заказ!';
?>
<div class="col-md-9 col-md-push-3 content-block">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="alert alert-info" role="alert">
                <?php if(!empty($order_id)): ?>
                <h3 class="text-center">Заказ №<?= $order_id; ?> успешно оформлен!</h3>
                <p class="text-center">Наш оператор Службы Доставки свяжется с вами в ближайшее время.</p>
                <?php else: ?>
                <p class="text-center">А вы ничего не заказывали((</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->