<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "proposal_history".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property string $no_proposal
 * @property integer $petani_id
 * @property integer $provinsi_id
 * @property integer $kabupatenkota_id
 * @property integer $kecamatan_id
 * @property integer $desakelurahan_id
 * @property string $luas_lahan
 * @property string $luas_unit
 * @property string $luas_m2
 * @property integer $komoditas_id
 * @property integer $varietas_id
 * @property integer $jenis_id
 * @property string $tgl_panen
 * @property string $tgl_tanam
 * @property integer $lapak_prov_id
 * @property integer $lapak_kabkota_id
 * @property integer $lapak_kec_id
 * @property integer $lapak_desakel_id
 * @property string $est_bobot_basah
 * @property string $est_bobot_kering
 * @property integer $jenis_bobot_kering_id
 * @property string $biaya_tebas
 * @property string $biaya_proses
 * @property integer $pasar_tag_id
 * @property string $est_tgl_kirim
 * @property string $kapasitas_pasar
 * @property string $kapasitas_periode
 * @property integer $pasar_id
 * @property string $est_harga_jual
 * @property string $biaya_kirim
 * @property string $prop_kadaluarsa
 * @property string $setuju_status
 * @property string $setuju_alasan
 * @property string $setuju_berkas
 * @property integer $versi
 * @property integer $proposal_id
 * @property string $log_time
 * @property string $picture
 *
 * @property Desakelurahan $desakelurahan
 * @property Jenis $jenis
 * @property JenisBobotKering $jenisBobotKering
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property Komoditas $komoditas
 * @property Desakelurahan $lapakDesakel
 * @property Kabupatenkota $lapakKabkota
 * @property Kecamatan $lapakKec
 * @property Provinsi $lapakProv
 * @property Pasar $pasar
 * @property PasarTag $pasarTag
 * @property Petani $petani
 * @property Proposal $proposal
 * @property Provinsi $provinsi
 * @property Varietas $varietas
 */
class ProposalHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposal_history';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function(){ return date('Y-m-d H:i:s'); /* MySql DATETIME */},
            ],
            'autouserid' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'tgl_panen', 'tgl_tanam', 'est_tgl_kirim', 'prop_kadaluarsa', 'log_time'], 'safe'],
            [['user_id', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'komoditas_id', 'varietas_id', 'jenis_id', 'lapak_prov_id', 'lapak_kabkota_id', 'lapak_kec_id', 'lapak_desakel_id', 'jenis_bobot_kering_id', 'pasar_tag_id', 'pasar_id', 'versi', 'proposal_id'], 'integer'],
            [['latitude', 'longitude', 'luas_lahan', 'luas_m2', 'biaya_tebas', 'biaya_proses', 'kapasitas_pasar', 'est_harga_jual', 'biaya_kirim'], 'number'],
            [['no_proposal', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'luas_lahan', 'luas_m2', 'komoditas_id', 'varietas_id', 'jenis_id', 'tgl_panen', 'lapak_prov_id', 'lapak_kabkota_id', 'lapak_kec_id', 'lapak_desakel_id', 'est_bobot_basah', 'jenis_bobot_kering_id', 'biaya_tebas', 'biaya_proses', 'pasar_tag_id', 'est_tgl_kirim', 'kapasitas_pasar', 'est_harga_jual', 'biaya_kirim', 'prop_kadaluarsa', 'proposal_id', 'log_time'], 'required'],
            [['luas_unit', 'kapasitas_periode', 'setuju_alasan'], 'string'],
            [['no_proposal'], 'string', 'max' => 100],
            [['est_bobot_basah', 'est_bobot_kering', 'setuju_berkas'], 'string', 'max' => 45],
            [['setuju_status'], 'string', 'max' => 255],
            [['picture'], 'string', 'max' => 1000],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jenis::className(), 'targetAttribute' => ['jenis_id' => 'id']],
            [['jenis_bobot_kering_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisBobotKering::className(), 'targetAttribute' => ['jenis_bobot_kering_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
            [['komoditas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['komoditas_id' => 'id']],
            [['lapak_desakel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['lapak_desakel_id' => 'id']],
            [['lapak_kabkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['lapak_kabkota_id' => 'id']],
            [['lapak_kec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['lapak_kec_id' => 'id']],
            [['lapak_prov_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['lapak_prov_id' => 'id']],
            [['pasar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pasar::className(), 'targetAttribute' => ['pasar_id' => 'id']],
            [['pasar_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => PasarTag::className(), 'targetAttribute' => ['pasar_tag_id' => 'id']],
            [['petani_id'], 'exist', 'skipOnError' => true, 'targetClass' => Petani::className(), 'targetAttribute' => ['petani_id' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
            [['provinsi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['provinsi_id' => 'id']],
            [['varietas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Varietas::className(), 'targetAttribute' => ['varietas_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'no_proposal' => 'No Proposal',
            'petani_id' => 'Petani ID',
            'provinsi_id' => 'Provinsi ID',
            'kabupatenkota_id' => 'Kabupatenkota ID',
            'kecamatan_id' => 'Kecamatan ID',
            'desakelurahan_id' => 'Desakelurahan ID',
            'luas_lahan' => 'Luas Lahan',
            'luas_unit' => 'Luas Unit',
            'luas_m2' => 'Luas M2',
            'komoditas_id' => 'Komoditas ID',
            'varietas_id' => 'Varietas ID',
            'jenis_id' => 'Jenis ID',
            'tgl_panen' => 'Tgl Panen',
            'tgl_tanam' => 'Tgl Tanam',
            'lapak_prov_id' => 'Lapak Prov ID',
            'lapak_kabkota_id' => 'Lapak Kabkota ID',
            'lapak_kec_id' => 'Lapak Kec ID',
            'lapak_desakel_id' => 'Lapak Desakel ID',
            'est_bobot_basah' => 'Est Bobot Basah',
            'est_bobot_kering' => 'Est Bobot Kering',
            'jenis_bobot_kering_id' => 'Jenis Bobot Kering ID',
            'biaya_tebas' => 'Biaya Tebas',
            'biaya_proses' => 'Biaya Proses',
            'pasar_tag_id' => 'Pasar Tag ID',
            'est_tgl_kirim' => 'Est Tgl Kirim',
            'kapasitas_pasar' => 'Kapasitas Pasar',
            'kapasitas_periode' => 'Kapasitas Periode',
            'pasar_id' => 'Pasar ID',
            'est_harga_jual' => 'Est Harga Jual',
            'biaya_kirim' => 'Biaya Kirim',
            'prop_kadaluarsa' => 'Prop Kadaluarsa',
            'setuju_status' => 'Setuju Status',
            'setuju_alasan' => 'Setuju Alasan',
            'setuju_berkas' => 'Setuju Berkas',
            'versi' => 'Versi',
            'proposal_id' => 'Proposal ID',
            'log_time' => 'Log Time',
            'picture' => 'Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesakelurahan()
    {
        return $this->hasOne(Desakelurahan::className(), ['id' => 'desakelurahan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(Jenis::className(), ['id' => 'jenis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisBobotKering()
    {
        return $this->hasOne(JenisBobotKering::className(), ['id' => 'jenis_bobot_kering_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupatenkota()
    {
        return $this->hasOne(Kabupatenkota::className(), ['id' => 'kabupatenkota_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kecamatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomoditas()
    {
        return $this->hasOne(Komoditas::className(), ['id' => 'komoditas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLapakDesakel()
    {
        return $this->hasOne(Desakelurahan::className(), ['id' => 'lapak_desakel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLapakKabkota()
    {
        return $this->hasOne(Kabupatenkota::className(), ['id' => 'lapak_kabkota_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLapakKec()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'lapak_kec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLapakProv()
    {
        return $this->hasOne(Provinsi::className(), ['id' => 'lapak_prov_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasar()
    {
        return $this->hasOne(Pasar::className(), ['id' => 'pasar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasarTag()
    {
        return $this->hasOne(PasarTag::className(), ['id' => 'pasar_tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetani()
    {
        return $this->hasOne(Petani::className(), ['id' => 'petani_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(Proposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id' => 'provinsi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVarietas()
    {
        return $this->hasOne(Varietas::className(), ['id' => 'varietas_id']);
    }
}
