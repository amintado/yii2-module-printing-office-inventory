<?php

namespace amintado\pinventory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use amintado\pinventory\models\Factor;

/**
 * amintado\pinventory\models\SalesFactorSearch represents the model behind the search form about `amintado\pinventory\models\Factor`.
 */
 class SalesFactorSearch extends Factor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'status', 'module'], 'integer'],
            [['serial', 'date', 'register_time', 'company', 'storage', 'description'], 'safe'],
            [['sum', 'tax', 'discount', 'transportation', 'paymentPrice'], 'number'],
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
        $query = Factor::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'register_time' => $this->register_time,
            'uid' => $this->uid,
            'sum' => $this->sum,
            'status' => $this->status,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'transportation' => $this->transportation,
            'paymentPrice' => $this->paymentPrice,
            'module' => $this->module,
        ]);

        $query->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'storage', $this->storage])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
