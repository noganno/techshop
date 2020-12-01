<?php

namespace api\modules\v1\controllers;

use common\models\Category;
use common\models\MobileMainMenu;
use Yii;
use yii\rest\ActiveController;

class MobileMainMenuController extends ActiveController
{

    public $modelClass = 'common\models\MainMobileMenu';
    public function actions()

    {

        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    public function actionIndex($lang)
    {
        Yii::$app->language = $lang;
        $menus = MobileMainMenu::find()->orderBy(['order' =>  SORT_DESC])->all();
        return $menus;
    }

    public function actionList($category_id,$lang)
    {


    }
}
