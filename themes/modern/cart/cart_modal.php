<?php if(!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Стоимость</th>
                    <th class="text-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($session['cart'] as $p_id => $product): ?>
                <tr>
                    <td><?= $product['title']; ?></td>
                    <td><?= $product['price']; ?> грн.</td>
                    <td><?= $product['qty']; ?></td>
                    <td><?= number_format((float)($product['price'] * $product['qty']), 2); ?> грн.</td>
                    <td class="text-right">
                        <span data-id="<?=$p_id; ?>" class="glyphicon glyphicon-remove text-danger modal-del-item" aria-hidden="true"></span>
                    </td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-right">Итого: </td>
                    <td colspan="2"><?= number_format((float)$session['cart.sum'], 2); ?> грн.</td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="alert alert-info" role="alert">Ваша корзина пуста</div>
        </div>
    </div>
<?php endif; ?>