<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use halumein\consumption\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Norm */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="norm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
    echo $form->field($model, 'element_id')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($services, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите сервис ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'resource_category')->dropDownList(
            ArrayHelper::map(Category::find()->all(), 'id', 'name'),
            [
                'prompt' => 'Все категории',
                'onchange'=>'
                    $.get( "'.Url::toRoute('/consumption/resource/get-by-category').'", { categoryId: $(this).val() } )
                        .done(function( data ) {
                            $( "#'.Html::getInputId($model, 'resource_id').'" ).html( data );
                        }
                    );
                '
            ]
            )->label('Категория ресурса')?>

    <?php
        echo $form->field($model, 'resource_id')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($resources, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите ресурс ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php echo $form->field($model, 'consumption')->textInput(['maxlength' => true, 'placeholder' => '0.000']) ?>

    <?php echo $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
