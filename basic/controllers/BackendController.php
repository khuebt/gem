<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use app\models\Product;

class BackendController extends \yii\web\Controller {

   
    function beforeAction($action) {
        if (Yii::$app->controller->id != 'login' && $action->id != 'login') {
            if (Yii::$app->user->isGuest) {
                $this->redirect(Yii::$app->urlManager->createUrl('login/login'));
            }
        }
        return parent::beforeAction($action);
    }
    

}
