<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $first_name
 * @property string $surname
 * @property string $password
 * @property string $email
 * @property string|null $username
 * @property string|null $register_date
 * @property string|null $access_token
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'surname', 'password', 'email','username'], 'required'],
            [['email'],'email'],
            [['email'],'unique','message'=>'E-mail must be unique'],
            [['username'],'unique','message'=>'Username must be unique'],
            [['register_date'], 'safe'],
            [['first_name', 'surname', 'email'], 'string', 'max' => 50],
            [['password', 'access_token'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'surname' => 'Surname',
            'password' => 'Password',
            'email' => 'Email',
            'username' => 'Username',
            'register_date' => 'Register Date',
            'access_token' => 'Access Token',
        ];
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token'=>$token]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){

    }


    public function validateAuthKey($authKey){

    }


    public static function findByUsername($username){
        return static::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }

}
