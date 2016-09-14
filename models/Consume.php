<?php

namespace halumein\consumption\models;

use halumein\consumption\models\Norm;
use Yii;

/**
 * This is the model class for table "consumption_consume".
 *
 * @property integer $id
 * @property string $date
 * @property string $order_model
 * @property integer $order_id
 * @property string $element_model
 * @property integer $element_id
 * @property integer $norm_id
 *
 * @property ConsumptionNorm $norm
 */
class Consume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_consume';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'order_model', 'order_id', 'element_model', 'element_id', 'norm_id'], 'required'],
            [['date'], 'safe'],
            [['order_id', 'element_id', 'norm_id'], 'integer'],
            [['order_model', 'element_model'], 'string', 'max' => 255],
            [['norm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Norm::className(), 'targetAttribute' => ['norm_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'order_model' => 'Модель заказа',
            'order_id' => 'ID заказа',
            'element_model' => 'Модель Service_Price',
            'element_id' => 'ID Price',
            'norm_id' => 'Норма',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNorm()
    {
        return $this->hasOne(Norm::className(), ['id' => 'norm_id']);
    }

    public function getElement()
    {
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;
        return $this->hasOne($serviceModel::className(), ['id' => 'element_id']);
    }
}
