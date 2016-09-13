<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Norm */

$this->title = 'Добавить норму';
$this->params['breadcrumbs'][] = ['label' => 'Нормы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'resources' => $resources,
    ]) ?>

</div>
