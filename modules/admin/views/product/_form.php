<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */

$providers = \yii\helpers\ArrayHelper::map(\app\modules\admin\models\Provider::find()->orderBy('title ASC')->asArray()->all(), 'id', 'title');
$producers = \yii\helpers\ArrayHelper::map(\app\modules\admin\models\Producer::find()->orderBy('title ASC')->asArray()->all(), 'id', 'title');
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => 'Оставьте поле пустым – и URL будет сгенерирован автоматически']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Число, разделитель дробной части – точка: 13.95']) ?>

    <?= $form->field($model, 'price_special')->textInput(['maxlength' => true, 'placeholder' => 'Число, разделитель дробной части – точка: 13.95']) ?>

    <?= $form->field($model, 'units')->dropDownList($model->getUnitsList()) ?>

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

    <?= $form->field($model, 'provider_id')->dropDownList($providers); ?>

    <?= $form->field($model, 'producer_id')->dropDownList($producers) ?>

<!--    --><?//= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?php
    if($model->isNewRecord){
        $model->added_date = $model->provider_date = date('Y-m-d');
    }
    else{
        if(!empty($model->added_date)){
            $added_ex = explode(' ', $model->added_date);
            $model->added_date = $added_ex[0];
        }
        else{
            $model->added_date = date('Y-m-d');
        }
        if(!empty($model->provider_date)){
            $provider_ex = explode(' ', $model->provider_date);
            $model->provider_date = $provider_ex[0];
        }
        else{
            $model->provider_date = date('Y-m-d');
        }
    }
    ?>
    <?= $form->field($model, 'added_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'provider_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'write_off')->dropDownList($model->getWriteOffList()) ?>

    <?= $form->field($model, 'special_conditions')->textarea(['rows' => 6]) ?>

    <?php $model->show = $model->isNewRecord ? 1 : $model->show; ?>
    <?= $form->field($model, 'show')->radioList(['0' => 'Скрыт', '1' => 'Активен']) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
