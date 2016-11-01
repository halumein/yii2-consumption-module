<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use nex\datepicker\DatePicker;
use yii\helpers\Url;


$this->title = 'Остатки';
$this->params['breadcrumbs'][] = $this->title;
if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('d.m.Y', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('d.m.Y', strtotime($dateStop));
}
?>
<div class="income-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-sm-2 col-md-5 text-right">
            <p>
                <?php echo Html::a('Оприходовать', ['create'], ['class' => 'btn btn-success']) ?>
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
                <input type="hidden" name="IncomeSearch[name]" value="" />
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
                    <a class="btn btn-default" href="<?= Url::to(['/consumption/income/index']) ?>" />Cбросить все фильтры</a>
                </div>
            </form>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            // [
            //     'attribute' => 'id',
            //     'filter' => false,
            //     'contentOptions' => [
            //         'width' => 35
            //     ]
            // ],
            [
                'attribute' => 'resource_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'resource_id',
                    ArrayHelper::map($resources, 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все ресурсы']
                ),
                'value' => function($model) {
                    return  $model->resource->title;
                },
            ],
            [
                'attribute' => 'income',
                'value' => function($model) {
                    return  $model->income . " " . $model->resource->measures;
                },
                'filter' => false,
            ],
            [
                'attribute' => 'amount',
                'value' => function($model) {
                    return  $model->remain->amount . " " . $model->resource->measures;
                },
                'filter' => false,
            ],
            [
                'attribute' => 'cost',
                'filter' => false,
            ],
            [
                'attribute' => 'date',
                'filter' => false,
            ],
            [
                'attribute' => 'user_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'user_id',
                    ArrayHelper::map($activeUsers, 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все сотрудники']
                ),
                'value' => 'user.fullName'
            ],

            //['class' => 'yii\grid\ActionColumn', 'template' => '{update}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 55px;']],

        ],
    ]); ?>

</div>
