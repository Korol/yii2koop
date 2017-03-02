<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

$category_filter = '<select class="form-control" name="ProductSearch[category_id]"><option value=""></option>';
$category_filter .= \app\components\MenuWidget::widget(['tpl' => 'select_product', 'model' => $searchModel]);
$category_filter .= '</select>';
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'id',
                'contentOptions'=>['style'=>'width: 70px;'],
            ],
            'title',
//            'url:url',
//            'price',
            [
                'attribute' => 'price',
                'format' => 'raw',
                'value' => function($data){
                    return $data->price . '<br>грн/' . $data->units;
                },
                'contentOptions'=>['style'=>'width: 100px;'],
            ],
//            'price_special',
            // 'units',
//             'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    return $data->getCategoryTitle();
                },
//                'filter' =>  \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title'),
                'filter' =>  $category_filter,
                'contentOptions'=>['style'=>'width: 280px;'],
            ],
            // 'content:ntext',
            // 'keywords',
            // 'description',
            // 'img',
//             'new',
            [
                'attribute' => 'new',
                'value' => function($data){
                    return $data->new ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
//             'hit',
            [
                'attribute' => 'hit',
                'value' => function($data){
                    return $data->hit ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
//             'sale',
            [
                'attribute' => 'sale',
                'value' => function($data){
                    return $data->sale ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
//             'popular',
            [
                'attribute' => 'popular',
                'value' => function($data){
                    return $data->popular ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
//             'recommended',
            [
                'attribute' => 'recommended',
                'value' => function($data){
                    return $data->recommended ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            // 'provider_id',
            // 'producer_id',
            // 'sku',
            // 'added_date',
            // 'provider_date',
            // 'write_off',
            // 'special_conditions:ntext',
//             'show',
            [
                'attribute' => 'show',
                'value' => function($data){
                    return $data->show ? 'Активен' : 'Скрыт';
                },
                'filter' => [0 => 'Скрыт', 1 => 'Активен'],
            ],
//             'qty',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function($data){
                    $img = $data->getMainImage($data->id);
                    return (!empty($img)) ? Html::img(\yii\helpers\Url::toRoute($img), ['alt' => $data->title]) : '';
                },
                'filter' => '',
                'enableSorting' => false,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>
