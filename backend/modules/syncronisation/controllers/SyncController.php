<?php

namespace backend\modules\syncronisation\controllers;

use common\models\Sklad;
use yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


/**
 * Default controller for the `syncronisation` module
 */
class SyncController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionGetSklads()
    {

        $sklads = Yii::$app->c1->getSklads();

        $oldSklads = Sklad::find()->asArray()->all();


//        $a1 = (ArrayHelper::getColumn(json_decode($sklads), 'УникальныйИдентификатор'));
//        $a2 = (ArrayHelper::getColumn($oldSklads, 'unique_id'));
//
//        dump($a1);
//        dump($a2);
//
//        $updated = (array_intersect($a1, $a2));
//
//        dd($updated);

//        Sklad::deleteAll(['NOT IN', 'unique_id', $updated]);

        return $this->render('sklads', [
            'sklads' => json_decode($sklads),
            'oldSklads' => $oldSklads
        ]);
    }

    public function actionGetRegions()
    {

        $regions = Yii::$app->c1->getSkladRegions();

//        $oldSklads = Sklad::find()->all();


        return $this->render('regions', [
            'regions' => json_decode($regions),
        ]);
    }

    public function actionGetProducts()
    {

        $sklads = Yii::$app->c1->getSklads();

        $oldSklads = Sklad::find()->all();


        return $this->render('product', [
            'sklads' => json_decode($sklads),
            'oldSklads' => $oldSklads
        ]);
    }


}
