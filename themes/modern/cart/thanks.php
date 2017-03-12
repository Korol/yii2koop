<?php

?>
<div class="col-md-9 col-md-push-3 content-block">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="alert alert-info" role="alert">
                <?php if(!empty($order_id)): ?>
                <h3 class="text-center">Заказ №<?= $order_id; ?> успешно оформлен!</h3>
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates ducimus ea impedit. Nihil voluptas fugiat, optio numquam, consequatur fugit sequi doloremque nostrum accusantium, eos vero. Eum sapiente consequatur vitae quidem nobis vel sed sequi eveniet ratione labore ipsa, fuga in nihil accusantium non adipisci ex voluptate ipsam nam ducimus dolor pariatur magni illum praesentium! Quasi nulla consequatur itaque, architecto molestiae odio omnis ex sit impedit corrupti voluptatum fugiat tempora doloremque quod, provident asperiores repudiandae dolorem consequuntur aut fuga dolore quis! Illum deserunt dolore incidunt amet, delectus dicta quibusdam consectetur. Sed, dolorem dolore quidem, ratione culpa ut blanditiis praesentium natus asperiores.</p>
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