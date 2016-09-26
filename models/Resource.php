<?php

namespace halumein\consumption\models;

use Yii;
use halumein\consumption\models\Norm;

/**
 * This is the model class for table "consumption_resource".
 *
 * @property integer $id
 * @property string $title
 * @property string $dimension
 * @property string $measures
 * @property string $base_unit
 * @property string $comment
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'measures', 'dimension', 'base_unit', 'base_cost'], 'required'],
            [['dimension', 'base_unit', 'base_cost'], 'number'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['measures'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'dimension' => 'Размерность',
            'measures' => 'Ед. измерения',
            'base_unit' => 'Базовая размерность',
            'base_cost' => 'Базовая стоимость',
            'category_id' => 'Категория',
            'comment' => 'Комментарий',
        ];
    }

    public function getName()
    {
        $name = $this->title. " (" . $this->measures . ")";
        return $name;
    }

    public function getNorms()
    {
        return $this->hasMany(Norm::className(), ['resource_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

}
