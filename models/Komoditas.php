<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "komoditas".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $nama
 * @property string $keterangan
 * @property string $penanggungjawab
 *
 * @property JenisBobotKering[] $jenisBobotKerings
 * @property PasarInfoHarian[] $pasarInfoHarians
 * @property PasarPermintaan[] $pasarPermintaans
 * @property Proposal[] $proposals
 * @property ProposalHistory[] $proposalHistories
 * @property Varietas[] $varietas
 */
class Komoditas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'komoditas';
    }

    /**
     * @inheritdoc
     */

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

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['nama'], 'required'],
            [['keterangan'], 'string'],
            [['nama'], 'string', 'max' => 100],
            [['penanggungjawab'], 'string', 'max' => 255],
            [['nama'], 'unique'],
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
            'penanggungjawab' => 'Penanggungjawab',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisBobotKerings()
    {
        return $this->hasMany(JenisBobotKering::className(), ['komoditas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasarInfoHarians()
    {
        return $this->hasMany(PasarInfoHarian::className(), ['komoditas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasarPermintaans()
    {
        return $this->hasMany(PasarPermintaan::className(), ['komoditas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::className(), ['komoditas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalHistories()
    {
        return $this->hasMany(ProposalHistory::className(), ['komoditas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVarietas()
    {
        return $this->hasMany(Varietas::className(), ['komoditas_id' => 'id']);
    }
}
