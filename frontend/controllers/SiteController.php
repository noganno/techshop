<?php

namespace frontend\controllers;

use common\models\Mytable;
use common\models\Page;
use common\models\Product;
use common\models\Towns;
use frontend\models\CategoryWithBehavior;
use frontend\models\ContactForm;
use frontend\models\LoginForm;
use frontend\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
//            'filter' => [
//                'class' => 'yii\filters\PageCache',
//                'except'=>['login'],
////                'only' => ['index'],
//                'duration' => Yii::$app->params['pageCache'],
//                'variations' => [
//                    \Yii::$app->language,
//                ],
//                'dependency' => [
//                    'class' => 'yii\caching\DbDependency',
//                    'sql' => 'SELECT COUNT(*) FROM product',
//                ],
//            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
                    'logout' => ['get'],
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

    // ACTIONS =============================================================

    public function actionSkladMap()
    {

        $regions = Towns::find()
            ->joinWith('sklads')
            ->andWhere(['towns.status' => 1])
            ->all();

        return $this->render('map', [
            'regions' => $regions
        ]);
    }


    public function actionCacheFlush()
    {
        Yii::$app->cache->flush();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionIndex()
    {
//        Yii::$app->cache->flush();


        return $this->render('index');
    }

    /**
     * @param $id string page identificator
     */
    public function actionPage($id)
    {

        $model = Page::find()->where(['idn' => $id])->one();
        if ($model == null) {
            not_found();
        }
        if ($model->status != 1) {

            if (Yii::$app->user->isGuest || !Yii::$app->user->identity->is_worker) {
                not_found();
            }
        }
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->username = Yii::$app->help->clearPhoneNumber($model->username);
            if ($model->validate()) {
                if ($model->login()) {
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    // Syncronize base ==================================================================
    public function actionSync()
    {

        $products = Mytable::find()->all();
        foreach ($products as $product) {
            $newProduct = new Product();
            $newProduct->name_ru = $product->name;
            $newProduct->status = 0;
            $newProduct->quantity = $product->qty;
            $newProduct->loan_price = $product->loan_price;
            $newProduct->price = $product->price;
            $newProduct->save();
        }

    }

    // Syncronize base ==================================================================


    public function actionSelectRegion()

    {

        $id = $this->request->get('id');


        $region = Towns::find()->where(['id' => $id, 'status' => 1])->one();

        if ($region == null) {

            $region = Towns::find()->one();

        }


        Yii::$app->session->set('_activeRegion', $region);

        // get the cookie collection (yii\web\CookieCollection) from the "response" component

        $cookies = Yii::$app->response->cookies;


        // add a new cookie to the response to be sent

        $cookies->add(new \yii\web\Cookie([

            'name' => 'selectedRegionId',

            'value' => $region->id,

            'expire' => time() + 30 * 86400,

        ]));


        return $this->redirect($this->request->referrer);


    }


    public function actionTest()
    {
        Yii::$app->name = "Texnomart";

        $mail = new Yii::$app->emailer();
        $mail->setFrom("isxoqjon_7710@mail.ru");
        $mail->setTo("isxoqjon_7710@mail.ru");
        $mail->setName(Yii::$app->name);
        $mail->setSubject("Texnomart");
        $mail->setHtml($this->renderAjax("@frontend/views/mail/html", [
            'user' => User::findOne(87)
        ]));
        $mail->sendMail();

        dd($mail);
    }

    public function actionCatalog()
    {


        $category = CategoryWithBehavior::findOne(1);
        $subCategories = $category->subCategories;

        return $this->render('catalog', [
            'subCategories' => $subCategories,
            'category' => $category
        ]);
    }

} 