<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Стоимости расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-index">


    <div class="row">
        <div class="col-sm-12" >
            <ul class="nav nav-pills pull-right">
                <li><a href="<?= Url::to(['/consumption/category/index']) ?>">Категории</a></li>
                <li><a href="<?= Url::to(['/consumption/resource/index']) ?>">Ресурсы</a></li>
                <li><a href="<?= Url::to(['/consumption/norm/index']) ?>">Нормы</a></li>
                <li class="active"><a href="<?= Url::to(['/consumption/cost/index']) ?>">Расходы</a></li>
                <li><a href="<?= Url::to(['/consumption/income/index']) ?>">Приходы</a></li>
                <li><a href="<?= Url::to(['/consumption/transaction/index']) ?>">Операции</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
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
                    [
                        'attribute' => 'consume_cost',
                        'value' => function($model) {
                            return  $model->consumeCost;
                        },
                        'filter' => false,
                    ],
                    'date',

                ],
            ]); ?>
        </div>
    </div>


</div>
