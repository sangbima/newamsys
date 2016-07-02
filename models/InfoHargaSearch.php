<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InfoHarga;

/**
 * InfoHargaSearch represents the model behind the search form about `app\models\InfoHarga`.
 */
class InfoHargaSearch extends InfoHarga
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'komoditas_id'], 'integer'],
            [['created_at', 'updated_at', 'tanggal', 'pasar', 'sumber'], 'safe'],
            [['harga_kg'], 'number'],
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
        $query = InfoHarga::find();

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
            'komoditas_id' => $this->komoditas_id,
            'tanggal' => $this->tanggal,
            'harga_kg' => $this->harga_kg,
        ]);

        $query->andFilterWhere(['like', 'pasar', $this->pasar])
            ->andFilterWhere(['like', 'sumber', $this->sumber]);

        return $dataProvider;
    }
}
