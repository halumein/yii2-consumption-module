<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\search\IncomeSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="income-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'date') ?>

    <?php echo $form->field($model, 'resource_id') ?>

    <?php echo $form->field($model, 'income') ?>

    <?php echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'balance') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
