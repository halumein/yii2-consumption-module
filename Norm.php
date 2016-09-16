<?php
namespace halumein\consumption;

use halumein\consumption\models\Norm as NormModel;
use halumein\consumption\interfaces\Norm as NormInterface;

class Norm implements NormInterface
{
    public function getNorms($price)
    {
        return NormModel::find()->where(['element_model' => $price::className(), 'element_id' => $price->id])->all();
    }
}