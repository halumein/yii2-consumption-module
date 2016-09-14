<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Consume */

$this->title = 'Изменить расход: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Расходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="consume-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
