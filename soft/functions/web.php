<?php

	function request(){

		return Yii::$app->request;

	}



function not_found($message = null)
{
    if ($message == null) {
        $message = t('Page not found.', 'yii');
    }

    throw new \yii\web\NotFoundHttpException($message);
}

function forbidden($message = null)
{
    if ($message == null) {
        $message = t('You are not allowed to perform this action!', 'yii');
    }

    throw new \yii\web\ForbiddenHttpException($message);
}