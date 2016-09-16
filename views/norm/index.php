<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Нормы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Добавить норму', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => false
            ],
            [
                'attribute' => 'element_id',
                'value' => 'element.name'
            ],
            [
                'attribute' => 'resource_id',
                'value' => 'resource.title'
            ],
            [
                'attribute' => 'consumption',
                'filter' => false
            ],
            [
                'attribute' => 'comment',
                'filter' => false
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 105px;']],
        ],
    ]); ?>

</div>