<?php

namespace halumein\consumption\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\consumption\models\Consume;

/**
 * ConsumeSearch represents the model behind the search form about `app\models\Consume`.
 */
class ConsumeSearch extends Consume
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'element_id', 'norm_id'], 'integer'],
            [['date', 'order_model', 'element_model'], 'safe'],
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
        $query = Consume::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'order_id' => $this->order_id,
            'element_id' => $this->element_id,
            'norm_id' => $this->norm_id,
        ]);

        $query->andFilterWhere(['like', 'order_model', $this->order_model])
            ->andFilterWhere(['like', 'element_model', $this->element_model]);

        return $dataProvider;
    }
}
