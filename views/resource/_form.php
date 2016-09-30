<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Resource */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="resource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'dimension')->textInput(['maxlength' => true, 'placeholder' => '0.000']) ?>

    <?php echo $form->field($model, 'measures')->textInput(['maxlength' => true, 'placeholder' => '(штуки, килограммы, литры ит.д)']) ?>

    <?php echo $form->field($model, 'base_unit')->textInput(['maxlength' => true, 'placeholder' => '0.000']) ?>

    <?php echo $form->field($model, 'base_cost')->textInput(['maxlength' => true, 'placeholder' => '0.00 рублей']) ?>

    <?php
        echo $form->field($model, 'category_id')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($categories, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите категорию ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php echo $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
