<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "provinsi".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property string $kode
 * @property string $nama
 *
 * @property Kabupatenkota[] $kabupatenkotas
 * @property Pasar[] $pasars
 * @property Petani[] $petanis
 * @property Proposal[] $proposals
 * @property Proposal[] $proposals0
 * @property ProposalHistory[] $proposalHistories
 * @property ProposalHistory[] $proposalHistories0
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provinsi';
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
            [['user_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 45],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupatenkotas()
    {
        return $this->hasMany(Kabupatenkota::className(), ['provinsi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasars()
    {
        return $this->hasMany(Pasar::className(), ['provinsi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetanis()
    {
        return $this->hasMany(Petani::className(), ['provinsi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::className(), ['lapak_prov_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals0()
    {
        return $this->hasMany(Proposal::className(), ['provinsi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['lapak_prov_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories0()
    {
        return $this->hasMany(ProposalHistory::className(), ['provinsi_id' => 'id']);
    }
}
