<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'maxButtonCount' => 200,
        ],
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'qty',
            'sum',
            // 'status',
            // 'user_id',
             'name',
             //'email:email',
             'phone',
             'address',
            // 'comment:ntext',
            [
                'attribute' => 'created_at',
                'filter' => DatePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        'options' => [
                            'class' => 'form-control'
                        ],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]
                ),
                'format' => 'html',
            ],
//            'updated_at',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data){
                    $status_list = $data::getStatusListHtml();
                    return $status_list[$data->status];
                },
                'filter' => \app\modules\admin\models\Order::getStatusList(),
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия'],
        ],
    ]); ?>
</div>
