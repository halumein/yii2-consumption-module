<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Norm */

$this->title = 'Изменить норму: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Нормы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="norm-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'resources' => $resources,
    ]) ?>

</div>
