<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "armada_tracking".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property integer $armada_kirim_id
 *
 * @property ArmadaKirim $armadaKirim
 */
class ArmadaTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'armada_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'armada_kirim_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['armada_kirim_id'], 'required'],
            [['armada_kirim_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArmadaKirim::className(), 'targetAttribute' => ['armada_kirim_id' => 'id']],
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
            'armada_kirim_id' => 'Armada Kirim ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmadaKirim()
    {
        return $this->hasOne(ArmadaKirim::className(), ['id' => 'armada_kirim_id']);
    }
}
