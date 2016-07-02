<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ApprovalAbmiForm extends Model
{
    public $est_harga_jual;
    public $setuju_status;
    public $setuju_alasan;
    public $setuju_berkas;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['est_harga_jual', 'setuju_status'], 'required'],
            [['est_harga_jual', 'setuju_status', 'setuju_alasan', 'setuju_berkas'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'est_harga_jual' => 'Est. Harga Jual(Rp)',
            'setuju_status' => 'Status',
            'setuju_alasan' => 'Alasan',
            'setuju_berkas' => 'Berkas',
        ];
    }
}
