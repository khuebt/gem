<?php

namespace app\controllers;

use Yii;
use app\models\User;

use yii\filters\VerbFilter;
use app\controllers\BackendController;

class LoginController extends BackendController
{

    public function actionLogin()
    {
        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new \app\models\LoginForm; 
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
    
        return $this->render('login', [
            'model' => $model,
          
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
