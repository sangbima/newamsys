<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "survey_tanam".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
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
 * @property string $harga_bibit
 * @property string $est_bobot_ton
 * @property string $picture
 * @property integer $proposal_id
 *
 * @property Desakelurahan $desakelurahan
 * @property Jenis $jenis
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property Komoditas $komoditas
 * @property Petani $petani
 * @property Provinsi $provinsi
 * @property Varietas $varietas
 */
class SurveyTanam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_tanam';
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
            [['created_at', 'updated_at', 'tgl_panen', 'tgl_tanam'], 'safe'],
            [['user_id', 'petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'komoditas_id', 'varietas_id', 'jenis_id', 'proposal_id'], 'integer'],
            [['latitude', 'longitude', 'luas_lahan', 'luas_m2', 'est_bobot_ton'], 'number'],
            [['petani_id', 'provinsi_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'luas_lahan', 'luas_m2', 'komoditas_id', 'varietas_id', 'tgl_panen'], 'required'],
            [['luas_unit','harga_bibit',], 'string'],
            [['picture'], 'string', 'max' => 1000],
            [['tgl_tanam'], function($attribute, $params){
                $tglTanam = strtotime($this->tgl_tanam);
                $tglPanen = strtotime($this->tgl_panen);
                if($tglPanen <= $tglTanam) {
                    $this->addError($attribute, 'Tgl panen harus lebih besar dari tgl tanam');
                }
            }],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jenis::className(), 'targetAttribute' => ['jenis_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
            [['komoditas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['komoditas_id' => 'id']],
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
            'user_id' => 'User ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'petani_id' => 'Petani',
            'provinsi_id' => 'Provinsi',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'kecamatan_id' => 'Kecamatan',
            'desakelurahan_id' => 'Desa/Kelurahan',
            'luas_lahan' => 'Luas Lahan',
            'luas_unit' => 'Luas Unit',
            'luas_m2' => 'Luas (M2)',
            'komoditas_id' => 'Komoditas',
            'varietas_id' => 'Varietas',
            'jenis_id' => 'Jenis',
            'tgl_panen' => 'Tgl Panen',
            'tgl_tanam' => 'Tgl Tanam',
            'harga_bibit' => 'Harga Bibit (Rp)',
            'est_bobot_ton' => 'Est Bobot (Ton)',
            'picture' => 'Picture',
            'proposal_id' => 'Proposal',
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
}
