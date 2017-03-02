<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\admin\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'provider_id', 'producer_id', 'show', 'qty'], 'integer'],
            [['title', 'url', 'units', 'content', 'keywords', 'description', 'img', 'new', 'hit', 'sale', 'popular', 'recommended', 'sku', 'added_date', 'provider_date', 'write_off', 'special_conditions'], 'safe'],
            [['price', 'price_special'], 'number'],
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
        $query = Product::find()->with('category');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
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
            'price' => $this->price,
            'price_special' => $this->price_special,
            'category_id' => $this->category_id,
            'provider_id' => $this->provider_id,
            'producer_id' => $this->producer_id,
            'added_date' => $this->added_date,
            'provider_date' => $this->provider_date,
            'show' => $this->show,
            'qty' => $this->qty,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'units', $this->units])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'new', $this->new])
            ->andFilterWhere(['like', 'hit', $this->hit])
            ->andFilterWhere(['like', 'sale', $this->sale])
            ->andFilterWhere(['like', 'popular', $this->popular])
            ->andFilterWhere(['like', 'recommended', $this->recommended])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'write_off', $this->write_off])
            ->andFilterWhere(['like', 'special_conditions', $this->special_conditions]);

        return $dataProvider;
    }
}
