<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [];
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Категорию', ['create'], ['class' => 'btn btn-success']) ?>
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
            'url',
//            'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($data){
                    return $data->getParentTitle();
                },
//                'filter' => function($data){
//                    return $data->getParentsList();
//                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title'),
            ],
//            'path',
            // 'keywords:ntext',
            // 'description:ntext',
            // 'show',
            [
                'attribute' => 'show',
                'value' => function($data){
                    return $data->show ? 'Активна' : 'Скрыта';
                },
                'filter' => array('0' => 'Скрыта', '1' => 'Активна'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
