<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CalculateForm;
use app\models\Notizia;
use yii\web\Request;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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

    /**
     * Displays calculate page.
     *
     * @return Response|string
     */
    public function actionCalculate()
    {
        $model = new CalculateForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // ricerca su db dell'url
            
            $query = Notizia::find()->where(['link' => $model->url ])->one();
            $query2 = Notizia::find()->where(['tipo_categoria' => $query->tipo_categoria])->andWhere(['>', 'indice_attendibilita', 50])->one();
                   
            //if(!$query)
            //{
            //    return $this->render('insert-news');
            //}
            // se non c'è aggiungi notizia
            
            $news = new Notizia(); //prima c'era News()
            return $this->render('calculate-confirm', [
                'news' => $query,
                'news2' => $query2,
            ]);
        }
        return $this->render('calculate', [
            'model' => $model,
        ]);
    }

    /**
     * Displays similar articles page.
     *
     * @return string
     */
    public function actionSimilarArticles($argument)
    {
        $list_news = Notizia::find()->where(['tipo_categoria' => $argument])->orderBy(['indice_attendibilita' => SORT_ASC])->all();
        return $this->render('similar-articles', ['list_news' => $list_news]);
    }

}
