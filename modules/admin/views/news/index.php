<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'maxButtonCount' => 200,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'slug',
                'value' => function ($data){
                    return Html::a(
                        $data->slug,
                        \yii\helpers\Url::to(['/news/' . $data->id . '/' . $data->slug]),
                        ['target' => '_blank']
                    );
                },
                'format' => 'html',
            ],
//            'keywords',
            'cut:ntext',
            // 'content:ntext',
            [
                'attribute' => 'pubdate',
                'filter' => DatePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'pubdate',
                        'options' => [
                            'class' => 'form-control'
                        ],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]
                ),
                'format' => 'html',
            ],
            // 'created_at',
            // 'updated_at',
            [
                'attribute' => 'show',
                'value' => function($data){
                    return $data->show ? '<span class="label label-success">Активна</span>' : '<span class="label label-danger">Скрыта</span>';
                },
                'filter' => [0 => 'Скрыта', 1 => 'Активна'],
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия'],
        ],
    ]); ?>
</div>
