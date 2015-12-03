<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\UserIdentity;
/**
 * LoginForm is the model behind the login form.
 */
class DangnhapForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public $_Identity;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
  public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
      public function kiemtra($username,$password){
        $code = User::find()->where(['username'=>$username,'password'=>$password])->count();
        if ($code==1){
            return true;
        }else { 
            return false; 
        }  
    }
    public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->username,$this->password);
		if (!$this->_identity->authenticate()) {
            $this->addError('password', 'Incorrect username or password.');
        }
    }
    
}
