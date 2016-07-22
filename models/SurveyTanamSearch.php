<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SurveyTanam;

/**
 * SurveyTanamSearch represents the model behind the search form about `app\models\SurveyTanam`.
 */
class SurveyTanamSearch extends SurveyTanam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'komoditas_id', 'varietas_id', 'jenis_id', 'proposal_id'], 'integer'],
            [['created_at', 'updated_at', 'luas_unit', 'tgl_panen', 'tgl_tanam', 'picture'], 'safe'],
            [['latitude', 'longitude', 'luas_lahan', 'luas_m2', 'harga_bibit', 'est_bobot_ton'], 'number'],
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
        $query = SurveyTanam::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'petani_id' => $this->petani_id,
            'provinsi_id' => $this->provinsi_id,
            'kabupatenkota_id' => $this->kabupatenkota_id,
            'kecamatan_id' => $this->kecamatan_id,
            'desakelurahan_id' => $this->desakelurahan_id,
            'luas_lahan' => $this->luas_lahan,
            'luas_m2' => $this->luas_m2,
            'komoditas_id' => $this->komoditas_id,
            'varietas_id' => $this->varietas_id,
            'jenis_id' => $this->jenis_id,
            'tgl_panen' => $this->tgl_panen,
            'tgl_tanam' => $this->tgl_tanam,
            'harga_bibit' => $this->harga_bibit,
            'est_bobot_ton' => $this->est_bobot_ton,
            'proposal_id' => $this->proposal_id,
        ]);

        $query->andFilterWhere(['like', 'luas_unit', $this->luas_unit])
            ->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
