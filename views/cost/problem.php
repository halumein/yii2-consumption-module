<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходы, не разнесенные на приходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problem-index">

<!--    <p>-->
<!--        --><?php //echo Html::a('Разнести затраты на приходы', ['problem'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['cost/resolve-problem'])
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Разнести затраты на приходы', ['class' =>  'btn btn-success']) ?>
    </div

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'transaction_id',
            [
                'attribute' => 'resource_id',
                'value' => function($model) {
                    return  $model->transaction->resource->name;
                },
                'filter' => false,
            ],
            'income_id',
            'consume_amount',
            'date',

        ],
    ]); ?>

    <?php $form = ActiveForm::end(); ?>
</div>
