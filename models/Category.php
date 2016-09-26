<?php

namespace halumein\consumption\models;

use Yii;

/**
 * This is the model class for table "consumption_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'parent' => 'Родитель',
        ];
    }

    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['resource_id' => 'id'])->viaTable('consumption_resource', ['category_id' => 'id']);
    }
}
