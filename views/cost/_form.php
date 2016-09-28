<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\consumption\models\Cost */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'transaction_id')->textInput() ?>

    <?php echo $form->field($model, 'income_id')->textInput() ?>

    <?php echo $form->field($model, 'consume_amount')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
