<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ApprovalBgrForm extends Model
{
    public $biaya_kirim;
    public $setuju_status;
    public $setuju_alasan;
    public $setuju_berkas;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['biaya_kirim', 'setuju_status'], 'required'],
            [['biaya_kirim', 'setuju_status', 'setuju_alasan', 'setuju_berkas'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'biaya_kirim' => 'Biaya Kirim (Rp)',
            'setuju_status' => 'Status',
            'setuju_alasan' => 'Alasan',
            'setuju_berkas' => 'Berkas',
        ];
    }
}
