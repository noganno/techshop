<?php

namespace api\modules\v1\controllers;

use common\models\Slider;
use yii\rest\ActiveController;

class SliderController extends ActiveController
{
    public $modelClass = 'common\models\Slider';

    public function actions()

    {

        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    public function actionIndex()
    {
        $slider = [];
        $temp_slider = Slider::find()->one();

        // $slider['images'] = $temp_slider->getImages();
        return $temp_slider->getImages();
    }
}
