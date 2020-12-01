<?php


namespace soft\widget;

use Yii;
use yii\bootstrap\Html;
use yeesoft\multilingual\assets\FormLanguageSwitcherAsset;

class FormLanguageSwitcher extends \yeesoft\multilingual\widgets\FormLanguageSwitcher
{
    private $_languages;

    public function init()
    {
        if ($this->model->getBehavior('multilingual')) {
            $this->_languages = $this->model->getBehavior('multilingual')->languages;
        }

        parent::init();
    }

    public function run()
    {
        FormLanguageSwitcherAsset::register(Yii::$app->view);
        echo $this->renderNavs();
    }

    public function renderNavs()
    {

        $navs = '';
        if (count($this->_languages) > 1){

            foreach ($this->_languages as $key => $value){
                $class = (Yii::$app->language === $key) ? 'nav-link active' : 'nav-link';
                $a = Html::a($value, "#{$key}", [
                    'data-lang' => $key,
                    'data-toggle' => 'pill',
                    'class' => $class,
                    'role'=>"tab",
                    'aria-controls'=>"pills-home"
                ]);
                $navs .= Html::tag('li', $a, ['class' => 'nav-item'] );
            }

            $navs = Html::tag('ul', $navs, ['class' => 'nav nav-pills form-language-switcher pull-right' , 'role' => 'tablist' ]);
        }

        return $navs;

    }

}