<?php

namespace halumein\consumption\models;

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
class Consume extends \yii\db\ActiveRecord
{
    public $resourceId;

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
            [['date', 'element_id', 'resource_id', 'consume'], 'required'],
            [['date'], 'safe'],
            [['ident', 'element_id', 'resource_id'], 'integer'],
            [['consume'], 'number'],
            [['element_model'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'date' => 'Дата',
            'ident' => 'Идентификатор',
            'element_id' => 'Услуга',
            'resource_id' => 'Расход',
            'comment' => 'Комментарий',
            'deleted' => 'Удалена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getResource()
//    {
//        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
//    }

    public function getElement()
    {
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;
        return $this->hasOne($serviceModel::className(), ['id' => 'element_id']);
    }

    public static function getActiveConsumes()
    {
        return Consume::find()->where(['deleted' => null])->all();
    }

    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }
}
