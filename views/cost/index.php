<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use nex\datepicker\DatePicker;


if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('d.m.Y', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('d.m.Y', strtotime($dateStop));
}

$this->title = 'Стоимости расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-index">


    <div class="row">
        <div class="col-sm-2 col-md-5 text-right">
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

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?=yii::t('order', 'Search');?></h3>
        </div>
        <div class="panel-body">
            <form action="" class="row search">
                <input type="hidden" name="CostSearch[name]" value="" />
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <?= DatePicker::widget([
                                'name' => 'date_start',
                                'addon' => false,
                                'value' => $dateStart,
                                'size' => 'sm',
                                'language' => 'ru',
                                'placeholder' => yii::t('order', 'Date from'),
                                'clientOptions' => [
                                    'format' => 'L',
                                    'minDate' => '2015-01-01',
                                    'maxDate' => date('Y-m-d'),
                                ],
                                'dropdownItems' => [
                                    ['label' => 'Yesterday', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('-1 day')],
                                    ['label' => 'Tomorrow', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('+1 day')],
                                    ['label' => 'Some value', 'url' => '#', 'value' => 'Special value'],
                                ],
                            ]);?>
                        </div>
                        <div class="col-md-6">
                            <?= DatePicker::widget([
                                'name' => 'date_stop',
                                'addon' => false,
                                'value' => $dateStop,
                                'size' => 'sm',
                                'placeholder' => yii::t('order', 'Date to'),
                                'language' => 'ru',
                                'clientOptions' => [
                                    'format' => 'L',
                                    'minDate' => '2015-01-01',
                                    'maxDate' => date('Y-m-d'),
                                ],
                                'dropdownItems' => [
                                    ['label' => yii::t('order', 'Yesterday'), 'url' => '#', 'value' => \Yii::$app->formatter->asDate('-1 day')],
                                    ['label' => yii::t('order', 'Tomorrow'), 'url' => '#', 'value' => \Yii::$app->formatter->asDate('+1 day')],
                                    ['label' => yii::t('order', 'Some value'), 'url' => '#', 'value' => 'Special value'],
                                ],
                            ]);?>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <input class="form-control btn-success" type="submit" value="Поиск" />
                </div>

                <div class="col-md-3">
                    <a class="btn btn-default" href="<?= Url::to(['/consumption/cost/index']) ?>" />Cбросить все фильтры</a>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    // 'id',
                    // 'transaction_id',
                    [
                        'label' => 'Объект',
                        'value' => function($model) {
                            $elementModel = $model->transaction->element_model;
                            $element = $elementModel::findOne($model->transaction->element_id);
                            return $element->name;
                        }
                    ],
                    [
                        'attribute' => 'resource_id',
                        'value' => function($model) {
                            return  $model->transaction->resource->name;
                        },
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'income_id',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'consume_amount',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'consume_cost',
                        'value' => function($model) {
                            return  $model->consumeCost;
                        },
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'date',
                        'value' => function($model) {
                            return date('d.m.Y H:i:s', strtotime($model->date));
                        },
                        'options' => ['style' => 'width: 100px;'],
                    ]
                ],
            ]); ?>
        </div>
    </div>


</div>
