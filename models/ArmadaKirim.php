<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "armada_kirim".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property string $status
 * @property integer $proposal_id
 * @property integer $lapak_proses_id
 * @property integer $pasar_tag_id
 * @property string $kode_kiriman
 * @property string $no_armada
 * @property string $no_polisi
 * @property string $pengemudi
 * @property string $keterangan
 *
 * @property LapakProses $lapakProses
 * @property PasarTag $pasarTag
 * @property Proposal $proposal
 * @property ArmadaTracking[] $armadaTrackings
 */
class ArmadaKirim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'armada_kirim';
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
            [['user_id', 'proposal_id', 'lapak_proses_id', 'pasar_tag_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['status', 'keterangan'], 'string'],
            [['proposal_id', 'lapak_proses_id', 'pasar_tag_id', 'no_polisi', 'pengemudi'], 'required'],
            [['kode_kiriman', 'no_armada', 'pengemudi'], 'string', 'max' => 100],
            [['no_polisi'], 'string', 'max' => 45],
            [['lapak_proses_id'], 'exist', 'skipOnError' => true, 'targetClass' => LapakProses::className(), 'targetAttribute' => ['lapak_proses_id' => 'id']],
            [['pasar_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => PasarTag::className(), 'targetAttribute' => ['pasar_tag_id' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
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
            'status' => 'Status',
            'proposal_id' => 'No. Proposal',
            'lapak_proses_id' => 'Lapak',
            'pasar_tag_id' => 'Wilayah',
            'kode_kiriman' => 'Kode Kiriman',
            'no_armada' => 'No Armada',
            'no_polisi' => 'No Polisi',
            'pengemudi' => 'Nama Pengemudi',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLapakProses()
    {
        return $this->hasOne(LapakProses::className(), ['id' => 'lapak_proses_id']);
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
    public function getProposal()
    {
        return $this->hasOne(Proposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmadaTrackings()
    {
        return $this->hasMany(ArmadaTracking::className(), ['armada_kirim_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalNo()
    {
        $modelProposal = \app\models\Proposal::find()->where(['setuju_status'=>'{"BGR":"Setuju","ABMI":"Setuju","PPI":"Setuju"}'])->asArray()->all();
        return ArrayHelper::map($modelProposal, 'id', 'no_proposal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProseslapak()
    {
        // Output Label: id - bobot_muat_kg - jumlah_karung
        $modelProsesLapak = \app\models\LapakProses::find()->where(['status'=>0])->all();

        $model = [];
        foreach ($modelProsesLapak as $key => $value) {
            $model = [$value['id'] => 'ID: '.$value['id'].' - Bobot: '.$value['bobot_muat_kg'].' Kg - Jml: '.$value['jumlah_karung'].' Karung'];
        }

        return $model;
    }
}
