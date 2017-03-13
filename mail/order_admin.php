<br/>
<h3>Информация о заказе №<?= $order->id; ?> в интернет-магазине «Вкус Жизни»</h3>
<div class="table-responsive">
    <table style="width: 50%; border: 1px solid #ddd; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;"><b>ФИО:</b></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left"><?= $order->name; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;"><b>Телефон:</b></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left"><?= $order->phone; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;"><b>Email:</b></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left"><?= $order->email; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;"><b>Адрес:</b></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left"><?= $order->address; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;"><b>Комментарий:</b></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left"><?= $order->comment; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<br/>
<br/>
<h3>Информация о товарах в заказе:</h3>
<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <thead>
        <tr style="background: #f9f9f9">
            <th style="padding: 8px; border: 1px solid #ddd;">Название</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Кол-во</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Стоимость</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($session['cart'] as $p_id => $product): ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $product['title']; ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $product['price']; ?> грн.</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $product['qty']; ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= number_format((float)($product['price'] * $product['qty']), 2); ?> грн.</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; text-align: right" colspan="3" class="text-right"><b>Итого:</b> </td>
            <td style="padding: 8px; border: 1px solid #ddd;" colspan="1"><?= number_format((float)$session['cart.sum'], 2); ?> грн.</td>
        </tr>
        </tbody>
    </table>
</div>