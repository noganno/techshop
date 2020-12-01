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
                $class = (Yii::$app->language === $key) ? 'pull-left active' : 'pull-left';
                $a = Html::a($value, "#{$key}", [
                    'data-lang' => $key,
                    'data-toggle' => 'pill',
                    'style' => 'height:40px;line-height:35px;font-size:16px!important',
                ]);
                $navs .= Html::tag('li', $a, ['class' => $class, ] );
            }

            $navs = Html::tag('ul', $navs, ['class' => 'nav nav-pills form-language-switcher pull-left' , 'role' => 'tablist', 'style' => 'height:80px' ]);
        }
        $div = Html::tag('div', $navs,  ['class' => 'col-xs-12']);
        return Html::tag('div', $div,  ['class' => 'row']);
    }

} ?>
