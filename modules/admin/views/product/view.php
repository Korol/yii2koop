<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$producer = \app\modules\admin\models\Producer::find()->where(['id' => $model->producer_id])->asArray()->one();
$provider = \app\modules\admin\models\Provider::find()->where(['id' => $model->provider_id])->asArray()->one();
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
    <?php $image = $model->getImage(); ?>
    <?php
    $gallery_value = '';
    $gallery = $model->getImages();
    if(!empty($gallery)){
        foreach($gallery as $gallery_image){
            if(!empty($gallery_image->isMain)) continue;
            $gallery_value .= '<img src="' . $gallery_image->getUrl('100x100') . '"/>&nbsp;';
        }
    }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'url',
            'price',
            'price_special',
            'units',
            [
                'attribute' => 'category_id',
                'value' => $model->getCategoryTitle(),
            ],
            'content:html',
            'keywords',
            'description',
            [
                'attribute' => 'image',
                'value' => '<img src="' . $image->getUrl('100x100') . '"/>',
                'format' => 'html',
            ],
            [
                'attribute' => 'gallery',
                'value' => $gallery_value,
                'format' => 'html',
            ],
            [
                'attribute' => 'new',
                'value' => $model->new ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'hit',
                'value' => $model->hit ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'sale',
                'value' => $model->sale ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'popular',
                'value' => $model->popular ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'recommended',
                'value' => $model->recommended ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'provider_id',
                'value' => $provider['title'],
            ],
            [
                'attribute' => 'producer_id',
                'value' => $producer['title'],
            ],
            'sku',
            'added_date',
            'provider_date',
            'write_off',
            'special_conditions:ntext',
            [
                'attribute' => 'show',
                'value' => $model->show ? 'Активен' : 'Скрыт',
            ],
            'qty',
        ],
    ]) ?>

</div>
