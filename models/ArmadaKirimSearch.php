<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ArmadaKirim;

/**
 * ArmadaKirimSearch represents the model behind the search form about `app\models\ArmadaKirim`.
 */
class ArmadaKirimSearch extends ArmadaKirim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'proposal_id', 'lapak_proses_id', 'pasar_tag_id'], 'integer'],
            [['created_at', 'updated_at', 'status', 'kode_kiriman', 'no_armada', 'no_polisi', 'pengemudi', 'keterangan'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = ArmadaKirim::find();

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
            'proposal_id' => $this->proposal_id,
            'lapak_proses_id' => $this->lapak_proses_id,
            'pasar_tag_id' => $this->pasar_tag_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'kode_kiriman', $this->kode_kiriman])
            ->andFilterWhere(['like', 'no_armada', $this->no_armada])
            ->andFilterWhere(['like', 'no_polisi', $this->no_polisi])
            ->andFilterWhere(['like', 'pengemudi', $this->pengemudi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
