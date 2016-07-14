<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class UserForm extends Model
{
    const STATUS_ACTIVE = 10;
    const STATUS_NONACTIVE = 20;

    public $username;
    public $fullname;
    public $email;
    public $password;
    public $newPasswordConfirm;
    public $status;

    public function rules()
    {
        return [
            [['username', 'fullname'], 'filter', 'filter' => 'trim'],
            [['username', 'fullname'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Username ini sudah ada, silahkan pilih yang lain.'],
            [['username', 'fullname'], 'string', 'min' => 6, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Email ini sudah ada, silahkan pilih yang lain.'],

            [['password', 'status'], 'required'],
            [['password', 'newPasswordConfirm'], 'string', 'min' => 6],
            [['password', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],
            [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'password', 'message' => 'Password tidak sama'],
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'status' => 'Status',
            'password' => 'Password',
            'newPasswordConfirm' => 'Ulangi Password',
            'fullname' => 'Nama Lengkap'
        ];
    }

    // public function validatePassword($password)
    // {
    //     return Yii::$app->security->validatePassword($password, $this->password_hash);
    // }

}
