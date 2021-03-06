<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Orders;
use app\models\Dishes;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
        $orders = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $orders->limit(5),
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => false
        ]);

        $mostPopularDishes = Dishes::getMostPopular();

        $dataProviderDishes = new ActiveDataProvider([
            'query' => $mostPopularDishes->limit(5)->orderBy(['orders_count' => SORT_DESC]),
            'pagination' => false
        ]);

        $sumOrders = Orders::getAllOrdersSum();

        $dataProviderDaySell = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $sumOrders,
            'sort' => [
                'attributes' => ['id', 'sum'],
            ]]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProviderDishes' => $dataProviderDishes,
            'dataProviderDaySell' => $dataProviderDaySell
        ]);
    }

    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
