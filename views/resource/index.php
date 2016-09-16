<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ResourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ресурсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Добавить ресурс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => false,
                'contentOptions' => [
                    'width' => 35
                ]
            ],
            [
                'attribute' => 'title',
                'filter' => false,
                'contentOptions' => [
                    'width' => 155
                ]
            ],
            [
                'attribute' => 'dimension',
                'filter' => false,
                'contentOptions' => [
                    'width' => 120
                ]
            ],
            [
                'attribute' => 'measures',
                'filter' => false,
                'contentOptions' => [
                    'width' => 150
                ]
            ],
            [
                'attribute' => 'base_unit',
                'filter' => false,
                'contentOptions' => [
                    'width' => 180
                ]
            ],
            [
                'attribute' => 'base_cost',
                'filter' => false
            ],
            [
                'attribute' => 'comment',
                'filter' => false,
            ],

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' =>
                [
                'width' => 80
                ]
            ],
        ],
    ]); ?>

</div>
