<?php

namespace frontend\modules\mobile\controllers;

use yii\web\Controller;
use common\models\Slider;
use Yii;
/**
 * Default controller for the `mobile` module
 */
class DefaultController extends Controller
{

    public function init()
    {
        parent::init();
        Yii::$app->response->format = 'json';
    }

    public function actionSlider()
    {
        $temp_slider = Slider::find()->one();
        return $temp_slider->getImages();
    }

}
