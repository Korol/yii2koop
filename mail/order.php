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
            <td style="padding: 8px; border: 1px solid #ddd; text-align: right" colspan="3" class="text-right">Итого: </td>
            <td style="padding: 8px; border: 1px solid #ddd;" colspan="1"><?= number_format((float)$session['cart.sum'], 2); ?> грн.</td>
        </tr>
        </tbody>
    </table>
</div>