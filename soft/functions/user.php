<?php


	function can($role = '')
	{
		return Yii::$app->user->can($role);
	}