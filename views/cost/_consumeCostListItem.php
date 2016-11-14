<tr>
    <td>
        <?= $model->ident ?>
    </td>
    <td>
        <?= $model->element->name ?>
    </td>
    <?php
        // выводим затраты всех ресурсов по элементу Ордера
        $costs = \Yii::$app->consumption->getCostsByOrderElement($model->ident, $model->element_model, $model->element_id);
    ?>
    <td>
        <?php foreach ($costs as $key => $cost){ ?>
            <p>
                <?= $cost->transaction->resource->name; ?>
            </p>
        <?php } ?>
    </td>
    <td>
        <?php foreach ($costs as $key => $cost){ ?>
            <p>
                <?= $cost->consume_amount; ?>
            </p>
        <?php } ?>
    </td>

    <td>
        <?php foreach ($costs as $key => $cost){ ?>
                <p> <?= $cost->consumeCost ?></p>
        <?php  } ?>
    </td>
    <td>
        <?= date('d.m.Y H:i:s', strtotime($model->date)) ?>
    </td>
</tr>
