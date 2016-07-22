<?php

namespace app\models;

use Yii;

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
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'proposal_id', 'jumlah_karung'], 'integer'],
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
            'proposal_id' => 'Proposal ID',
            'bobot_muat_kg' => 'Bobot Muat Kg',
            'jumlah_karung' => 'Jumlah Karung',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmadaKirims()
    {
        return $this->hasMany(ArmadaKirim::className(), ['lapak_proses_id' => 'id']);
    }
}
