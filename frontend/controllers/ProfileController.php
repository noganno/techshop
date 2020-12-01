<?php


namespace frontend\controllers;

use common\models\Order;
use frontend\models\UpdatePersonalDataForm;
use soft\web\SController;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;

class ProfileController extends SController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    public function actionPersonalData()
    {
        $model = UpdatePersonalDataForm::createUserModel();
        $model->scenario = 'updatePassword';
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            $model = UpdatePersonalDataForm::createUserModel();
            $this->setFlash('success', t('Your data has been successfully updated'));
        }

        return $this->render('personalData', [
            'model' => $model,
        ]);
    }

    public function actionCreditHistory()
    {
        $guid = Yii::$app->user->identity->guid;

        $history = Yii::$app->c1->getUserInfo($guid)->data;

//        dd($history);

        $provider = new ArrayDataProvider([
            'allModels' => $history['info'][2],
            'sort' => [
                'attributes' => ['id', 'ContractNumber','MonthlyCredit', 'DebtTotal','ContractDate','Status','Sum','PaymentsList'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
// get the posts in the current page
//        $posts = $provider->getModels();
//        dd($posts);
        return $this->render('history', [
            'history' => $history,
            'dataProvider' => $provider
        ]);
    }


    public function actionOrderHistory()
    {
//        $guid = Yii::$app->user->identity->guid;

//        $history = Yii::$app->c1->getUserInfo($guid)->data;

//        dd($history);

        $orders = Order::findAll(['user_id' => Yii::$app->user->identity->id]);


        return $this->render('orderHistory', [
            'orders' => $orders
        ]);
    }

    public function actionIndex()
    {
        $guid = Yii::$app->user->identity->guid;

        $history = Yii::$app->c1->getUserInfo($guid)->data;

//        dd($history);

        $countProducts = 0;

        foreach ($history['info'][2] ? $history['info'][2] : [] as $dogovor) {
            $countProducts += count($dogovor['GoodsList']);
        }


        $first_name = Yii::$app->user->identity->surname ? Yii::$app->user->identity->surname : t('Not inserted');
        $last_name = Yii::$app->user->identity->name ? Yii::$app->user->identity->name : t('Not inserted');
        $phone = Yii::$app->user->identity->phone ? Yii::$app->user->identity->phone : t('Not inserted');

        //        $fio =
//

        return $this->render('index', [
            'countProducts' => $countProducts,
            'history' => $history,
            'fio' => $last_name . " " . $first_name,
            'phone' => $phone,
//            'fio'=>$last_name . " ". $first_name,
        ]);
    }

    public function actionMoiPokupki()
    {
        $guid = Yii::$app->user->identity->guid;

        $history = Yii::$app->c1->getUserInfo($guid)->data;

//        dd($history);

        $countProducts = 0;

        foreach ($history['info'][2] ? $history['info'][2] : [] as $dogovor) {
            $countProducts += count($dogovor['GoodsList']);
        }


        $first_name = Yii::$app->user->identity->surname ? Yii::$app->user->identity->surname : t('Not inserted');
        $last_name = Yii::$app->user->identity->name ? Yii::$app->user->identity->name : t('Not inserted');
        $phone = Yii::$app->user->identity->phone ? Yii::$app->user->identity->phone : t('Not inserted');

        //        $fio =
//

        return $this->render('moipokupki', [
            'countProducts' => $countProducts,
            'history' => $history,
            'fio' => $last_name . " " . $first_name,
            'phone' => $phone,
//            'fio'=>$last_name . " ". $first_name,
        ]);
    }


}