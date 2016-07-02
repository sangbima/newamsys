<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "kabupatenkota".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property string $kode
 * @property string $nama
 * @property string $tipe
 * @property integer $provinsi_id
 *
 * @property Provinsi $provinsi
 * @property Kecamatan[] $kecamatans
 * @property Pasar[] $pasars
 * @property Petani[] $petanis
 * @property Proposal[] $proposals
 * @property Proposal[] $proposals0
 * @property ProposalHistory[] $proposalHistories
 * @property ProposalHistory[] $proposalHistories0
 */
class Kabupatenkota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kabupatenkota';
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
            [['user_id', 'provinsi_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['kode', 'nama', 'provinsi_id'], 'required'],
            [['tipe'], 'string'],
            [['kode', 'nama'], 'string', 'max' => 45],
            [['kode'], 'unique'],
            [['provinsi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['provinsi_id' => 'id']],
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
            'tipe' => 'Tipe',
            'provinsi_id' => 'Provinsi',
        ];
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
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasars()
    {
        return $this->hasMany(Pasar::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetanis()
    {
        return $this->hasMany(Petani::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals0()
    {
        return $this->hasMany(Proposal::className(), ['lapak_kabkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['kabupatenkota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories0()
    {
        return $this->hasMany(ProposalHistory::className(), ['lapak_kabkota_id' => 'id']);
    }
}
