<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProposalHistory;

/**
 * ProposalHistorySearch represents the model behind the search form about `app\models\ProposalHistory`.
 */
class ProposalHistorySearch extends ProposalHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'komoditas_id', 'varietas_id', 'jenis_id', 'lapak_prov_id', 'lapak_kabkota_id', 'lapak_kec_id', 'lapak_desakel_id', 'jenis_bobot_kering_id', 'pasar_tag_id', 'pasar_id', 'versi', 'proposal_id'], 'integer'],
            [['created_at', 'updated_at', 'no_proposal', 'luas_unit', 'tgl_panen', 'tgl_tanam', 'est_bobot_basah', 'est_bobot_kering', 'est_tgl_kirim', 'kapasitas_periode', 'prop_kadaluarsa', 'setuju_status', 'setuju_alasan', 'setuju_berkas', 'log_time', 'picture'], 'safe'],
            [['latitude', 'longitude', 'luas_lahan', 'luas_m2', 'biaya_tebas', 'biaya_proses', 'kapasitas_pasar', 'est_harga_jual', 'biaya_kirim'], 'number'],
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
        $query = ProposalHistory::find();

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
            'lapak_prov_id' => $this->lapak_prov_id,
            'lapak_kabkota_id' => $this->lapak_kabkota_id,
            'lapak_kec_id' => $this->lapak_kec_id,
            'lapak_desakel_id' => $this->lapak_desakel_id,
            'jenis_bobot_kering_id' => $this->jenis_bobot_kering_id,
            'biaya_tebas' => $this->biaya_tebas,
            'biaya_proses' => $this->biaya_proses,
            'pasar_tag_id' => $this->pasar_tag_id,
            'est_tgl_kirim' => $this->est_tgl_kirim,
            'kapasitas_pasar' => $this->kapasitas_pasar,
            'pasar_id' => $this->pasar_id,
            'est_harga_jual' => $this->est_harga_jual,
            'biaya_kirim' => $this->biaya_kirim,
            'prop_kadaluarsa' => $this->prop_kadaluarsa,
            'versi' => $this->versi,
            'proposal_id' => $this->proposal_id,
            'log_time' => $this->log_time,
        ]);

        $query->andFilterWhere(['like', 'no_proposal', $this->no_proposal])
            ->andFilterWhere(['like', 'luas_unit', $this->luas_unit])
            ->andFilterWhere(['like', 'est_bobot_basah', $this->est_bobot_basah])
            ->andFilterWhere(['like', 'est_bobot_kering', $this->est_bobot_kering])
            ->andFilterWhere(['like', 'kapasitas_periode', $this->kapasitas_periode])
            ->andFilterWhere(['like', 'setuju_status', $this->setuju_status])
            ->andFilterWhere(['like', 'setuju_alasan', $this->setuju_alasan])
            ->andFilterWhere(['like', 'setuju_berkas', $this->setuju_berkas])
            ->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
