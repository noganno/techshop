<?php

namespace soft\web;
use Yii;
/**
 * Controller va View uchun qo'shimcha metodlar
 * */

trait VCTrait
{
    # <editor-fold desc="Request" defaultstate="collapsed">
    public  function getRequest(){
        return Yii::$app->getRequest();
    }

    public function post($name = null, $defaultValue = null){
        return Yii::$app->request->post($name, $defaultValue);
    }
    public function getIsAjax(){

        return $this->request->isAjax;
    }
    # </editor-fold>

    # <editor-fold defaultstate="collapsed" desc="Response">

    public function getResponse(){
        return Yii::$app->getResponse();
    }

    public  function getFormatJson(){
        $this->getResponse()->format = 'json';
    }
// </editor-fold>

    # <editor-fold defaultstate="collapsed" desc="Model">
    

    public function modelSave(&$model){
        return $model->load($this->post()) && $model->save();
    }

    public function modelValidate(&$model){
        return $model->load($this->post()) && $model->validate();
    }
    # </editor-fold>
  
    # <editor-fold defaultstate="collapsed" desc="View">

    /**
     * Set breadbrumbs for view
     * @param array $breadcrumbs links for Breadcrumb widget
     * */
    public  function setBreadcrumbs($breadcrumbs=[])
    {
        foreach ($breadcrumbs as $breadcrumb) {
            Yii::$app->view->params['breadcrumbs'][] = $breadcrumb;
        }
    }
    # </editor-fold>

    # <editor-fold defaultstate="collapsed" desc="User">

    public function getUser()
    {
        return Yii::$app->user;
    }

    public function getHasUser()
    {
        return !(Yii::$app->user->isGuest);
    }
    # </editor-fold>

    # <editor-fold defaultstate="collapsed" desc="Session">

    public function getSession()
    {
        return Yii::$app->session;
    }

    public function setFlash($key, $value = true, $removeAfterAccess = true)
    {
       $this->getSession()->setFlash($key, $value, $removeAfterAccess);
    }

    public function getFlash($key, $defaultValue = null, $delete = false)
    {
        return $this->getSession()->getFlash($key, $defaultValue, $delete);
    }
    # </editor-fold>


}