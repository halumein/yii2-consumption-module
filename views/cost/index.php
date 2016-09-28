<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Стоимости расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-index">


    <p>
        <?php //echo Html::a('Create Cost', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'transaction_id',
            'income_id',
            'consume_amount',
            'date',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
