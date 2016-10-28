<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-form">

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-12">
            <?php echo $form->errorSummary($model); ?>
        </div>
        <div class="col-sm-10 col-md-4">
            <?= $form
                    ->field($model, 'name')
                    ->textInput(['maxlength' => true, 'placeholder' => 'Название категории'])
                    ->label(false)?>
        </div>
        <div class="col-sm-2 col-md-2">
            <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить название', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>



    <?php //echo $form->field($model, 'parent')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>
