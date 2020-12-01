<?php

namespace api\modules\v1\controllers;

use common\models\Category;
use Yii;
use yii\rest\ActiveController;

class CategoryController extends ActiveController
{

    public $modelClass = 'common\models\Category';
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
