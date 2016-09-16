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
            [['id', 'ident', 'element_id', 'resource_id'], 'integer'],
            [['consume'], 'number'],
            [['date', 'element_model'], 'safe'],
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
            'ident' => $this->ident,
            'element_id' => $this->element_id,
            'resource_id' => $this->resource_id,
        ]);

        $query->andWhere([
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'element_model', $this->element_model]);

        if($dateStart = yii::$app->request->get('date_start')) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            if(!yii::$app->request->get('date_stop')) {
                $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") = :dateStart', [':dateStart' => $dateStart]);
            } else {
                $query->andWhere('date > :dateStart', [':dateStart' => $dateStart]);
            }
        }

        if($dateStop = yii::$app->request->get('date_stop')) {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
            if($dateStop == '0000-00-00 00:00:00') {
                $dateStop = date('Y-m-d');
            }

            $query->andWhere('date < :dateStop', [':dateStop' => $dateStop]);
        }

        return $dataProvider;
    }
}
