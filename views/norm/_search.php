<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NormSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="norm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'element_model') ?>

    <?php echo $form->field($model, 'element_id') ?>

    <?php echo $form->field($model, 'resource_id') ?>

    <?php echo $form->field($model, 'consumption') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
