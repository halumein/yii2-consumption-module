<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Consume */

$this->title = 'Добавить расход';
$this->params['breadcrumbs'][] = ['label' => 'Расход', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consume-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'resources' => $resources,
    ]) ?>

</div>
