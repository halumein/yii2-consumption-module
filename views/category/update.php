<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Изменить категорию: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
