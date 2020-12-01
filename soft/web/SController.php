<?php

namespace soft\web;

use Yii;
use yii\web\Controller;
use soft\helpers\SArray;
use soft\helpers\SUrl;

class SController extends Controller
{
    use VCTrait;

	/**
	 * @return array
	*/

	public function modal($options=[]){
        
            $request = Yii::$app->request;
            $model = $options['model'];
            $params = SArray::getValue($options, 'params', []); 
            $view = SArray::getValue($options, 'view', '@forms/general_form'); 
            $title = SArray::getValue($options, 'title', null);
            if ($title == null) {
                $title = $model->isNewRecord ? "Yangi qo'shish" : "Tahrirlash";
            }
            $footer = SArray::getValue($options, 'footer', Yii::$app->help->modalFooter);

         if($request->isAjax){

            /**
             * Ajax process
            */
            $this->formatJson;

            if($this->modelSave($model)){
            	return ['forceReload'=>'#crud-datatable-pjax', 'forceClose' => true];
            }
            else{
                $params['model'] = $model;
                $content = $this->renderAjax($view, $params);
                return [
                    'title'=> $title,
                    'content'=> $content,
                    'footer'=> $footer,
                ];    
            }
        }else{

        	/**
        	 * Non Ajax
        	*/

        	if ($this->modelSave($model)) {
         	   return $this->redirect(SUrl::previous());
        	}
        	else {
                    $params['model'] = $model;
                    $this->view->title = $title;
                    SUrl::remember($request->referrer);
                    return $this->render($view, $params);
        	}
        	
        }
	        
	}

    public function back()
    {
        return $this->redirect($this->request->referrer);
	}

}
	