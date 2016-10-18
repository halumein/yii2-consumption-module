<?php

namespace halumein\consumption\models;

use halumein\consumption\models\Cost;
use halumein\consumption\models\Resource;
use Yii;

/**
 * This is the model class for table "consumption_consume".
 *
 * @property integer $id
 * @property string $date
 * @property string $order_model
 * @property integer $ident
 * @property string $element_model
 * @property integer $element_id
 * @property integer $norm_id
 *
 * @property ConsumptionNorm $norm
 */
class Transaction extends \yii\db\ActiveRecord
{
    public $resourceId;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'element_id', 'resource_id', 'count'], 'required'],
            [['date'], 'safe'],
            [['ident', 'element_id', 'resource_id'], 'integer'],
            [['count'], 'number'],
            [['element_model', 'type'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 500],
            //[['recource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resource_id' => 'id']],
            [['deleted'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => 'Приход/Расход',
            'date' => 'Дата',
            'ident' => 'ID', // order id
            'element_id' => 'Услуга',
            'resource_id' => 'Ресурс',
            'count' => 'Кол-во расхода',
            'amount' => 'Остаток',
            'comment' => 'Комментарий',
            'deleted' => 'Удалена',
        ];
    }

    public function getElement()
    {
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;
        return $this->hasOne($serviceModel::className(), ['id' => 'element_id']);
    }

    public static function getActiveTransactions()
    {
        return Transaction::find()->where(['deleted' => null])->all();
    }

    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->viaTable('consumption_resource', ['id' => 'resource_id']);
    }

    public function getCost()
    {
        return $this->hasOne(Cost::className(), ['transaction_id' => 'id']);
    }
}
