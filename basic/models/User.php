<?php

namespace app\models;

use \yii\db\ActiveRecord;
use Yii;
use \yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 *
 * @property Category $category
 * @property Product[] $products
 */
class User extends ActiveRecord implements IdentityInterface
{
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
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_id' => 'user_id']);
    }
    
    public function validatePassword($pass)
    {
        $thucte= $this->password;
        return Yii::$app->security->compareString($pass, $thucte);
    }
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id]);
    }
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {  
    }
    public function getAuthKey()
    {}
    public function validateAuthKey($authKey) 
    {}
     
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getEmail()  
    {
        return $this->email;
    }
    public function validateEmail($pass)
    {
        $thucte= $this->email;
        return Yii::$app->security->compareString($pass, $thucte);
    }
}
