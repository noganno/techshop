<?php

namespace soft\components;

use Yii;
use backend\models\Field;
use yii\base\Model;


class Site extends Model
{
	public function siteLogo(){

	}

	public function getValue($url = ''){

		$model = Field::find()->where(['url' => $url])->one();
		if($model == NULL){ 	
			return ''; 	
		}
		else{ 
			return $model->value; 
		}
	}

	public function getValueById($id = ''){

		$model = Field::findOne($id);
		if($model == NULL){ 	return ''; 	}
		else{ return $model->value; }
	}

	public function getTel(){
		$model = Field::find()->where(['type' => 'Tel', 'status' => 'Faol'])->all();
		if($model == NULL){ 	return ''; 	}
		else{ 
			$tel = '';
			foreach ($model as $m) {
				$tel .= $m->value."<br>";
			}
			return $tel;
		 }
	}

	public function getTitle()
	{
		return 'aman - '. t('Furniture trade center');
	}

	public function getDescription()
	{
		return static::getValue('site_description');
	}

	public function getKeywords()
	{
		return static::getValue('site_keywords');
	}

	public function getLogo()
	{
		return static::getValue('site_logo');
	}

	public function getFavicon()
	{
		$icon = static::getValue('favicon');
		$favicon = '<link rel="shortcut icon" href="'.$icon.'">';
		return $favicon;
	}

}
