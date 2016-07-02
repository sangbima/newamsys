<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "desakelurahan".
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
 * @property integer $kecamatan_id
 *
 * @property Kecamatan $kecamatan
 * @property Pasar[] $pasars
 * @property Petani[] $petanis
 * @property Proposal[] $proposals
 * @property Proposal[] $proposals0
 * @property ProposalHistory[] $proposalHistories
 * @property ProposalHistory[] $proposalHistories0
 */
class Desakelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'desakelurahan';
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
            [['user_id', 'kecamatan_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['kode', 'nama', 'kecamatan_id'], 'required'],
            [['tipe'], 'string'],
            [['kode'], 'string', 'max' => 45],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
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
            'kecamatan_id' => 'Kecamatan',
        ];
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
    public function getPasars()
    {
        return $this->hasMany(Pasar::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetanis()
    {
        return $this->hasMany(Petani::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals0()
    {
        return $this->hasMany(Proposal::className(), ['lapak_desakel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['desakelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories0()
    {
        return $this->hasMany(ProposalHistory::className(), ['lapak_desakel_id' => 'id']);
    }
}
