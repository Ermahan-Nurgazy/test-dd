<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $email
 * @property string $city
 * @property string $address
 * @property string $auth_key
 * @property string $password_hash
 * @property string $access_token
 * @property string $access_token_expire
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['email', 'email'],
            [['access_token', 'access_token_expire'], 'safe'],
        ];
    }


    /**
     * @param int $id
     * @return static|null
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param int $id
     * @return static|null
     */
    public static function findById($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @param mixed $token
     * @param $type
     * @return static|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->andWhere(['access_token' => $token])
            ->andWhere(['>=', 'access_token_expire', date('Y-m-d H:i:s')])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates access token
     */
    public function generateAccessToken()
    {
        $token = md5(Yii::$app->security->generateRandomString());
        if (static::findOne(['access_token' => $token])) {
            $this->generateAccessToken();
        }

        $this->access_token = $token;
        $this->access_token_expire = date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 365);
    }

    /**
     * @inheritdoc
     */
    public function getAccessToken()
    {
        if (!$this->access_token || $this->access_token_expire <= date('Y-m-d H:i:s')) {
            $this->generateAccessToken();
            $this->save();
        }

        return $this->access_token;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
