<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-sm-4 col-md-3">
            <p>
                <?php echo Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-8 col-md-9" >
            <ul class="nav nav-pills pull-right">
                <li class="active"><a href="<?= Url::to(['/consumption/category/index']) ?>">Категории</a></li>
                <li><a href="<?= Url::to(['/consumption/resource/index']) ?>">Ресурсы</a></li>
                <li><a href="<?= Url::to(['/consumption/norm/index']) ?>">Нормы</a></li>
                <li><a href="<?= Url::to(['/consumption/cost/index']) ?>">Расходы</a></li>
                <li><a href="<?= Url::to(['/consumption/income/index']) ?>">Приходы</a></li>
                <li><a href="<?= Url::to(['/consumption/transaction/index']) ?>">Операции</a></li>
            </ul>
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
