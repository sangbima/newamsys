<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "proposal".
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
 * @property Provinsi $provinsi
 * @property Varietas $varietas
 * @property ProposalHistory[] $proposalHistories
 */
class Proposal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposal';
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
            [['created_at', 'updated_at', 'tgl_panen', 'tgl_tanam', 'est_tgl_kirim', 'prop_kadaluarsa'], 'safe'],
            [['user_id', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'komoditas_id', 'varietas_id', 'jenis_id', 'lapak_prov_id', 'lapak_kabkota_id', 'lapak_kec_id', 'lapak_desakel_id', 'jenis_bobot_kering_id', 'pasar_tag_id', 'pasar_id', 'versi'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['luas_lahan', 'luas_m2', 'biaya_tebas', 'biaya_proses', 'kapasitas_pasar'], 'string'],
            [['no_proposal', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'luas_lahan', 'luas_m2', 'komoditas_id', 'varietas_id', 'jenis_id', 'tgl_panen', 'lapak_prov_id', 'lapak_kabkota_id', 'lapak_kec_id', 'lapak_desakel_id', 'est_bobot_basah', 'jenis_bobot_kering_id', 'biaya_tebas', 'biaya_proses', 'pasar_tag_id', 'est_tgl_kirim', 'kapasitas_pasar', 'prop_kadaluarsa'], 'required'],
            [['luas_unit', 'kapasitas_periode'], 'string'],
            [['no_proposal'], 'string', 'max' => 100],
            [['est_bobot_basah', 'est_bobot_kering'], 'string', 'max' => 45],
            [['picture'], 'string', 'max' => 1000],
            [['tgl_tanam'], function($attribute, $params){
                $tglTanam = strtotime($this->tgl_tanam);
                $tglPanen = strtotime($this->tgl_panen);
                if($tglPanen <= $tglTanam) {
                    $this->addError($attribute, 'Tgl panen harus lebih besar dari tgl tanam');
                }
            }],
            [['prop_kadaluarsa'], function($attribute, $params){
                $now = strtotime(date("d F Y"));
                $tglPanen = strtotime($this->tgl_panen);
                $tglExpired = strtotime($this->prop_kadaluarsa);
                if($tglExpired < $now) {
                    $this->addError($attribute, 'Masa berlaku minimal adalah hari ini');
                }
                if($tglExpired > $tglPanen) {
                    $this->addError($attribute, 'Masa berlaku tdk boleh lebih dari tgl panen');
                }
            }],
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
            'user_id' => 'User',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'no_proposal' => 'No Proposal',
            'petani_id' => 'Nama Petani',
            'provinsi_id' => 'Provinsi',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'kecamatan_id' => 'Kecamatan',
            'desakelurahan_id' => 'Desa/Kelurahan',
            'luas_lahan' => 'Luas Lahan',
            'luas_unit' => 'Luas Unit',
            'luas_m2' => 'Luas(M2)',
            'komoditas_id' => 'Komoditas',
            'varietas_id' => 'Varietas',
            'jenis_id' => 'Jenis',
            'tgl_panen' => 'Tgl. Panen',
            'tgl_tanam' => 'Tgl. Tanam',
            'lapak_prov_id' => 'Lapak Provinsi',
            'lapak_kabkota_id' => 'Lapak Kabupaten/Kota',
            'lapak_kec_id' => 'Lapak Kecamatan',
            'lapak_desakel_id' => 'Lapak Desa/Kelurahan',
            'est_bobot_basah' => 'Bobot Basah(Ton)',
            'est_bobot_kering' => 'Bobot Kering(Ton)',
            'jenis_bobot_kering_id' => 'Jenis Bobot Kering',
            'biaya_tebas' => 'Biaya Tebas(Rp)',
            'biaya_proses' => 'Biaya Proses(Rp)',
            'pasar_tag_id' => 'Pasar Tag',
            'est_tgl_kirim' => 'Tgl. Kirim',
            'kapasitas_pasar' => 'Kapasitas Pasar (Ton/Minggu)',
            'kapasitas_periode' => 'Kapasitas Periode',
            'pasar_id' => 'Nama Pasar',
            'est_harga_jual' => 'Est. Harga Jual(Rp)',
            'biaya_kirim' => 'Biaya Kirim(Rp)',
            'prop_kadaluarsa' => 'Kadaluarsa Proposal',
            'setuju_status' => 'Status',
            'setuju_alasan' => 'Alasan',
            'setuju_berkas' => 'Berkas',
            'versi' => 'Versi',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['proposal_id' => 'id']);
    }

    public static function proposalstatus($status)
    {
        if ($status == 'Setuju') {
            return '<span class="label label-success" data-toggle="tooltip" data-placement="top" title="Disetujui"><i class="glyphicon glyphicon-ok"></i> Setuju</span>';
        } elseif ($status == 'Tolak') {
            return '<span class="label label-warning" data-toggle="tooltip" data-placement="top" title="Ditolak"><i class="glyphicon glyphicon-minus-sign"></i> Ditolak</span>';
        } else {
            return '<span class="label label-default" data-toggle="tooltip" data-placement="top" title="Pending"><i class="glyphicon glyphicon-time"></i> Pending</span>';
        }
    }

    public static function proposalstatusindex($status)
    {
        // Pending, Setuju, Tolak
        // <button type="button" class="btn btn-xs btn-raised btn-info" data-toggle="tooltip" data-placement="top" title="BGR Pending">P</button>
        if($status == 'Setuju') {
            return 'V';
        } elseif($status == 'Tolak') {
            return 'X';
        } else {
            return 'P';
        }
    }

    public static function proposalstatuscolor($status)
    {
        if($status == 'Setuju') {
            return 'btn-success';
        } elseif($status == 'Tolak') {
            return 'btn-danger';
        } else {
            return 'btn-default';
        }
    }

    public static function proposallabelcolor($status)
    {
        if($status == 'Setuju') {
            return 'label-success';
        } elseif($status == 'Tolak') {
            return 'label-danger';
        } else {
            return 'label-default';
        }
    }
}
