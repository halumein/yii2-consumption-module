<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Consume */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="consume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'element_id')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($services, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите сервис ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php echo $form->field($model, 'resource_id')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($resources, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите ресурс ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php echo $form->field($model, 'consume')->textInput() ?>

    <?php echo $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
