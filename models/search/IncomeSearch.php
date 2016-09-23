<?php

namespace halumein\consumption\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\consumption\models\Income;

/**
 * IncomeSearch represents the model behind the search form about `halumein\cashbox\models\Income`.
 */
class IncomeSearch extends Income
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'resource_id'], 'integer'],
            [['date'], 'safe'],
            [['income', 'cost', 'balance'], 'number'],
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
        $query = Income::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'resource_id' => $this->resource_id,
            'income' => $this->income,
            'cost' => $this->cost,
            'balance' => $this->balance,
        ]);

        if($dateStart = yii::$app->request->get('date_start')) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $query->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
        }

        if($dateStop = yii::$app->request->get('date_stop')) {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
            $query->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        }

        return $dataProvider;
    }
}
