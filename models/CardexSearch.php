<?php

namespace amintado\pinventory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use amintado\pinventory\models\Cardex;

/**
 * amintado\pinventory\models\CardexSearch represents the model behind the search form about `amintado\pinventory\models\Cardex`.
 */
 class CardexSearch extends Cardex
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'integer'],
            [['date', 'description', 'module', 'model', 'username', 'storage', 'product'], 'safe'],
            [['change', 'stock'], 'number'],
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
        $query = Cardex::find();

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
            'change' => $this->change,
            'uid' => $this->uid,
            'stock' => $this->stock,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'storage', $this->storage])
            ->andFilterWhere(['like', 'product', $this->product]);

        return $dataProvider;
    }
}
