<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Product;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSay($message='Hello')
    {
        return $this->render('say', ['thongdiep'=>$message]);
    }
    public function actionDanhsach()
    {
        $query = Product::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $products = $query->orderBy('product_name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('danhsach', [
            'product' => $products,
            'pagination' => $pagination,
        ]);
    }/*public function actionLogin()
    {
        $model=new DangnhapForm();
        if($model->load(Yii::$app->request->post())){
            $request = Yii::$app->request->post('User');
            $username = $request['username'];
            $password = $request['password'];
            

            if(($model->kiemtra($username, $password)==true)){
                $this->goHome();
                
            }else{
                Yii::$app->session->setFlash('loginFalse');
               // $this->redirect(Yii::$app->request->referrer);
            }
        }
        
        return $this->render('login',[
            'model'=>$model,
        ]);
         
       
    }*/
}
