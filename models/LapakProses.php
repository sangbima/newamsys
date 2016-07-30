<?php

namespace app\models;

use Yii;
use app\models\Proposal;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lapak_proses".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property integer $proposal_id
 * @property string $bobot_muat_kg
 * @property integer $jumlah_karung
 * @property string $keterangan
 * @property boolean $status
 *
 * @property ArmadaKirim[] $armadaKirims
 */
class LapakProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lapak_proses';
    }

    /**
     * @inheritdoc
     */

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
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'proposal_id', 'jumlah_karung', 'status'], 'integer'],
            [['latitude', 'longitude', 'bobot_muat_kg'], 'number'],
            [['proposal_id'], 'required'],
            [['keterangan'], 'string'],
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
            'proposal_id' => 'No. Proposal',
            'bobot_muat_kg' => 'Bobot Muat (Kg)',
            'jumlah_karung' => 'Jumlah Karung',
            'keterangan' => 'Keterangan',
        ];
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
    public function getLapakKarungs()
    {
        return $this->hasMany(LapakKarung::className(), ['lapak_proses_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmadaKirims()
    {
        return $this->hasMany(ArmadaKirim::className(), ['lapak_proses_id' => 'id']);
    }

    public function getProposalNo()
    {
        $modelProposal = \app\models\Proposal::find()->where(['setuju_status'=>'{"BGR":"Setuju","ABMI":"Setuju","PPI":"Setuju"}'])->asArray()->all();
        return ArrayHelper::map($modelProposal, 'id', 'no_proposal');
    }
}
