<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Income */

$this->title = 'Изменить приход: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Приходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="income-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'resources' => $resources,
    ]) ?>

</div>
