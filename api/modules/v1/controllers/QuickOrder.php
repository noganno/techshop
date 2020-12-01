<?php

namespace api\modules\v1\controllers;

use common\models\Category;
use Yii;
use yii\rest\ActiveController;

class QuickOrderController extends ActiveController
{

    public $modelClass = 'common\models\QuichOrder';
    public function actions()

    {

        $actions = parent::actions();


        unset($actions['index']);

        return $actions;
    }

    public function actionIndex($lang)

    {   
       return Category::mainCategories($lang);
    }

    public function actionList($category_id,$lang)
    {   

       return Category::listSubCategories($category_id,$lang);
    }
}
