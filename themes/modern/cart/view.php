<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-md-9 col-md-push-3 content-block">
<div class="row">
    <div class="col-lg-12">
        <h3 class="lined"><span>Корзина</span></h3>
    </div>
</div>
<?php if(!empty($session['cart'])): ?>
<div class="row cart-info-block">
    <!-- <div class="col-lg-12 text-center">
        <h4><span class="label label-success">Заказ № 123456</span></h4>
    </div> -->
    <div class="col-lg-12 text-right">
        <button class="btn btn-default">
            <span class="glyphicon glyphicon-print"></span> Печать
        </button>
    </div>
    <div class="col-lg-12 cart-products-table-block">
        <table class="table table-bordered cart-products-table">
            <thead>
<!--            <th>#</th>-->
            <th>Название</th>
            <th>Цена</th>
            <th class="cart-qty-column">Кол-во товара</th>
            <th>Стоимость</th>
            <th>Удалить</th>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach($session['cart'] as $key => $product):
            ?>
                <tr id="cart_tr_<?=$key;?>">
<!--                    <td class="text-center">--><?//=$i;?><!--</td>-->
                    <td><?=$product['title']; ?></td>
                    <td><span id="pprice_<?=$key;?>"><?=$product['price']; ?></span> грн</td>
                    <td>
                        <div class="input-group product-qty-grid-block">
                        <span class="input-group-btn">
                            <button class="btn btn-default cart-qty-oper" type="button" data-id="<?=$key; ?>" data-oper="minus">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        </span>
                            <input type="text" class="form-control qty-input" value="<?=$product['qty'];?>" readonly id="pqty_<?=$key;?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default cart-qty-oper" type="button" data-id="<?=$key; ?>" data-oper="plus">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </span>
                        </div><!-- /input-group -->
                    </td>
                    <td><span class="cart-cost" id="pcost_<?=$key;?>"><?=number_format(($product['qty']*$product['price']), 2); ?></span> грн</td>
                    <td class="text-center">
                        <button type="button" onclick="removeFromCart(<?=$key;?>)" class="btn btn-danger">&times;</button>
                    </td>
                </tr>
            <?php
                $i++;
            endforeach;
            ?>
            <tr>
                <td colspan="7" class="text-right">
                    <span class="text-uppercase">Всего:</span>
                    <span class="cart-total-cost"><span id="cart_total"><?=number_format($session['cart.sum'], 2);?></span></span> грн
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php /*div class="col-lg-12">
        <div class="alert alert-danger">
            <b>Информация о Бесплатной доставке:</b><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt inventore explicabo provident itaque, nam ipsam nesciunt recusandae magni possimus est earum sed vel atque, quisquam saepe assumenda. Nisi cupiditate ut et, perferendis eos delectus sed eum sit quidem cum facilis suscipit aperiam reprehenderit vel voluptatem quo consequuntur magni neque aut!
        </div>
    </div*/?>
</div>

<?php $form = \yii\widgets\ActiveForm::begin([
    'class' => 'form-horizontal',
    'method' => 'post',
]); ?>
<div class="row cart-info-block">
    <div class="col-lg-12">
        <div class="well">
            <?php /*b>Пояснения по заполнению этой формы:</b>
            <p>Какой-то текс.</p*/?>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">

                        <div class="form-group">
                            <label for="inputName4" class="col-sm-3 control-label">Имя<span class="req">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($order, 'name')->textInput(['placeholder' => 'Иванов Иван Иванович'])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone4" class="col-sm-3 control-label">Телефон<span class="req">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($order, 'phone')->textInput(['placeholder' => '380631234567'])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4" class="col-sm-3 control-label">Email<span class="req">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($order, 'email')->textInput(['placeholder' => 'mail@example.com'])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress4" class="col-sm-3 control-label">Адрес доставки<span class="req">*</span></label>
                            <div class="col-sm-9">
                                <?= $form->field($order, 'address')->textarea(['placeholder' => 'ул. Строителей, 42/53, домофон #53'])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress4" class="col-sm-3 control-label">Комментарий к заказу</label>
                            <div class="col-sm-9">
                                <?= $form->field($order, 'comment')->textarea(['placeholder' => 'Ваш комментарий к этому заказу'])->label(false); ?>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success btn-lg text-uppercase']); ?>
    </div>
</div>

<?php \yii\widgets\ActiveForm::end(); ?>

<?php else: ?>

<div class="row cart-info-block">
    <div class="col-lg-12 text-center">
        <div class="alert alert-info" role="alert">Ваша корзина пуста</div>
    </div>
</div>

<?php endif; ?>

</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->