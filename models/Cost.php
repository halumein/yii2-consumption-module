<?php

namespace halumein\consumption\models;

use Yii;

/**
 * This is the model class for table "consumption_cost".
 *
 * @property integer $id
 * @property integer $transaction_id
 * @property integer $income_id
 * @property string $date
 */
class Cost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'date', 'consume_amount'], 'required'],
            [['transaction_id', 'income_id'], 'integer'],
            [['consume_amount'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => 'Транзакция ID',
            'income_id' => 'Приход ID',
            'consume_amount' => 'Количество затраты',
            'date' => 'Дата',
        ];
    }
}
