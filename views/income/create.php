<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Income */

$this->title = 'Оприходовать расходник';
$this->params['breadcrumbs'][] = ['label' => 'Остатки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'resources' => $resources,
    ]) ?>

</div>
