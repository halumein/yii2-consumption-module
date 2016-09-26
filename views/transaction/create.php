<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Добавить транзакцию';
$this->params['breadcrumbs'][] = ['label' => 'Транзакция', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consume-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'resources' => $resources,
    ]) ?>

</div>
