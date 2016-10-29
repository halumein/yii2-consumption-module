<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

$this->title = 'Изменить категорию: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Создать расходный метариал в текущую категорию</h3>
        </div>
        <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->errorSummary($newResourceModel); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <?php echo $form->field($newResourceModel, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                    <?php // echo $form->field($model, 'dimension')->textInput(['maxlength' => true, 'placeholder' => '0.000']) ?>
                    <div class="col-sm-6 col-md-4">
                        <?php echo $form->field($newResourceModel, 'measures')->textInput(['maxlength' => true, 'placeholder' => '(штуки, килограммы, литры ит.д)']) ?>
                    </div>

                <?php // echo $form->field($model, 'base_unit')->textInput(['maxlength' => true, 'placeholder' => '0.000']) ?>

                <?php // echo $form->field($model, 'base_cost')->textInput(['maxlength' => true, 'placeholder' => '0.00 рублей']) ?>
                    <div class="col-sm-6 col-md-4">
                        <?php echo $form->field($newResourceModel, 'comment')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
    </div>

    <h3>Расходные материалы категории:</h3>

    <div class="row">
        <div class="col-sm-12">
            <?php echo GridView::widget([
                'dataProvider' => $resourceDataProvider,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'filter' => false,
                        'contentOptions' => [
                            'width' => 155
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
                    'attribute' => 'comment',
                    'filter' => false,
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}{delete}',
                        'buttons' => [
                            'update' => function($url, $model, $key) {
                                $options = [
                                    'title' => Yii::t('yii', 'Update'),
                                    'aria-label' => Yii::t('yii', 'Update'),
                                    'data-pjax' => '0',
                                    'class' => 'btn btn-default'
                                ];
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['/consumption/resource/update', 'id' => $model->id]), $options);
                            },
                            'delete' => function($url, $model, $key) {

                                $options = [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'aria-label' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => 'Удалить ресурс?',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                    'class' => 'btn btn-default'
                                ];
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(['/consumption/resource/delete', 'id' => $model->id]), $options);
                            },
                        ],
                        'options' => ['style' => 'width: 110px;']
                    ],

                ],
            ]); ?>
        </div>
    </div>

</div>
