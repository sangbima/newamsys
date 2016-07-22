<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lapak_karung".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $lapak_proses_id
 * @property string $bobot_kg
 */
class LapakKarung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lapak_karung';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'lapak_proses_id'], 'integer'],
            [['lapak_proses_id', 'bobot_kg'], 'required'],
            [['bobot_kg'], 'number'],
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
            'lapak_proses_id' => 'Lapak Proses ID',
            'bobot_kg' => 'Bobot Kg',
        ];
    }
}
