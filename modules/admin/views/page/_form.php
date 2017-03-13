<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'placeholder' => 'МЕТА-тег keywords']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3, 'placeholder' => 'МЕТА-тег description']) ?>

    <?php
    echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'height' => 600,
        ]),
    ]);
    ?>

    <?= $form->field($model, 'show')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
