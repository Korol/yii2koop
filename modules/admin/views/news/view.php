<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту новость?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Создать Новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'slug',
            'keywords',
            'description:ntext',
            'cut:ntext',
            'content:html',
            'pubdate',
            'created_at',
            'updated_at',
            [
                'attribute' => 'show',
                'value' => $model->show ? '<span class="label label-success">Активна</span>' : '<span class="label label-danger">Скрыта</span>',
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
