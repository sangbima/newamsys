<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PasarInfoHarian;

/**
 * PasarInfoHarianSearch represents the model behind the search form about `app\models\PasarInfoHarian`.
 */
class PasarInfoHarianSearch extends PasarInfoHarian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'pasar_id', 'komoditas_id', 'varietas_id'], 'integer'],
            [['created_at', 'updated_at', 'keterangan'], 'safe'],
            [['latitude', 'longitude', 'harga_jual_kg'], 'number'],
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
        $query = PasarInfoHarian::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 10,
            ],
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'pasar_id' => $this->pasar_id,
            'komoditas_id' => $this->komoditas_id,
            'varietas_id' => $this->varietas_id,
            'harga_jual_kg' => $this->harga_jual_kg,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
