<?php

namespace halumein\consumption\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\consumption\models\Resource;

/**
 * ResourceSearch represents the model behind the search form about `app\models\Resource`.
 */
class ResourceSearch extends Resource
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'measures', 'comment'], 'safe'],
            [['dimension', 'base_unit', 'base_cost'], 'number'],
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
        $query = Resource::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dimension' => $this->dimension,
            'base_unit' => $this->base_unit,
            'base_cost' => $this->base_cost,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'measures', $this->measures])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }

    public function searchByCategory($categoryId)
    {
        $query = Resource::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([
            'category_id' => $categoryId,
        ]);

        return $dataProvider;
    }
}
