<?php
error_reporting(E_ALL);
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот заказ??',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data){
                    $status_list = $data::getStatusListHtml();
                    return $status_list[$data->status];
                },
            ],
//            'user_id',
            'name',
            'email:email',
            'phone',
            'address',
            'comment:ntext',
        ],
    ]) ?>

    <?php
    $items = $model->orderItem;
    /*if(!empty($items)):
    ?>
        <h4>Товары в заказе:</h4>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>ID товара</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($items as $product): ?>
                    <tr>
                        <td><?= $product->product_id; ?></td>
                        <td><a href="<?=Url::to(['product/view', 'id' => $product->product_id]); ?>" target="_blank"><?= $product->title; ?></a></td>
                        <td><?= $product->price; ?> грн.</td>
                        <td><?= $product->qty; ?></td>
                        <td><?= number_format((float)($product->sum), 2); ?> грн.</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-right">Итого: </td>
                    <td colspan="1"><?= number_format((float)$model->sum, 2); ?> грн.</td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php endif;*/ ?>

</div>
