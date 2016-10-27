<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Resource */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Расходные материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
