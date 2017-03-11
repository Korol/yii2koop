<?php

?>
<div class="col-md-9 col-md-push-3 content-block">
<div class="row">
    <div class="col-lg-12">
        <h3 class="lined"><span>Корзина</span></h3>
    </div>
</div>
<?php if(!empty($products)): ?>
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
            <th>#</th>
            <th>Название</th>
            <th>Ед.</th>
            <th>Цена</th>
            <th class="cart-qty-column">Кол-во товара</th>
            <th>Стоимость</th>
            <th>Удалить</th>
            </thead>
            <tbody>
            <?php foreach($products as $key => $product): ?>
                <tr id="cart_tr_<?=$product->id;?>">
                    <td class="text-center"><?=++$key;?></td>
                    <td><?=$product->title; ?></td>
                    <td><?=$product->units; ?></td>
                    <td><span id="pprice_<?=$product->id;?>"><?=$cart[$product->id]['price']; ?></span> грн</td>
                    <td>
                        <div class="input-group product-qty-grid-block">
                        <span class="input-group-btn">
                            <button class="btn btn-default ppqminus" type="button" id="ppqminus_<?=$product->id;?>">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        </span>
                            <input type="text" class="form-control qty-input" value="<?=$cart[$product->id]['qty'];?>" readonly id="ppqty_<?=$product->id;?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default ppqplus" type="button" id="ppqplus_<?=$product->id;?>">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </span>
                        </div><!-- /input-group -->
                    </td>
                    <?php $p_cost = $cart[$product->id]['qty']*$cart[$product->id]['price']; ?>
                    <td><span class="cart-cost" id="pcost_<?=$product->id;?>"><?=$p_cost; ?></span> грн</td>
                    <td class="text-center">
                        <button type="button" onclick="removeFromCart(<?=$product->id;?>)" class="btn btn-danger">&times;</button>
                    </td>
                </tr>
                <?php
                $cart_total += $p_cost;
                ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="7" class="text-right">
                    <span class="text-uppercase">Всего:</span>
                    <span class="cart-total-cost"><span id="cart_total"><?=number_format($cart_total, 2);?></span></span> грн
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <b>Информация о Бесплатной доставке:</b><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt inventore explicabo provident itaque, nam ipsam nesciunt recusandae magni possimus est earum sed vel atque, quisquam saepe assumenda. Nisi cupiditate ut et, perferendis eos delectus sed eum sit quidem cum facilis suscipit aperiam reprehenderit vel voluptatem quo consequuntur magni neque aut!
        </div>
    </div>
</div>

<div class="row cart-info-block">
    <div class="col-lg-12">
        <div class="well">
            <b>Пояснения по заполнению этой формы:</b>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus ex, quia aliquid aut necessitatibus, repellat error ullam fugit asperiores vero doloribus, eius quos saepe molestiae at odio expedita inventore dolores iste doloremque tenetur officia, veritatis. Incidunt, facilis dicta sed dignissimos dolores consectetur nam sint, quis, perferendis eaque totam tenetur placeat.</p>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form class="form-horizontal" name="orderForm" method="post" action="/thanks.php">
                        <div class="form-group">
                            <label for="inputName4" class="col-sm-3 control-label">Имя</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName4" placeholder="Иванов Иван Иванович">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone4" class="col-sm-3 control-label">Телефон</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPhone4" placeholder="380631234567">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="inputEmail4" placeholder="mail@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress4" class="col-sm-3 control-label">Адрес доставки</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="inputAddress4" rows="3" placeholder="ул. Строителей, 42/53, домофон #53"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress4" class="col-sm-3 control-label">Комментарий к заказу</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="inputAddress4" rows="3" placeholder="Ваш комментарий к этому заказу"></textarea>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="row">
    <div class="col-lg-12 text-center">
        <div class="alert alert-info" role="alert">Ваша корзина пуста</div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12 text-center">
        <button type="button" onclick="document.orderForm.submit();" class="btn btn-success btn-lg text-uppercase">Оформить заказ</button>
    </div>
</div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->