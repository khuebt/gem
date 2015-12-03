<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
public $username;
public $password;
public $email;
public $rememberMe = true;

private $_user = false;

/**
 * @return array the validation rules.
 */
public function rules()
{
    return [
        // username and password are both required
        [['username', 'password','email'], 'required','message'=>'bắt buộc, ko dc để trống'],
        ['username','string','min'=>3],
        ['password','string','min'=>6],
        // rememberMe must be a boolean value
        ['rememberMe', 'boolean'],
        // password is validated by validatePassword()
        ['password', 'validateInfo'],
        ['email','email'],
        ['email','validateInfo'],
        
         
       
         
    ];
}

/**
 * Validates the password.
 * This method serves as the inline validation for password.
 *
 * @param string $attribute the attribute currently being validated
 * @param array $params the additional name-value pairs given in the rule
 */
 public function validateInfo($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)||!$user->validateEmail($this->email)) {
                $this->addError($attribute, 'Incorrect username or password or email.');
            }
        }
    }

/**
 * Logs in a user using the provided username and password.
 * @return boolean whether the user is logged in successfully
 */
public function login()
{
    if ($this->validate()) {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
    } else {
        return false;
    }
}

 
public function getUser()
{
    if ($this->_user === false) {
        $this->_user = User::findByUsername($this->username);
    }
    return $this->_user;
}
}
