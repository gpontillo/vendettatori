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
use app\models\ReportArticleForm;
use app\models\CalculateSourceForm;
use app\models\Notizia;
use app\models\Fonte;
use app\models\Media;
use app\models\ReportMediaForm;
use app\models\Segnalazioni;
use app\models\SegnalazioniSearch;
use yii\web\Request;
use yii\web\UploadedFile;

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
            $this->redirect(['news', 'url' => $model->url]);
        } else
            return $this->render('calculate', [
                'model' => $model,
            ]);
    }

    public function actionNews($url)
    {
        $query = Notizia::find()->where(['link' => $url])->one();
        $news1 = null;
        $news2 = null;

        if ($query == null) {
            $news1 = Notizia::calculateNotizia($url);
            if ($news1->indice_attendibilita === -1) {
                $this->redirect(['report-article', 'url' => $url, 'id' => $news1->id]);
            }
        } else
            $news1 = $query;
        if ($news1 != null) {
            if ($news1->indice_attendibilita != -1) {
                $query2 = Notizia::find()->where(['>', 'indice_attendibilita', 50]);
                $query2->andWhere(['<>', 'id', $news1->id]);
                $arguments = [];
                foreach (explode(Notizia::separatorSoggetti, $news1->argomento) as $soggetto) {
                    array_push($arguments, '%' . $soggetto . '%');
                }
                $query2->andWhere(['or like', 'argomento', $arguments, false]);
                $news2 = $query2->one();
            }
            return $this->render('news', [
                'news' => $news1,
                'news2' => $news2,
            ]);
        }
    }

    public function actionCalculateSource()
    {
        $modelSource = new CalculateSourceForm();

        if ($modelSource->load(Yii::$app->request->post()) && $modelSource->validate()) {
            $this->redirect(['source', 'source' => $modelSource->source]);
        }

        return $this->render('calculate-source', [
            'model' => $modelSource,
        ]);
    }

    public function actionSource($source)
    {
        $query = Fonte::find()->where(['nome_fonte' => $source])->one();
        $query2 = null;

        if ($query != null) {
            $query->calcolaIndiceFonte();
            $query2 = Fonte::find()->andFilterCompare('indice_fonte', '>50')->all();
        }

        return $this->render('source', [
            'font' => $query,
            'font2' => $query2
        ]);
    }

    /**
     * Displays similar articles page.
     *
     * @return string
     */
    public function actionSimilarArticles($id, $argument)
    {
        $query2 = Notizia::find()->where(['<>', 'id', $id]);
        $arguments = [];
        foreach (explode('_', $argument) as $soggetto) {
            array_push($arguments, '%' . $soggetto . '%');
        }
        $query2->andWhere(['or like', 'argomento', $arguments, false]);
        $list_news = $query2->all();
        return $this->render('similar-articles', ['list_news' => $list_news]);
    }

    /**
     * Displays report article page.
     *
     * @return Response|string
     */
    public function actionReportArticle()
    {
        $model = new ReportArticleForm();
        $model->url = Yii::$app->request->get('url');
        $model->id_notizia = Yii::$app->request->get('id');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $segnalazione = new Segnalazioni();
            $id = Segnalazioni::find()->max('id');
            if ($id == null)
                $id = 1;
            else
                $id++;
            $segnalazione->id = $id;
            $segnalazione->url = $model->url;
            $segnalazione->motivo = $model->motive;
            $segnalazione->valutazione = $model->review;
            $segnalazione->id_notizia = $model->id_notizia;
            $segnalazione->save();

            return $this->redirect([
                'calculate',
                'success' => true
            ]);
        }
        return $this->render('report-article', [
            'model' => $model,
        ]);
    }




    /**
     * Displays report media page.
     *
     * @return Response|string
     */
    public function actionReportMedia()
    {
        $model = new ReportMediaForm();
        $model->url = Yii::$app->request->get('url');
        $model->id_notizia = Yii::$app->request->get('id');

        if ($model->load(Yii::$app->request->post())) {
            $model->media = UploadedFile::getInstance($model, 'media');
            if ($model->upload()) {
                $segnalazione = new Segnalazioni();
                $id = Segnalazioni::find()->max('id');
                if ($id == null)
                    $id = 1;
                else
                    $id++;
                $segnalazione->id = $id;
                $segnalazione->url = $model->url;
                $segnalazione->motivo = $model->motive;
                $segnalazione->valutazione = -1;
                $segnalazione->media_path = $model->getMediaPath();
                $segnalazione->id_notizia = $model->id_notizia;
                $segnalazione->save();

                return $this->redirect([
                    'calculate',
                    'success' => true
                ]);
            }
        }
        return $this->render('report-media', [
            'model' => $model,
        ]);
    }

    /**
     * Displays media page.
     *
     * @return string
     */
    public function actionMedia($id)
    {
        $media = Media::find()->where(['id' => $id])->one();
        $typeOfMedia = 0;
        if ($media->isImage($media->estensione))
            $typeOfMedia = 1;
        else if ($media->isAudio($media->estensione))
            $typeOfMedia = 2;
        else if ($media->isVideo($media->estensione))
            $typeOfMedia = 3;
        if ($media != null)
            $notizie = $media->retriveNews($media->id);
        return $this->render('media', ['model' => $media, 'news' => $notizie, 'tipo' => $typeOfMedia]);
    }
}
