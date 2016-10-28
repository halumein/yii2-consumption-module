<?php

namespace halumein\consumption\models;

use Yii;
use halumein\consumption\models\Resource;


/**
 * This is the model class for table "consumption_norm".
 *
 * @property integer $id
 * @property string $element_model
 * @property integer $element_id
 * @property integer $resource_id
 * @property string $consumption
 * @property string $comment
 *
 * @property ConsumptionResource $resource
 * @property ServiceComplex $element
 */
class Norm extends \yii\db\ActiveRecord
{
    public $resource_category;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_norm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;

        return [
            [['element_model', 'element_id', 'resource_id', 'consumption'], 'required'],
            [['element_id', 'resource_id'], 'integer'],
            [['consumption'], 'number'],
            [['element_model'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 500],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resource_id' => 'id']],
            [['element_id'], 'exist', 'skipOnError' => true, 'targetClass' => $serviceModel::className(), 'targetAttribute' => ['element_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'element_model' => 'Модель нормирования',
            'element_id' => 'Объект нормирования',
            'resource_id' => 'Ресурс',
            'consumption' => 'Норма расхода',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }

    public function getResourceId()
    {
        $resource = $this->hasOne(Resource::className(), ['id' => 'resource_id'])->one();
        return $resource->id;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElement()
    {
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;
        return $this->hasOne($serviceModel::className(), ['id' => 'element_id']);
    }

    public function getName()
    {
        $name = $this->resource->title. " : " .$this->resource->dimension. " " .$this->resource->measures;
        return $name;
    }

}
