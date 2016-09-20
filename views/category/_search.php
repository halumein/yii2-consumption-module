<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategorySearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'parent') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
