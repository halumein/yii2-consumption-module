<?php

namespace halumein\consumption\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\consumption\models\Norm;

/**
 * NormSearch represents the model behind the search form about `app\models\Norm`.
 */
class NormSearch extends Norm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'element_id', 'resource_id'], 'integer'],
            [['element_model', 'comment'], 'safe'],
            [['consumption'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Norm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'element_id' => $this->element_id,
            'resource_id' => $this->resource_id,
            'consumption' => $this->consumption,
        ]);

        $query->andFilterWhere(['like', 'element_model', $this->element_model])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
