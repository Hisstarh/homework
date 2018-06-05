<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sit;

/**
 * SitSearch represents the model behind the search form of `common\models\Sit`.
 */
class SitSearch extends Sit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'margin_on_sit', 'priceform_id', 'created_at', 'updated_at'], 'integer'],
            [['sit', 'owner', 'adress'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Sit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'margin_on_sit' => $this->margin_on_sit,
            'priceform_id' => $this->priceform_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sit', $this->sit])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'adress', $this->adress]);

        return $dataProvider;
    }


}
