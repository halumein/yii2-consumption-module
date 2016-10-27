<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-12 col-md-4">
            <?php echo $form->field($newCategoryModel, 'name')->textInput(['maxlength' => true, 'placeholder' => 'наименование'])->label(false) ?>
        </div>
        <div class="col-sm-3 col-md-2">
            <?php echo Html::submitButton('Добавить категорию', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="row">
        <div class="col-sm-2 col-md-5">
            <p>
                <?php echo Html::a('Оприходовать', [Url::to(['/consumption/income/create'])], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-8 col-md-7" >
            <div class="service-menu">
                <?=$this->render('../_common/menu');?>
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
                    'name',
                    //'parent',

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update}{delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 110px;']],

                ],
            ]); ?>
        </div>
    </div>

</div>
