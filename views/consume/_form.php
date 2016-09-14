<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Consume */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="consume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->field($model, 'date')->textInput() ?>

    <?php //echo $form->field($model, 'order_model')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'order_id')->textInput() ?>

    <?php //echo $form->field($model, 'element_model')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'element_id')->textInput() ?>

    <?php echo $form->field($model, 'norm_id')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
