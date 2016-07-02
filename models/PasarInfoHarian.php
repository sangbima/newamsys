<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "pasar_info_harian".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property integer $pasar_id
 * @property integer $komoditas_id
 * @property integer $varietas_id
 * @property string $harga_jual_kg
 * @property string $keterangan
 *
 * @property Komoditas $komoditas
 * @property Pasar $pasar
 * @property Varietas $varietas
 */
class PasarInfoHarian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasar_info_harian';
    }

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
            [['user_id', 'pasar_id', 'komoditas_id', 'varietas_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['pasar_id', 'komoditas_id', 'harga_jual_kg'], 'required'],
            [['keterangan', 'harga_jual_kg'], 'string'],
            [['komoditas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['komoditas_id' => 'id']],
            [['pasar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pasar::className(), 'targetAttribute' => ['pasar_id' => 'id']],
            [['varietas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Varietas::className(), 'targetAttribute' => ['varietas_id' => 'id']],
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
            'pasar_id' => 'Pasar',
            'komoditas_id' => 'Komoditas',
            'varietas_id' => 'Varietas',
            'harga_jual_kg' => 'Harga Jual/Kg (Rp)',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomoditas()
    {
        return $this->hasOne(Komoditas::className(), ['id' => 'komoditas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasar()
    {
        return $this->hasOne(Pasar::className(), ['id' => 'pasar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVarietas()
    {
        return $this->hasOne(Varietas::className(), ['id' => 'varietas_id']);
    }
}
