<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//
?>


    <td>
        <input type="checkbox" class="case" name="costIds[]" value="<?= $model->id ?>"/>
    </td>
    <td>
        <?= Html::encode($model->transaction_id) ?>
    </td>
    <td>
        <?= HtmlPurifier::process($model->transaction->resource->name) ?>
    </td>
    <td>
        <?= Html::encode($model->consume_amount) ?>
    </td>
    <td>
        <?= Html::encode($model->date) ?>
    </td>


