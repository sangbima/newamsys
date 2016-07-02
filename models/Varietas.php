<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "varietas".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $nama
 * @property string $keterangan
 * @property integer $komoditas_id
 *
 * @property Jenis[] $jenis
 * @property PasarInfoHarian[] $pasarInfoHarians
 * @property PasarPermintaan[] $pasarPermintaans
 * @property Proposal[] $proposals
 * @property ProposalHistory[] $proposalHistories
 * @property Komoditas $komoditas
 */
class Varietas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'varietas';
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
            [['user_id', 'komoditas_id'], 'integer'],
            [['nama', 'komoditas_id'], 'required'],
            [['keterangan'], 'string'],
            [['nama'], 'string', 'max' => 100],
            [['nama'], 'unique'],
            [['komoditas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['komoditas_id' => 'id']],
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
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'komoditas_id' => 'Komoditas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasMany(Jenis::className(), ['varietas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasarInfoHarians()
    {
        return $this->hasMany(PasarInfoHarian::className(), ['varietas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasarPermintaans()
    {
        return $this->hasMany(PasarPermintaan::className(), ['varietas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::className(), ['varietas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['varietas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomoditas()
    {
        return $this->hasOne(Komoditas::className(), ['id' => 'komoditas_id']);
    }
}
