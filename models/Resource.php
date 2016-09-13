<?php

namespace halumein\consumption\models;

use Yii;

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
            [['title', 'measures', 'dimension'], 'required'],
            [['dimension', 'base_unit'], 'number'],
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
            'comment' => 'Комментарий',
        ];
    }
}
