<?php
use yii\bootstrap\Nav;
?>
<div class="menu-container">
    <?= Nav::widget([
        'items' => yii::$app->getModule('consumption')->menu,
        'options' => ['class' =>'nav-pills pull-right'],
    ]); ?>
</div>
