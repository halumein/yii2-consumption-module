<?php

namespace halumein\consumption\models;

use Yii;

/**
 * This is the model class for table "consumption_remain".
 *
 * @property integer $id
 * @property integer $income_id
 * @property string $amount
 */
class Remain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_remain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['income_id', 'amount'], 'required'],
            [['income_id'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'income_id' => 'ID Прихода',
            'amount' => 'Количество',
        ];
    }
}
