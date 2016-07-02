<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\Html;

class UploadFile extends \yii\base\Model
{

  public $fileupload;
  public $filename;
  public $folder;


  /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fileupload'], 'file', 'skipOnEmpty' => false],
        ];
    }

    public function upload()
    {
        if($this->validate()) {}
    }
}
