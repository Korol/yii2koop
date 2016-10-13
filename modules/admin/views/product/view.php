<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'url',
            'price',
            'price_special',
            'units',
//            'category_id',
            [
                'attribute' => 'category_id',
                'value' => $model->getCategoryTitle(),
            ],
            'content:html',
            'keywords',
            'description',
            'img',
//            'new',
            [
                'attribute' => 'new',
                'value' => $model->new ? 'Да' : 'Нет',
            ],
//            'hit',
            [
                'attribute' => 'hit',
                'value' => $model->hit ? 'Да' : 'Нет',
            ],
//            'sale',
            [
                'attribute' => 'sale',
                'value' => $model->sale ? 'Да' : 'Нет',
            ],
//            'popular',
            [
                'attribute' => 'popular',
                'value' => $model->popular ? 'Да' : 'Нет',
            ],
//            'recommended',
            [
                'attribute' => 'recommended',
                'value' => $model->recommended ? 'Да' : 'Нет',
            ],
            'provider_id',
            'producer_id',
            'sku',
            'added_date',
            'provider_date',
            'write_off',
            'special_conditions:ntext',
//            'show',
            [
                'attribute' => 'show',
                'value' => $model->show ? 'Активен' : 'Скрыт',
            ],
            'qty',
        ],
    ]) ?>

</div>
