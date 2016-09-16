<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConsumeSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="consume-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'date') ?>

    <?php echo $form->field($model, 'order_model') ?>

    <?php echo $form->field($model, 'ident') ?>

    <?php echo $form->field($model, 'element_model') ?>

    <?php // echo $form->field($model, 'element_id') ?>

    <?php // echo $form->field($model, 'norm_id') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
