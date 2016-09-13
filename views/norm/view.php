<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Norm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Нормы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-view">

    <p>
        <?php echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уврены что хотите удалить эту норму?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'element_model',
            'element_id',
            'resource_id',
            'consumption',
            'comment',
        ],
    ]) ?>

</div>
