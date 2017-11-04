<?php

namespace amintado\pinventory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use amintado\pinventory\models\StorageItems;

/**
 * amintado\pinventory\models\StorageItemsSearch represents the model behind the search form about `amintado\pinventory\models\StorageItems`.
 */
 class StorageItemsSearch extends StorageItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['storage', 'product'], 'safe'],
            [['stock'], 'number'],
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
        $query = StorageItems::find();

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
            'stock' => $this->stock,
        ]);

        $query->andFilterWhere(['like', 'storage', $this->storage])
            ->andFilterWhere(['like', 'product', $this->product]);

        return $dataProvider;
    }
}
