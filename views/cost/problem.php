<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходы, не разнесенные на приходы';
$this->params['breadcrumbs'][] = $this->title;


\halumein\consumption\assets\CostHandlerAsset::register($this);

?>


<div class="problem-index">


    <?php $form = ActiveForm::begin([
        'action' => Url::to(['cost/resolve-problem'])
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Разнести затраты на приходы', ['class' =>  'btn btn-success']) ?>
    </div

    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectall"/></th>
                <th data-role="test">ID транзакции</th>
                <th>Ресурс</th>
                <th>Количество затраты</th>
                <th>Дата транзакции</th>
            </tr>
            </thead>
            <tbody>
            <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'emptyText' => 'Не разнесенных расходов не найдено',
                'itemOptions' => [
                    'tag' => 'tr',
                ],
                'itemView' => '_listItem',
            ]);
            ?>
            </tbody>
        </table>
    </div>



    <?php
//        echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            'id',
//            'transaction_id',
//            [
//                'attribute' => 'resource_id',
//                'value' => function($model) {
//                    return  $model->transaction->resource->name;
//                },
//                'filter' => false,
//            ],
//            'income_id',
//            'consume_amount',
//            'date',
//
//        ],
//    ]);
    ?>

    <?php $form = ActiveForm::end(); ?>

    <?php

    if (Yii::$app->getSession()->getFlash('error')) {
        echo  Alert::widget([
                'options' => [
                    'class' => 'alert alert-warning',
                ],
                'body' => Yii::$app->getSession()->getFlash('error'),
            ]
        );
    }
    ?>
</div>

