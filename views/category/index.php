<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="row">
        <div class="col-sm-2 col-md-5 text-right">
            <p>
                <?php echo Html::a('Оприходовать', ['/consumption/income/create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-8 col-md-7" >
            <div class="service-menu">
                <?=$this->render('../_common/menu');?>
            </div>
        </div>
    </div>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Добавить категорию</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-sm-12 col-md-4">
                    <?php echo $form->field($newCategoryModel, 'name')->textInput(['maxlength' => true, 'placeholder' => 'наименование'])->label(false) ?>
                </div>
                <div class="col-sm-3 col-md-2">
                    <?php echo Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [

                    //'id',
                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a($model->name, ['/consumption/category/update', 'id' => $model->id]);
                        }
                    ],
                    //'parent',

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update}{delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 110px;']],

                ],
            ]); ?>
        </div>
    </div>

</div>
