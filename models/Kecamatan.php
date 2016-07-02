<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "kecamatan".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property string $kode
 * @property string $nama
 * @property integer $kabupatenkota_id
 *
 * @property Desakelurahan[] $desakelurahans
 * @property Kabupatenkota $kabupatenkota
 * @property Pasar[] $pasars
 * @property Petani[] $petanis
 * @property Proposal[] $proposals
 * @property Proposal[] $proposals0
 * @property ProposalHistory[] $proposalHistories
 * @property ProposalHistory[] $proposalHistories0
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kecamatan';
    }

    public function behaviors()
    {
        /*return [
            TimestampBehavior::className(),
        ];*/

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
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'kabupatenkota_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['kode', 'nama', 'kabupatenkota_id'], 'required'],
            [['kode'], 'string', 'max' => 45],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
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
            'kode' => 'Kode',
            'nama' => 'Nama',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'provinsi_id' => 'Provinsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesakelurahans()
    {
        return $this->hasMany(Desakelurahan::className(), ['kecamatan_id' => 'id']);
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
    public function getPasars()
    {
        return $this->hasMany(Pasar::className(), ['kecamatan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetanis()
    {
        return $this->hasMany(Petani::className(), ['kecamatan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::className(), ['kecamatan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals0()
    {
        return $this->hasMany(Proposal::className(), ['lapak_kec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['kecamatan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories0()
    {
        return $this->hasMany(ProposalHistory::className(), ['lapak_kec_id' => 'id']);
    }
}
