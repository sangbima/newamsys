<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "pasar_permintaan".
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
 * @property integer $jenis_id
 * @property string $pemesan
 * @property string $kuantitas
 * @property string $harga_minta
 * @property string $tanggal_tiba
 * @property string $keterangan
 *
 * @property Jenis $jenis
 * @property Komoditas $komoditas
 * @property Pasar $pasar
 * @property Varietas $varietas
 */
class PasarPermintaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasar_permintaan';
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
            [['created_at', 'updated_at', 'tanggal_tiba'], 'safe'],
            [['user_id', 'pasar_id', 'komoditas_id', 'varietas_id', 'jenis_id'], 'integer'],
            [['latitude', 'longitude', 'kuantitas'], 'number'],
            [['pasar_id', 'komoditas_id', 'varietas_id', 'pemesan', 'kuantitas', 'harga_minta', 'tanggal_tiba'], 'required'],
            [['keterangan', 'harga_minta'], 'string'],
            [['pemesan'], 'string', 'max' => 150],
            [['jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jenis::className(), 'targetAttribute' => ['jenis_id' => 'id']],
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
            'jenis_id' => 'Jenis',
            'pemesan' => 'Pemesan',
            'kuantitas' => 'Kuantitas (T)',
            'harga_minta' => 'Harga Minta',
            'tanggal_tiba' => 'Tanggal Tiba',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(Jenis::className(), ['id' => 'jenis_id']);
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
