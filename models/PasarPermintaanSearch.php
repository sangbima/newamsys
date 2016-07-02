<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PasarPermintaan;

/**
 * PasarPermintaanSearch represents the model behind the search form about `app\models\PasarPermintaan`.
 */
class PasarPermintaanSearch extends PasarPermintaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'pasar_id', 'komoditas_id', 'varietas_id', 'jenis_id'], 'integer'],
            [['created_at', 'updated_at', 'pemesan', 'tanggal_tiba', 'keterangan'], 'safe'],
            [['latitude', 'longitude', 'kuantitas', 'harga_minta'], 'number'],
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
        $query = PasarPermintaan::find();

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
            'jenis_id' => $this->jenis_id,
            'kuantitas' => $this->kuantitas,
            'harga_minta' => $this->harga_minta,
            'tanggal_tiba' => $this->tanggal_tiba,
        ]);

        $query->andFilterWhere(['like', 'pemesan', $this->pemesan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
