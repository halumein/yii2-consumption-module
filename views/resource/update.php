<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Resource */

$this->title = 'Изменить расходник: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Расходные материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="resource-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
