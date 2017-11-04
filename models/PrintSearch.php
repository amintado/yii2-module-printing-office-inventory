<?php

namespace amintado\pinventory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use amintado\pinventory\models\Sprint;

/**
 * amintado\pinventory\models\PrintSearch represents the model behind the search form about `amintado\pinventory\models\Sprint`.
 */
 class PrintSearch extends Sprint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'frame_count', 'zink_count', 'one_two', 'uid'], 'integer'],
            [['storage', 'product', 'zink_number', 'Dimensions', 'five_color', 'date', 'description'], 'safe'],
            [['tiraj', 'color_count', 'page_count'], 'number'],
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
        $query = Sprint::find();

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
            'tiraj' => $this->tiraj,
            'frame_count' => $this->frame_count,
            'zink_count' => $this->zink_count,
            'one_two' => $this->one_two,
            'color_count' => $this->color_count,
            'page_count' => $this->page_count,
            'date' => $this->date,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'storage', $this->storage])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'zink_number', $this->zink_number])
            ->andFilterWhere(['like', 'Dimensions', $this->Dimensions])
            ->andFilterWhere(['like', 'five_color', $this->five_color])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
