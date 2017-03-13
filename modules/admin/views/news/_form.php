<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'placeholder' => 'Оставьте поле пустым – и URL будет сгенерирован автоматически']) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'placeholder' => 'МЕТА-тег keywords']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3, 'placeholder' => 'МЕТА-тег description']) ?>

    <?= $form->field($model, 'cut')->textarea(['rows' => 6, 'placeholder' => 'Краткий текст – для списка новостей']) ?>

    <?php
    echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',['height' => 500]),
    ]);
    ?>

    <?php
    if($model->isNewRecord){
        $model->pubdate = date('Y-m-d');
    }
    ?>
    <?= $form->field($model, 'pubdate')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            'class' => 'form-control'
        ],
    ]) ?>

    <?php /* $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() */?>

    <?php $model->show = $model->isNewRecord ? 1 : $model->show; ?>
    <?= $form->field($model, 'show')->radioList(['0' => 'Скрыта', '1' => 'Активна']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
