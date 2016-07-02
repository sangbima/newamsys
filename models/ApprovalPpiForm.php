<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ApprovalPpiForm extends Model
{
    public $setuju_status;
    public $setuju_alasan;
    public $setuju_berkas;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['setuju_status'], 'required'],
            [['setuju_status', 'setuju_alasan', 'setuju_berkas'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'setuju_status' => 'Status',
            'setuju_alasan' => 'Alasan',
            'setuju_berkas' => 'Berkas',
        ];
    }
}
