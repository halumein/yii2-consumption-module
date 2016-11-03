<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use pistol88\service\models\Price;
use halumein\consumption\models\Resource;
use yii\helpers\ArrayHelper;
use nex\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;
if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('d.m.Y', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('d.m.Y', strtotime($dateStop));
}
?>
<div class="transaction-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-sm-2 col-md-2">
        </div>
        <div class="col-sm-2 col-md-3 text-right">
            <p>
                <?php echo Html::a('Оприходовать', ['/consumption/income/create'], ['class' => 'btn btn-success']) ?>
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
                <input type="hidden" name="TransactionSearch[name]" value="" />
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
                    <a href="<?= Url::to(['/consumption/transaction/index']) ?>" /><div class="form-control text-center">Cбросить все фильтры</div></a>
                </div>
            </form>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' =>'ident',
                'contentOptions' => [
                    'width' => 40]
            ],
            [
                'attribute' =>'type',
                'contentOptions' => [
                    'width' => 80
                ],
                'value' => function ($model) {
                    return ($model->type === 'income') ? 'Приход' : 'Расход';
                },
            ],
            [
                'attribute' => 'element_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'element_id',
                    ArrayHelper::map(Price::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все услуги']
                ),
                'value' => function ($model) {
                    if ($model->ident === 0 && $model->type === 'income') {
                        return 'Приход на склад';
                    } else if ($model->ident === 0 && $model->type === 'outcome') {
                        return 'Списание со склада';
                    } else {
                        return $model->element->name;
                    }
                },
            ],
            [
                'attribute' => 'resource_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'resource_id',
                    ArrayHelper::map(Resource::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все ресурсы']
                ),
                'value' => function($model) {
                        return  $model->resource->title . ' : ' . $model->count;
                },
//                'contentOptions' => [
//                    'width' => 450],
            ],
            // [
            //     'attribute' => 'amount',
            //     'filter' => false,
            //     'contentOptions' => [
            //         'width' => 130],
            // ],
            [
                'attribute' => 'date',
                'contentOptions' => [
                    'width' => 180],
                'filter' => false,
            ],
//            [
//                'attribute' => 'comment',
//                'filter' => false,
//                'contentOptions' => [
//                    'width' => 180],
//            ],

            //['class' => 'yii\grid\ActionColumn', 'template' => '{update}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 55px;']],
        ],
    ]); ?>

</div>
