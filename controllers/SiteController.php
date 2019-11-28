<?php

namespace app\controllers;

use app\models\PlayForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Item;
use app\models\Money;
use app\models\Bonus;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

	public function actionPlay()
	{
		if (Yii::$app->user->isGuest) {
			return $this->goHome();
        }
        $userId = Yii::$app->user->getId();
		$form = new PlayForm();
		$connection = \Yii::$app->db;
		$connection->open();
		$command = $connection->createCommand('SELECT * FROM user_money');
		$posts = $command->queryAll();


		if (Yii::$app->request->isAjax) {
            $priseType = rand(1,3);


            switch ($priseType) {
                case 1:
                    $moneyAmount = rand(1,1000);
                    Yii::$app->db->createCommand('UPDATE `user_money` set `amount` = `amount` + '.$moneyAmount.' WHERE user_id = '.$userId);
                    return 'Money '.$moneyAmount;
                break;
                case 2:
                    $bonusAmount = rand(1,1000);
                    Yii::$app->db->createCommand('UPDATE `user_bonus` set `amount` = `amount` + '.$bonusAmount.' WHERE user_id = '.$userId);
                    return 'Bonus '.$bonusAmount;
                break;
                case 3:
                try{
                    $item = Yii::$app->db->createCommand('SELECT `title` FROM `items` ORDER BY RAND()')
                        ->queryOne();
                } catch (Exception $e) {
                	die($e->getMessage());
                    return $e->getMessage();
                }
                    return $item;
                break;
            }
		
		} else {
			return $this->render('play_form', ['form' => $form]);
		}
    }
    
    public function actionSave()
	{
        return "";
    }
}
