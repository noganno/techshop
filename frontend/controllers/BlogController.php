<?php


namespace frontend\controllers;


use backend\modules\postmanager\models\Discount;
use backend\modules\postmanager\models\News;
use backend\modules\postmanager\models\Review;
use yii\web\Controller;

class BlogController extends Controller
{

    public function actionAllNews()
    {
        $news = News::find()->active()->recently()->published()->paginate(12);
        return  $this->render('allNews', compact('news'));
    }

    public function actionNews($id='')
    {
        $model = News::find()->where(['slug' => $id])->one();
        if ($model == null){
            not_found();
        }
        return $this->render('newsDetail', ['model' => $model]);
    }

    public function actionReviews()
    {
        $reviews = Review::find()->active()->recently()->published()->paginate(12);
        return  $this->render('reviews', compact('reviews'));
    }

    public function actionReview($id='')
    {
        $model = Review::find()->active()->published()->where(['slug' => $id])->one();
        if ($model == null){
            not_found();
        }
        return $this->render('reviewDetail', ['model' => $model]);
    }


     public function actionDiscounts()
    {
        $discounts = Discount::find()->active()->recently()->paginate(12);
        return  $this->render('discounts', compact('discounts'));
    }

    public function actionDiscount($id='')
    {
        $model = Discount::find()->active()->where(['slug' => $id])->one();
        if ($model == null){
            not_found();
        }
        return $this->render('discountDetail', ['model' => $model]);
    }

}