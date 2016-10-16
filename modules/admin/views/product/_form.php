<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_special')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'units')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-product-category_id">
        <label class="control-label" for="product-category_id">Категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">
            <?= \app\components\MenuWidget::widget(['tpl' => 'select_product', 'model' => $model]); ?>
        </select>
        <div class="help-block"></div>
    </div>

    <?php
    echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
//        'editorOptions' => [
//            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
//            'inline' => false, //по умолчанию false
//        ],
    ]);
    ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php
    if(!$model->isNewRecord){
        $mainImage = $model->getImage();
        if(!empty($mainImage) && ($mainImage->urlAlias != 'placeHolder')){
            echo '<div class="thumbnail product-form-thumb" id="pf_' . $mainImage->id . '">';
            echo Html::img([$mainImage->getUrl('100x100')]);
            echo '<button type="button" title="Удалить это фото" class="btn btn-danger btn-xs pf-delphoto-btn center-block" onclick="delProductPhoto(' . $model->id . ', ' . $mainImage->id . ');">Удалить</button>';
            echo '</div> ';
        }
    }
    ?>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <?php
    if(!$model->isNewRecord){
        $gallery = $model->getImages();
        if(!empty($gallery)){
            foreach($gallery as $image){
                if(!empty($image->isMain) || ($image->urlAlias == 'placeHolder')) continue;
                echo '<div class="thumbnail product-form-thumb" id="pf_' . $image->id . '">';
                echo Html::img([$image->getUrl('100x100')]);
                echo '<button type="button" title="Удалить это фото" class="btn btn-danger btn-xs pf-delphoto-btn center-block" onclick="delProductPhoto(' . $model->id . ', ' . $image->id . ');">Удалить</button>';
                echo '</div> ';
            }
            echo '<br/>';
        }
    }
    ?>

    <?= $form->field($model, 'new')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'hit')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'sale')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'popular')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'recommended')->checkbox(['0', '1']) ?>

<!--    --><?//= $form->field($model, 'new')->dropDownList(['0' => 'Нет', '1' => 'Да'], ['prompt' => '']) ?>
<!---->
<!--    --><?//= $form->field($model, 'hit')->dropDownList(['0' => 'Нет', '1' => 'Да'], ['prompt' => '']) ?>
<!---->
<!--    --><?//= $form->field($model, 'sale')->dropDownList(['0' => 'Нет', '1' => 'Да'], ['prompt' => '']) ?>
<!---->
<!--    --><?//= $form->field($model, 'popular')->dropDownList(['0' => 'Нет', '1' => 'Да'], ['prompt' => '']) ?>
<!---->
<!--    --><?//= $form->field($model, 'recommended')->dropDownList(['0' => 'Нет', '1' => 'Да'], ['prompt' => '']) ?>

    <?= $form->field($model, 'provider_id')->textInput() ?>

    <?= $form->field($model, 'producer_id')->textInput() ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'added_date')->textInput() ?>

    <?= $form->field($model, 'provider_date')->textInput() ?>

    <?= $form->field($model, 'write_off')->dropDownList([ 'нет' => 'нет', 'бой' => 'бой', 'утеря' => 'утеря', 'повреждение' => 'повреждение', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'special_conditions')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'show')->dropDownList(['0' => 'Скрыт', '1' => 'Активен']) ?>
    <?php $model->show = $model->isNewRecord ? 1 : $model->show; ?>
    <?= $form->field($model, 'show')->radioList(['0' => 'Скрыт', '1' => 'Активен']) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
