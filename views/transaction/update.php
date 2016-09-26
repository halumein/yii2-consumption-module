<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Изменить транзакцию: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="consume-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'resources' => $resources,
    ]) ?>

</div>
