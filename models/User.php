<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\helpers\Security;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $fullname
 * @property integer $status
 * @property string $tanda_setuju
 * @property string $tanda_tolak
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public $newpassword, $newPasswordConfirm, $editPassword, $editPasswordConfirm;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        /*return [
            TimestampBehavior::className(),
        ];*/

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
            [['user_id', 'status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            // [['username', 'auth_key', 'password_hash', 'fullname', 'status'], 'required'],
            [['username', 'email', 'fullname'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Username ini sudah ada, silahkan cari yang lain.'],
            ['username', 'string', 'min' => 5, 'max' => 50],
            [['auth_key', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email', 'fullname'], 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Email ini sudah ada, silahkan cari yang lain.'],
            [['tanda_setuju', 'tanda_tolak'], 'string', 'max' => 45],
            [['editPassword', 'editPasswordConfirm', 'newpassword', 'newPasswordConfirm'], 'string', 'min' => 6, 'max' => 100],
            [['editPassword', 'editPasswordConfirm', 'newpassword', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],
            [['newpassword'], 'required'],
            [['newpassword', 'newPasswordConfirm'], 'required', 'when' => function ($model) {
				return (!empty($model->newpassword));
			}, 'whenClient' => "function (attribute, value) {
                return ($('#user-newpassword').val().length>0);
            }"],
            [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'newpassword', 'message' => 'Password tidak sama'],
            [['editPasswordConfirm'], 'compare', 'compareAttribute' => 'editPassword', 'message' => 'Password tidak sama'],
        ];
    }

    // public function scenarios()
	// {
	// 	$scenarios = parent::scenarios();
	// 	$scenarios['password'] = ['newpassword', 'newPasswordConfirm'];
	// 	return $scenarios;
	// }

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
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'fullname' => 'Fullname',
            'status' => 'Status',
            'tanda_setuju' => 'Tanda Setuju',
            'tanda_tolak' => 'Tanda Tolak',
            'newpassword' => 'Password',
            'newPasswordConfirm' => 'Ulangi Password',
            'editPassword' => 'Password Baru',
            'editPasswordConfirm' => 'Ulangi Password',
        ];
    }

    /**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRoles()
	{
		return $this->hasMany(AuthAssignment::className(), [
			'user_id' => 'id',
		]);
	}

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // return static::findOne(['access_token' => $token]);
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
      $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
      $this->password_reset_token = null;
    }
}
