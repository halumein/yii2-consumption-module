<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use halumein\consumption\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ResourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходные материалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-sm-2 col-md-2">
            <p>
                <?php echo Html::a('Добавить расходник', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-2 col-md-3 text-right">
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
                    // [
                    //     'attribute' => 'id',
                    //     'filter' => false,
                    //     'contentOptions' => [
                    //         'width' => 35
                    //     ]
                    // ],
                    [
                        'attribute' => 'title',
                        'filter' => false,
                        'contentOptions' => [
                            'width' => 155
                        ]
                    ],
                    // [
                    //     'attribute' => 'dimension',
                    //     'filter' => false,
                    //     'contentOptions' => [
                    //         'width' => 120
                    //     ]
                    // ],
                    [
                        'attribute' => 'measures',
                        'filter' => false,
                        'contentOptions' => [
                            'width' => 150
                        ]
                    ],
                    // [
                    //     'attribute' => 'base_unit',
                    //     'filter' => false,
                    //     'contentOptions' => [
                    //         'width' => 180
                    //     ]
                    // ],
                    // [
                    //     'attribute' => 'base_cost',
                    //     'filter' => false
                    // ],
                    [
                        'attribute' => 'category_id',
                        'filter' => Html::activeDropDownList(
                        $searchModel,
                        'category_id',
                        ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                        ['class' => 'form-control', 'prompt' => 'Все категории']
                        ),
                        'value' => 'category.name'
                        ],
                        [
                        'attribute' => 'comment',
                        'filter' => false,
                        ],

                        ['class' => 'yii\grid\ActionColumn', 'template' => '{update}{delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 110px;']],

                        ],
                        ]); ?>
        </div>
    </div>

</div>
