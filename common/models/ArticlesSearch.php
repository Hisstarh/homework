<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Articles;


/**
 * ArticlesSearch represents the model behind the search form of `common\models\Articles`.
 * @property mixed delevery_id
 * @property mixed update_user
 * @property mixed sit_id
 * @property mixed side_left
 * @property mixed side_right
 * @property mixed side_rear
 * @property mixed side_top
 * @property mixed side_bottom
 * @property mixed side_front
 * @property mixed purchase_price
 * @property mixed sell_price
 * @property mixed margin
 * @property mixed place
 * @property mixed code
 */
class ArticlesSearch extends Articles
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code','status', 'created_at', 'updated_at','update_user','side_left','side_right','side_front','side_rear','side_top','side_bottom'], 'integer'],
            [['name', 'place', 'mark', 'body', 'drive', 'model', 'description', 'code_manufacturer', 'optics','sit_id','delevery_id','sit', 'delevery'], 'safe'],
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
        dump($params);
        $query = Articles::find()->with('sit','delevery','users');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        $this->load($params);

        // получение параметров для поиска
        $side_left = @$params['ArticlesSearch']['side_left'];



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'place'=> $this->place,
            'status' => $this->status,
            'sell_price' => $this->sell_price,
            'sit_id' => $this->sit_id,
            'delevery_id' => $this->delevery_id,
            'update_user' => $this->update_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        if ($side_left==1) {
                $query->andFilterWhere(['side_left'=> 1 ]);
        }
        if ($side_left==2) {
            $query->andFilterWhere(['side_right'=> 1]);
        }
        if ($side_left==3) {
            $query->andFilterWhere(['side_front'=>1 ]);
        }
        if ($side_left==4) {
            $query->andFilterWhere(['side_rear'=> 1]);

        }
        if ($side_left==5) {
            $query->andFilterWhere(['side_top'=> 1]);
        }
        if ($side_left==6) {
            $query->andFilterWhere([ 'side_bottom'=> 1]);
        }
        /*
         *  // Год основания
        if ($since_date) {
            if (is_array($since_date)) {
                $query->andFilterWhere(['in', 'Product.since_date', $since_date]);
            }
        }

        // технологии
        if (@$params['ProductSearch']['_tech']) {
            $query->leftJoin('technology', '`technology`.`Product_uid` = `Product`.`uid`');
            $query->andFilterWhere(['`technology`.title' => $this->_tech]);
        }
        // Специализация
        if (@$params['ProductSearch']['_spec']) {
            $query->leftJoin('specialization', '`specialization`.`Product_uid` = `Product`.`uid`');
            $query->andFilterWhere(['`specialization`.title' => $this->_spec]);
        }
         */



        return $dataProvider;
    }

    /**
     * @param mixed $tags
     * @return ArticlesSearch
     */

}
